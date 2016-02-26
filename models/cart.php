<?php

class cart {

    public $cartID;
    public $session_id;
    public $created_date;
    public $itemID;
    public $product_id;
    public $price;
    public $quantity;
    public $discount;
    public $orderID;
    public $userID;
    public $ordered_date;
    public $status;
    public $objDBConnect;

    public function cart() {
        require_once 'db_connect.php';
        $this->objDBConnect = new DBConnect();
    }

    public function insert_cart() {
        $sql = "insert into cart (created_date,session_id) values"
                . "('$this->created_date','$this->session_id')";
        return $this->objDBConnect->GetData($sql);
    }

    public function getcart_by_session_id() {
        $sql = "select * from cart where session_id='$this->session_id'";
        return $this->objDBConnect->GetData($sql);
    }

    public function insert_cart_item() {
        $sql = "insert into cart_item (cartID,product_id,price,quantity,discount) "
                . "values "
                . "('$this->cartID','$this->product_id','$this->price','$this->quantity','$this->discount')";
        return $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_cart_item_by_productcartID() {
        $sql = "select * from cart_item where product_id='$this->product_id' and cartID='$this->cartID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function update_quantity() {
        $sql = "update cart_item set quantity='$this->quantity' where itemID='$this->itemID'";
        return $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_cartdetail_by_session_id() {
        $sql = "select cart_item.itemID,product.product_name,product.product_image,cart_item.price,cart_item.quantity 
            from cart,cart_item,product where cart.cartID=cart_item.cartID and cart_item.product_id=product.product_id
              and cart.session_id='$this->session_id'";
        return $this->objDBConnect->GetData($sql);
    }

    public function delete_product() {
        $sql = "Delete from cart_item where itemID='$this->itemID'";
        return $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_items_by_cartid() {
        $sql = "select * from cart_item where cartID='$this->cartID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function empty_cart() {
        $sql = "Delete from cart_item where itemID='$this->itemID'";
        return $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_carts() {
        $sql = "select * from cart";
        return $this->objDBConnect->GetData($sql);
    }

    
    public function get_orders(){
        $sql="select * from orders ";
        return $this->objDBConnect->GetData($sql);
    }
    public function add_order() {
        $sql = "insert into orders (cartID,userID,ordered_date,status)"
                . "values ('$this->cartID','$this->userID','$this->ordered_date','$this->status')";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_orders_by_userID() {
        $sql = "select * from orders where userID='$this->userID'";
        return $this->objDBConnect->GetData($sql);
    }
    public function get_orders_by_orderID() {
        $sql = "select * from orders where orderID='$this->orderID'";
        return $this->objDBConnect->GetData($sql);
    }
    public function update_orders_by_orderID() {
        $sql = "update orders set status='$this->status' where orderID='$this->orderID'";
        $this->objDBConnect->ExecuteQry($sql);
    }    
    public function delete_order() {
        $sql = "delete from orders where orderID='$this->orderID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

}
?> 
