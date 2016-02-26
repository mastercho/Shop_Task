<?php
require_once '../views/top.php';
require_once '../models/cart.php';
$obj_cart = new cart();
$obj_cart->session_id = session_id();
$result_cart = $obj_cart->get_cartdetail_by_session_id();
//echo $result_row= count($obj_cart->get_cartdetail_by_session_id());

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];


    $obj_user = new User();
    $obj_user->username = $user['username'];
    $result_userID = $obj_user->get_user_ID();
    $row_uid = $result_userID->fetch_array();

    $obj_cart->userID = $user['userID'];
    $result_order = $obj_cart->get_orders_by_userID();
}
?>
<script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script>
setInterval(function ()
        {
            var sessionID = $("#session_id").val();
            $.post("../process/process_chat.php?action=get_detail", {sessionID:sessionID}, function (data)
            {
                $("#cartitems").load(document.URL + ' #cartitems');
               // alert(data);
            });
        }, 1000);
</script>

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
                    Shopping Cart

                    <?php
                    if (isset($_SESSION['user'])) {
                        ?>    
                        <span class="pull-right">
                            <a href="orders.php?uid=<?php echo $row_uid['userID'] ?>" class="btn btn-danger">Orders
                                <span class="badge"><?php echo $result_order->num_rows; ?></span> 
                            </a>
                        </span>
                        <?php
                    }
                    ?>
                </h2>
            </div>
            <?php
            if (!empty($_SESSION['items'])) {
                ?> 
            <div id="cartitems">
                <form method="post" action="../process/process_cart.php?action=manage" >               

                    <table class="table table-hover">
                        <thead class="no_show">
                            <tr>
                                <th>Sr #</th>  
                                <th></th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>Total</th>                  

                            </tr>
                        </thead>
                        <tbody>
                        <input type="hidden" id="session_id" value="<?php echo session_id(); ?>">
                            <?php
                            $counter = 1;
                            while ($row_cart = $result_cart->fetch_array()) {
                                $Total = 0;
                                ?>       
                                <tr>
                                    <td><?php echo $counter; ?></td>  
                                    <td>
                                        <input type="checkbox" class="form-control"
                                               name="chkids[]" value="<?php echo $row_cart['itemID']; ?>">
                                    </td>
                                    <td>
                                        <?php echo $row_cart['product_name']; ?>
                                    </td>
                                    <td>
                                        <img class="img-responsive" id="prdct_add_image"  
                                             src="../images/products/<?php echo $row_cart['product_name']; ?>/<?php echo $row_cart['product_image']; ?>">
                                    </td>
                                    <td>$ <?php echo $row_cart['price']; ?></td>
                                    <td>
                                        <input type="hidden" name="txtids[]" value="<?php echo $row_cart['itemID']; ?>">
                                        <input type="text" class="form-control" style="width: 50px;" maxlength="3" 
                                               name="quantity[]" value="<?php echo $row_cart['quantity']; ?>" >                       
                                    </td>
                                    <td>$
                                        <?php
                                        $Total = $row_cart["price"] * $row_cart["quantity"];
                                        echo $Total;
                                        ?>
                                    </td>
                            <input type="hidden" name="itemids[]" value="<?php echo $item_id = $row_cart['itemID']; ?>">
                            <input type="hidden" name="total[]" value="<?php echo $Total; ?>">

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

                        <thead class="no_show">
                            <tr >
                                <th colspan="2">
                                    <input type="submit" class="form-control btn-danger" name="btnmanage" value="Delete">
                                </th>  
                                <th colspan="2">
                                    <input type="submit" class="form-control btn-info" name="btnmanage" value="Update">
                                </th>
                                <th colspan="3">    
                                    <input type="submit" class="form-control btn-success" name="btnmanage" value="Empty">
                                </th>
                            </tr>
                        </thead>

                        </tbody>
                    </table>

                    <?php
                    ?>

                </form>
            </div>
                <?php
                $obj_cart->session_id = session_id();
                $check_out = $obj_cart->getcart_by_session_id();
                $row_check_out = $check_out->fetch_array();
                ?>            
                <form class="form-horizontal" method="post" action="checkout.php?cid=<?php echo $row_check_out['cartID'] ?>">
                    <button class="btn btn-primary form-control">Check Out</button>
                </form>


                <hr>
                <?php
            } else {
                echo '<h4>Sorry You Have No Items In Cart</h4>';
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
