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
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
<div class="container">
      <a class="navbar-brand" href="<?php echo URL ?>/home" target='_blank'>Market</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          
          <?php 
          new Session;
            if(!Session::existed('admin_name')){ ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/admins/login">SignIn</a>
                </li>
            <?php  }else{ ?>
               <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  id="dropdown01" data-toggle="dropdown"><?php Session::get('admin_name') ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="<?php echo URL ?>/admins/profile">Profile</a>
                        <a class="dropdown-item" href="<?php echo URL ?>/admins/logout">Logout</a>
                    </div>
                </li>
            <?php  }
           ?>
        </ul>
        
      </div>
      </div>
    </nav>
