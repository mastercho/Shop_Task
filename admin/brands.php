<?php
require_once 'views/top.php';

$obj_brand = new brand();
$result_brand = $obj_brand->view_brand();
$item_per_page = 6;
$total_items = $result_brand->num_rows;
$total_pages = ceil($total_items / $item_per_page);

if (empty($_GET['s'])) {
    $s = 0;
} else {
    $s = $_GET['s'];
}
$resultlimitbrand = $obj_brand->get_brand_by_limit($s, $item_per_page);


if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<title>Admin Panel || Brands</title>
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

            <h2>Active Brands</h2>
            <div class="col-lg-8">
                <form class="form-horizontal" role="form" method="Get">
                    <label class="control-label col-sm-3" for="search">Search Brands:</label>
                    <div class="col-sm-7">  
                        <input class="form-control" type="search" placeholder="Enter Brand ID or Name">
                    </div>
                </form>
                <button class="btn btn-primary"><a href="<?php echo (BASE_URL); ?>admin/insert/add_brand.php" class="bg-primary">Add Brand</a></button>
            </div>
        </div>
        <hr>            
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>  
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Status</th>
                        <th>Edit Brand</th>
                        <th>Delete Brand</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($s < 1) {$counter = 1;}
                     else { $counter = $s+1; }
                    while ($row_brand = $resultlimitbrand->fetch_array()) {
                        ?>
                        <tr>
                            <td><?php echo $counter; ?></td>  
                            <td><?php echo $row_brand["brand_name"]; ?></td>
                            <td><img class="img-responsive" id="prdct_add_image"  src="../images/brands/<?php echo $row_brand["brand_name"]; ?>/<?php echo $row_brand["brand_image"]; ?>"></td>
                            <td><?php echo $row_brand["status"]; ?></td>
                            <td><a href="update/edit_brand.php?brandID=<?php echo $row_brand["brandID"]; ?>">Edit</a></td>
                            <td><a href="delete/delete_brand.php?brandID=<?php echo $row_brand["brandID"]; ?>">Delete</a></td>
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
                        echo '<li><a href="brands.php?s=' . $start_index . '">' . $page_counter . '</a></li>';
                        $start_index = $start_index + $item_per_page;
                    }
                    ?>
                </ul>
            </div>
            <!--pagination-->
            
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
