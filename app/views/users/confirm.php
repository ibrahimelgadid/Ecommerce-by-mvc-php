<?php require_once ROOT ."/views/inc/header.php" ?>


        <div class="  mt-4">
            <div class="row">
               <div class="col-10 col-md-8 m-auto ">
               <?php
                     
                    new Session();
                    Session::success("confirm");
                    echo  isset($data['err']) ?  '<div class="text-danger">'.$data['err'].'</div>' : null;
                    ?>
                <h5 class='text-center my-4'>Please Confirm Your Email</h5>
                <form action="<?php echo URL?>/users/confirm" method="POST">
                    <div class="input-group">
                        <input type="text" name="vkey" class="form-control <?php echo  isset($data['errVkey']) ?  'is-invalid' : '' ?>" placeholder='Enter confirmation code...'>
                        <?php echo  isset($data['errVkey']) ?  '<div class="invalid-feedback">'.$data['errVkey'].'</div>' : '' ?>
                        <div class="input-group-btn">
                            <input type="submit" value="confirm" name="confirm" class="btn btn-success">
                        </div>
                    </div>
                    <small class="text-muted">Check your email and get verification code and put it in this input within 30 minutes</small>
                </form>
               </div>
            </div>
        </div>
        <?php //require_once ROOT ."/views/inc/footer.php" ?>
