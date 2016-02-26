<?php

require_once '../../models/product.php';
$obj_product = new product();
$obj_product->productID = $_REQUEST['productID'];
$obj_product->delete_product();

header("location:../products.php");
?>
