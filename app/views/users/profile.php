
<?php require_once ROOT ."/views/inc/header.php" ?>
        <div class=" ">
            <div class="row">
                <div class="col-12 col-md-8  m-auto">
                <?php 
                new Session();
                ?>
                
                <div class= 'text-center mt-3'>
                    <img style='height:200px;width:200px' class="img-thumbnail rounded-circle card-img-top" src="<?php echo URL ?>/uploads/<?php Session::get('user_img') ?>" alt="Card image cap">
                    <h4><a href="<?php echo URL ?>/users/avatar/<?php Session::get('user_id') ?>" class='btn btn-sm btn-default'>Edit <i class="fa fa-edit"></i></a></h4>
                </div>
 
                <div class="card my-4">
                        <div class="card-header">
                            <h5 class='text-muted text-center float-left'>Hello,<?php Session::get('user_name') ?> </h5>
                            <a href="<?php echo URL ?>/users/edit/<?php echo Session::get('user_id') ?>" class="btn btn-sm btn-info float-right">Edit <i class="fa fa-edit"></i></a>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>ID: </strong><?php Session::get('user_id') ?></li>
                                <li class="list-group-item"><strong>Name: </strong><?php Session::get('user_name') ?></li>
                                <li class="list-group-item"><strong>Email: </strong><?php echo $data['user']->email ?></li>
                                <li class="list-group-item"><strong>Social: </strong> 
                                    <i style='color:#3b5998;padding:5px' class="fa fa-facebook-square fa-2x"></i>
                                    <i style='color:#1da1f2;padding:5px' class="fa fa-twitter-square fa-2x"></i>
                                    <i style='color:#ff0000;padding:5px' class="fa fa-youtube-square fa-2x"></i>
                                    <i style='color:#0077b5;padding:5px' class="fa fa-linkedin-square fa-2x"></i>
                                    <i style='color:#405de6;padding:5px' class="fa fa-instgram-square fa-2x"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/footer.php" ?>