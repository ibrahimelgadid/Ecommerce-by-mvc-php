<?php 

    class Manufacture extends Controller{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getAllMan($active=''){
            if($active==''){
                $sql = "";
            }else {
                $sql = "WHERE manufactures.active=$active";
            }
            $this->db->query("SELECT manufactures.*, users.full_name as
            creator  FROM manufactures INNER JOIN users ON 
            manufactures.man_user = users.user_id $sql");
            $manufactures = $this->db->resultSet();
           if($manufactures){
               return $manufactures;
           }else {
               return false;
           }
        }


        public function search($searched){
            $this->db->query("SELECT manufactures.*, users.full_name as
            creator  FROM manufactures INNER JOIN users ON 
            manufactures.man_user = users.user_id WHERE man_name LIKE
            '%$searched%'");
            // $this->db->bind(':searched',$searched);
            $results = $this->db->resultSet();
            if($results){
                return $results;
            }else {
                return false;
            }
        }



        public function add($man_name,$man_user,$description){
            $this->db->query("INSERT INTO 
            manufactures (man_name,man_user,active,description)
            VALUES (:man_name,:man_user,0,:description)");
            $this->db->bind(':man_name',$man_name);
            $this->db->bind(':man_user',$man_user);
            $this->db->bind(':description',$description);
            $this->db->execute();
        }

        public function update($id,$name,$description){
            $this->db->query("UPDATE manufactures SET man_name=:man_name
            ,description=:description WHERE man_id=:man_id");
            $this->db->bind(':man_name',$name);
            $this->db->bind(':description',$description);
            $this->db->bind(':man_id',$id);
            $this->db->execute();
        }

        public function show($id){
            $this->db->query("SELECT manufactures.*, users.full_name as
            creator  FROM manufactures INNER JOIN users ON 
            manufactures.man_user = users.user_id WHERE man_id=:man_id");
            $this->db->bind(':man_id',$id);
            $manufacture = $this->db->single();
            return $manufacture;
        }

        

        public function findManName($man_name,$man_id = ''){
            $this->db->query("SELECT man_id FROM manufactures 
            WHERE man_name =:man_name AND man_id != :man_id");
            $this->db->bind(':man_name',$man_name);
            $this->db->bind(':man_id',$man_id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function delete($id){
            $this->db->query("DELETE FROM manufactures WHERE man_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function activate($id){
            $this->db->query("UPDATE manufactures SET active  = 1 WHERE man_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function inActivate($id){
            $this->db->query("UPDATE manufactures SET active  = 0 WHERE man_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }


    }