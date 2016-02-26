<?php
require_once '../views/top.php';
require_once '../models/cart.php';
$obj_cart = new cart();
$obj_cart->userID = $_REQUEST['uid'];
$result_order = $obj_cart->get_orders_by_userID();
//echo $result_row= count($obj_cart->get_cartdetail_by_session_id());
?>

</head>
<body>

    <!--logo Area-->
    <?php
    require_once '../views/header.php';
    ?>
    <!--logo area closed-->
    <!-- Page Content -->



    <!--coursal-->
    <?php
//require_once '../views/slider.php';
    ?> 
    <!--Coursal-->
    <div class="container">

        <!--Middle Nav-->
        <?php
//require_once '../views/middle_nav.php';
        ?>        

        <!--Middle Nav close-->

        <!--Cart Products -->
        <div class="col-md-12" >


            <div class="col-md-12" >
                <h2 class="page-header">
                    <span  class="glyphicon glyphicon-shopping-cart"></span>
                    Orders
                </h2>
            </div>
            <?php
            if ($result_order->num_rows > 0) {
                ?>            

                <table class="table table-hover">
                    <thead class="no_show">
                        <tr class="bg-success">
                            <th>Sr #</th>  
                            <th>Order ID</th>
                            <th>Ordered Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        while ($row_order = $result_order->fetch_array()) {
                            ?>       
                            <tr class="bg-info">
                                <td><?php echo $counter; ?></td>  
                                <td>
                                    <?php echo $row_order['orderID']; ?>
                                </td>
                                <td><?php echo $row_order['ordered_date']; ?></td>
                                <td>
                                    <?php
                                    echo $row_order['status'];
                                    ?>
                                </td>

                            </tr>

                            <?php
                            $counter++;
                        }

                        /* else
                          {
                          echo '<style>.no_show{display:none;}</style>';
                          echo '<h3>Sorry You Have no Products In Cart</h3>';
                          } */
                        ?>

                    </tbody>
                </table>

                <?php
                ?>




                <hr>
                <?php
            } else {
                echo '<h4>Sorry You Have No Orders</h4>';
            }
            ?>
        </div>
    </div>
    <!---Product Close-->

    <!-- Footer -->
    <?php
    require_once '../views/footer.php';
    ?>

    <!-- Footer -->

</body>

</html>
