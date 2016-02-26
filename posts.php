<?php
require_once 'views/top.php';
require_once 'models/post.php';
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


$obj_user = new User();
$obj_user->username = $user['username'];
$user_id = $obj_user->get_user_ID();
$userID = $user_id->fetch_array();

$obj_post = new post();
$obj_post->user_ID = $userID['userID'];
$result_post = $obj_post->get_posts_by_user_id();
//print_r($user);
?>

</head>
<body>
    <!--logo Area-->
    <?php
    require_once './views/header.php';
    ?>
    <!--logo area closed-->
    <div class="container">
        <div class="page-header">
            <h2>Posts</h2>
        </div>

        <div class="row">
            <div class="col-md-5 pull-right right">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Create Post</h4>
                    </div>
                    <div class="panel-body">
                        <!--<div class="form-horizontal">-->
                        <form class="form-horizontal" method="post" action="process/process_posts.php?action=post" enctype="multipart/form-data"> 
                            <input type="hidden" value="<?php echo $userID['userID']; ?>" name="userID" id="userID">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="post_title">Post Title :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="post_title" id="post_title" 
                                           placeholder="Post Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="post_subtitle">Post Sub-Title :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="post_subtitle"
                                           id="post_subtitle" placeholder="Post Sub-Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="post_image">Post Image :</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" name="post_image"
                                           id="post_image" placeholder="Post Image">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-sm-4" for=""></label>
                                <div class="col-sm-6">
                                    <input type="submit" id="post" value="Post" class="form-control btn-primary">
                                </div>
                            </div> 
                            <!--</div>-->  
                        </form>

                    </div>
                </div>
            </div>        



            <?php
            while ($row_post = $result_post->fetch_array()) {

                if ($result_post->num_rows >= 1) {
                    ?>              
                    <div class="col-md-7">

                        <!-- First Blog Post -->
                        <div class="panel panel-default">

                            <div class="panel panel-heading"> 
                                <p class="row">
                                <h3>
                                    <img id="img_post" class="img-rounded" src="images/users/<?php echo $user['username']; ?>/<?php echo $user['profile_image']; ?>">
                                    <a class="text-capitalize text-primary" href="profile.php?uname=<?php echo $user['username']; ?>" target="_blank">
                                        <?php echo $user['username']; ?>
                                    </a>
                                    <div class="dropdown pull-right">
                                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <span class="glyphicon glyphicon-cog"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li class="">
                                                <a href="users/edit_post.php?pid=<?php echo $row_post['post_id'] ?>">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="modal" data-target="#<?php echo $row_post['post_id']; ?>" href="#">
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>    
                                </h3>

                                <h4 class="left">   
                                    <p><a href="#"><?php echo $row_post["post_title"]; ?></a>


                                        <i class="fa fa-clock-o "></i>on 
                                        <?php
                                        $time = strtotime($row_post["created_date"]);
                                        $myFormatForView = date("jS,F Y", $time);
                                        //echo $row_post["created_date"];
                                        echo $myFormatForView;
                                        ?>
                                    </p>

                                </h4>
                                </p>
                            </div>
                            <div class="panel-body">     
                                <a href="photos.php?uname=<?php echo $user['username']; ?>" target="_blank">
                                    <img width="500"  class="img-responsive img-thumbnail img-hover" src="images/posts/<?php echo $row_post["post_title"]; ?>/<?php echo $row_post["post_image"]; ?>" alt="Sorry No Image">
                                </a>
                                <hr>
                                <p><?php echo $row_post["post_subtitle"]; ?></p>
                            </div>                  
                        </div>
                    </div>

                    <div class="modal fade" id="<?php echo $row_post['post_id'] ?>" style="padding-top:25%;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>Do you wish to delete Post "<?php echo $row_post['post_title']; ?>"?</h4><br>
                                    <a href="process/process_posts.php?action=delete&pid=<?php echo $row_post['post_id'] ?>">
                                        <button class="btn btn-danger" style="width:30%;">
                                            <span class="glyphicon glyphicon-ok"></span> Yes
                                        </button>
                                    </a>
                                    <a  data-dismiss="modal" aria-label="Close" href="#">
                                        <button class="btn btn-primary" style="width:30%;">
                                            <span class="glyphicon glyphicon-remove"></span> No
                                        </button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php
                } else {
                    echo "<h4>Sorry you have no Posts</h4>";
                }
            }
            ?>
        </div>


            <?php /*
              $counter=0;
              while($row = $result->fetch_array())
              {  ?>

              <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="col-md-12 col-md-12">
              <div class="panel panel-default text-center">
              <div class="panel-heading"><h4><?php echo $row["post_title"];?></h4>
              <h5><?php echo $row["post_subtitle"];?></h5>
              </div>
              <div class="panel-body col-md-12 col-md-12">
              <a href="#" id="product_img_area">
              <img id="post_img" class="img-thumbnail " src="images/post/post.jpg" alt="">
              </a>
              </div>
              <div class="panel-footer">
              <div class="btn-group btn-group-justified">
              <a href="#" class="btn btn-default">LIKE</a>
              <a href="#" class="btn btn-default">Comment</a>
              <a href="#" class="btn btn-default  ">Share</a>
              </div>
              </div>
              </div>
              </div>
              </div>
              <?php
              $counter++;
              }

             */ ?>

        <!-- Page Content -->
    </div>
    <hr>





    <!-- Footer -->

<?php
require_once "./views/footer.php";
?>

    <!--Footer-->
</body>

</html>
