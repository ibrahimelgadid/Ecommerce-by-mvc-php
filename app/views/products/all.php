
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
    <div class="  text-center mt-4">

        <h5>Products Management</h5>
            
        <input type="text" id='search_pro' class="form-control w-50 mx-auto" placeholder="Search">
   
        <span class="float-right m-3">
            <a href="<?php echo URL ?>/products/add">Add new pro +</a>
        </span>
        <?php if($data['products'] ){ ?> 
        <table class="table table-dark table-responsive-md searched">
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Creator</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                

                
                $i = 0;
                    foreach ( $data['products'] as $pro) { $i++ ?>                        
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>
                            <a href="<?php echo URL ?>/products/show/<?php echo $pro->product_id?>" class="text-danger">
                                <?php echo $pro->name ?>
                            </a>
                        </td>
                        <td><?php echo $pro->creator ?></td>
                        <td>
                            <a href="<?php echo URL ?>/products/<?php echo $pro->active == 0 ? 'activate':'inActivate'?>/<?php echo $pro->product_id ?>">
                                <?php echo $pro->active == 0 ? '<i class="fa fa-thumbs-down text-secondary"></i>':'<i class="fa fa-thumbs-up  text-success"></i>' ?>
                            </a>
                        </td>
                        <td><?php echo $pro->cat_name ?></td>
                        <td><?php echo $pro->man_name ?></td>
                        <td><img src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt="" style='height:50px;width:50px;border-radius:50%'></td>
                        <td>
                        <form class='d-inline' action="<?php echo URL ?>/products/delete/<?php echo $pro->product_id?>" method='GET'>
                            <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                            <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                        </form>
                            <a href="<?php echo URL ?>/products/edit/<?php echo $pro->product_id?>" class="btn btn-info btn-sm  py-0"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                <?php } 
                
                ?>
            </tbody>
        </table>
        <?php }else{?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Products</p>
                    <?php  } ?>
    </div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>