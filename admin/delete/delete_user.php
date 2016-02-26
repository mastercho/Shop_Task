<?php

require_once '../../models/user.php';

$obj_user = new User();
$obj_user->userID = $_REQUEST['userID'];
$obj_user->delete_user();

header("location:../customers.php");
?>
