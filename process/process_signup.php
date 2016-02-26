<?php

session_start();

if ($_REQUEST['action'] == "signup") {
    require_once '../models/user.php';
//print_r ($_POST);
//echo '<br>';
    echo("<pre>");
    print_r($_POST);
    echo("</pre>");
    echo("<pre>");
    print_r($_SESSION);
    echo("</pre>");



    $obj_user = new User();
    $errors = array();
    $signup = array();
    /*  Checks First Name      */
    try {
        $first_name = $_POST['first_name'];
        $reg = "/^[a-z]+$/i";
        if (empty($first_name) || !preg_match($reg, $first_name)) {
            throw new Exception("Invalid / Missing First name");
        } else {
            $obj_user->first_name = $first_name;
            $signup['first_name'] = $first_name;
        }
    } catch (Exception $ex) {
        $errors['first_name'] = $ex->getMessage();
    }

    /*  Checks last Name */
    try {
        $last_name = $_POST['last_name'];
        $reg = "/^[a-z]+$/i";
        if (empty($last_name) || !preg_match($reg, $last_name)) {
            throw new Exception("Invalid / Missing Last name");
        } else {
            $obj_user->last_name = $last_name;
            $signup['last_name'] = $last_name;
        }
    } catch (Exception $ex) {
        $errors['last_name'] = $ex->getMessage();
    }

    /*  Checks User Name      */

    try {
        $user_name = $_POST['username'];
        $reg = "/^[a-z][a-z0-9]{5,19}$/i";
        if (!preg_match($reg, $user_name) || empty($user_name)) {
            throw new Exception("Invalid / Missing Username");
        } else {
            $obj_user->username = $user_name;
            $signup['user_name'] = $user_name;
        }
    } catch (Exception $ex) {
        $errors['user_name'] = $ex->getMessage();
    }

    /*  Checks Email      */

    try {
        $email = $_POST['email'];
        $reg = "/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zAZ]\.)+[a-zA-Z]{2,4})$/";
        if (!preg_match($reg, $email) || empty($email)) {
            throw new Exception("Invalid / Missing Email");
        } else {
            $obj_user->email = $email;
            $signup['email'] = $email;
        }
    } catch (Exception $ex) {
        $errors['email'] = $ex->getMessage();
    }

    /*  Checks Password   */

    try {
        $password = $_POST['password'];
        $reg = "/^[a-z][a-z0-9]{5,15}$/i";
        if (!preg_match($reg, $password)) {
            throw new Exception("Invalid / Missing Password");
        } else {
            $obj_user->password = sha1($password);
            $signup['password'] = $password;
        }
    } catch (Exception $ex) {
        $errors['password'] = $ex->getMessage();
    }
    /*  Checks Retype Password   */

    try {
        if (empty($_POST['password2']) || $_POST['password2'] != $_POST['password']) {
            throw new Exception("Missing / Password Does Not Match");
        }
    } catch (Exception $ex) {
        $errors['password2'] = $ex->getMessage();
    }

    /*  Checks Date Of Birth   */

    try {
        $DOB = $_POST['date_of_birth'];
        $reg = "m-d-y";
        if (empty($DOB)) {
            throw new Exception("Missing Date Of Birth");
        } else {
            $obj_user->date_of_birth = $DOB;
            $signup['date_of_birth'] = $DOB;
        }
    } catch (Exception $ex) {
        $errors['date_of_birth'] = $ex->getMessage();
    }
    /*   Profile Image     */
    try {
        $profile_image = $_FILES['profile_image'];
//    echo '<br>';
//    print_r($_FILES['profile_image']);
        if ($profile_image['error'] == 4) {
            throw new Exception("File Missing");
        }
        if ($profile_image['size'] > 512000) {
            throw new Exception("MAx file size is 500KB");
        }
        $img_data = getimagesize($profile_image['tmp_name']);
        if (!$img_data) {
            throw new Exception("Not a valid file");
        }

        if ($img_data['mime'] != $profile_image['type']) {
            throw new Exception("Corrupt Image");
        }
        $valid_types = array("image/jpeg", "image/bmp", "image/png", "image/gif");
        if (!in_array($profile_image['type'], $valid_types)) {
            throw new Exception("Not an allowed type");
        } else {
            $obj_user->profile_image = $_FILES['profile_image']['name'];
        }
    } catch (Exception $ex) {
        $errors['profile_image'] = $ex->getMessage();
    }
    /*  Checks Gender   */

    try {
        $gender = $_POST['gender'];
        $genders = array("Male", "Female");
        if (!in_array($gender, $genders)) {
            throw new Exception("Missing Gender");
        } else {
            $obj_user->gender = $_POST['gender'];
            $signup['gender'] = $gender;
        }
    } catch (Exception $ex) {
        $errors['gender'] = $ex->getMessage();
    }

    /*  Checks Education   */

    try {
        $education = $_POST['edu'];
        if (is_null($education)) {
            throw new Exception("Missing Education Option(s)");
        } else {
            $obj_user->education = $_POST['edu'];
        }
    } catch (Exception $ex) {
        $errors['education'] = $ex->getMessage();
    }

    /*  Checks Country   */

    try {
        $country = $_POST['country'];
        if (empty($country)) {
            throw new Exception("Missing Country");
        } else {
            $obj_user->country = $country;
        }
    } catch (Exception $ex) {
        $errors['country'] = $ex->getMessage();
    }
    /*  Checks City  */

    try {
        $city = $_POST['city'];
        if (empty($city)) {
            throw new Exception("Missing City");
        } else {
            $obj_user->city = $city;
        }
    } catch (Exception $ex) {
        $errors['city'] = $ex->getMessage();
    }
    /*  Checks About  */

    try {
        $about = $_POST['about'];
        $about = trim($about);
        if (empty($about) || strlen($about) < 10) {
            throw new Exception("Missing/Too Short About");
        } else {
            $obj_user->about = $about;
        }
    } catch (Exception $ex) {
        $errors['about'] = $ex->getMessage();
    }
    /* Check Security Code */
    if (!($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code']) )) {
        $errors['security_code'] = "Invalid / Missing Security Code";
    }

    $obj_user->register_date = date("y-m-d");
    /*  Checks Complete   */
    $full_name = "$obj_user->first_name $obj_user->last_name";
    //return $full_name;   
    if (count($errors) == 0) {
        try {
            $obj_user->signup();
            $msg = "Congratulations $full_name";
            $_SESSION['msg'] = $msg;
            unset($_SESSION['signup']);
            //$msg_email = "Click to <a href='http://localhost/php278/project/activate.php?userID=$obj_user->userID&act_code=$act_code' target='_blank'>Activate</a>"; 
            //$_SESSION['msg_email'] = $msg_email;
            // File Type
            $FileType = $_FILES['profile_image']['type'];
            // Move file from temp location to desire/destination location
            $objuser->username = $user_name;
            $dp_folder = "../images/users/" . $obj_user->username;
            //echo $dp_folder;
            if (!is_dir($dp_folder)) {
                mkdir($dp_folder, 0777);

                //mkdir($obj_product->product_name);
            }
            //exit();
            $DestinationPath = "../images/users/" . $obj_user->username . "/" . $_FILES['profile_image']['name'];

            move_uploaded_file($_FILES['profile_image']['tmp_name'], $DestinationPath);
            echo "Upload completed";
        } catch (Exception $ex) {
            $_SESSION['msg_err'] = $ex->getMessage();
        }
        header("Location:../activate.php?uname=" . $_POST['username'] . "");
    } else {
        $msg = " Error";
        $_SESSION['msg'] = $msg;
        $_SESSION['errors'] = $errors;
        $_SESSION['signup'] = $signup;
        //$_SESSION['obj_user'] = serialize($obj_user);
        //print_r($errors);
        header("Location:../signup.php");
    }
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
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
        echo '<h4>Too Short or Invalid Username<h4>';
    }
} else if ($_GET['action'] == "check_password") {
    $reg = "/^[a-z][a-z0-9]{5,19}$/i";
    if (preg_match($reg, $_POST['password'])) {
		 echo "<h4><img src='images/tick.gif'></h4>";		
		}else {
			echo '<h4>Too Short/Long or Invalid Password<h4>';
		}
} else if ($_GET['action'] == "scode") {
    session_start();
    if ($_POST['security_code'] != $_SESSION['security_code']) {
        echo "Invalid Code";
    }
} else if ($_REQUEST['action'] == "activate") {
    require_once '../models/user.php';

    $objuser = new User();
    $objuser->status = $_POST['status'];
    $objuser->username = $_POST['username'];
    echo $_POST['username'];
    
    $objuser->activate_user();
    echo "<br>";
	$result=$objuser->get_username();
	$row= $result->fetch_array();
    $user = array();
    $user['userID'] = $row['userID'];
    $user['username'] = $row['username'];
    $user['profile_image'] = $row['profile_image'];
	$_SESSION['user'] = $user;
	
	print_r($_SESSION['user']);
	header("location:../index.php");
     
} else if ($_REQUEST['action'] == "get_profile") {
    require_once '../models/user.php';

    $objuser = new User();
    $objuser->username = $_POST['username'];
    
    $result=$objuser->get_username();
    if($result->num_rows > 0){
    $row= $result->fetch_array();
    
    echo "<div class='h5 pull-right'>Found ".$result->num_rows." User(s)</div> ";
    echo "<div class='row bg-info'>";
    echo "<div class='col-md-3 row'>";
    echo "<img class='img-thumbnail' src='images/users/". $row['username']."/". $row['profile_image']."'>";
    echo  "</div>";
    echo  "<div class='col-md-5'>";
    echo  "<h4 class='text-capitalize  pull-left'>Username : " .$row['username'] . "</h4>";
    echo  "<h4 class='text-capitalize pull-left'>Email : " .$row['email'] . "</h4>";
    echo  "<p><h4 class='text-capitalize pull-left'>Full Name : " .$row['first_name'] ." ". $row['last_name'] . "</h4></p>";
    echo  "<h4 class='pull-left'><a class='btn-btn-link' href='users/f_password.php?uname=" . $row['username'] ."'>Click To Countinue </a></h4>";
    echo  "</div>";
    echo  "</div>";
    }
    else{
        echo "No User Found" ;
    }
     
}
else if($_REQUEST['action'] == "forgot_password"){
    require_once "../models/user.php";
    $obj_user = new User();
    $errors = array();
    if(!empty($_POST['code'])){
       if($_POST['code']=$_SESSION['code']){
           $obj_user->username = $_POST['uname'];
           $result=$obj_user->get_username();
           $row=$result->fetch_array();
           $pass=$row['password'];
           $_SESSION['pass']=  unserialize($pass);
           echo $_SESSION['pass'];
       }
       else{
           echo "Code Does Not Match";
       }
    }
    else{
        echo "Please Enter The Code Sent Again";
        }
    
    print_r($_POST);
}
else if($_REQUEST['action'] == "check_signup"){
	echo "<img src='images/tick.gif'>";
}
?>     