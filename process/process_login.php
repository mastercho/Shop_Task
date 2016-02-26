<?php

session_start();

if ($_REQUEST["action"] = "login") {
    require_once '../models/user.php';
//print_r ($_POST);
//echo '<br>';
    echo("<pre>");
    print_r($_POST);
    echo("</pre>");
    echo ("<pre>");
    print_r($_SESSION);
    echo ("</pre>");


    $obj_user = new User();
    $errors = array();

    /*  Checks User Name      */

    try {
        $username = $_POST['username'];
        //$reg = $obj_user->get_username_email();
        if (empty($username)) {
            throw new Exception("Missing Username");
        }
        if ($obj_user->username = $username) {
            $result = $obj_user->get_login_username();
            $row = mysqli_num_rows($result);
            if ($row <= "0") {
                throw new Exception("Username Does not exists");
            }
        } else {
            $obj_user->username;
        }
    } catch (Exception $ex) {
        $errors['username'] = $ex->getMessage();
    }

    try {
        $password = sha1($_POST['password']);
        if (empty($password) || $obj_user->password = $password) {

            $result = $obj_user->login();
            $row = mysqli_num_rows($result);
            if ($row <= "0") {
                throw new Exception("Password does not match");
            }
        } else {
            $obj_user->password = $password;
        }
    } catch (Exception $ex) {
        $errors['password'] = $ex->getMessage();
    }


    $result_user = $obj_user->get_username();
    $user_row = $result_user->fetch_array();
    print_r($user_row);
    $user = array();
    $user['userID'] = $user_row['userID'];
    $user['username'] = $obj_user->username;
	$user['city'] = $user_row['city'];
	$user['zip'] = $user_row['zip_code'];
	$user['birthday'] = $user_row['date_of_birth'];
	$user['email'] = $user_row['email'];

    $user['profile_image'] = $user_row['profile_image'];
    if (count($errors) == 0) {
        try {
            $obj_user->login();
			$status="online";
			$obj_user->change_status($status);
            $_SESSION['user'] = $user;
           /* if($_POST['remember']=="on")
              {
              setcookie("userID", $user['userID'], time() + (86400 * 1), "/"); // 86400 = 1 day
              setcookie("username", $user['username'], time() + (86400 * 1), "/"); // 86400 = 1 day
              setcookie("profile_image", $user['profile_image'], time() + (86400 * 1), "/"); // 86400 = 1 day
              }
              else
              {
              setcookie("userID","",-time()+24*3600);
              setcookie("username","",-time()+24*3600);
              setcookie("profile_image","",-time()+24*3600); 
              }
*/           
        } catch (Exception $ex) {
            $_SESSION['msg_err'] = $ex->getMessage();
        }
        header("Location:../profile.php?uname=$obj_user->username");
    } else {
        $msg = " Error";
        $_SESSION['msg'] = $msg;
        $_SESSION['errors'] = $errors;
        // $_SESSION['obj_user'] = serialize($obj_user);
        //print_r($errors);
        header("Location:../login.php");
    }
} else if ($_GET['action'] == "check_username") {
    require_once("../models/user.php");
    $objuser = new User();
    $objuser->username = $_POST['username'];
//      $obj_user->username=$_REQUEST['username'];
    $result = $objuser->validate_username();

    $reg = "/^[a-z][a-z0-9]{5,19}$/i";
    if (preg_match($reg, $_POST['username'])) {

        if ($_POST['username'] <= 6 & !empty($_POST['username'])) {
            if ($result->num_rows == 1) {
                echo "<h4>Already Taken</h4>";
            } else {
                echo "<h4><img src='images/tick.gif'> Available</h4>";
            }
        }
    } else {
        echo 'Too Short or Invalid Username';
    }
}
?>