<?php
require_once '../views/top.php';
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<script>
    $(document).ready(function (e) {
        $("#ad_name").keyup(function (e)
        {
            var name = $("#ad_name").val();

            $.post("../process/process_ad.php?action=check_name", {name: name}, function (data)
            {
                $("#name_error").html(data);
            });
        });

        $("#ad_description").keyup(function (e)
        {
            var info = $("#ad_description").val();

            $.post("../process/process_ad.php?action=check_info", {info: info}, function (data)
            {
                $("#description_error").html(data);
            });
        });
        
        
        $(function () {
            $("input:file").change(function () {
                var image = $(this).val();
                $.post("../process/process_ad.php?action=check_image", {image: image}, function (data)
                {     
                  $("#image_error").html(data);
                });
            });
        });

        $("#status").change(function (e)
        {
            var status = $("#status").val();

            $.post("../process/process_ad.php?action=check_status", {status: status}, function (data)
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
    <div class container>

        <div class="col-lg-12">
            <div class="page-header">
                <h3>Create Ad</h3>
            </div>

            <div class="col-md-12">


                <form class="form-horizontal" role="form" method="post" action="../process/process_ad.php?action=add" enctype="multipart/form-data">  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad_name">Ad Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="ad_name" id="ad_name" placeholder="Enter Ad Name">
                        </div>
                        <div class="col-sm-4" id="name_error"></div>
                    </div>                    

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad_description">Ad Description:</label>
                        <div class="col-sm-6"> 
                            <input type="text" class="form-control" id="ad_description" name="ad_description" placeholder="Enter Ad Description">
                        </div>
                        <div class="col-sm-4" id="description_error"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad_image">Ad Image:</label>
                        <div class="col-sm-6"> 
                            <input type="file" class="form-control" id="ad_image" name="ad_image">
                        </div>
                        <div class="col-sm-4" id="image_error"></div>

                    </div>                    

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Status:</label>
                        <div class="col-sm-6"> 
                            <select class="form-control" name="status" id="status">
                                <option name="name"></option>
                                <option name="name">Active</option>
                                <option name="name">In-Active</option>
                            </select>
                        </div>
                        <div class="col-sm-4" id="status_error"></div>

                    </div>  

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Create Ad</button>  
                        </div>
                    </div>


                </form>


            </div>
        </div>       

    </div>
    <!-- Page Content -->



    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="col-sm-12">
                <div class="panel">    
                    <p>Copyright &copy; Online Shop 2015</p>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </footer>


    <!-- /.container -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

</body>

</html>
