
<?php require_once ROOT ."/views/inc/header.php" ?>
<div class=" ">
            <div class="row">
                <div class="col-8  m-auto">
  
                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Add Picture</h5>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="<?php echo URL?>/users/avatar/<?php echo Session::get('user_id') ?>" method="POST">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input name='image' type="file" class="custom-file-input <?php echo  isset($data['errImg']) ?  'is-invalid' : '' ?>" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose image</label>
                                    </div>
                                    <div class="input-group-prepend">
                                        <input class="btn btn-outline-secondary" name='addAvatar' type="submit" value='Upload'>
                                    </div>
                                </div>
                                <small><?php echo  isset($data['errImg']) ?  '<div class="text-danger">'.$data['errImg'].'</div>' : '' ?></small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/footer.php" ?>