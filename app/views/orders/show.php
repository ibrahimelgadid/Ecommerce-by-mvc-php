
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
    <div class="   mt-4">
        <h4 class="text-center">Order Details</h4>
        <div class="row">

            <div class="col-md-5">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-list"></i> Customer Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" >
                            <thead class='text-truncate'>
                                <th><i class="fa fa-user"></i> Customer name</th>
                                <th><i class="fa fa-mobile"></i> Mobile</th>
                            </thead>
                            <tbody>
                                <td> <?php Session::get('user_name') ?></td>
                                <td><?php echo $data['shipping']->mobile ?></td>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-list"></i> Shipping Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive" >
                            <thead class='text-truncate'>
                                <th><i class="fa fa-user"></i> Username</th>
                                <th><i class="fa fa-user"></i> Address</th>
                                <th><i class="fa fa-mobile"></i> Mobile</th>
                                <th><i class="fa fa-envelope"></i> Email</th>
                            </thead>
                            <tbody>
                                <td><?php echo $data['shipping']->full_name ?></td>
                                <td>
                                <?php echo $data['shipping']->address ?>, 
                                    <?php echo $data['shipping']->city ?>
                                </td>
                                <td><?php echo $data['shipping']->mobile ?></td>
                                <td><?php echo $data['shipping']->email ?></td>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-shopping-basket"></i> Order Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-sm" >
                            <thead class='text-truncate'>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>SubTotal</th>
                            </thead>
                            <?php 
                                $i = 0;
                                foreach ($data['orderDetails'] as $order) { $i++?>
                                    <tbody>
                                        <td><?php echo $order->product_id ?></td>
                                        <td><?php echo $order->product_name ?></td>
                                        <td><?php echo number_format($order->product_price,2) ?>$</td>
                                        <td><?php echo $order->product_qty ?></td>
                                        <td><?php echo number_format($order->product_price * $order->product_qty,2) ?>$</td>
                                    </tbody>
                                <?php }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>

        </div>
    
        <a href='<?php echo URL ?>/orders' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>