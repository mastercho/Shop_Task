<?php

require_once '../../models/ads.php';
$obj_ad = new ads();
$obj_ad->ad_ID = $_REQUEST['ad_ID'];
$obj_ad->delete_ad();

header("location:../ads.php");
?>
