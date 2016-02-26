<?php
require_once 'models/web_interface.php';
require_once 'models/user.php';
require_once 'views/top.php';
/*
  echo '<pre>';
  print_r($_SESSION['errors']);
  print_r($_SESSION['signup']);
  echo '</pre>';
*/
 ?>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#username").keyup(function(e)
        {
            var username = $("#username").val();

            $.post("process/process_signup.php?action=check_username", {username: username}, function(data)
            {
                $("#username_error").html(data);
            });
        });
        
		$("#password").keyup(function(e)
        {
			var username = $("#username").val();
            var password = $("#password").val();
            if(username != ""){
				if(password == username){
					$("#password_error").html("<h4>Username Cant Be Password</h4>");
				}
			}
            $.post("process/process_signup.php?action=check_password", {password:password}, function(data)
            {
                $("#password_error").html(data);
            });
		});
		
		$("#password2").keyup(function(e)
        {
            var password = $("#password").val();
            var password2 = $("#password2").val();
            if(password != ""){
				if(password2 != password){
					$("#password2_error").html("<h4>Password Does not Match</h4>");
				}
				else
				{
					$("#password2_error").html("<img src='images/tick.gif'>");
				}
			}
			/*
            $.post("process/process_signup.php?action=check_password", {password:password}, function(data)
            {
                $("#password2_error").html(data);
            });
			*/
		});
        setInterval(function ()
        {
			$.get("process/process_signup.php?action=check_signup", function (data)
            {
                $("#submit_ok").html(data);
			});
			
			
        }, 5000);		
    });

</script>
</head>
<body>

    <!--logo Area-->
    <?php
    require_once './views/header.php';
    ?>
    <!--logo area closed-->

    <!--coursal-->
    <?php
//  require_once './views/slider.php';
    ?> 
    <!--Coursal-->
    <div class="container">
        <!--Middle Nav-->
        <?php
