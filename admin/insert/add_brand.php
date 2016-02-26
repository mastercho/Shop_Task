<?php
require_once '../views/top.php';
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: ../login.php"));
}
?>
<script>
    $(document).ready(function (e) {
        $("#brand_name").keyup(function (e)
        {
            var name = $("#brand_name").val();

            $.post("../process/process_brand.php?action=check_name", {name: name}, function (data)
            {
                $("#name_error").html(data);
            });
        });
        $(function () {
            $("input:file").change(function () {
                var image = $(this).val();
                $.post("../process/process_brand.php?action=check_image", {image: image}, function (data)
                {     
                  $("#image_error").html(data);
                });
            });
        });
        $("#status").change(function (e)
        {
            var status = $("#status").val();

            $.post("../process/process_brand.php?action=check_status", {status: status}, function (data)
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
                <h3>Add Brand</h3>
            </div>
            <div class="col-md-12">
                <form class="form-horizontal" role="form" action="../process/process_brand.php?action=add" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-2">Brand Name :</label>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" name="brand_name" id="brand_name" placeholder="Brand Name">
                        </div>
						<div class="col-md-4" id="name_error"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Brand Image :</label>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="file" name="brand_image">
                        </div>
						<div class="col-md-4" id="image_error"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Status :</label>
                        <div class="form-group col-md-6">
                            <select class="form-control" name="status" id="status">
                                <option name="status"></option>
                                <option name="status">Active</option>
                                <option name="status">In-Active</option>
                            </select>
                        </div>
						<div class="col-md-4" id="status_error"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="form-group col-md-6">
                            <button class="btn btn-primary form-control" >Add Brand</button>
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
