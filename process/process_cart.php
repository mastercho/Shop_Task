<?php

session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

require_once '../models/cart.php';
$obj_cart = new cart();
if ($_GET["action"] == "add") {
    $obj_cart->session_id = session_id();
    $obj_cart->created_date = date("y-m-d h:i:s");
    $obj_cart->product_id = $_POST['pid'];
    $obj_cart->price = $_POST['price'];
    $obj_cart->quantity = 1;
    $obj_cart->discount = 0;

    $result_cart = $obj_cart->getcart_by_session_id();
    if ($result_cart->num_rows > 0) {
        $row_cart = $result_cart->fetch_array();
        $obj_cart->cartID = $row_cart['cartID'];
        $_SESSION['cartID'] = $row_cart['cartID'];
//         echo $obj_cart->cartID  ;
    } else {
        $obj_cart->cartID = $obj_cart->insert_cart();
    }
    $result_cart_item = $obj_cart->get_cart_item_by_productcartID();
    if ($result_cart_item->num_rows > 0) {
        $row_cart_item = $result_cart_item->fetch_array();
//        /echo $row_cart_item['quantity'];
        $obj_cart->itemID = $row_cart_item['itemID'];
        $obj_cart->quantity = $row_cart_item['quantity'] + 1;
        $obj_cart->update_quantity();
    } else {
        $obj_cart->insert_cart_item();
    }

    $obj_cart->cartID = $_SESSION['cartID'];
    $result_items = $obj_cart->get_items_by_cartid();
    $_SESSION['items'] = $result_items->num_rows;

    
    
    echo $_POST['pid'];
    header("location: " . $_SERVER['HTTP_REFERER']);
} else if ($_REQUEST['action'] == "manage") {
    if ($_POST['btnmanage'] == "Delete") {
        $arrids = $_POST['chkids'];
        foreach ($arrids as $ids) {
            $obj_cart->itemID = $ids;
            $obj_cart->delete_product();
        }
        //echo $ids;
        $obj_cart->cartID = $_SESSION['cartID'];
        $result_items = $obj_cart->get_items_by_cartid();
        $_SESSION['items'] = $result_items->num_rows;

        header("location:../products/shopping_cart.php");
    } else if ($_POST['btnmanage'] == "Update") {
        $arrids = $_POST['txtids'];
        $arrqty = $_POST['quantity'];
        for ($counter = 0; $counter < count($arrids); $counter++) {
            $obj_cart->itemID = $arrids[$counter];
            $obj_cart->quantity = $arrqty[$counter];
            $obj_cart->update_quantity();
        }
        //print_r ($arrids);
        header("Location:../products/shopping_cart.php");
    } else if ($_POST['btnmanage'] == "Empty") {
        $arrids = $_POST['itemids'];
        foreach ($arrids as $ids) {
            $obj_cart->itemID = $ids;
            $obj_cart->empty_cart();
        }
        $obj_cart->cartID = $_SESSION['cartID'];
        $result_items = $obj_cart->get_items_by_cartid();
        $_SESSION['items'] = $result_items->num_rows;

        header("Location:../products/shopping_cart.php");
    }
} else if ($_REQUEST['action'] = "order") {
    $obj_cart->cartID = $_POST['cartID'];
    $obj_cart->userID = $_POST['userID'];
    $obj_cart->ordered_date = date("y-m-d  h:i:s");
    $obj_cart->status = "active";
    $obj_cart->add_order();
    header("location:../index.php");
}


else if ($_REQUEST['action'] = "get_detail") {
    $obj_cart->session_id=$_POST['sessionID'];
    $result_cart=$obj_cart->get_cartdetail_by_session_id();
    $row_cart=$result_cart->fetch_array();
}
?>
