<?php 

    class Category extends Controller{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getAllCat($active=''){
            if($active==''){
                $sql = "";
            }else {
                $sql = "WHERE categories.active=$active";
            }
            $this->db->query("SELECT categories.*, users.full_name as
            creator  FROM categories INNER JOIN users ON 
            categories.cat_user = users.user_id $sql");
            $categories = $this->db->resultSet();
            if($categories){
                return $categories;
            }else {
                return false;
            }
        }

        public function search($searched){
            $this->db->query("SELECT categories.*, users.full_name as
            creator  FROM categories INNER JOIN users ON 
            categories.cat_user = users.user_id WHERE cat_name LIKE
            '%$searched%'");
            // $this->db->bind(':searched',$searched);
            $results = $this->db->resultSet();
            if($results){
                return $results;
            }else {
                return false;
            }
        }

        public function add($cat_name,$cat_user,$description){
            $this->db->query("INSERT INTO 
            categories (cat_name,cat_user,active,description)
            VALUES (:cat_name,:cat_user,0,:description)");
            $this->db->bind(':cat_name',$cat_name);
            $this->db->bind(':cat_user',$cat_user);
            $this->db->bind(':description',$description);
            $this->db->execute();
        }

        public function update($id,$name,$description){
            $this->db->query("UPDATE categories SET cat_name=:cat_name
            ,description=:description WHERE cat_id=:cat_id");
            $this->db->bind(':cat_name',$name);
            $this->db->bind(':description',$description);
            $this->db->bind(':cat_id',$id);
            $this->db->execute();
        }

        public function show($id){
            $this->db->query("SELECT categories.*, users.full_name as
            creator  FROM categories INNER JOIN users ON 
            categories.cat_user = users.user_id WHERE cat_id=:cat_id");
            $this->db->bind(':cat_id',$id);
            $category = $this->db->single();
            return $category;
        }

        

        public function findCatName($cat_name,$cat_id = ''){
            $this->db->query("SELECT cat_id FROM categories 
            WHERE cat_name =:cat_name AND cat_id != :cat_id");
            $this->db->bind(':cat_name',$cat_name);
            $this->db->bind(':cat_id',$cat_id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function delete($id){
            $this->db->query("DELETE FROM categories WHERE cat_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function activate($id){
            $this->db->query("UPDATE categories SET active  = 1 WHERE cat_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function inActivate($id){
            $this->db->query("UPDATE categories SET active  = 0 WHERE cat_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }


    }