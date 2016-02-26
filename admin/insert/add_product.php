<?php
require_once '../views/top.php';
$obj_category = new category();
$result_category = $obj_category->view_category();

$obj_brand = new brand();
$result_brand = $obj_brand->view_brand();


if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location:../ login.php"));
}
?>
<script>
    $(document).ready(function (e) {
        $("#product_name").keyup(function (e)
        {
            var name = $("#product_name").val();

            $.post("../process/process_product.php?action=check_name", {name: name}, function (data)
            {
                $("#name_error").html(data);
            });
        });

        $("#product_info").keyup(function (e)
        {
            var info = $("#product_info").val();

            $.post("../process/process_product.php?action=check_info", {info: info}, function (data)
            {
                $("#info_error").html(data);
            });
        });
        $("#product_price").keyup(function (e)
        {
            var price = $("#product_price").val();

            $.post("../process/process_product.php?action=check_price", {price: price}, function (data)
            {
                $("#price_error").html(data);
            });
        });
        
        $(function () {
            $("input:file").change(function () {
                var image = $(this).val();
                $.post("../process/process_product.php?action=check_image", {image: image}, function (data)
                {     
                  $("#image_error").html(data);
                });
            });
        });
        $("#discount").change(function (e)
        {
            var discount = $("#discount").val();

            $.post("../process/process_product.php?action=check_discount", {discount: discount}, function (data)
            {
                $("#discount_error").html(data);
            });
        });        
        $("#category").change(function (e)
        {
            var category = $("#category").val();

            $.post("../process/process_product.php?action=check_category", {category: category}, function (data)
            {
                $("#category_error").html(data);
            });
        });
        $("#brand").change(function (e)
        {
            var brand = $("#brand").val();

            $.post("../process/process_product.php?action=check_brand", {brand: brand}, function (data)
            {
                $("#brand_error").html(data);
            });
        });
        $("#status").change(function (e)
        {
            var status = $("#status").val();

            $.post("../process/process_product.php?action=check_status", {status: status}, function (data)
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

        <div class="col-lg-12">
            <div class="page-header">
                <h3>Add Product</h3>
            </div>
            <div class="col-md-7">     
                <form class="form-horizontal" role="form" method="post" action="../process/process_product.php?action=add" enctype="multipart/form-data">  

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="product_name">Product Name:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
                        </div>
                        <div class="col-sm-4" id="name_error"></div>
                    </div>            

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="product_info">Product Info:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="product_info" name="product_info" placeholder="Enter Product info">
                        </div>
                        <div class="col-sm-4" id="info_error"></div>
                    </div>         

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="product_price">Product Price:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price">
                        </div>
                        <div class="col-sm-4" id="price_error"></div>
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="product_image">Product image:</label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control" id="product_image" name="product_image" placeholder="Enter Product Image">
                        </div>
                        <div class="col-sm-4" id="image_error"></div>
                    </div>         

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="product_discount">Discount:</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="discount" name="product_discount">
                                <option name="product_discount"></option>
                                <?php
                                for ($counter = 0; $counter <= 100; $counter++) {
                                    ?>

                                    <option name="product_discount"><?php echo $counter; ?>%</option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-sm-4" id="discount_error"></div>
                    </div>          

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="category">Category:</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="category" name="product_category">
                                <option name="product_category"></option>
                                <?php
                                $counter = 1;
                                while ($row_category = $result_category->fetch_array()) {
                                    if ($row_category["status"] == "Active") {
                                        ?>  

                                        <option name="product_category"><?php echo $row_category['category_name']; ?></option>
                                        <?php
                                    } else {
                                        echo '';
                                    }
                                    $counter++;
                                }
                                ?>    
                            </select>
                        </div>
                        <div class="col-sm-4" id="category_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="brand">Brand :</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="brand" name="product_brand">
                                <option></option>
                                <?php
                                $counter = 1;
                                while ($row_brand = $result_brand->fetch_array()) {
                                    if ($row_brand["status"] == "Active") {
                                        ?>  

                                        <option name="product_brand"><?php echo $row_brand['brand_name']; ?></option>
                                        <?php
                                    } else {
                                        echo '';
                                    }
                                    $counter++;
                                }
                                ?>    
                            </select>
                        </div>
                        <div class="col-sm-4" id="brand_error"></div>
                    </div>                    

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="status">Status:</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="status" name="product_status">
                                <option name="product_status"></option>
                                <option name="product_status">Active</option>
                                <option name="product_status"> In-Active</option>
                                <option name="product_status">Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-sm-4" id="status_error"></div>
                    </div>                                          


                    <div class="form-group"> 
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="submit" class="btn btn-default">Add Product</button>  
                        </div>
                    </div>


                </form>



            </div>
        </div>       

    </div>
    <!-- Page Content -->
    
    <hr>
<?php

    require_once '../views/footer.php';
?>
</body>

</html>
