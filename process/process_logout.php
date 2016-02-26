<?php
session_start();
if (isset($_SESSION['user'])) {
    $user=$_SESSION['user'];
} 

require_once "../models/user.php";
$obj_user = new User();
$obj_user->username=$user['username'];
$status="offline";
$obj_user->change_status($status);

unset($_SESSION['user']);


header("Location:../index.php");
?>