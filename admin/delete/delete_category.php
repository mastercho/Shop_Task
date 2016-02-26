<?php

require_once '../../models/category.php';
$obj_category = new category();
$obj_category->categoryID = $_REQUEST['categoryID'];

$obj_category->delete_category();

echo $obj_category->delete_category();
echo 'category deleted';
header("location:../category.php");
?>