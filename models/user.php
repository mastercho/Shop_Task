<?php

class User {

    public $userID;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $date_of_birth;
    public $profile_image;
    public $gender;
    public $education;
    public $country;
    public $city;
    public $about;
    public $register_date;
    public $status;
    public $objDBConnect;

    public function user() {
        require_once ("db_connect.php");
        $this->objDBConnect = new DBConnect();
    }

    public function signup() {
        $sql = "insert  into `users`
            (first_name,last_name,username,email,password,date_of_birth,profile_image,gender,education,country,city,about,register_date,status)
            values 
             ('$this->first_name','$this->last_name','$this->username','$this->email','$this->password','$this->date_of_birth','$this->profile_image','$this->gender','$this->education','$this->country','$this->city','$this->about','$this->register_date','$this->status')";

        $this->objDBConnect->ExecuteQry($sql);

        //echo  $sql;
    }

    public function login() {
        $sql = "select * from users where username='$this->username' and password='$this->password'";
        return $this->objDBConnect->GetData($sql);

        //echo  $sql;
    }

    public function update_profile($userID) {
        $sql = "update users set first_name='$this->first_name',last_name='$this->last_name',"
                . "email='$this->email',password='$this->password',date_of_birth='$this->date_of_birth',"
                . "education='$this->education',country='$this->country',city='$this->city',"
                . "about='$this->about'"
                . "where userID='$userID'";
        $this->objDBConnect->ExecuteQry($sql);
//         echo $sql;
    }
    public function update_profile_image($username) {
        $sql = "update users set profile_image='$this->profile_image'"
                . "where username='$username'";
        $this->objDBConnect->ExecuteQry($sql);
//         echo $sql;
    }
    public function get_login_username() {
        $sql = "select * from users where username='$this->username'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_username_by_userID() {
        $sql = "select * from users where userID='$this->userID'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_user_ID() {
        $sql = "select userID from users where username='$this->username'";
        return $this->objDBConnect->GetData($sql);
    }

    public function validate_username() {
        $sql = "select * from users where username ='$this->username'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_username() {
        $sql = "select * from users where username ='$this->username'";
        return $this->objDBConnect->GetData($sql);
    }

    public function get_all_users() {
        $sql = "select * from users";
        return $this->objDBConnect->GetData($sql);
    }

    public function delete_user() {
        $sql = "delete from users where userID='$this->userID'";
        $this->objDBConnect->ExecuteQry($sql);
    }

    public function activate_user() {
        $sql = "update users set status='$this->status' where username='$this->username'";
        $this->objDBConnect->ExecuteQry($sql);
        echo $sql;
    }
    public function change_status($status) {
        $sql = "update users set status='$status' where username='$this->username'";
        $this->objDBConnect->ExecuteQry($sql);
        echo $sql;
    }
    
    private function get_full_name() {
        $full_name = "$this->first_name $this->last_name";
        return $full_name;
    }

    public function send_mail() {
        require_once 'class.phpmailer.php';
        /*
          $mail = new PHPMailer(true);
          try {
          $mail->AddAddress($this->email, $this->full_name);
          $mail->SetFrom('admin@demos.com', 'Admin');
          $mail->Subject = $subject;
          $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
          $mail->AddReplyTo('admin@demos.com', 'Admin');
          $mail->MsgHTML($msg);
          if(!is_null($attachements)){
          foreach ($attachements as $a) {
          $mail->AddAttachment($a);      // attachment

          }
          }
          $mail->Send();
          //echo "Message Sent OK</p>\n";
          } catch (phpmailerException $e) {
          throw $e;
          //echo $e->errorMessage(); //Pretty error messages from PHPMailer
          } catch (Exception $e) {
          //echo $e->getMessage(); //Boring error messages from anything else!
          throw $e;
          }
         * */
        $mail = new PHPMailer();

        $body = "Hello i am a message";

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host = "localhost"; // SMTP server
        $mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 587;                   // set the SMTP port for the GMAIL server
        $mail->Username = "test@gmail.com";  // GMAIL username
        $mail->Password = "test";            // GMAIL password

        $mail->SetFrom('aydan@site.com', 'Aydan');

        $mail->AddReplyTo("aydan@site.com", "Aydan");

        $mail->Subject = "PHPMailer Test Subject via smtp (Gmail), basic";

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $mail->MsgHTML($body);

        $address = "aydan.aleydin@gmail.com";
        $mail->AddAddress($address, "aydan");

        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
    public function send_code($email) {
        require_once 'class.phpmailer.php';
        $pass = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
        $_SESSION['code']=$pass;
/*        $mail = new PHPMailer(true);
          try {
          $mail->AddAddress($this->email, $this->username);
          $mail->SetFrom('admin@demos.com', 'Admin');
          $mail->Subject = $subject;
          $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
          $mail->AddReplyTo('admin@demos.com', 'Admin');
          $mail->MsgHTML($msg);
          if(!is_null($attachements)){
          foreach ($attachements as $a) {
          $mail->AddAttachment($a);      // attachment

          }
          }
          $mail->Send();
          //echo "Message Sent OK</p>\n";
          } catch (phpmailerException $e) {
          throw $e;
          //echo $e->errorMessage(); //Pretty error messages from PHPMailer
          } catch (Exception $e) {
          //echo $e->getMessage(); //Boring error messages from anything else!
          throw $e;
          }
*/
        
        
    }
}
