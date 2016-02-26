<?php

require_once '../../models/brand.php';
$obj_brand = new brand();
if ($_REQUEST['action'] == "add") {
    // File Type
    $FileType = $_FILES['brand_image']['type'];
    // Move file from temp location to desire/destination location
    $obj_brand->brand_name = $_POST['brand_name'];
    $BFolder = "../../images/brands/" . $obj_brand->brand_name;
    echo $BFolder;
    if (!is_dir($BFolder)) {
        mkdir($BFolder, 0777);
        //mkdir($obj_brand->brand_name);
    }
    //exit();
    $DestinationPath = "../../images/brands/" . $obj_brand->brand_name . "/" . $_FILES['brand_image']['name'];

    move_uploaded_file($_FILES['brand_image']['tmp_name'], $DestinationPath);
    echo "Upload completed";
    $obj_brand->brand_name = $_POST['brand_name'];
    $obj_brand->brand_image = $_FILES['brand_image']['name'];
    $obj_brand->status = $_POST['status'];
    $obj_brand->add_brand();

    header("location:../brands.php");
} else if ($_REQUEST['action'] == "update") {
    // File Type
    $FileType = $_FILES['brand_image']['type'];
    // Move file from temp location to desire/destination location
    $obj_brand->brand_name = $_POST['brand_name'];
    $BFolder = "../../images/brands/" . $obj_brand->brand_name;
    echo $BFolder;
    if (!is_dir($BFolder)) {
        mkdir($BFolder, 0777);
        //mkdir($obj_brand->brand_name);
    }
    //exit();
    $DestinationPath = "../../images/brands/" . $obj_brand->brand_name . "/" . $_FILES['brand_image']['name'];

    move_uploaded_file($_FILES['brand_image']['tmp_name'], $DestinationPath);
    echo "Upload completed";

    $obj_brand->brandID = $_POST['brandID'];
    $obj_brand->brand_name = $_POST['brand_name'];
    $obj_brand->brand_image = $_FILES['brand_image']['name'];
    $obj_brand->status = $_POST['status'];
    $obj_brand->update_brand();

    header("location:../brands.php");
}
else if($_REQUEST['action'] == "check_name"){

        $name = $_POST['name'];
        $reg = "/^[a-z][a-z0-9]+$/i";
        if (empty($name) || !preg_match($reg, $name)) {
            //echo "<blockquote>Invalid / Missing Product name</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Invalid or Missing Brand Name !</strong>";
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
               echo "<strong>Missing Brand Image!</strong>";
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
               echo "<strong>Missing Brand Status!</strong>";
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