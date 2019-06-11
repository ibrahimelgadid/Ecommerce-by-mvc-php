
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
    <div class="  mt-4">
       

        <h5 class="text-center"><?php echo $data['category']->cat_name ?></h5>
        <div class="card">
            <div class="card-header">
                <h6><?php echo $data['category']->cat_name ?></h6>
            </div>
            <div class="card-body">
            <ul class="list-unstyled">
                <li>
                    <strong><i class="fa fa-tag"></i> Category: </strong> <?php echo $data['category']->cat_name ?>
                </li>
                <li>
                    <strong><i class="fa fa-id-card"></i> ID: </strong> <?php echo $data['category']->cat_id ?>
                </li>
                <li>
                    <strong><i class="fa fa-list-alt"></i> Description: </strong> <?php echo $data['category']->description ?>
                </li>
                <li>
                    <strong><i class="fa fa-lock"></i> Status: </strong> <?php echo $data['category']->active == 0? '<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">InActive</span>'?>
                </li>
                <li>
                    <strong><i class="fa fa-user"></i> Creator: </strong> <?php echo $data['category']->creator ?>
                </li>
                <li>
                    <strong><i class="fa fa-calendar"></i> Date: </strong> <?php echo $data['category']->created_at ?>
                </li>
            </ul>
            </div>
        </div>
        <a href='<?php echo URL ?>/categories' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>