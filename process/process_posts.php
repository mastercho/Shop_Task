<?php

require_once '../models/post.php';
$obj_post = new post();

if ($_REQUEST['action'] == "post") {
 if(!empty($_FILES["post_image"]['name'])){
    $obj_post->user_ID = $_POST['userID'];
    $obj_post->post_title = $_POST['post_title'];
    $obj_post->post_subtitle = $_POST['post_subtitle'];
    $obj_post->post_image = $_FILES['post_image']['name'];
    if (!empty($_FILES['post_image']['name'])) {
// File Type
        $FileType = $_FILES['post_image']['type'];
        // Move file from temp location to desire/destination location
        $obj_post->post_title = $_POST['post_title'];
        $PFolder = "../images/posts/" . $obj_post->post_title;
        //echo $PFolder;
        IF (!is_dir($PFolder)) {
            mkdir($PFolder, 0777);
        }
        //exit();
        $DestinationPath = "../images/posts/" . $obj_post->post_title . "/" . $_FILES['post_image']['name'];

        move_uploaded_file($_FILES['post_image']['tmp_name'], $DestinationPath);
        echo "Upload completed";
    } else {
        echo "FILE not uploaded";
    }
    $obj_post->created_date = date("y-m-d h:i:s");

    $obj_post->create_post();
  
    header("location:../posts.php");
 }
} else if ($_REQUEST['action'] == "delete") {
    $obj_post->post_id = $_REQUEST['pid'];
    $obj_post->delete_post_by_post_id();
    header("location:../posts.php");
} else if ($_REQUEST['action'] == "edit") {
    $obj_post->post_id = $_POST['pid'];
    $result = $obj_post->get_post_by_post_id();
    $row = $result->fetch_array();
    $file_path = "../images/posts/" . $row['post_title'] . "";
    if (is_dir($file_path)) {
        mkdir($file_path);
    }
    $new_name = "../images/posts/" . $_POST['post_title'] . "";
    rename($file_path, $new_name);

    $obj_post->post_title = $_POST['post_title'];
    $obj_post->post_subtitle = $_POST['post_subtitle'];
    echo $_POST['pid'];

    $obj_post->update_post_by_post_id();
    header("location:../posts.php");
}