//require_once './views/middle_nav.php';
        ?>        

        <!--Middle Nav close-->
        <!--Form Registeration-->
        <div class="container">
            <div class="col-sm-12"> 
                <div class="page-header text-center">
                    <h3>
                        <span class="glyphicon glyphicon-user"></span>    
                        New User Registration
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
                        if (isset($_SESSION['signup'])) {
                            $signup = $_SESSION['signup'];
                        }
                        if (isset($_SESSION['obj_user'])) {
                            $obj_user = unserialize($_SESSION['obj_user']);
                        } else {
                            $obj_user = new User();
                        }
                        ?>


                    </h3>
                </div>
                <form id="signup-form" class="form-horizontal" role="form" method="post" action="process/process_signup.php?action=signup" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="first_name">First Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="first_name"  
                                   value="<?php if (isset($signup['first_name'])) {
                            echo $signup['first_name'];
                        } ?>" placeholder="First Name">
                        </div>
                        <div class="col-sm-4" id="error_msg">

                            <?php
                            if (isset($errors['first_name'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['first_name']);
                                echo '</strong>';
                                echo '</div>';
                            } else if (empty($signup['first_name'])) {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo 'Use Alphabets Only (Example:Ali,Saad)';
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="middle_name">Middle Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name (optional)">
                        </div>
                    </div>      

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="last_name">Last Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="<?php if (isset($signup['last_name'])) {
                                echo $signup['last_name'];
                            } ?>" placeholder="Last Name">
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['last_name'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['last_name']);
                                echo '</strong>';
                                echo '</div>';
                            } else if (empty($signup['last_name'])) {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo 'Use Alphabets Only (Example:Ali,Saad)';
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div>      

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Username:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" 
                                   name="username" value="<?php if (isset($signup['user_name'])) {
                                echo $signup['user_name'];
                            } ?>" placeholder="Enter username">
                        </div>
                        <span class="col-sm-4" id="username_error">
                            <?php
                            if (isset($errors['user_name'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['user_name']);
                                echo '</strong>';
                                echo '</div>';
                            } else if (empty($signup['user_name'])) {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo 'Use Alphabets & Numbers Only within 6-20 characters (Example:abcdef,Cat001)';
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </span>
                    </div>            

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email"
                                   value="<?php if (isset($signup['email'])) {
                                echo $signup['email'];
                            } ?>" placeholder="Enter email">
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['email'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['email']);
                                echo '</strong>';
                                echo '</div>';
                            } else if (empty($signup['email'])) {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo 'Use Valid Email Address (Example:abc@xyz.com)';
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">Password:</label>
                        <div class="col-sm-6"> 
                            <input type="password" class="form-control" name="password" id="password"
                                   value="<?php if (isset($signup['password'])) {
                                echo $signup['password'];
                            } ?>" placeholder="Enter password">
                        </div>
                        <div class="col-sm-4" id="password_error">

                            <?php
                            if (isset($errors['password'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['password']);
                                echo '</strong>';
                                echo '</div>';
                            } else if (empty($signup['password'])) {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo 'Type A Strong Password (Example:@li001,saad&ali)';
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password2">Re-type Password:</label>
                        <div class="col-sm-6"> 
                            <input type="password" class="form-control" name="password2" id="password2"
                                   value="<?php if (isset($signup['password'])) {
                                echo $signup['password'];
                            } ?>" placeholder="Re-type password">
                        </div>
                        <div class="col-sm-4" id="password2_error">
                            <?php
                            if (isset($errors['password2'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['password2']);
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="date_of_birth">Date Of Birth:</label>
                        <div class="col-sm-6"> 
                            <input type="date" class="form-control" name="date_of_birth" 
                                   value="<?php if (isset($signup['date_of_birth'])) {
                                echo $signup['date_of_birth'];
                            } ?>">
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['date_of_birth'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['date_of_birth']);
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div> 

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="profile_image">Profile Image:</label>
                        <div class="col-sm-6"> 
                            <input type="file" class="form-control" id="profile_image" name="profile_image" >
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['profile_image'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['profile_image']);
                                echo '</strong>';
                                echo '</div>';
                            } else {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo 'Select a Valid Image (Max-Size: 500KB)';
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div>      

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="gender">Gender:</label>
                        <div class="col-sm-6"> 
                            <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender == "Male") echo "checked"; ?> value="Male">Male</label>
                            <label class="radio-inline"><input type="radio" name="gender" <?php if (isset($gender) && $gender == "Female") echo "checked"; ?> value="Female" >Female</label> 

                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['gender'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['gender']);
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div>        

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="education">Education:</label>
                        <div class="col-sm-6"> 
                            <label class="checkbox-inline ">
                                <input type="checkbox" name="edu" value="FA">FA
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="edu" value="FSC">FSC
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="edu" value="BSC">BSC
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="edu" value="BSCS">BSCS
                            </label>
                        </div>
                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['education'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['education']);
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>
                        </div>


                    </div>        

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country">Country:</label>
                        <div class="col-sm-6"> 
                            <?php
                            Web_Interface::load_countries();
                            ?>         
                        </div>

                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['country'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['country']);
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>

                        </div>

                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="city">City:</label>
                        <div class="col-sm-6"> 
                            <input type="text" class="form-control" name="city">          
                        </div>
                        <div class="col-sm-4 " id="error_msg">
                            <?php
                            if (isset($errors['city'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['city']);
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?>

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comment">About:</label>
                        <div class="col-sm-6">
                            <textarea  class="form-control col-sm-6" rows="2" name="about" value="<?php echo($obj_user->about); ?>"></textarea>
                        </div>

                        <div class="col-sm-4" id="error_msg">
                            <?php
                            if (isset($errors['about'])) {
                                echo '<div class="alert alert-danger fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo($errors['about']);
                                echo '</strong>';
                                echo '</div>';
                            } else {
                                echo '<div class="alert alert-success fade in">';
                                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                echo '<strong>';
                                echo 'Tell us About YourSelf ';
                                echo '</strong>';
                                echo '</div>';
                            }
                            ?> 
                        </div>
                    </div>    

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="security">Security Code:</label>
                        <div class="col-sm-6"> 
                            <div class="col-md-push-6">  
                                <input type="text" class="form-control" name="security_code" placeholder="Enter Security code">
                            </div>
                            <img class="img-thumbnail" src="models/CaptchaSecurityImages.php?characters=6&width=550">
                        </div>
                        <div class="col-sm-4" id="secode_error">
<?php
if (isset($errors['security_code'])) {
    echo '<div class="alert alert-danger fade in">';
    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo '<strong>';
    echo($errors['security_code']);
    echo '</strong>';
    echo '</div>';
}
?>    
                        </div>
                    </div>   

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label><input type="checkbox"> Remember me</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit <span id="submit_ok"></span></button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>


                </form>

            </div>


        </div>




        <!--Form Registeration Close-->
    </div>        
    <!-- Footer -->
<?php
require_once "views/footer.php";
?>

    <!--Footer-->
</body>

</html>
