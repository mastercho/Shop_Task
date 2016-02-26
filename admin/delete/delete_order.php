<?php
session_start();

require_once '../../models/cart.php';
$obj_order= new cart();

$obj_order->orderID = $_REQUEST['orderID'];
$obj_order->delete_order();

header("location:../orders.php");


?>
