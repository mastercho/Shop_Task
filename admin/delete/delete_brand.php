<?php

require_once '../../models/brand.php';
$obj_brand = new brand();
$obj_brand->brandID = $_REQUEST['brandID'];
$obj_brand->delete_brand();

header("location:../brands.php");
?>
