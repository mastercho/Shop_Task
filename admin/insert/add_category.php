<?php
require_once '../views/top.php';
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: ../login.php"));
}
?>
<script>
    $(document).ready(function (e) {
        $("#category_name").keyup(function (e)
        {
            var name = $("#category_name").val();

            $.post("../process/process_category.php?action=check_name", {name: name}, function (data)
            {
                $("#name_error").html(data);
            });
        });

        $("#status").change(function (e)
        {
            var status = $("#status").val();

            $.post("../process/process_category.php?action=check_status", {status: status}, function (data)
            {
                $("#status_error").html(data);
            });
        });
    });

</script>
</head>

<body>

    <!--logo Area-->
    <?php
    require_once '../views/header.php';
    ?>
    <!--logo area closed-->

    <!-- Page Content -->
    <div class="container">
        <div class="col-md-12">
            <div class="page-header">
                <h3>Add Category</h3>
            </div>
            <div class="col-md-12">
                <form class="form-horizontal" role="form" action="../process/process_category.php?action=add" method="post">
                    <div class="form-group">
                        <label class="control-label col-md-2">New Category :</label>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" id="category_name" name="new_category" placeholder="Category Name">
                        </div>
                    <div class="col-md-4" id="name_error"></div>
					</div>
					

                    <div class="form-group">
                        <label class="control-label col-md-2">Status :</label>
                        <div class="form-group col-md-6">
                            <select class="form-control" name="status" id="status">
                                <option name="status"></option>
                                <option name="status">Active</option>
                                <option name="status">IN-Active</option>
                            </select>
                        </div>
						<div class="col-md-4" id="status_error"></div>
					</div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="form-group col-md-6">
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
    require_once '../views/footer.php';
    ?>
    <!-- /.container -->



</body>

</html>
