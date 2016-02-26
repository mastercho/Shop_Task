<?php

require_once '../../models/product.php';
$obj_product = new product();

if ($_REQUEST['action'] == "add") {
    // File Type
    $FileType = $_FILES['product_image']['type'];
    // Move file from temp location to desire/destination location
    $obj_product->product_name = $_POST['product_name'];
    $PFolder = "../../images/products/" . $obj_product->product_name;
    echo $PFolder;
    if (!is_dir($PFolder)) {
        mkdir($PFolder, 0777);
        //mkdir($obj_product->product_name);
    }
    //exit();
    $DestinationPath = "../../images/products/" . $obj_product->product_name . "/" . $_FILES['product_image']['name'];

    move_uploaded_file($_FILES['product_image']['tmp_name'], $DestinationPath);
    echo "Upload completed";

    $obj_product->product_name = $_POST['product_name'];
    $obj_product->product_info = $_POST['product_info'];
    $obj_product->product_price = $_POST['product_price'];
    $obj_product->product_image = $_FILES['product_image']['name'];
    $obj_product->product_discount = $_POST['product_discount'];
    $obj_product->product_category = $_POST['product_category'];
    $obj_product->product_brand = $_POST['product_brand'];
    $obj_product->product_status = $_POST['product_status'];
    $obj_product->created_date = date("y-m-d h:i:s");

    $obj_product->add_product();
    header("location:../products.php");
} else if ($_REQUEST['action'] == "update") {
    // File Type
    $FileType = $_FILES['product_image']['type'];
    // Move file from temp location to desire/destination location
    $obj_product->product_name = $_POST['product_name'];
    $PFolder = "../../images/products/" . $obj_product->product_name;
    echo $PFolder;
    if (!is_dir($PFolder)) {
        mkdir($PFolder, 0777);
        //mkdir($obj_product->product_name);
    }
    //exit();
    $DestinationPath = "../../images/products/" . $obj_product->product_name . "/" . $_FILES['product_image']['name'];

    move_uploaded_file($_FILES['product_image']['tmp_name'], $DestinationPath);
    echo "Upload completed";

    $obj_product->productID = $_POST['product_ID'];
    $obj_product->product_name = $_POST['product_name'];
    $obj_product->product_info = $_POST['product_info'];
    $obj_product->product_price = $_POST['product_price'];
    $obj_product->product_image = $_FILES['product_image']['name'];
    $obj_product->product_discount = $_POST['product_discount'];
    $obj_product->product_category = $_POST['product_category'];
    $obj_product->product_brand = $_POST['product_brand'];
    $obj_product->product_status = $_POST['product_status'];
    $obj_product->created_date = date("y-m-d h:i:s");
    $obj_product->update_product();

    //echo $obj_product->product_status=$_POST['product_status'];
    header("location:../products.php");
}
else if($_REQUEST['action'] == "check_name"){

        $name = $_POST['name'];
        $reg = "/^[a-z][a-z0-9]+$/i";
        if (empty($name) || !preg_match($reg, $name)) {
            //echo "<blockquote>Invalid / Missing Product name</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Invalid or Missing Product Name !</strong>";
               echo "</div>";
            
        } else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }
    
}
else if($_REQUEST['action'] == "check_info"){

        $info = $_POST['info'];
        $reg = "/^[a-z][a-z0-9]{20,100}+$/i";
        if (empty($info) || !preg_match($reg, $info)) {
            //echo "<blockquote>Invalid / Missing Product name</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Invalid or Missing Product Info!</strong>";
               echo "</div>";
            
        } else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}
else if($_REQUEST['action'] == "check_price"){

        $price = $_POST['price'];
        $reg = "/^[0-9]+$/i";
        if (empty($price)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing Product Price!</strong>";
               echo "</div>";
            
        }
        if (!preg_match($reg, $price)) {
            //echo "<blockquote>Invalid / Missing Product name</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Invalid Product Price! Use Numbers</strong>";
               echo "</div>";
            
        } else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}
else if($_REQUEST['action'] == "check_image"){

        $image = $_POST['image'];
        if (empty($image)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing Product Image!</strong>";
               echo "</div>";
            
        }
         else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}
else if($_REQUEST['action'] == "check_discount"){

        $discount = $_POST['discount'];
        if (empty($discount)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing Product Discount!</strong>";
               echo "</div>";
            
        }
         else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}
else if($_REQUEST['action'] == "check_category"){

        $category = $_POST['category'];
        if (empty($category)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing Product Category!</strong>";
               echo "</div>";
            
        }
         else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}
else if($_REQUEST['action'] == "check_brand"){

        $brand = $_POST['brand'];
        if (empty($brand)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing Product Brand!</strong>";
               echo "</div>";
            
        }
        else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}
else if($_REQUEST['action'] == "check_status"){

        $status = $_POST['status'];
        if (empty($status)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing Product Status!</strong>";
               echo "</div>";
            
        }
        else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}
?>