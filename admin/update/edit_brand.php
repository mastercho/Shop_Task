<?php
require_once '../views/top.php';

$obj_brand = new brand();
$obj_brand->brandID = $_REQUEST['brandID'];
$result_brand = $obj_brand->get_brand_by_id();
$row_brand = $result_brand->fetch_array();

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
                    <h3>Edit Brand</h3>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" action="../process/process_brand.php?action=update" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-md-2">Brand Name :</label>
                            <div class="form-group col-md-8">
                                <input type="hidden" name="brandID" value="<?php echo $row_brand["brandID"]; ?>">
                                <input class="form-control" type="text" name="brand_name" placeholder="Brand Name" value="<?php echo $row_brand["brand_name"]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Brand image :</label>
                            <div class="form-group col-md-8">
                                <input class="form-control" type="file" name="brand_image" placeholder="Brand image" value="<?php echo $row_brand["brand_image"]; ?>">
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
                                <button class="btn btn-primary form-control" >Edit Brand</button>
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
