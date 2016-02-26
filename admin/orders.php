<?php
require_once 'views/top.php';
require_once '../models/cart.php';
require_once '../models/user.php';

$obj_order = new cart();
$result = $obj_order->get_orders();
$obj_user = new User();

if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<title>Admin Panel || Orders</title>
<script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function (e) {
     $("#status").change(function(){   
        var orderID = $("#orderID").val();
        var status = $("#status").val();
        $.post("process/process_order.php",{orderID:orderID,status:status},function(data)
        {
         alert(data);   
        });
      


    });
    });



</script>
</head>
<body>
    <!--logo Area-->
    <?php
    require_once 'views/header.php';
    ?>
    <!--logo area closed-->

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <h2>Active Orders</h2>
            <div class="col-lg-8">
                <form class="form-horizontal" role="form" method="Get">
                    <label class="control-label col-sm-2" for="order">Search Order:</label>
                    <div class="col-sm-7">  
                        <input class="form-control" type="search" placeholder="Enter Order">
                    </div>
                </form>
            </div>
        </div>
        <hr>            
        <table class="table table-hover table-striped">
            <thead>

                <tr>
                    <th>#</th>  
                    <th>CartID</th>
                    <th>Customer</th>
                    <th>Ordered Date</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = $result->fetch_array()) {
                    ?>            
                    <tr>
                        <td><?php echo $counter; ?></td>  
                        <td><?php echo $row["cartID"]; ?></td>
                        <td class="text-capitalize">
                            <?php
                            $obj_user->userID = $row['userID'];
                            $result_name = $obj_user->get_username_by_userID();
                            $row_name = $result_name->fetch_array();
                            echo $row_name['username'];
                            //echo $result_name->num_rows;
                            ?>
                        </td>
                        <td>
                            <?php
                            $time = strtotime($row["ordered_date"]);
                            $myFormatForView = date("jS,F Y", $time);
                            //echo $row_post["created_date"];
                            echo $myFormatForView;
                            ?>
                        </td>
                        <td class="text-capitalize">
                            <select class="form-control" id="status">
                                <option name="status"></option>
                                <option name="status">Active</option>
                                <option name="status">In-Active</option>
                                <option name="status">Pending</option>
                                <option name="status">Cleared</option>
                                <option name="status">Shipping</option>
                            </select>
                            <?php // echo $row["status"]; ?>
                        </td>
            <input type="hidden" id="orderID" value="<?php echo $row ['orderID']; ?>">
                <td><a href="update/edit_order.php?orderID=<?php echo $row['orderID']; ?>">Edit</a></td>
                <td><a href="delete/delete_order.php?orderID=<?php echo $row['orderID']; ?>">Delete</a></td>
                </tr>
                <?php
                $counter++;
            }
            ?>


            </tbody>
        </table>
    </div>

    <!---page content-->       
    <!-- Footer -->
    <?php
    require_once 'views/footer.php';
    ?>
    <!-- Footer -->

    <!-- /.container -->



</body>

</html>
