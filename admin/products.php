<?php
require_once 'views/top.php';
require_once '../models/product.php';

$obj_product = new product();
$result_product = $obj_product->get_products();
$item_per_page = 9;
$total_items = $result_product->num_rows;
$total_pages = ceil($total_items / $item_per_page);

if (empty($_GET['s'])) {
    $s = 0;
} else {
    $s = $_GET['s'];
}
$resultlimitproduct = $obj_product->get_product_by_limit($s, $item_per_page);
if (isset($_POST['search'])) {
    $name = $_POST['search'];
} else {
    $name = "";
}

$result_search = $obj_product->get_product_by_query($name);
//print_r($result_search);

if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<title>Admin Panel | Products</title>
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

            <h2>Active Products</h2>
            <div class="col-lg-12">
                <form class="form-horizontal" role="form" method="post" action="products.php">
                    <label class="control-label col-sm-2" for="email">Search Products:</label>
                    <div class="col-sm-6">  
                        <input class="form-control" type="text" name="search" placeholder="Enter Product ID or Product Name">
                    </div>
                    <div class="col-sm-2">  
                        <input class="form-control" type="submit" value="Search">
                    </div>

                </form>
                <button class="btn btn-primary"><a href="insert/add_product.php" class="bg-primary">Add Product</a></button>
            </div>
        </div>
        <hr>  
        <p>Click on Product Image to Add More</p>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>  
                        <th>Product Name</th>
                        <th>Product Info</th>
                        <th>Product Price</th>
                        <th>Category</th>
                        <th>Product Image</th>
                        <th>Product Discount</th>
                        <th>Status</th>
                        <th>Created date</th>
                        <th>Edit Product</th>
                        <th>Delete Product</th>
                    </tr>
                </thead>
                <tbody>
<?php

if($s < 1){
$counter = 1; //$counter<=9;
}
 else {
 $counter = $s+1;    
}
while ($row_product = $resultlimitproduct->fetch_array()) {
    ?>
                        <tr>
                            <td><?php echo $counter; ?></td>  
                            <td><?php echo $row_product['product_name'] ?></td>
                            <td><?php echo $row_product['product_info'] ?></td>
                            <td>$<?php echo $row_product['product_price'] ?></td>
                            <td>
    <?php echo $row_product['product_category']; ?>
                            </td>
                            <td>
                                <a href="insert/add_pimages.php?pid=<?php echo $row_product['product_ID']; ?>" class="bg-primary">  
                                    <img class="img-responsive" id="prdct_add_image"  
                                         src="../images/products/<?php echo $row_product['product_name']; ?>/<?php echo $row_product['product_image']; ?>">
                                </a>
                            </td>
                            <td><?php echo $row_product['product_discount']; ?></td>
                            <td><?php echo $row_product['product_status']; ?></td>
                            <td><?php echo $row_product['created_date']; ?></td>
                            <td><a href="update/edit_product.php?productID=<?php echo $row_product['product_ID'] ;?>">Edit</a></td>
                            <td><a href="delete/delete_product.php?productID=<?php echo $row_product['product_ID'] ;?>">Delete</a></td>
                        </tr>



    <?php
    $counter++;
}
?>

                </tbody>
            </table>
          
            <div class="col-md-12">
                <ul class="pagination center-block">
                    <?php
                    $start_index = 0;
                    for ($page_counter = 1; $page_counter <= $total_pages; $page_counter++) {
                                               echo '<li><a href="products.php?s=' . $start_index . '">' . $page_counter . '</a></li>';
                        $start_index = $start_index + $item_per_page;
                        
                    }
                    ?>
                </ul>
            </div>
        <!--pagination-->
        </div>
        <div class="modal fade" id="delete" style="padding-top:25%;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Do you wish to delete Product?</h4><br>
                        <a href="delete/delete_product.php">
                            <button class="btn btn-danger" style="width:30%;">
                                <span class="glyphicon glyphicon-ok"></span> Yes
                            </button>
                        </a>
                        <a  data-dismiss="modal" aria-label="Close" href="#">
                            <button class="btn btn-primary" style="width:30%;">
                                <span class="glyphicon glyphicon-remove"></span> No
                            </button>
                        </a>
                    </div>

                </div>
            </div>
        </div>                
    </div>
    <!---page content-->       
    <!-- Footer -->
<?php
require_once './views/footer.php';
?>
    <!-- /.footer -->



</body>

</html>
