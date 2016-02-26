<?php
require_once './views/top.php';
require_once './models/user.php';
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    die(header("Location: login.php"));
}
$objuser = new User();
$objuser->username = $_REQUEST['uname'];
$result_user = $objuser->get_username();
$row_user = $result_user->fetch_array();
//print_r ($row_user);

?>

</head>
<body>
    <!--logo Area-->
    <?php
    require_once './views/header.php';
    ?>
    <!--logo area closed-->

    <!-- Page Content -->
    <div class="container">
        <div class="page-header">
            <h2 class="text-capitalize">
			<?php
			if(isset($user['username'])){
				echo $user['username'];
			}
			else{
			echo "User Profile";
			}
			if (isset($_SESSION['msg'])) {
                  $msg = $_SESSION['msg'];
                  unset($_SESSION['msg']);
                  echo(" - $msg");
            }
			?>
			</h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">
                        <h4>Profile Picture:</h4>
                    </label>
                    <img class="img-thumbnail" 
                         src="images/users/<?php echo $row_user['username'] ?>/<?php echo $row_user['profile_image']; ?>">
                    <br>
                    <br>
                    <div class="col-md-3">
                        <a href="users/edit_profile_image.php" class="btn btn-primary">Update Profile Image</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <label class="control-label">
                        <h4>Basic Info: <small>(
						<a href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
						Click to update 
						</a>
						)
						</small></h4>
                    </label><br>
<!--
                    <div class="col-md-6">
                    
					<label class="control-label">First Name :</label>
                        <span>
                            <a class="active" href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                <?php echo $row_user['first_name']; ?>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Last Name :</label>
                        <span>
                            <a href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                <?php echo $row_user['last_name']; ?>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Email :</label>
                        <span><?php echo $row_user['email']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Username :</label>
                        <span><?php echo $row_user['username']; ?></span>
                    </div>                    
                    <div class="col-md-6">
                        <label class="control-label">Password :</label>
                        <span>********(
                            <a href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                Edit
                            </a>
                            )
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Date Of Birth :</label>
                        <span>
                            <a href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                <?php echo $row_user['date_of_birth']; ?>
                            </a>
                        </span>
                    </div>

                    <div class="col-md-6">
                        <label class="control-label">Age :</label>
                        <span>
                            <?php
                            $dob = $row_user['date_of_birth'];
                            $birthDate = $dob;

                            $birthDate = explode("-", $birthDate);

                            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));
                            echo $age;
                            ?>

                        </span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Education :</label>
                        <span>
                            <a class="active" href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                <?php echo $row_user['education']; ?>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Gender :</label>
                        <span><?php echo $row_user['gender']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Country :</label>
                        <span>
                            <a href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                <?php echo $row_user['country']; ?>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">City :</label>
                        <span>
                            <a href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                <?php echo $row_user['city']; ?>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Street Address :</label>
                        <span>
                            <a href="users/edit_profile.php?uname=<?php echo $row_user['username']; ?>">
                                <?php echo $row_user['about']; ?>
                            </a>
                        </span>
                    </div>

-->
<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>First Name :</strong> <?php echo $row_user["first_name"]; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Last Name :</strong> <?php echo $row_user["last_name"]; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>User Name :</strong> <?php echo $row_user["username"]; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="">
<strong>Email :</strong> <?php echo $row_user["email"]; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Password :</strong> *********
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Date OF Birth :</strong> 
<?php
   $time = strtotime($row_user["date_of_birth"]);
   $DOB = date("jS,F Y", $time);
   //echo $row_user["date_of_birth"];
   echo $DOB;
?>
</blockquote>
</div>
<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Age :</strong> 
<?php
    $dob = $row_user['date_of_birth'];
    $birthDate = $dob;
    $birthDate = explode("-", $birthDate);
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));
    echo $age;

?> years
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Gender :</strong> <?php echo $row_user["gender"]; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Education :</strong> <?php echo $row_user['education']; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Country :</strong> <?php echo $row_user['country']; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>City :</strong> <?php echo $row_user['city']; ?>
</blockquote>
</div>

<div class="col-md-12">
<blockquote class="text-capitalize">
<strong>About :</strong> <?php echo $row_user['about']; ?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Registered Since :</strong> 
<?php
   $register = strtotime($row_user["register_date"]);
   $RD = date("jS,F Y", $register);
   //echo $row_user["register_date"];
   echo $RD;
?>
</blockquote>
</div>

<div class="col-md-6">
<blockquote class="text-capitalize">
<strong>Status :</strong> <?php echo $row_user['status']; ?>
</blockquote>
</div>


                </div>

            </div>
            <br>
            <?php
            $obj_post = new post();
            $obj_post->user_ID = $row_user['userID'];
            $result_post = $obj_post->get_posts_by_user_id();
//print_r($result_post);
            ?>            
            <div class="btn-group btn-group-justified">
                <a href="<?php echo (BASE_URL); ?>posts.php?uname=<?php echo $row_user['username']; ?>" class="btn btn-default">
                    <?php if ($result_post->num_rows != 0) { ?>
                        <span class="badge">
                            <?php echo $result_post->num_rows; ?>
                        </span>
                    <?php } ?>
                    Posts 
                </a>
                <a href="photos.php" class="btn btn-default">
                    <?php if ($result_post->num_rows != 0) { ?>
                        <span class="badge">
                            <?php echo $result_post->num_rows; ?>
                        </span>
                    <?php } ?>
                    Photos
                </a>
                <a href="#" class="btn btn-default">Vidoes</a>
                <a href="messages.php" class="btn btn-default">Messages</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        More.. <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Pages</a></li>
                        <li><a href="#">Books</a></li>
                        <li><a href="#">Movies</a></li>
                        <li><a href="#">Places</a></li>
                    </ul>
                </div>
            </div>
        </div>



    </div>




    <!-- Footer -->

    <?php
    require_once "./views/footer.php";
    ?>

    <!--Footer-->
</body>

</html>
