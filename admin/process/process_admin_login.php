<?php

session_start();
$username = $_POST['admin_name'];
$Password = $_POST['admin_password'];
if ($username == "aydan" && $Password == "aydan") {
    $_SESSION['admin_user'] = $username;
    header("location:../home.php");
} else {
    echo "Invalid Emailaddress or Password";
    header("Location:../login.php");
}
?>