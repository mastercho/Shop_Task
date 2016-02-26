<?php
require_once 'views/top.php';
require_once '../models/product.php';
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
$obj_product = new product();
$obj_category = new category();
$obj_brand = new brand();
if (isset($_POST['search'])) {
    $name = $_POST['search'];
} else {
    $name = "";
}
$result = array();
$result['product'] = $result_p = $obj_product->get_product_by_query($name);
$result['category'] = $result_c = $obj_category->get_category_by_query($name);
$result['brand'] = $result_b = $obj_brand->get_brand_by_query($name);

//print_r($result_p);
//print_r($result_c);
//print_r($result_b);
//sassprint_r($result);


?>
<title>Admin Panel | Search</title>



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

            <h2>Search</h2>
            <div class="col-lg-8">
                <form class="form-horizontal" role="form" method="post" action="search.php">
                    <label class="control-label col-sm-3" for="email">Search :</label>
                    <div class="col-sm-7">  
                        <input class="form-control" type="text" id="search"
                               name="search" placeholder="Enter your Query"
                               value="<?php if(isset($name)){ echo $name;}?>">
                    </div>
                    <div class="col-sm-2">
                        <input class="form-control" type="submit" name="submit" value="search">
                    </div>
                </form>
            </div>
        </div>
        <hr>  
        <div class="col-md-4" id="results">
            <div class="h4">Products</div>
<?php
if (isset($_POST['search']) & !empty($_POST['search'])) {
    if ($result['product']->num_rows > 0) {
        $counter = 1;
        while ($row = $result['product']->fetch_array()) {
            
            ?>
                        <span>
                            <a href="../products/details.php?pid=<?php echo $row['product_ID'] ?>" target="_blank">
                        <?php
                      
                        if (!empty($row['product_name'])) {
                            //echo 'Product :';
                            echo $row['product_name'];
                        }
                        ?>
                            </a> 
                        </span>  <br> 
                                <?php
                                $counter++;
                            }
                        } else {
                            echo 'No result found';
                        }
        }
        ?>
                                    
                        
        </div>

        <div class="col-md-4" id="results">
            <div class="h4">Category</div>
            <?php
            if (isset($_POST['search']) & !empty($_POST['search'])) {
                if ($result['category']->num_rows > 0) {
                    $counter = 1;
                    while ($row = $result['category']->fetch_array()) {
                        ?>
                        <span>
                        <?php
                        if (!empty($row['category_name'])) {
                            //echo 'Category :';
                            echo $row['category_name'];
                        }
                        ?>

                        </span>  <br> 
                            <?php
                            $counter++;
                        }
                    } else {
                        echo 'No result found';
                    }
                }
                ?>
        </div>            

        <div class="col-md-4" id="results">
            <div class="h4">Brand</div>
            <?php
            if (isset($_POST['search']) & !empty($_POST['search'])) {
                if ($result['brand']->num_rows > 0) {
                    $counter = 1;
                    while ($row = $result['brand']->fetch_array()) {
                        ?>
                        <span>
                        <?php
                        if (!empty($row['brand_name'])) {
                            //echo 'Brand :';
                            echo $row['brand_name'];
                        }
                        ?>

                        </span>  <br> 
                        <?php
                        $counter++;
                    }
                } else {
                    echo 'No result found';
                }
            }
            ?>
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
