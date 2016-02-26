<?php

session_start();

if ($_REQUEST['action'] == "update") {
    require_once '../../models/user.php';
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
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
    /*  Checks First Name      */
    try {
        $first_name = $_POST['first_name'];
        $reg = "/^[a-z]+$/i";
        if (!preg_match($reg, $first_name)) {
            throw new Exception("Invalid / Missing First name");
        } else {
            $obj_user->first_name = $first_name;
        }
    } catch (Exception $ex) {
        $errors['first_name'] = $ex->getMessage();
    }

    /*  Checks last Name      */
    try {
        $last_name = $_POST['last_name'];
        $reg = "/^[a-z]+$/i";
        if (!preg_match($reg, $last_name)) {
            throw new Exception("Invalid / Missing Last name");
        } else {
            $obj_user->last_name = $last_name;
        }
    } catch (Exception $ex) {
        $errors['last_name'] = $ex->getMessage();
    }

    /*  Checks Email      */

    try {
        $email = $_POST['email'];
        $reg = "/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zAZ]\.)+[a-zA-Z]{2,4})$/";
        if (!preg_match($reg, $email)) {
            throw new Exception("Invalid / Missing Email");
        } else {
            $obj_user->email = $email;
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
            $obj_user->password = $password;
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
        }
    } catch (Exception $ex) {
        $errors['date_of_birth'] = $ex->getMessage();
    }

    /*  Checks Education   */

    try {
        $education = $_POST["edu"];
        if (is_null($education)) {
            throw new Exception("Missing Education Option(s)");
        } else {
            $obj_user->education = $_POST["edu"];
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
    /*  Checks Complete   */
    $full_name = "$obj_user->first_name $obj_user->last_name";
    //return $full_name;   
    if (count($errors) == 0) {
        try {
            $userID = $_REQUEST['userID'];
            $username = $user['username'];
            echo $userID;
            $obj_user->update_profile($userID);
            $msg = "Profile updated $username";
            $_SESSION['msg'] = $msg;
            //$msg_email = "Click to <a href='http://localhost/php278/project/activate.php?userID=$obj_user->userID&act_code=$act_code' target='_blank'>Activate</a>"; 
            //$_SESSION['msg_email'] = $msg_email;
        } catch (Exception $ex) {
            $_SESSION['msg_err'] = $ex->getMessage();
        }
        header("Location:../../profile.php?uname=" . $user['username'] . "");
    } else {
        $msg = " Error";
        $_SESSION['msg'] = $msg;
        $_SESSION['errors'] = $errors;
        //$_SESSION['obj_user'] = serialize($obj_user);
        //print_r($errors);
        header("Location:../edit_profile.php?uname=" . $user['username'] . "");
    }
}
else if($_REQUEST['action']="profile_image"){
        require_once '../../models/user.php';
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    $obj_user = new User();
    $errors = array();
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
    
    if (count($errors) == 0) {
        try {
            $username=$user['username'];
            $obj_user->update_profile_image($username);
            $FileType = $_FILES['profile_image']['type'];
            // Move file from temp location to desire/destination location
            $obj_user->username = $user["username"];
            $dp_folder = "../../images/users/" . $obj_user->username;
            //echo $dp_folder;
            if (!is_dir($dp_folder)) {
                mkdir($dp_folder, 0777);

                //mkdir($obj_product->product_name);
            }
            //exit();
            $DestinationPath = "../../images/users/" . $obj_user->username . "/" . $_FILES['profile_image']['name'];

            move_uploaded_file($_FILES['profile_image']['tmp_name'], $DestinationPath);
            echo "Upload completed";
        } catch (Exception $ex) {
            $_SESSION['msg_err'] = $ex->getMessage();
        }
        header("Location:../../profile.php?uname=" . $user['username'] . "");
    } else {
        $msg = " Error";
        $_SESSION['msg'] = $msg;
        $_SESSION['errors'] = $errors;
        header("Location:../edit_profile_image.php");
    }    
    
    
}else if ($_REQUEST['action']="forgot_password") {
    echo "Helllo";
}

?>
