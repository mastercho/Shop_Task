<?php

require_once 'user.php';

class chat {

    public $userID;
    public $chatID;
    public $sender;
    public $reciever;
    public $message;
    public $created_date;
    public $sent_date;
    public $objDBConnect;

    public function chat() {
        require_once 'db_connect.php';
        $this->objDBConnect = new DBConnect();
    }

    public function get_chat() {
        $sql = "select * from chat where sender='$this->sender' and reciever='$this->reciever'"
                . "or reciever='$this->sender' and sender='$this->reciever'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_chat_by_chatID() {
        $sql = "select * from chat where chatID='$this->chatID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_messages_by_chatID() {
        $sql = "select * from messages where chatID='$this->chatID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function create_chat() {
        $sql = "insert into chat (sender,reciever,created_date) values"
                . "('$this->sender','$this->reciever','$this->created_date')";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function send() {
        $sql = "insert into messages (chatID,message,userID,sent_date)"
                . "values ('$this->chatID','$this->message','$this->userID','$this->sent_date')";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function recieve_msg() {
        $sql = "select * from messages where chatID='$this->chatID' and sender='$this->sender'";
        return $this->objDBConnect->GetData($sql);
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365, 'year'),
            array(60 * 60 * 24 * 30, 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24, 'day'),
            array(60 * 60, 'hour'),
            array(60, 'minute'),
            array(1, 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";
        return $print;
    }

    function timeAgo($timestamp) {
        $datetime1 = new DateTime("now");
        $datetime2 = date_create($timestamp);
        $diff = date_diff($datetime1, $datetime2);
        $timemsg = '';
        if ($diff->y > 0) {
            $timemsg = $diff->y . ' year' . ($diff->y > 1 ? "'s" : '');
        } else if ($diff->m > 0) {
            $timemsg = $diff->m . ' month' . ($diff->m > 1 ? "'s" : '');
        } else if ($diff->d > 0) {
            $timemsg = $diff->d . ' day' . ($diff->d > 1 ? "'s" : '');
        } else if ($diff->h > 0) {
            $timemsg = $diff->h . ' hour' . ($diff->h > 1 ? "'s" : '');
        } else if ($diff->i > 0) {
            $timemsg = $diff->i . ' minute' . ($diff->i > 1 ? "'s" : '');
        } else if ($diff->s > 0) {
            $timemsg = $diff->s . ' second' . ($diff->s > 1 ? "'s" : '');
        }

        $timemsg = $timemsg . ' ago';
        return $timemsg;
    }

    function get_time_difference_php($created_time) {
        date_default_timezone_set('Asia/Calcutta'); //Change as per your default time
        $str = strtotime($created_time);
        $today = strtotime(date('Y-m-d H:i:s'));

        // It returns the time difference in Seconds...
        $time_differnce = $today - $str;

        // To Calculate the time difference in Years...
        $years = 60 * 60 * 24 * 365;

        // To Calculate the time difference in Months...
        $months = 60 * 60 * 24 * 30;

        // To Calculate the time difference in Days...
        $days = 60 * 60 * 24;

        // To Calculate the time difference in Hours...
        $hours = 60 * 60;

        // To Calculate the time difference in Minutes...
        $minutes = 60;

        if (intval($time_differnce / $years) > 1) {
            return intval($time_differnce / $years) . " years ago";
        } else if (intval($time_differnce / $years) > 0) {
            return intval($time_differnce / $years) . " year ago";
        } else if (intval($time_differnce / $months) > 1) {
            return intval($time_differnce / $months) . " months ago";
        } else if (intval(($time_differnce / $months)) > 0) {
            return intval(($time_differnce / $months)) . " month ago";
        } else if (intval(($time_differnce / $days)) > 1) {
            return intval(($time_differnce / $days)) . " days ago";
        } else if (intval(($time_differnce / $days)) > 0) {
            return intval(($time_differnce / $days)) . " day ago";
        } else if (intval(($time_differnce / $hours)) > 1) {
            return intval(($time_differnce / $hours)) . " hours ago";
        } else if (intval(($time_differnce / $hours)) > 0) {
            return intval(($time_differnce / $hours)) . " hour ago";
        } else if (intval(($time_differnce / $minutes)) > 1) {
            return intval(($time_differnce / $minutes)) . " minutes ago";
        } else if (intval(($time_differnce / $minutes)) > 0) {
            return intval(($time_differnce / $minutes)) . " minute ago";
        } else if (intval(($time_differnce)) > 1) {
            return intval(($time_differnce)) . " seconds ago";
        } else {
            return "few seconds ago";
        }
    }

}
