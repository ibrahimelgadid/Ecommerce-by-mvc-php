<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once 'config/config.php';
    require_once 'helpers/errors.php';
    require_once 'helpers/email.php';
    require_once 'helpers/session.php';
    require_once 'helpers/redirect.php';
    require_once 'helpers/auth.php';

    require_once 'helpers/csrf.php';

    new Redirect;
    new Auth;
    new Csrf();


    spl_autoload_register(function($class){
        require_once 'libs/'.$class.'.php';
    });

