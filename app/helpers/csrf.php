<?php 




class Csrf {
    public static function get(){
        if(empty($_SESSION['csrf'])){
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
                
        }
        return $csrf = hash_hmac('sha256', 'string for protection of php form',$_SESSION['csrf']);
    }

    public static function CsrfToken(){
       
        if(isset( $_POST['csrf'])){
            if(hash_equals(self::get(),  $_POST['csrf'])){
                return true;
            }else {
                die('You can\'t');
            }
        }

        if(isset( $_GET['csrf'])){
            if(hash_equals(self::get(),  $_GET['csrf'])){
                return true;
            }else {
                die('You can\'t');
            }
        }
    }
}