<?php 

    class Cart extends Controller{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getAllCart(){

            $this->db->query("SELECT cart.*,products.name as pro_name ,
            products.price as price FROM cart 
            INNER JOIN users ON cart.user = users.user_id
            INNER JOIN products ON cart.product= products.product_id
            WHERE cart.user = :user");
            $this->db->bind(':user', Session::name('user_id'));
            $carts = $this->db->resultSet();
            if($carts){
                return $carts;
            }else{
                return false;
            }
        }


        public function addOne($pro_id){
            $this->db->query("UPDATE cart SET qty=qty + 1
            WHERE product = :pro_id AND user = :user");
            $this->db->bind(':pro_id',$pro_id);
            $this->db->bind(':user',Session::name('user_id'));
            $this->db->execute();
        }

        public function addnew($pro_id,$user_id,$price){
            $this->db->query("INSERT INTO 
            cart (product,user,qty,price)
            VALUES (:product,:user_id,1,:price)");
            $this->db->bind(':product',$pro_id);
            $this->db->bind(':user_id',$user_id);
            $this->db->bind(':price',$price);
            $this->db->execute();
        }

        public function updateQty($id,$qty){
            $this->db->query("UPDATE cart SET qty=:qty
            WHERE product=:product AND user=:user");
            $this->db->bind(':product',$id);
            $this->db->bind(':qty',$qty);
            $this->db->bind(':user',Session::name('user_id'));
            $this->db->execute();
        }

        

        public function findCartPro($pro_id,$user_id){
            $this->db->query("SELECT * FROM cart 
            WHERE product =:product_id AND user=:user");
            $this->db->bind(':user',$user_id);
            $this->db->bind(':product_id',$pro_id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function delete($id){
            $this->db->query("DELETE FROM cart WHERE cart_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function clear(){
            $this->db->query("DELETE FROM cart WHERE user=:user");
            $this->db->bind(':user',Session::name('user_id'));
            return $this->db->execute();
        }

    }