<?php 

class Controller {
    public function model($model){
        require_once "../app/models/".$model.".php";
        return  new $model();
    }

    public function view($view,$data=[]){
        if(file_exists('../app/views/'.str_replace('.','/',$view).'.php')){
            require_once "../app/views/".str_replace('.','/',$view).".php";
            // echo str_replace('.','/',$view);
        }else {
        die('View does not exist');
        }
    }
}