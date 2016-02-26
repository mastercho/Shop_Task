<?php
require_once '../views/top.php';
require_once '../../models/cart.php';
require_once '../../models/user.php';

$obj_order = new cart();
$obj_order->orderID = $_REQUEST['orderID'];
$result_order = $obj_order->get_orders_by_orderID();
$row_order = $result_order->fetch_array();

$obj_user = new User();

if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
</head>
<body>

    <!--logo Area-->
    <?php
    require_once '../views/header.php';
    ?>
    <!--logo area closed-->

    <!-- Page Content -->
    <div class container>

        <div class="col-lg-12">
            <div class="page-header">
                <h3>Update Order</h3>
            </div>

            <div class="col-md-12">


                <form class="form-horizontal" role="form" method="post" action="../process/process_order.php?action=update" enctype="multipart/form-data">  


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Status:</label>
                        <div class="col-sm-6"> 
                            <select class="form-control" name="status">
                                <option name="status"></option>
                                <option name="status">Active</option>
                                <option name="status">In-Active</option>
                                <option name="status">Pending</option>
                                <option name="status">Cleared</option>
                                <option name="status">Shipping</option>
                                
                            </select>
                        </div>
                        
                    </div>  

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="orderID" value="<?php echo $_REQUEST['orderID']; ?>">
                            <button type="submit" class="btn btn-default">Save</button>  
                        </div>
                    </div>


                </form>


            </div>
        </div>       

    </div>
    <!-- Page Content -->



    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="col-sm-12">
                <div class="panel">    
                    <p>Copyright &copy; Online Shop 2015</p>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </footer>


    <!-- /.container -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

</body>

</html>
