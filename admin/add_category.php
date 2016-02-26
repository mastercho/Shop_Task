<?php
require_once 'views/top.php';
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<title>Add Category</title>
</head>
<body>

    <!--logo Area-->
    <?php
    require_once 'views/header.php';
    ?>
    <!--logo area closed-->

    <!-- Page Content -->
    <div class="container">
        <div class="col-md-12">
            <div class="page-header">
                <h3>Add Category</h3>
            </div>
            <div class="col-md-12">
                <form class="form-horizontal" role="form" action="process/process_add_category.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-md-2">New Category :</label>
                        <div class="form-group col-md-8">
                            <input class="form-control" type="text" name="new_category" placeholder="Category Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Status :</label>
                        <div class="form-group col-md-8">
                            <input class="checkbox-inline" type="checkbox" name="status">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="form-group col-md-8">
                            <button class="btn btn-primary form-control" >Add Categrory</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!---page content-->       
    <!-- Footer -->
    <?php
    require_once './views/footer.php';
    ?>
    <!-- /.container -->



</body>

</html>
