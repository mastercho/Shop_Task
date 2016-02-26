<?php
require_once './views/top.php';
require_once "models/category.php";
require_once './models/post.php';
$obj_product = new product();
$result_product = $obj_product->get_products();
?>
</head>
<body>

    <!--logo Area-->
    <?php
    require_once './views/header.php';
    ?>
    <!--logo area closed-->
    <!--coursal-->
    <?php
    require_once './views/slider.php';
    ?> 
    <!--Coursal-->


    <!-- Page Content -->



    <div class="container">
        <!--Middle Nav-->

        <?php
        require_once './views/middle_nav.php';
        ?>        
        <!--Middle Nav close-->

        <!-- Products -->
        <div class="col-lg-9 col-md-9 col-sm-12" id="product_area">


            <div class="col-md-12" >
                <h2 class="page-header">Products</h2>
            </div>
            <?php
            while ($row_product = $result_product->fetch_array()) {
                if ($row_product["product_status"] == "Active") {
                    ?>            

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <?php if ($row_product['view_count'] >= 30) { ?>    
                                <span class="badge">Specials</span>
                            <?php } else { ?>    
                                <span class="badge">New</span>
                            <?php } ?>    

                            <img id="product_img" src="images/products/<?php echo $row_product['product_name']; ?>/<?php echo $row_product['product_image']; ?>" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?php echo $row_product['product_price']; ?></h4>
                                <h4><a id="details" title="Click To view Details" 
                                       href="products/details.php?product_ID=<?php echo $row_product['product_ID']; ?>" target="_blank">
                                           <?php echo $row_product["product_name"]; ?>
                                    </a>
                                </h4>
                                <p><?php echo $row_product['product_info']; ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?php echo $row_product['view_count']; ?> reviews</p>
                                <p>
                                    <?php
                                    if ($row_product["view_count"] <= 30) {
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

                        </div>
                    </div>

                    <?php
                } else {
                    echo '';
                }
            }
            ?>
            <!--pagination-->
            <div class="col-md-12">
                <ul class="pagination">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
            </div>
            <!--pagination-->

        </div>
    </div>
    <!---Product Close-->

    <!-- Footer -->
    <hr>
    <?php
    require_once "./views/footer.php";
    ?>

    <!--Footer-->
</body>

</html>
