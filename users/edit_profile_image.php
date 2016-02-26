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
                    Update Profile Image
                </h4>
            </label>
            <br><br>
            <form id="signup-form" class="form-horizontal" role="form" method="post" action="process/process_update.php?action=profile_image&userID=<?php echo $row_user['userID'] ?>" enctype="multipart/form-data" novalidate>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="profile_image">Profile Image</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="profile_image">
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
                            echo 'Max File Size (500 KB)';
                            echo '</strong>';
                            echo '</div>';
                        }
                        ?>
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
