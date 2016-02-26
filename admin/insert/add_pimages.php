<?php
require_once '../views/top.php';
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
$obj_product = new product();
$obj_product->productID = $_REQUEST['pid'];
$result_product = $obj_product->get_product_by_id();
$row_product = $result_product->fetch_array();
?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#target').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-input").change(function () {
        readURL(this);
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
                <h3>Add images</h3>
            </div>

            <div class="col-md-12">


                <form class="form-horizontal" role="form" method="post" action="../process/process_ad.php?action=add" enctype="multipart/form-data">  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pid">Product name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="<?php echo $row_product['product_name']; ?>">
                        </div>
                        <div class="col-sm-4" id="error_msg">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="images">Select Images:</label>
                        <div class="col-sm-6"> 
                            <div class="filestyle">
                                <label for="file-input">
                                    <img src="../../images/add.png">
                                </label>
                                <input id="file-input" class="form-control" type="file"/>
                            </div>     
                            <img id="target" src="#" height="200">       
                        </div>
                        <div class="col-sm-4" id="error_msg">

                        </div>

                    </div>                    


                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Save</button>  
                        </div>
                    </div>


                </form>


            </div>
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
