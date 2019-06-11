<?php 

    class User extends Controller{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function register($fullname, $email,$img, $hashedPassword,$vkey){
           
            $this->db->query(
                    "INSERT INTO users (full_name,email,image,password,verified,vkey,admin,active)
                    VALUES (:full_name,:email,:image,:password,0,:vkey,0,0)
                    ");

            $this->db->bind(':full_name',$fullname);
            $this->db->bind(':email',$email);
            $this->db->bind(':image',$img);
            $this->db->bind(':password',$hashedPassword);
            $this->db->bind(':vkey',$vkey);
            $this->db->execute();
        }

        public function login($email,$password){
            $this->db->query("SELECT * FROM users WHERE email =:email");
            $this->db->bind(':email',$email);
            $user = $this->db->single();
            
            $hashedPassword = $user->password;
            if(password_verify($password,$hashedPassword)){
                return $user;
            }else{
                return false;
            }
        }

        public function show($id){
            $this->db->query("SELECT * FROM users WHERE user_id=:user_id");
            $this->db->bind(':user_id',$id);
            $user = $this->db->single();
            return $user;
        }

        public function update($id,$name,$email,$password){
            $this->db->query("UPDATE users SET full_name=:full_name
            ,email=:email,password=:password WHERE user_id=:user_id");
            $this->db->bind(':full_name',$name);
            $this->db->bind(':email',$email);
            $this->db->bind(':password',$password);
            $this->db->bind(':user_id',$id);
            $this->db->execute();
        }
        

        public function notVerified($email){
            $this->db->query("SELECT * FROM users WHERE email =:email");
            $this->db->bind(':email',$email);
            $row = $this->db->single();
            $verified = $row->verified;
            if($verified == 0){
                return true;
            }else {
                return false;
            }
        }

        public function findUserByEmail($email,$id=''){
            $this->db->query("SELECT * FROM users WHERE 
            email =:email AND user_id != :user_id");
            $this->db->bind(':email',$email);
            $this->db->bind(':user_id',$id);
            $this->db->execute();
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            };
        }

        public function forgotP($email,$vkey){
            $this->db->query("SELECT `user_id` FROM `users` WHERE `email` = :email");
            $this->db->bind(':email', $email);
            $this->db->execute();
            $row = $this->db->rowCount();
            if($row != 0 ){
                
                $this->db->query("UPDATE users SET vkey = :vkey , 
                token_expire = DATE_ADD(NOW(), INTERVAL 60 MINUTE)
                WHERE email=:email");
                $this->db->bind(':email', $email);
                $this->db->bind(':vkey', $vkey);
                if($this->db->execute()){
                    return true;
                }else {
                    return false;
                }
            }
        }
        
        public function resetP($vkey,$password){
            
            $this->db->query("SELECT user_id FROM users WHERE 
            vkey =:vkey AND token_expire > NOW()");
            $this->db->bind(':vkey',$vkey);
            $this->db->execute();
            $row = $this->db->rowCount();
            if($row > 0){
                $this->db->query("UPDATE users SET password =:password
                WHERE vkey=:vkey");
                $this->db->bind(':vkey',$vkey);
                $this->db->bind(':password',$password);
                if($this->db->execute()){
                    return true;
                }else {
                    return false;
                };
                }else{
                return false;
            } 
        }
       
 

        public function selectVkey($email,$vkey){
            $this->db->query("SELECT * FROM users WHERE vkey=:vkey AND email=:email");
            $this->db->bind(':vkey',$vkey);
            $this->db->bind(':email',$email);
            $userData = $this->db->single();
            $user = $this->db->rowCount();
            if ($user > 0) {
                $this->db->query("UPDATE users SET verified = 1 WHERE vkey=:vkey AND email=:email");
                $this->db->bind(':vkey',$vkey);
                $this->db->bind(':email',$email);
                $user1 =  $this->db->execute();
                if($user1){
                    return $userData;
                }else {
                    return false;
                }
            } else {
            return false;
            }
            
            
        }

        public function userData($name,$user_id){
            $this->db->query("SELECT * FROM users WHERE user_id=:user_id AND full_name=:full_name");
            $this->db->bind(':user_id',$user_id);
            $this->db->bind(':full_name',$name);
            $user = $this->db->single();
            if($user){
                return $user;
            }else{
                return false;
            }
        }

        public function avatar($id, $img){
            $this->db->query("UPDATE users SET image = :image
            WHERE user_id=:user_id");
            $this->db->bind(':image',$img);
            $this->db->bind(':user_id',$id);
            return $this->db->execute();
        }
        
    }