<?php

class product {

    public $productID;
    public $product_name;
    public $product_info;
    public $product_price;
    public $product_image;
    public $product_discount;
    public $product_category;
    public $product_brand;
    public $product_status;
    public $created_date;
    public $view_count;
    public $objDBConnect;

    public function product() {
        require_once 'db_connect.php';
        $this->objDBConnect = new DBConnect();
    }

    public function add_product() {
        $sql = "insert into product "
                . "(product_name,product_info,product_price,product_image,product_discount,product_category"
                . ",product_brand,product_status,created_date)"
                . "values"
                . "('$this->product_name','$this->product_info','$this->product_price','$this->product_image',"
                . "'$this->product_discount','$this->product_category','$this->product_brand','$this->product_status','$this->created_date')";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_products() {
        $sql = "Select * from product";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_product_by_limit($start, $end) {
        $sql = "select * from product limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_product_by_id() {
        $sql = "select * from product where product_ID='$this->productID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_product_by_category() {
        $sql = "select * from product where product_category='$this->product_category'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_product_by_brand() {
        $sql = "select * from product where product_brand='$this->product_brand'";
        return $this->objDBConnect->GetData($sql);
    }

    public function update_view_count() {

        $sql = "update product set view_count= view_count+1 where product_ID='$this->productID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function update_product() {
        $sql = "update product set product_name='$this->product_name',product_info='$this->product_info',"
                . "product_price='$this->product_price',product_image='$this->product_image',product_discount='$this->product_discount',"
                . "product_category='$this->product_category',product_brand='$this->product_brand',product_status='$this->product_status',created_date='$this->created_date' "
                . "where product_ID='$this->productID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function new_products() {
        $sql = "SELECT * FROM `product` ORDER BY `product`.`view_count` ASC ";
        return $this->objDBConnect->GetData($sql);
    }

    public function new_products_by_limit($start, $end) {
        $sql = "SELECT * FROM `product` ORDER BY `product`.`view_count` ASC limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }

    public function special_products() {
        $sql = "SELECT * FROM `product` ORDER BY `product`.`view_count` DESC";
        return $this->objDBConnect->GetData($sql);
    }

    public function special_products_by_limit($start, $end) {
        $sql = "SELECT * FROM `product` ORDER BY `product`.`view_count` DESC limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }

    public function featured_products() {
        $sql = "SELECT * FROM `product` ORDER BY `product`.`product_discount` asc";
        return $this->objDBConnect->GetData($sql);
    }

    public function featured_products_by_limit($start, $end) {
        $sql = "SELECT * FROM `product` ORDER BY `product`.`product_discount` asc limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }

    public function delete_product() {
        $sql = "delete from product where product_ID='$this->productID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_products_by_category($category) {
        $sql = "Select * from product where product_category = '$category'";
        return $this->objDBConnect->GetData($sql);
    }

    public function product_category_by_limit($category, $start, $end) {
        $sql = "SELECT * FROM `product`where product_category='$category' limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_products_by_brand($brand) {
        $sql = "Select * from product where product_brand = '$brand'";
        return $this->objDBConnect->GetData($sql);
    }

    public function product_brand_by_limit($brand, $start, $end) {
        $sql = "SELECT * FROM `product`where product_brand='$brand' limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_product_by_query($name) {
        $sql = "select * from product where product_name LIKE '%" . $name . "%'";
        return $this->objDBConnect->GetData($sql);
    }
    
    public function get_product_by_greater($price) {
        $sql = "SELECT * FROM `product` WHERE `product_price` >= $price";
        return $this->objDBConnect->GetData($sql);
        echo $sql;
    }
    
    
    
    

}
