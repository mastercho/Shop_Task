<?php
if (isset($_SESSION['user'])) {
    header("location:index.php");
}

require_once 'models/user.php';
require_once './views/top.php';
?>
<script>
    $(document).ready(function (e) {
    $("#btn_moveon").click(function(){
    var username = $("#get_username").val();
    
            $.post("process/process_signup.php?action=get_profile", {username: username}, function (data)
            {
                $("#show").html(data);
            });
    });
    });
</script>
</head>
<body>
    <!--logo Area-->
    <?php
    require_once './views/header.php';
    ?>
    <!--logo area closed-->
    <!-- Page Content -->

    <!--Middle Nav close-->
    <!--Form Registeration-->
    <div class="container">
        <div class="col-md-3"></div>

        <div class="col-md-6"> 
            <div class="page-header text-center">
                <h3>
                    <span class="glyphicon glyphicon-user"></span>    
                    Login
                    <?php
                    if (isset($_SESSION['msg'])) {
                        $msg = $_SESSION['msg'];
                        unset($_SESSION['msg']);
                        echo(" - $msg");
                    }

                    if (isset($_SESSION['errors'])) {
                        $errors = $_SESSION['errors'];
                        unset($_SESSION['errors']);
                    }
                    if (isset($_SESSION['obj_user'])) {
                        $obj_user = unserialize($_SESSION['obj_user']);
                    } else {
                        $obj_user = new User();
                    }
                    ?>


                </h3>
            </div>
            <form id="signup-form" class="form-horizontal" role="form" method="post" action="process/process_login.php" enctype="multipart/form-data" novalidate>        
                <div class="form-group">
                    <label class="control-label col-sm-4" for="username">Username:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="username" 
                               name="username" placeholder="Enter username">
                    </div>
                    <span class="col-sm-4"></span>
                    <span class="col-sm-6" id="username_error">
                        <?php
                        if (isset($errors['username'])) {
                            echo '<div class="alert alert-danger fade in">';
                            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            echo '<strong>';
                            echo($errors['username']);
                            echo '</strong>';
                            echo '</div>';
                        }
                        ?>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">Password:</label>
                    <div class="col-sm-6"> 
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <span class="col-sm-4" id="error_msg"></span>
                    <span class="col-sm-6" id="error_msg">

                        <?php
                        if (isset($errors['password'])) {
                            echo '<div class="alert alert-danger fade in">';
                            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            echo '<strong>';
                            echo($errors['password']);
                            echo '</strong>';
                            echo '</div>';
                        }
                        ?>

                    </span>

                </div>    
                <div class="form-group"> 
                    <div class="col-sm-offset-4 col-sm-10">
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Remember me</label>
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-4 col-sm-6">
                        <button type="submit" class=" form-control btn btn-primary">Login</button>
                    </div>
                </div>
                <a class="btn btn-link col-md-offset-4" data-toggle="modal" data-target="#forgot" href="#" >Forget Password</a>  
            </form>
        </div>
    </div>
    <!--Modal For image details-->
    <div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Enter Username</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="users/f_password.php">
                        <input type="text" name="username" id="get_username" class="form-control">
                        <input type="button" id="btn_moveon" value="Move on" class="form-control"> 
                    </form>
                </div>
                        <div class="modal-footer" id="show"></div>  
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php
        require_once "views/footer.php";
        ?>

        <!--Footer-->
        </body>

        </html>


