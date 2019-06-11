
<?php require_once ROOT ."/views/inc/header.php" ?>

<div class=" ">

            <div class="row">
                <div class="col-8  m-auto">
                    <div class="card my-4">
                        <div class="card-header">
                            <h3 class='text-muted text-center'>Edit Profile</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL ?>/users/update/<?php echo $data['user']->user_id ?>" method="POST">
                                <div class="form-group">
                                    <input value="<?php echo $data['user']->full_name ?>" type="text" name="full_name" placeholder="Full Name" class="form-control <?php echo  isset($data['errName']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errName']) ?  '<div class="invalid-feedback">'.$data['errName'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo $data['user']->email ?>" type="text" name="email" placeholder="Email" class="form-control <?php echo  isset($data['errEmail']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errEmail']) ?  '<div class="invalid-feedback">'.$data['errEmail'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="oldPass" value="<?php echo $data['user']->password ?>">
                                    <input  type="password" name="password" placeholder="Password" class="form-control <?php echo  isset($data['errPassword']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errPassword']) ?  '<div class="invalid-feedback">'.$data['errPassword'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name='editProfile' value='Edit' class="btn btn-success btn-block">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/footer.php" ?>