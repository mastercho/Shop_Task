<?php

require_once '../../models/ads.php';
$obj_ad = new ads();

if ($_REQUEST['action'] == "add") {
// File Type
    $FileType = $_FILES['ad_image']['type'];
    // Move file from temp location to desire/destination location
    $obj_ad->ad_name = $_POST['ad_name'];
    $ADFolder = "../../images/ads/" . $obj_ad->ad_name;
    echo $ADFolder;
    if (!is_dir($ADFolder)) {
        mkdir($ADFolder, 0777);
        //mkdir($obj_product->product_name);
    }
    //exit();
    $DestinationPath = "../../images/ads/" . $obj_ad->ad_name . "/" . $_FILES['ad_image']['name'];

    move_uploaded_file($_FILES['ad_image']['tmp_name'], $DestinationPath);
    echo "Upload completed";
    $obj_ad->ad_name = $_POST['ad_name'];
    $obj_ad->ad_description = $_POST['ad_description'];
    $obj_ad->ad_image = $_FILES['ad_image']['name'];
    $obj_ad->status = $_POST['status'];
    $obj_ad->created_date = date("y-m-d h:i:s");
    $obj_ad->add_ad();

    header("location:../ads.php");
} else if ($_REQUEST['action'] == "update") {
// File Type
    $FileType = $_FILES['ad_image']['type'];
    // Move file from temp location to desire/destination location
    $obj_ad->ad_name = $_POST['ad_name'];
    $ADFolder = "../../images/ads/" . $obj_ad->ad_name;
    echo $ADFolder;
    if (!is_dir($ADFolder)) {
        mkdir($ADFolder, 0777);
        //mkdir($obj_product->product_name);
    }
    //exit();
    $DestinationPath = "../../images/ads/" . $obj_ad->ad_name . "/" . $_FILES['ad_image']['name'];

    move_uploaded_file($_FILES['ad_image']['tmp_name'], $DestinationPath);
    echo "Upload completed";
    $obj_ad->ad_ID = $_POST['ad_ID'];
    $obj_ad->ad_name = $_POST['ad_name'];
    $obj_ad->ad_description = $_POST['ad_description'];
    $obj_ad->ad_image = $_FILES['ad_image']['name'];
    $obj_ad->status = $_POST['status'];
    $obj_ad->created_date = date("y-m-d h:i:s");
    $obj_ad->update_ad();

    header("location:../ads.php");
}else if($_REQUEST['action'] == "check_name"){

        $name = $_POST['name'];
        $reg = "/^[a-z][a-z0-9]+$/i";
        if (empty($name) || !preg_match($reg, $name)) {
            //echo "<blockquote>Invalid / Missing Product name</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Invalid or Missing AD Name !</strong>";
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
               echo "<strong>Invalid or Missing Ad Info!</strong>";
               echo "</div>";
            
        } else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}else if($_REQUEST['action'] == "check_image"){

        $image = $_POST['image'];
        if (empty($image)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing Ad Image!</strong>";
               echo "</div>";
            
        }
         else {
            ///echo "<blockquote><img src='../../images/tick.gif'></blockquote>";
               echo "<div class='alert alert-success fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong><img src='../../images/tick.gif'></strong>";
               echo "</div>";      
           
        }    
}else if($_REQUEST['action'] == "check_status"){

        $status = $_POST['status'];
        if (empty($status)) {
            //echo "<blockquote>Missing Product Price</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Missing AD Status!</strong>";
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
