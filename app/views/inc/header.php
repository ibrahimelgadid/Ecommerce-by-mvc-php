<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo URL ?>/css/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/css/dropzone.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>/css/css.css">

    <title><?php echo $data['title1'] ?></title>
    
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
<div class="container">
      <a class="navbar-brand" href="<?php echo URL ?>/home">Market</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          
          <?php 
            if(!Session::existed('user_id')){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/users/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/users/login">Login</a>
                </li>
            <?php  }else{ 
              ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/carts">
                      Cart<i class="fa fa-shopping-cart"></i><span class="badge badge-danger ml-0" style='border-radius:50%'>
                        <?php Session::get('user_cart')?>
                      </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/carts/orders">My Orders</a>
                </li>
                <li class="nav-item dropdown user">
                    <a class="nav-link dropdown-toggle "  id="dropdown01" data-toggle="dropdown"><?php Session::get('user_name')?> <img style='height:30px;width:30px;border-radius:50%' src="<?php echo URL . '/uploads/'?>/<?php echo Session::get('user_img') ?>" alt=""></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="<?php echo URL ?>/users/profile">Profile</a>
                        <a class="dropdown-item" href="<?php echo URL ?>/users/logout">Logout</a>
                    </div>
                </li>
            <?php  }

            if(Session::existed('email')){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/users/confirm">Confirm</a>
                </li>
                
            <?php  }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0 d-none d-md-block" action='<?php echo URL ?>/home/search' method='POST'>
          <input class="form-control mr-sm-2" type="text" name='search' placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
      </div>
    </nav>
    <div class="container all">
    <?php require_once ROOT ."/views/inc/messages.php" ?>