<?php

class brand {

    public $brandID;
    public $brand_name;
    public $brand_image;
    public $status;
    public $objDBConnect;

    public function brand() {
        require_once 'db_connect.php';
        $this->objDBConnect = new DBConnect();
    }

    public function add_brand() {
        $sql = "insert  into `brand`
            (brand_name,brand_image,status)
            values 
             ('$this->brand_name','$this->brand_image','$this->status')";

        $this->objDBConnect->ExecuteQry($sql);
    }

    public function view_brand() {
        $sql = "select * from brand";
        return $this->objDBConnect->GetData($sql);
    }
    public function get_brand_by_limit($start, $end) {
        $sql = "select * from brand limit $start,$end";
        return $this->objDBConnect->GetData($sql);
    }
    public function get_brand_by_id() {
        $sql = "select * from brand where brandID='$this->brandID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function update_brand() {
        $sql = "update brand set brand_name='$this->brand_name',brand_image='$this->brand_image',"
                . "status='$this->status' where brandID='$this->brandID' ";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function delete_brand() {
        $sql = "delete from brand where brandID='$this->brandID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_brand_by_query($name) {
        $sql = "select * from brand where brand_name LIKE '%" . $name . "%'";
        return $this->objDBConnect->GetData($sql);
    }

}
