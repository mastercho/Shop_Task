<?php

class category {

    public $categoryID;
    public $category_name;
    public $status;
    public $created_date;
    public $objDBConnect;

    public function category() {
        require_once("db_connect.php");
        $this->objDBConnect = new DBConnect();
    }

    public function add_category() {
        $sql = "insert  into `category`
            (category_name,status,created_date)
            values 
             ('$this->category_name','$this->status','$this->created_date')";

        $this->objDBConnect->ExecuteQry($sql);
    }

    public function view_category() {
        $sql = "select * from category";
        return $this->objDBConnect->GetData($sql);
    }
    public function get_category_by_limit($start, $end) {
        $sql = "select * from category limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_category_by_id() {
        $sql = "select * from category where categoryID='$this->categoryID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function update_category() {
        $sql = "update category set category_name='$this->category_name',status='$this->status',created_date='$this->created_date'"
                . "where categoryID='$this->categoryID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function delete_category() {
        $sql = "delete from category where categoryID = '$this->categoryID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_category_by_query($name) {
        $sql = "select * from category where category_name LIKE '%" . $name . "%'";
        return $this->objDBConnect->GetData($sql);
    }

}
