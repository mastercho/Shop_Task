<?php

date_default_timezone_set('Asia/Karachi');

session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
print_r($_POST);
require_once '../models/chat.php';
require_once '../models/user.php';
$obj_chat = new chat();
$obj_user = new User();
if ($_REQUEST['action'] == "create_chat") {
    $obj_chat->sender = $user['userID'];
    $obj_chat->reciever = $_REQUEST['id'];
    $obj_chat->created_date = date("y-m-d h:i:s");

    $obj_user->userID = $_REQUEST['id'];
    $result_user = $obj_user->get_username_by_userID();
    $row_user = $result_user->fetch_array();
    // print_r($row_user);   

    $result_chat = $obj_chat->get_chat();
    $row_chat = $result_chat->fetch_array();
    //echo $row_chat['chatID'];
    if ($result_chat->num_rows > 0) {
        header("location:../messages.php?chatID=" . $row_chat['chatID'] . "");
        $msg = $row_user['username'];
        $_SESSION['msg'] = $msg;
    } else {
        $obj_chat->create_chat();
        header("location:../messages.php?chatID=" . $row_chat['chatID'] . "");
        $msg = $row_user['username'];
        $_SESSION['msg'] = $msg;
    }
} else if ($_GET['action'] == "send") {
    require_once '../models/chat.php';
    $obj_chat = new chat();
    $obj_chat->chatID = $_POST['chatID'];
    $obj_chat->userID = $_POST['userID'];
    $obj_chat->message = $_POST['msg'];
    $obj_chat->sent_date = date("y-m-d h:i:s");
    $obj_chat->send();
    $result_chat = $obj_chat->get_messages_by_chatID();
    $row_chat = $result_chat->fetch_array();
    //  header("location:../messages.php?chatID=".$row_chat['chatID']."");
    print_r($row_chat);
    //print_r($_POST);
} else if ($_GET['action'] == "recieve") {
    require_once '../models/chat.php';
    $obj_chat = new chat();
    $obj_chat->chatID = $_POST['chatID'];
    $obj_user->userID = $_POST['userID'];
    $result_chat = $obj_chat->get_messages_by_chatID();
    $row_chat = $result_chat->fetch_array();
    //  header("location:../messages.php?chatID=".$row_chat['chatID']."");
    print_r($row_chat);
} else if ($_GET['action'] == "notify") {
    require_once '../models/chat.php';
    $obj_chat = new chat();
    $obj_chat->chatID = $_POST['chatID'];
    $result_chat = $obj_chat->get_messages_by_chatID();

//$row_chat=$result_chat->fetch_array();
    //  header("location:../messages.php?chatID=".$row_chat['chatID']."");
    echo $result_chat->num_rows;
}
?>
