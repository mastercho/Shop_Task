<?php
require_once '../../models/cart.php';

$obj_order= new cart();
$obj_order->orderID=$_POST['orderID'];
$obj_order->status= $_POST['status'];
$obj_order->update_orders_by_orderID();
Echo "Changed To ".$_POST['status']."";
//header("location:../orders.php");

