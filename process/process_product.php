<?php
session_start();
require_once '../models/product.php';
$obj_product= new product();

if($_GET['action']="greater"){
    $price=$_POST['price'];
    setcookie("price",$price,  time() + (86400 * 1), "/");
    echo $_COOKIE['price'];
}


?>