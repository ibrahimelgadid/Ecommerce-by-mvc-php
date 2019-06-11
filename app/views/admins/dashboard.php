
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
<div class="">
            <div class="row">
                <div class="col-8  m-auto">
                
                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Welcome To Dashboard <span class='text-success'><?php echo $data['admin_name'] ?></span></h5>
                            <?php print_r($_SESSION) ?>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>