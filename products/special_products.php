<?php
require_once '../views/top.php';
require_once '../models/post.php';
require_once '../models/category.php';

$obj_product = new product();
$resultproduct = $obj_product->special_products();
$item_per_page = 9;
$total_items = $resultproduct->num_rows;
$total_pages = ceil($total_items / $item_per_page);

if (empty($_GET['s'])) {
    $s = 0;
} else {
    $s = $_GET['s'];
}
$resultlimitproduct = $obj_product->special_products_by_limit($s, $item_per_page);
?>

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
    <div class="container">

        <!--Middle Nav-->
        <?php
        require_once '../views/middle_nav.php';
        ?>        

        <!--Middle Nav close-->

        <!-- Products -->
        <div class="col-sm-9" id="product_area">


            <div class="col-md-12" >
                <h2 class="page-header">Special Products</h2>
            </div>

            <?php
            while ($row_product = $resultlimitproduct->fetch_array()) {
                if ($row_product["product_status"] == "Active") {
                    ?> 
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <?php if ($row_product['view_count'] >= 30) { ?>    
                                <span class="badge">Specials</span>
                            <?php } else { ?>      
                                <span class="badge">New</span>
                            <?php } ?>    
                            <a id="details" title="Click To view Details" data-toggle="modal" data-target="#<?php echo $row_product['product_ID'] ?>" href="#">
                                <img id="product_img" src="../images/products/<?php echo $row_product['product_name']; ?>/<?php echo $row_product['product_image']; ?>" alt="">
                            </a>
                            <div class="caption">
                                <h4 class="pull-right">$<?php echo $row_product['product_price']; ?></h4>
                                <h4><a id="details" title="Click To view Details" 
                                       href="details.php?pid=<?php echo $row_product['product_ID']; ?>" target="_blank">
                                           <?php echo $row_product["product_name"]; ?>
                                    </a>
                                </h4>
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
                            <div class="btn-group">
                                <form method="post" role="form" action="../process/process_cart.php?action=add">
                                    <input type="hidden" id="pid" name="pid" value="<?php echo $row_product["product_ID"]; ?>">
                                    <input type="hidden" id="price" name="price" value="<?php echo $row_product["product_price"]; ?>">
                                    <button id="add_to_cart" type="submit" class="btn btn-block">Add To Cart</button>
                                </form>
                                <!--<button id="details" type="button" class="btn btn-default">Details</button>-->
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo '';
                }
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
                                <img  src="../images/products/<?php echo $row_m_p['product_name']; ?>/<?php echo $row_m_p['product_image']; ?>" alt=""> 
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

            <div class="col-md-12">
                <ul class="pagination">
                    <ul class="pagination">
                        <?php
                        $start_index = 0;
                        for ($page_counter = 1; $page_counter <= $total_pages; $page_counter++) {
                            echo '<li><a href="special_products.php?s=' . $start_index . '">' . $page_counter . '</a></li>';
                            $start_index = $start_index + $item_per_page;
                        }
                        ?>
                    </ul>
                </ul>
            </div>
            <!--pagination-->

        </div>
        <!--pagination-->

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
