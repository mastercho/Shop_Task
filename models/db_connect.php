<?php

Class DBConnect {

    const SeverName = "localhost";
    const DBServer = "localhost";
    const DBUserName = "root";
    const DBPassword = "root";
    const DBName = "wine";

    public $objDbConnect;

    public function DBConnect() {
        $this->objDbConnect = new mysqli(DBConnect::DBServer, DBConnect::DBUserName, DBConnect::DBPassword, DBConnect::DBName);
        if (mysqli_connect_errno()) {
            echo "DB Connect Error";
            exit();
        } else {
            //echo "DB Connected";
        }
    }

    public function ExecuteQry($sql) {

        $this->objDbConnect->query($sql);

//		echo $this->objDbConnect->error_no();
    }

    public function GetData($sql) {
        $result = $this->objDbConnect->query($sql);
        return $result;
    }

}

?>
