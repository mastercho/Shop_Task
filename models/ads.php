<?php

class ads {

    public $ad_ID;
    public $ad_name;
    public $ad_description;
    public $ad_image;
    public $status;
    public $created_date;
    public $objDBConnect;

    public function ads() {
        require_once 'db_connect.php';
        $this->objDBConnect = new DBConnect();
    }

    public function add_ad() {
        $sql = "insert into ads "
                . "(ad_name,ad_description,ad_image,status,created_date)"
                . "values"
                . "('$this->ad_name','$this->ad_description','$this->ad_image','$this->status','$this->created_date')";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function get_ad() {
        $sql = "select * from ads";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_ad_by_id() {
        $sql = "select * from ads where ad_ID='$this->ad_ID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function update_ad() {
        $sql = "update ads set ad_name='$this->ad_name',ad_description='$this->ad_description',"
                . "ad_image='$this->ad_image',status='$this->status',created_date='$this->created_date'"
                . "where ad_ID='$this->ad_ID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function delete_ad() {
        $sql = "delete from ads where ad_ID='$this->ad_ID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

}
