<?php
require_once '../views/top.php';
require_once '../models/user.php';
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    die(header("Location: ../login.php"));
}
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
$obj_user = new User();
$obj_user->username = $user['username'];
$result_user = $obj_user->get_username();
$row_user = $result_user->fetch_array();
//echo $row_user;
//print_r($row_user);
/*
  echo '<pre>';
  print_r($row_user);
  echo '</pre>';
 */
?>
<script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>

</head>
<body>
    <!--logo Area-->
    <?php
    require_once '../views/header.php';
    ?>
    <!--logo area closed-->

    <!-- Page Content -->
    <div class="container">
        <div class="page-header">
            <h2>Update Profile
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
            </h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <label class="control-label">
                <h4>
                    Update Information
                    <a id="alert_launch"><span class="glyphicon glyphicon-question-sign"></span></a>: 
                </h4>
            </label>
            <br><br>
            <form id="signup-form" class="form-horizontal" role="form" method="post" action="process/process_update.php?action=update&userID=<?php echo $row_user['userID'] ?>" enctype="multipart/form-data" novalidate>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="first_name">First Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="first_name"  
                               value="<?php
                               if (isset($errors['first_name'])) {
                                   echo '';
                               } else {
                                   echo $row_user['first_name'];
                               }
                               ?>" 
                               placeholder="First Name">
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
                        } else {
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
                               value="<?php
                               if (isset($errors['last_name'])) {
                                   echo '';
                               } else {
                                   echo $row_user['last_name'];
                               }
                               ?>"
                               placeholder="Last Name">
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
                        } else {
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
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="email"
                               value="<?php
                               if (isset($errors['email'])) {
                                   echo '';
                               } else {
                                   echo $row_user['email'];
                               }
                               ?>"
                               placeholder="Enter email">
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
                        } else {
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
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <div class="col-sm-4" id="error_msg">

                        <?php
                        if (isset($errors['password'])) {
                            echo '<div class="alert alert-danger fade in">';
                            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            echo '<strong>';
                            echo($errors['password']);
                            echo '</strong>';
                            echo '</div>';
                        } else {
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
                        <input type="password" class="form-control" name="password2" placeholder="Re-type password">
                    </div>
                    <div class="col-sm-4" id="error_msg">
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
                               value="<?php
                               if (isset($errors['date_of_birth'])) {
                                   echo '';
                               } else {
                                   echo $row_user['date_of_birth'];
                               }
                               ?>">
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
                    <label class="control-label col-sm-2" for="education">Education:</label>
                    <div class="col-sm-6"> 
                        <label class="checkbox-inline ">
                            <input type="checkbox" name="edu" 
                            <?php
                            if ($row_user['education'] == 'FA') {
                                echo 'checked';
                            }
                            ?>
                                   value="FA">FA
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="edu"
                            <?php
                            if ($row_user['education'] == 'FSC') {
                                echo 'checked';
                            }
                            ?>
                                   value="FSC">FSC
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="edu"        
                            <?php
                            if ($row_user['education'] == 'BSC') {
                                echo 'checked';
                            }
                            ?>
                                   value="BSC">BSC
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="edu"       
                            <?php
                            if ($row_user['education'] == 'BSCS') {
                                echo 'checked';
                            }
                            ?>
                                   value="BSCS">BSCS
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
                        <select class="txtBox form-control"  name="city">
                            <option value='0'>City</option>
                            <option name="city" 
                            <?php
                            if ($row_user['city'] == 'lahore') {
                                echo 'selected';
                            }
                            ?>
                                    value="lahore">Lahore
                            </option>
                            <option name="city"
                            <?php
                            if ($row_user['city'] == 'dehli') {
                                echo 'selected';
                            }
                            ?>
                                    value="multan">Multan
                            </option>
                            <option name="city"
                            <?php
                            if ($row_user['city'] == 'karachi') {
                                echo 'selected';
                            }
                            ?> 
                                    value="karachi">Karachi
                            </option>
                            <option name="city"
                            <?php
                            if ($row_user['city'] == 'islamabad') {
                                echo 'selected';
                            }
                            ?> 
                                    value="islamabad">Islamabad
                            </option>
                        </select>
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
                        <textarea class="form-control col-sm-6"
                                  rows="2" name="about" >
                        </textarea>
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
                        <img class="img-thumbnail" src="../models/CaptchaSecurityImages.php?characters=6&width=550">
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
                        <button type="submit" class="btn btn-default">Update</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>


            </form>                    


        </div>
        <br>
    </div>







    <!-- Footer -->

    <?php
    require_once "../views/footer.php";
    ?>

    <!--Footer-->
</body>

</html>
