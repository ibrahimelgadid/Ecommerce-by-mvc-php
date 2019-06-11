<?php 

    class Order extends Controller{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getAllOrder($status=''){
            if($status==''){
                $sql = "";
            }else {
                $sql = "WHERE c_order.status=$status";
            }
           
            $this->db->query("SELECT c_order.*, users.full_name as
            creator, payment.payment_method as method FROM c_order 
            INNER JOIN users ON c_order.customer_id = users.user_id
            INNER JOIN payment ON c_order.payment_id = 
            payment.payment_id
             $sql");
            $orders = $this->db->resultSet();
           if($orders){
               return $orders;
           }else {
               return false;
           }
        }

        public function addToShipping($name,$email,$mobile,$address,$city){
            $this->db->query("INSERT INTO shipping 
            (full_name,email,mobile,address,city)
            VALUES(:full_name,:email,:mobile,:address,:city)");
            $this->db->bind(':full_name',$name);
            $this->db->bind(':email',$email);
            $this->db->bind(':mobile',$mobile);
            $this->db->bind(':address',$address);
            $this->db->bind(':city',$city);
            return $this->db->insertById();
        }

        public function addToPayment($method,$shipping){
            $this->db->query("INSERT INTO payment 
            (payment_method,payment_status,payment_shipping)
            VALUES(:method,0,:payment_shipping)");
            $this->db->bind(':method',$method);
            $this->db->bind(':payment_shipping',$shipping);
            return $this->db->insertById();
        }

    
        public function addToOrder($customer,$shipping,$payment,$total){
            $this->db->query("INSERT INTO c_order (customer_id,shipping_id,
            payment_id,order_status,order_total)
            VALUES(:customer_id,:shipping_id,
            :payment_id,0,:order_total)");
            $this->db->bind(':customer_id',$customer);
            $this->db->bind(':shipping_id',$shipping);
            $this->db->bind(':payment_id',$payment);
            $this->db->bind(':order_total',$total);
            return $this->db->insertById();
        }

        public function addToOrderDetails($order,$product,$product_name,
        $price,$qty,$user){
            $this->db->query("INSERT INTO c_order_details
            (order_id,product_id,
            product_name,product_price,product_qty,user)
            VALUES(:order_id,:product_id,
            :product_name,:product_price,:product_qty,:user)");
            $this->db->bind(':order_id',$order);
            $this->db->bind(':product_id',$product);
            $this->db->bind(':product_name',$product_name);
            $this->db->bind(':product_price',$price);
            $this->db->bind(':product_qty',$qty);
            $this->db->bind(':user',$user);
            $this->db->execute();
        }

        public function show($id){
            $this->db->query("SELECT * FROM c_order 
            WHERE order_id=:order_id");
            $this->db->bind(':order_id',$id);
            return $this->db->single();
        }
        
        public function showShipping($id){
            $this->db->query("SELECT * FROM shipping 
            WHERE shipping_id=:shipping_id");
            $this->db->bind(':shipping_id',$id);
            return $this->db->single();
        }


        public function getAllOrderDetalails($id){
            $this->db->query("SELECT * FROM c_order_details 
            WHERE order_id=:order_id");
            $this->db->bind(':order_id',$id);
            return $this->db->resultSet();
        }

        public function getUserOrderDetalails($user){
            $this->db->query("SELECT * FROM c_order_details 
            WHERE user=:user");
            $this->db->bind(':user',$user);
            return $this->db->resultSet();
        }

        public function delete($id){
            $this->db->query("DELETE FROM shipping 
            WHERE shipping_id=:shipping_id");
            $this->db->bind(':shipping_id',$id);
            $this->db->execute();
        }



        public function activate($id){
            $this->db->query("UPDATE c_order SET order_status  = 1 WHERE order_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function inActivate($id){
            $this->db->query("UPDATE c_order SET order_status  = 0 WHERE order_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

    }