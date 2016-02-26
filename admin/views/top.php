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
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo(BASE_URL); ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo(BASE_URL); ?>css/styles.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="../../js/jquery-1.8.3.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
