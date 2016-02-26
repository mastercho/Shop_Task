<?php
require_once '../views/top.php';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = "";
}


$obj_product = new product();
$obj_product->productID = $_REQUEST['pid'];
$result_product = $obj_product->get_product_by_id();
$row_product = $result_product->fetch_array();
$update_view_count = $obj_product->update_view_count();

$obj_comment = new comment();
$pid = $_REQUEST['pid'];
$result_comment = $obj_comment->get_comments($pid);
?>

<script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function (e) {

        $("#comment").click(function ()
        {
            var userID = $("#userID").val();
            var productID = $("#productID").val();
            var comment = $("#c_text").val();
            $.post("../process/process_comment.php?action=comment", {userID: userID, productID: productID, comment: comment}, function (data)
            {
                //$("#launch").html(data);
                $("#feedback").load(document.URL + ' #comments');
               $("#c_text").val("");               
 //alert(data);

            });

        });

    });

</script>

</head>
<body>
    <!--logo Area-->
    <?php
    require_once '../views/header.php';
    ?>
    <!--logo area closed-->

    <?php
    require_once '../views/slider.php';
    ?> 

    <div class="container">
        <!-- Page Content -->

        <!--Middle Nav-->
        <?php
        require_once '../views/middle_nav.php';
        ?>        

        <!--Middle Nav close-->

        <!-- Products -->
        <div class="col-md-9" id="product_area">


            <div class="col-md-12" >
                <h2 class="page-header"><?php echo $row_product['product_name']; ?></h2>
            </div>
            <div class="col-md-12">

                <label class="control-label col-md-4" for="product_image">Product Image :</label>
                <div class="col-md-6">
                    <img  class="img-responsive" src="../images/products/<?php echo $row_product["product_name"]; ?>/<?php echo $row_product["product_image"]; ?>">
                </div> 

                <div class="col-md-8">
                    <label class="control-label col-md-6" for="first_name">Product Info :</label>
                    <div class="col-md-12">
                        <p><?php echo $row_product["product_info"] ?></p>
                    </div>   

                    <label class="control-label col-md-6" for="product_price">Product Price :</label>
                    <div class="col-md-4">
                        <p>$ <?php echo $row_product["product_price"] ?></p>
                    </div>   

                    <label class="control-label col-md-6" for="product_type">Product Category :</label>
                    <div class="col-md-4">
                        <p><?php echo $row_product["product_category"] ?></p>
                    </div>   

                    <label class="control-label col-md-6" for="product_type">Product Brand :</label>
                    <div class="col-md-4">
                        <p><?php echo $row_product["product_brand"] ?></p>
                    </div>   

                    <label class="control-label col-md-6" for="product_discount">Product Discount :</label>
                    <div class="col-md-4">
                        <p><?php echo $row_product["product_discount"] ?></p>
                    </div>
                    <label class="control-label col-md-6" for="views">Product Views :</label>
                    <div class="col-md-4">
                        <p><?php echo $row_product["view_count"] ?></p>
                    </div>
                    <label class="control-label col-md-6" for="product_type">Available :</label>
                    <div class="col-md-4">
                        <p><?php
                            if ($row_product["product_status"] == "Active") {
                                echo 'Yes';
                            } else {
                                echo 'Sorry Not available';
                            }
                            ?></p>
                    </div> 

                </div>
                <div class="form-group">
                    <form method="post" class="form-horizontal" role="form" action="../process/process_cart.php?action=add">
                        <input type="hidden" id="pid" name="pid" value="<?php echo $row_product["product_ID"]; ?>">
                        <input type="hidden" id="price" name="price" value="<?php echo $row_product["product_price"]; ?>">
                        <input class="form-control btn-primary" type="submit" value="Add to Cart">
                    </form>

                </div>
                <div class="col-md-12" >
                    <label class="control-label col-md-6 h3" for="feedback">Feedback</label>
                    <br>
                    <div class="row">
                        <?php if (isset($_SESSION['user'])) { ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Comment :</label>
                                    <textarea class="form-control" id="c_text"></textarea>  
                                </div> 
                                <input type="hidden" value="<?php echo $user['userID']; ?>" id="userID">
                                <input type="hidden" value="<?php echo $_REQUEST['pid']; ?>" id="productID">
                                <input type="button" class="form-control" value="Comment" id="comment">
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="row" id="feedback">
                        <div class="col-md-12" id="comments">
                            <?php
                            //if ($result_comment->num_rows < 0) {
                                while ($row_comment = $result_comment->fetch_array()) {
                                    ?>    
                                    <label class="control-label text-capitalize">
                                        <?php
                                        $obj_user = new User();
                                        $obj_user->userID = $row_comment['userID'];
                                        $result_username = $obj_user->get_username_by_userID();
                                        $row_username = $result_username->fetch_array();
                                        echo $row_username['username'];
                                        ?>
                                    </label>
                                    <span>at 
                                        <?php
                                        $time = strtotime($row_comment["created_date"]);
                                        $myFormatForView = date("jS,F Y", $time);
                                        //echo $row_post["created_date"];
                                        echo $myFormatForView;
                                        //echo $row_comment['created_date']; 
                                        ?>
                                    </span>
                                    <blockquote class="bg-info">
                                        <?php
                                        echo $row_comment['comment'];
                                        ?>
                                    </blockquote>
                                    <?php
                                }
                         /*   } else {
                                echo "No Feedback Yet";
                            }*/
                            ?>
                        </div>
                    </div>    
                </div>   
            </div>
        </div>
    </div>
    <!---Product Close-->
    <hr>
    <!-- Footer -->
    <?php
    require_once '../views/footer.php';
    ?>

    <!-- Footer -->

</body>

</html>
