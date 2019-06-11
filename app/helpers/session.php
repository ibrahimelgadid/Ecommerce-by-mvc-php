<?php 

class Session{

    public static function  start(){
        session_start();
    }
    public static function  get($name){
        echo $_SESSION[$name];
    }

    public static function  destroy(){
        session_destroy();
    }

    public static function  name($name){
        return $_SESSION[$name];
    }

    public static function  set($name, $msg){
       return $_SESSION[$name] = $msg;
       
    }

    public static function clear($name){
        unset($_SESSION[$name]);
    }

    public static function existed($name){
       if(isset($_SESSION[$name])){
           return true;
       }else {
        return false;
       }
    }

    public static function success($msg){
        if(isset($_SESSION[$msg])){
            echo '<div class="messages">
            <button class="btn btn-success m-2 btn-sm" style="border-radius:50%">
            <i class="fa fa-check fa-2x"></i></button>
            <span class= "text-success mt-2">'.$_SESSION[$msg].'</span></div>';
            unset($_SESSION[$msg]);
        }
    }

    public static function danger($msg){
        if(isset($_SESSION[$msg])){
            echo '<div class="messages"><button class="btn btn-danger m-2 btn-sm" style="border-radius:50%">
            <i class="fa fa-times fa-2x"></i></button>
            <span class= "text-danger mt-2">'.$_SESSION[$msg].'</span></div>';
            unset($_SESSION[$msg]);
        }
     }
}

