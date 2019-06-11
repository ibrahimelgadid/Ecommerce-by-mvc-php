
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<div class="">

            <div class="row">
                <div class="col-8  m-auto">
               
                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Login To Dashboard</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL?>/admins/login" method="POST">
    
                            <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" class="form-control <?php echo  isset($data['errEmail']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errEmail']) ?  '<div class="invalid-feedback">'.$data['errEmail'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo  isset($data['errPassword']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errPassword']) ?  '<div class="invalid-feedback">'.$data['errPassword'].'</div>' : '' ?>
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" name='login' value='Login' class="btn btn-success btn-block">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php //require_once ROOT ."/views/inc/adminFooter.php" ?>