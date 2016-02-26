<?php
require_once '../views/top.php';
require_once '../models/user.php';

$obj_user = new User();

if (isset($_REQUEST['uname'])) {
    
    $obj_user->username=$_REQUEST['uname'];
    $result_uanme = $obj_user->get_username();
    $row_uname=$result_uanme->fetch_array();
    $email=$row_uname['email'];
    $obj_user->send_code($email);
    $msg="A Code Has Been Sent To Your Email";
}
else
{
    header("location:../index.php");
}
print_r($_SESSION['code']);
?>
<script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script></script>
</head>
<body>
    <!--logo Area-->
    <?php
    require_once '../views/header.php';
    ?>
    <!--logo area closed-->
    <div class="container">
        <div class="page-header">
            <h2>Forgot Password</h2>
        </div>
            <?php
              echo "".$msg."";
              $msg="";
            ?>
        <div class="row">
            <div class="col-md-7 ">
                <form class="form-horizontal" method="post" action="../process/process_signup.php?action=forgot_password">
                    <div class="col-lg-12">
                        <label class="control-label">Code :</label>
                        <div class="">
                            <input type="text" id="code" name="code" class="form-control">
                            <input type="hidden" value="<?php echo $_REQUEST['uname']; ?>" id="uname" name="uname" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="">
                            <input type="submit" value="Get Password" class="form-control">
                        </div>
                    </div>
                </form>  
            </div>
            </div>        

        </div>



    </div>
    <hr>





    <!-- Footer -->

    <?php
    require_once "../views/footer.php";
    ?>

    <!--Footer-->
</body>

</html>
