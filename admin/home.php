<?php
require_once 'views/top.php';
require_once '../models/cart.php';
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
$obj_user = new User();
$result_user=$obj_user->get_all_users();

$obj_cart = new cart();
$result_cart = $obj_cart->get_carts();
$result_order = $obj_cart->get_orders();

$obj_product = new product();
$result_product = $obj_product->get_products();

$obj_category = new category();
$result_category = $obj_category->view_category();

$obj_brand = new brand();
$result_brand = $obj_brand->view_brand();

$obj_ad = new ads();
$result_ad = $obj_ad->get_ad();

$obj_message = new chat();
$result_message=$obj_message->get_messages_by_chatID();

?>
<title>Admin Panel</title>

</head>
<body>



    <!--logo Area-->
    <?php
    require_once 'views/header.php';
    ?>
    <!--logo area closed-->
    <!-- Page Content -->
    <div class="container">
        <div class="row page-header">
            <h2>Dash Board</h2> 
        </div>
        <div class="col-md-8 row">

            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                                <div class="h3"><?php echo $result_user->num_rows; ?></div>
                                <div>Active Users!</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/customers.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-check"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                                <div class="h3"><?php echo $result_order->num_rows; ?></div>
                                <div>Active Orders!</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/orders.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-th-large"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                                <div class="h3"><?php echo $result_product->num_rows; ?></div>
                                <div>Active Products!</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/products.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-tasks"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                                <div class="h3"><?php echo $result_category->num_rows; ?></div>
                                <div>Active Categorys!</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/category.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-apple"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                                <div class="h3"><?php echo $result_brand->num_rows; ?></div>
                                <div>Active Brands!</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/brands.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                                <div class="h3"><?php echo $result_ad->num_rows; ?></div>
                                <div>Active Ads!</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/ads.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-1">
                                <span class="glyphicon glyphicon-tags"></span>
                            </div>
                            <div class="col-xs-10">
                                <div class="h3">5 Tasks</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <blockquote class="bg-info">Make Changes</blockquote>
                        <blockquote class="bg-info">Build New Admin Chat system</blockquote>
                        <blockquote class="bg-info">Check For Bugs</blockquote>
                        <blockquote class="bg-info">Delete Extra Carts</blockquote>
                        <blockquote class="bg-info">Update Site Info</blockquote>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/home.php">
                        <div class="panel-footer">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>            
    </div>
        <div class="col-md-4">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h2 col-xs-1">
                                <span class="glyphicon glyphicon-comment"></span>
                            </div>
                            <div class="col-xs-10 text-center">
                                <div class="h3">
                                    <?php echo $result_message->num_rows; ?> New Messages
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                    <?php
                     while ($row_msg=$result_message->fetch_array()){
                    ?>    
                        <div class="row">
                            <div class="col-xs-4">
                                <span class="h4 text-capitalize">
                                    <?php
                                    $obj_user->userID=$row_msg['userID'];
                                    $result = $obj_user->get_username_by_userID();
                                    $row_name=$result->fetch_array();
                                    echo $row_name['username'];
                                    ?>
                                </span>
                            </div>
                            <div class="col-xs-10 text-left">
                                <div class="">
                                    <?php echo $row_msg['message']; ?> 
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php
                     }
                    ?>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View More</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-home"></span>
                            </div>
                            <div class="col-xs-8 text-center">
                                <div class="h3">1024</div>
                                <div>Visits</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="h1 col-xs-2">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                            </div>
                            <div class="col-xs-8 text-center">
                                <div class="h3">230</div>
                                <div>Purchases</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            
        </div>    
        
        
	</div>
    <!---page content-->       
    <!-- Footer -->
    <hr>
	<?php
    require_once './views/footer.php';
    ?>
    <!-- Footer -->

    <!-- /.container -->



</body>

</html>
