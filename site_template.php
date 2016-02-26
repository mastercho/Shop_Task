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
        <div class="col-sm-9" id="product_area">


            <div class="col-md-12" >
                <h2 class="page-header">Products</h2>
            </div>
            <?php
            while ($row_product = $result_product->fetch_array()) {
                if ($row_product["product_status"] == "Active") {
                    ?> 
                    <div class="col-md-4 col-md-6">
                        <div class="panel panel-default text-center">
        <?php
        if ($row_product["view_count"] <= 30) {
            ?>
                                <div class="panel text-primary"><h4>New</h4></div>
                                <?php
                            } else {
                                ?>
                                <div class="panel text-success"><h4>Special</h4></div>
                                <?php
                            }
                            ?>

                            <div class="panel-body">    

                                <a href="#" id="product_img_area">
                                    <img id="product_img" class="img-responsive portfolio-item" src="images/products/<?php echo $row_product['product_name']; ?>/<?php echo $row_product['product_image']; ?>" alt="">
                                </a>
                            </div>
                            <div class="panel-heading">
                                <h4><?php echo $row_product["product_name"]; ?></h4>
                            </div> 
                            <h4 >Price : $ <?php echo $row_product['product_price']; ?> (U.S)</h4>
                            <h6>(Views :<?php echo $row_product['view_count']; ?>)</h6>

                            <div class="form-group">
                                <form method="" role="form">
                                    <input type="hidden" value="<?php echo $row_product["product_ID"]; ?>">
                                    <input id="add_to_cart" class=" btn btn-primary" type="button" value="Add to Cart">
                                    <a id="details" class="btn btn-default" href="products/details.php?product_ID=<?php echo $row_product['product_ID']; ?>" target="_blank">
                                        Details
                                    </a>
                                </form>
                            </div>
                        </div>     

                    </div>
        <?php
    } else {
        echo '';
    }
}
?>    

            <!--            <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading"><h4>Product Name</h4></div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
                        <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading"><h4>Product Name</h4></div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
                        <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">Product Name</div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
                        <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">Product Name</div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
                        <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">Product Name</div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
                        <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">Product Name</div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
                        <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">Product Name</div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
                        <div class="col-md-4 col-ms-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">Product Name</div>   
                                <div class="panel-body">    
                            <a href="#">
                                <img class="img-responsive portfolio-item" src="images/product.jpg" alt="">
                            </a>
                                    <h4>$ 90 only(U.S)</h4>
                                </div>
                               
                            <div class="form-group">
                            <form method="post" role="form" >
                                <input id="add_to_cart" class="btn btn-default" type="button" value="Add to Cart">
                                <button id="details" class="btn btn-default">Details</button>
                            </form>
                            </div>
                            </div>     
                                
                        </div>
                        
            
            -->

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
        <!---Product Close-->

        <!-- Footer -->
        <hr>
<?php
require_once "./views/footer.php";
?>

        <!--Footer-->
        </body>

        </html>
