<?php
session_start();
define("BASE_URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . "shop/");

function __autoload($class_name) {
    //echo("$class_name");
    //die;

    $file_name = $_SERVER['DOCUMENT_ROOT']
            . '/shop/models/'
            . $class_name . ".php";
    if (!is_file($file_name)) {
        die("Failed to load model $class_name");
    }

    require_once $file_name;
}

if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = 0;
}
if (isset($_SESSION['user'])) {
    $user=$_SESSION['user'];
}  

//check if cart exists

$obj_cart = new cart();
$obj_cart->session_id = session_id();
$obj_cart->created_date = date('y-m-d');
$c = $obj_cart->getcart_by_session_id();
//echo $c->num_rows;
if ($c->num_rows <= 0) {
    $obj_cart->insert_cart();
}
/*
  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
 */
?>
<!DOCTYPE html>
<html lang="en">

    <div id="loading">
        <img id="loading-image" class="img-responsive top"
             src="<?php echo (BASE_URL); ?>images/loaders/ajax-loader.gif" alt="Loading..."/>
    </div>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Online Shop</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo(BASE_URL); ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo(BASE_URL); ?>css/styles.css" rel="stylesheet">
        <script src="<?php echo (BASE_URL); ?>js/jquery-1.8.3.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <link type="text/css" rel="stylesheet" href="../js/magiczoom/magiczoom.css"/>	
            <script type="text/javascript" src="../js/magiczoom/magiczoom.js"></script>
    
        <![endif]-->
        <script language="javascript" type="text/javascript">
            $(window).load(function () {
                $('#loading').hide();
            });

        </script>
