
<?php require_once ROOT ."/views/inc/header.php" ?>

<div class=" ">

            <div class="row">
                <div class="col-8  m-auto">
                    <div class="card my-4">
                        <div class="card-header">
                            <h3 class='text-muted text-center'>Register</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL ?>/users/register" method="POST">
                                <div class="form-group">
                                    <input type="text" name="full_name" placeholder="Full Name" class="form-control <?php echo  isset($data['errName']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errName']) ?  '<div class="invalid-feedback">'.$data['errName'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" class="form-control <?php echo  isset($data['errEmail']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errEmail']) ?  '<div class="invalid-feedback">'.$data['errEmail'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo  isset($data['errPassword']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errPassword']) ?  '<div class="invalid-feedback">'.$data['errPassword'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password2" placeholder="Confirm Password" class="form-control <?php echo  isset($data['errPassword2']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errPassword2']) ?  '<div class="invalid-feedback">'.$data['errPassword2'].'</div>' : '' ?>                                </div>
                                <div class="form-group">
                                    <input type="submit" name='register' value='Create Account' class="btn btn-success btn-block">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php //require_once ROOT ."/views/inc/footer.php" ?>