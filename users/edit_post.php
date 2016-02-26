<?php
require_once '../views/top.php';
require_once '../models/post.php';
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    die(header("Location: login.php"));
}
/*
  $objuser=new User();
  $result_user=$objuser->get_all_users();
  $row_user= $result_user->fetch_array();

  $objuser->username=$_REQUEST['uname'];
  $user_id=$objuser->get_user_ID();
  $ID=$user_id->fetch_array();
  print_r ($ID);



  $obj_post = new post();
  $result=$obj_post->get_posts();
 */
if (empty($_SESSION['user'])) {
    $msg = "Please Login To View This Page";
    header("location:login.php?msg=$msg");
}
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}


$obj_post = new post();
$obj_post->post_id = $_REQUEST['pid'];
$result_edit_post = $obj_post->get_post_by_post_id();
$edit_post = $result_edit_post->fetch_array();
//print_r($edit_post);
?>

</head>
<body>
    <!--logo Area-->
    <?php
    require_once '../views/header.php';
    ?>
    <!--logo area closed-->
    <div class="container">
        <div class="page-header">
            <h2>Edit Post</h2>
        </div>

        <div class="row">
            <div class="col-md-7 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Edit Post "<?php echo $edit_post['post_title']; ?>"</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="../process/process_posts.php?action=edit" enctype="multipart/form-data" >
                            <input type="hidden" value="<?php echo $edit_post['post_id']; ?>" name="pid">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="post_title">Post Title :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="post_title" placeholder="Post Title" value="<?php echo $edit_post['post_title']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="post_subtitle">Post Sub-Title :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="post_subtitle"
                                           value="<?php echo $edit_post['post_subtitle'] ?>" placeholder="Post Sub-Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="">Create Post:</label>
                                <div class="col-sm-8">
                                    <input type="submit" class="form-control">
                                </div>
                            </div> 
                        </form>
                    </div>
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
