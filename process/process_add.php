<?php

require_once '../models/product.php';

$obj_product = new product();
$obj_product->product_ID = $_POST['product_id'];
$obj_product->product_name = $_POST['product_name'];
$obj_product->product_info = $_POST['product_info'];
$obj_product->product_price = $_POST['product_price'];
$obj_product->product_image = $_POST['product_image'];
$obj_product->product_discount = $_POST['product_discount'];
$obj_product->product_category = $_POST['product_category'];
$obj_product->product_status = $_POST['product_status'];
$obj_product->add_product();
echo '<br>';
$product_Code = $_POST["product_id"];

if ($product_Code == "" || empty($product_Code) || !preg_match("/^[a-zA-Z ]*$/", $product_Code)) {
    echo "Product Code Required";
} else {
    //echo  $_POST["product_name"];
}
echo '<br>';

$product_name = $_POST["product_name"];

if ($product_name == "" || empty($product_name) || !preg_match("/^[a-zA-Z ]*$/", $product_name)) {
    echo "Product Name Required";
} else {
    //echo  $_POST["product_name"];
}
echo '<br>';
?>

