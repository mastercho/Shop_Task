<?php
require_once '../views/top.php';
require_once "../models/category.php";
require_once '../models/post.php';
$obj_product = new product();
$result_product = $obj_product->get_products();
?>
<script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function (e) {
        $("#price_greater").blur(function ()
        { 
            var price = $("#price_greater").val();
            if (isNaN(price)) 
            {
              alert("Must input numbers");
            }
            else{
             $.post("../process/process_product.php?action=greater", {price:price}, function (data)
                {
                    $("#product_area").load();
                    alert(data);
                });
            
            }
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
    <!--coursal-->
    <?php
    require_once '../views/slider.php';
    ?> 
    <!--Coursal-->


    <!-- Page Content -->



    <div class="container">
        <!--Middle Nav-->

        <?php
        require_once '../views/middle_nav.php';
        ?>        
        <!--Middle Nav close-->

        <div class="col-md-9" >
            <h2 class="page-header">Products
                <button class="pull-right btn" data-toggle="collapse" data-target="#search_tools">Show Tools</button>
            </h2>
        </div>
        <div class="col-md-9 pager" id="search_tools">
            <h4>Search tools</h4>
            <div class="col-md-2 col-sm-2">
                <label class="control-label">Min. Price</label>
                <input class="form-control" type="text" id="price_greater">
            </div>

            <div class="col-md-2 col-sm-2">
                <label class="control-label">Max. Price</label>
                <input class="form-control" type="text" id="price_less">
            </div>
            
            
        </div>
        <!-- Products -->
        <div class="col-lg-9 col-md-9 col-sm-12" id="product_area">

            <?php
            
            while ($row_p = $result_product->fetch_array()) {
            echo "<pre>";
            print_r($row_p);
            echo "</pre>";
                ?> 
            
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <?php if ($row_p['view_count'] >= 30) { ?>    
                                <span class="badge">Specials</span>
                            <?php } else { ?>    
                                <span class="badge">New</span>
                            <?php } ?>    
                            <a id="details" title="Click To view Details" data-toggle="modal" data-target="#<?php echo $row_p['product_ID']; ?>" href="#">
                                <img id="product_img" src="../images/products/<?php echo $row_p['product_name']; ?>/<?php echo $row_p['product_image']; ?>" alt="">
                            </a>
                            <div class="caption">
                                <h4 class="pull-right">$<?php echo $row_p['product_price']; ?></h4>
                                <h4><a id="details" title="Click To view Details" 
                                       href="products/details.php?pid=<?php echo $row_p['product_ID']; ?>" target="_blank">
                                           <?php echo $row_p["product_name"]; ?>
                                    </a>
                                </h4>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?php echo $row_p['view_count']; ?> reviews</p>
                                <p>
                                    <?php
                                    if ($row_p["view_count"] <= 30) {
                                        ?>    
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>                                   
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>          
                                        <?php
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="btn-group">
                                <form method="post" role="form" action="process/process_cart.php?action=add">
                                    <input type="hidden" id="pid" name="pid" value="<?php echo $row_p["product_ID"]; ?>">
                                    <input type="hidden" id="price" name="price" value="<?php echo $row_p["product_price"]; ?>">
                                    <button id="add_to_cart" type="submit" class="btn btn-block">Add To Cart</button>
                                </form>
                                <!--<button id="details" type="button" class="btn btn-default">Details</button>-->

                            </div>
                        </div>
                    </div>
                    <?php
            }
            
            ?>    
            <?php
            $obj_m_product = new product();
            $result_m_p = $obj_m_product->get_products();

            while ($row_m_p = $result_m_p->fetch_array()) {
                ?>
                <!--Modal For image details-->
                <div class="modal fade" id="<?php echo $row_m_p['product_ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo $row_m_p['product_name']; ?></h4>
                            </div>
                            <div class="modal-body">
                                <img  src="images/products/<?php echo $row_m_p['product_name']; ?>/<?php echo $row_m_p['product_image']; ?>" alt=""> 
                            </div>
                            <div class="modal-footer">
                                <p class="pull-left">
                                    <label class="control-label">Details : </label>
                                    <?php echo $row_m_p['product_info']; ?>
                                </p>
                            </div>  
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
            <!--pagination-->
            
            <!--pagination-->

        </div>
    </div>
    <!---Product Close-->
    <!-- Footer -->
    <hr>
    <?php
    require_once "../views/footer.php";
    //require_once './views/chat_box.php';
    ?>

    <!--Footer-->
</body>

</html>
