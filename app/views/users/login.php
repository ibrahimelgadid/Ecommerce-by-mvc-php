
<?php require_once ROOT ."/views/inc/header.php" ?>
<div class=" ">
            <div class="row">
                <div class="col-8  m-auto">
                <?php 
                

                new Session();
                
                Session::danger("danger");
                Session::success("success");
            
            
                echo  isset($data['errNotVerified']) ?  '<div class="text-danger">'.$data['errNotVerified'].'</div>' : ''
                 ?>
                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Login To Your Account</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL?>/users/login" method="POST">
    
                            <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" class="form-control <?php echo  isset($data['errEmail']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errEmail']) ?  '<div class="invalid-feedback">'.$data['errEmail'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo  isset($data['errPassword']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errPassword']) ?  '<div class="invalid-feedback">'.$data['errPassword'].'</div>' : '' ?>
                                </div>

                                <div><a href="<?php echo URL ?>/users/forgotPassword">Forgot Password?</a></div>
                                
                                <div class="form-group">
                                    <input type="submit" name='login' value='Login' class="btn btn-success btn-block">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php //require_once ROOT ."/views/inc/footer.php" ?>