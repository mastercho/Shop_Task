<?php
class comment {
    public $commentID;
    public $userID;
    public $productID;
    public $postID;
    public $comment;
    public $created_date;
    public $objDbConnect;
    
    public function comment(){
        require_once 'db_connect.php';
        $this->objDbConnect= new DBConnect();
    }
    public function add_comment(){
        $sql = "insert into comments (userID,productID,comment,created_date) values"
                . "('$this->userID','$this->productID','$this->comment','$this->created_date')";
        $this->objDbConnect->ExecuteQry($sql);

     //   echo $sql;
    }
	public function delete_comment(){
        $sql = "delete from comments where commentID= '$this->commentID'";
        $this->objDbConnect->ExecuteQry($sql);

       echo $sql;
    }
    public function get_comments($pid){
        $sql="select * from comments where productID='$pid'";
        return $this->objDbConnect->GetData($sql);
    }
    
}
