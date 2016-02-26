<?php
//print_r($_POST);


if($_GET['action']="comment"){
require_once '../models/comment.php';
$obj_comment= new comment();

$obj_comment->userID=$_POST['userID'];
$obj_comment->productID=$_POST['productID'];
$obj_comment->comment=$_POST['comment'];
$obj_comment->created_date=date("y-m-d H:i:s");
$obj_comment->add_comment();


$pid=$_POST['productID'];
$result_coment = $obj_comment->get_comments($pid);
$row_comment=$result_coment->fetch_array();
//print_r($row_comment);
}
/*
else if($_GET['action']="delete")
{
require_once '../models/comment.php';
$obj_comment= new comment();
	
	
    $obj_comment->commentID=$_POST['commentID'];
    $obj_comment->delete_comment();

	
	$pid=$_POST['productID'];
	$result_coment = $obj_comment->get_comments($pid);
	$row_comment=$result_coment->fetch_array();
	echo "got it";
}
*/