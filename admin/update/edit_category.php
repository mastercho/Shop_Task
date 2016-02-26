<?php
require_once '../views/top.php';
require_once '../../models/category.php';
$obj_category = new category();
$obj_category->categoryID = $_REQUEST['categoryID'];
$result_category = $obj_category->get_category_by_id();
$row_category = $result_category->fetch_array();

if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
</head>
<body>
    <div class="container">
        <!--logo Area-->
        <?php
        require_once '../views/header.php';
        ?>
        <!--logo area closed-->
        <hr>
        <!-- Page Content -->
        <div class="container">
            <div class="col-md-12">
                <div class="page-header">
                    <h3>Edit Category</h3>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" action="../process/process_category.php?action=update" method="post">
                        <div class="form-group">
                            <label class="control-label col-md-2">Category Name :</label>
                            <div class="form-group col-md-8">
                                <input type="hidden" name="categoryID" value="<?php echo $row_category["categoryID"]; ?>">
                                <input class="form-control" type="text" name="category_name" placeholder="Category Name" value="<?php echo $row_category["category_name"]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Status :</label>
                            <div class="form-group col-md-8">
                                <select class="form-control" name="status">
                                    <option name="status">Active</option>
                                    <option name="status">In-Active</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="form-group col-md-8">
                                <button class="btn btn-primary form-control" >Edit Categrory</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!---page content-->       
        <!-- Footer -->
        <?php
        require_once '../views/footer.php';
        ?>
        <!-- /.container -->



</body>

</html>
