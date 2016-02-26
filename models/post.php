<?php

class post {

    public $post_id;
    public $user_ID;
    public $post_title;
    public $post_subtitle;
    public $post_image;
    public $created_date;
    public $objDBConnect;

    public function post() {
        require_once 'db_connect.php';
        $this->objDBConnect = new DBConnect();
    }

    public function create_post() {
        $sql = "insert into posts"
                . "(user_id,post_title,post_subtitle,post_image,created_date)"
                . "values"
                . "('$this->user_ID','$this->post_title','$this->post_subtitle','$this->post_image','$this->created_date')";
        $this->objDBConnect->ExecuteQry($sql);
        echo $sql;
    }

    public function get_posts() {
        $sql = "select * from posts ORDER BY `posts`.`created_date` DESC";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_posts_by_user_id() {
        $sql = "select * from posts where user_id='$this->user_ID' ORDER BY `posts`.`created_date` DESC";
        return $this->objDBConnect->GetData($sql);
    }

    public function delete_post_by_post_id() {
        $sql = "delete from posts where post_id='$this->post_id'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function update_post_by_post_id() {
        $sql = "update posts set post_title='$this->post_title',post_subtitle='$this->post_subtitle',"
                . "post_image='$this->post_image' where post_id='$this->post_id' ";
        $this->objDBConnect->ExecuteQry($sql);
        echo $sql;
    }

    public function get_post_by_post_id() {
        $sql = "select * from posts where post_id='$this->post_id'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_posts_notify() {
        $sql = "SELECT userID as count FROM posts";
        return $this->objDBConnect->GetData($sql);
        echo $sql;
    }

}
