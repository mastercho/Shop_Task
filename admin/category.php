<?php
require_once 'views/top.php';
require_once '../models/category.php';
$obj_category = new category();
$result_category = $obj_category->view_category();
$item_per_page = 12;
$total_items = $result_category->num_rows;
$total_pages = ceil($total_items / $item_per_page);

if (empty($_GET['s'])) {
    $s = 0;
} else {
    $s = $_GET['s'];
}
$resultlimitcategory = $obj_category->get_category_by_limit($s, $item_per_page);


if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<title>Admin Panel || Category</title>
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

            <h2>Category Management</h2>
            <br>
            <div class="col-lg-8">
                <form class="form-horizontal" role="form" method="Get">
                    <label class="control-label col-sm-3" for="email">Search Categorys:</label>
                    <div class="col-sm-7">  
                        <input class="form-control" type="search" placeholder="Enter Category Name">
                    </div>
                </form>
				<a href="<?php echo (BASE_URL); ?>admin/insert/add_category.php" class="bg-primary">
                <button class="btn btn-primary">Add Category</button>
				</a>
            </div>
        </div>

        <hr>            
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>  
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
            if($s < 1) {
            $counter = 1; //$counter<=9;
                } else {
                    $counter = $s+1;
                }
        while ($row = $resultlimitcategory->fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>  
                        <td><?php echo $row["category_name"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td><?php echo $row["created_date"]; ?></td>
                        <td><a href="<?php echo (BASE_URL); ?>admin/update/edit_category.php?categoryID=<?php echo $row["categoryID"]; ?>">Edit</a></td>
                        <td><a href="delete/delete_category.php?categoryID=<?php echo $row["categoryID"]; ?>">Delete</a></td>
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
                        echo '<li><a href="category.php?s=' . $start_index . '">' . $page_counter . '</a></li>';
                        $start_index = $start_index + $item_per_page;
                    }
                    ?>
                </ul>
            </div>
            <!--pagination-->
        
    </div>

    <!---page content-->       
    <!-- Footer -->
    <?php
    require_once './views/footer.php';
    ?>
    <!-- /.footer -->



</body>

</html>
