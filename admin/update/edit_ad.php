<?php
require_once '../views/top.php';
require_once '../../models/ads.php';

$obj_ad = new ads();
$obj_ad->ad_ID = $_REQUEST['ad_ID'];
$result_ad = $obj_ad->get_ad_by_id();
$row_ad = $result_ad->fetch_array();



if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
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
                <h3>Update Ad</h3>
            </div>

            <div class="col-md-12">


                <form class="form-horizontal" role="form" method="post" action="../process/process_ad.php?action=update" enctype="multipart/form-data">  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad_name">Ad Name:</label>
                        <div class="col-sm-6">
                            <input type="hidden" class="form-control" name="ad_ID"  value="<?php echo $row_ad['ad_ID']; ?>">
                            <input type="text" class="form-control" name="ad_name" id="ad_name" value="<?php echo $row_ad['ad_name']; ?>">
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <div class="alert alert-danger fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>   
                                <strong>Please Provide Ad Name!</strong>
                            </div>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad_description">Ad Description:</label>
                        <div class="col-sm-6"> 
                            <input type="text" class="form-control" name="ad_description" value="<?php echo $row_ad['ad_description']; ?>">
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <div class="alert alert-danger fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>   
                                <strong>Please Provide Ad Description!</strong>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad_image">Ad Image:</label>
                        <div class="col-sm-6"> 
                            <input type="file" class="form-control" name="ad_image" value="<?php echo $row_ad['ad_image']; ?>">
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <div class="alert alert-danger fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>   
                                <strong>Please Provide Ad Image!</strong>
                            </div>
                        </div>

                    </div>                    

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Status:</label>
                        <div class="col-sm-6"> 
                            <select class="form-control" name="status">
                                <option name="name">Active</option>
                                <option name="name">In-Active</option>
                            </select>
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <div class="alert alert-danger fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>   
                                <strong>Please Provide Ad Image!</strong>
                            </div>
                        </div>

                    </div>  

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Update Ad</button>  
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
