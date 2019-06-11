
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
        <div class="">
            <div class="row">
                <div class="col-10 col-md-6  m-auto">
                
                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Add New Category</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL?>/categories/add" method="POST">
    
                                <div class="form-group">
                                    <input type="text" name="category" placeholder="Enter category name" class="form-control <?php echo  isset($data['errCat']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errCat']) ?  '<div class="invalid-feedback">'.$data['errCat'].'</div>' : '' ?>
                                </div>
                                <div class="from-group mb-2">
                                    <textarea 
                                        name="description" 
                                        placeholder="Enter category description" 
                                        class="form-control <?php echo  isset($data['errDes']) ?  'is-invalid' : '' ?>"
                                    ></textarea>
                                    <?php echo  isset($data['errDes']) ?  '<div class="invalid-feedback">'.$data['errDes'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <a href='<?php echo URL ?>/categories' class="btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i>
                                        Go Back
                                    </a>
                                    <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                                    <input type="submit" name='addCategory' value='Add' class="btn btn-success btn-sm">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>