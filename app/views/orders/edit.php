
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
        <div class=" ">
            <div class="row">
                <div class="col-10 col-md-6  m-auto">

                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Edit Manufacture</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL?>/manufactures/update/<?php echo $data['manufacture']->man_id ?>" method="POST">
    
                                <div class="form-group">
                                    <input 
                                        value="<?php echo $data['manufacture']->man_name ?>"
                                        type="text" 
                                        name="manufacture" 
                                        placeholder="Enter manufacture name" 
                                        class="form-control <?php echo  isset($data['errMan']) ?  'is-invalid' : '' ?>"
                                    >
                                    <input type="hidden" name="man_id" value="<?php echo $data['manufacture']->man_id ?>">
                                    <?php echo  isset($data['errMan']) ?  '<div class="invalid-feedback">'.$data['errMan'].'</div>' : '' ?>
                                </div>
                                <div class="from-group mb-2">
                                    <textarea 
                                        name="description" 
                                        class="form-control <?php echo  isset($data['errDes']) ?  'is-invalid' : '' ?>"
                                    ><?php echo $data['manufacture']->description ?>
                                    </textarea>
                                    <?php echo  isset($data['errDes']) ?  '<div class="invalid-feedback">'.$data['errDes'].'</div>' : '' ?>
                                </div>

                                <div class="form-group">
                                    <a href='<?php echo URL ?>/manufactures' class="btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i>
                                        Go Back
                                    </a>
                                    <input type="submit" name='editManufacture' value='Edit' class="btn btn-success btn-sm">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>