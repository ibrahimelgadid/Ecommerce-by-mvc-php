<?php 

 class Errors{
    private $errors;

    public function __construct($error){
        $this->errors =array();

        if(isset($error)){
            array_push($this->errors,$error);
        }

        if(in_array($error,$this->errors)){
            return $error;
        }
    }
 }

