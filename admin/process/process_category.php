<?php

require_once '../../models/category.php';
$obj_category = new category();

if ($_REQUEST['action'] == "add") {
    $obj_category->category_name = $_POST['new_category'];
    $obj_category->status = $_POST['status'];
    $obj_category->created_date = date("y-m-d h:i:s");
    $obj_category->add_category();

    header("location:../category.php");
} else if ($_REQUEST['action'] == "update") {
    $obj_category->categoryID = $_POST['categoryID'];
    $obj_category->category_name = $_POST['category_name'];
    $obj_category->status = $_POST['status'];
    $obj_category->created_date = date("y-m-d h:i:s");
    $obj_category->update_category();
    header("Location:../category.php");
} else if ($_REQUEST['action'] == "delete") {
    
}
else if($_REQUEST['action'] == "check_name"){

        $name = $_POST['name'];
        $reg = "/^[a-z][a-z0-9]+$/i";
        if (empty($name) || !preg_match($reg, $name)) {
            //echo "<blockquote>Invalid / Missing Product name</blockquote>";
               echo "<div class='alert alert-danger fade in'>";
               echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   
               echo "<strong>Invalid or Missing Category Name !</strong>";
               echo "</div>";
            
        } else {
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
               echo "<strong>Missing Category Status!</strong>";
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