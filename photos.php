<?php
require_once './views/top.php';
require_once "models/category.php";
require_once './models/post.php';
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    die(header("Location: login.php"));
}
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}


$obj_user = new User();
$obj_user->username = $user['username'];
$user_id = $obj_user->get_user_ID();
$ID = $user_id->fetch_array();
$obj_post = new post();
$obj_post->user_ID = $ID['userID'];
$result_post = $obj_post->get_posts_by_user_id();
?>
</head>
<body>

    <!--logo Area-->
<?php
require_once './views/header.php';
?>
    <!--logo area closed-->
    <!--coursal-->
<?php
///require_once './views/slider.php';
?> 
    <!--Coursal-->


    <!-- Page Content -->



    <div class="container">
        <!--Middle Nav-->

<?php
//require_once './views/middle_nav.php';
?>        
        <!--Middle Nav close-->

        <!-- Products -->
        <div class="col-lg-12 col-md-12 col-sm-12" id="product_area">


            <div class="col-md-12" >
                <h2 class="page-header">Photos </h2>
            </div>
<?php
while ($row_post = $result_post->fetch_array()) {
    ?>  
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" >
                    <span class=""><h4><?php echo $row_post['post_title']; ?></h4></span>
                    <a class="thumbnail border-primary" title="Click To view Details" data-toggle="modal" data-target="#<?php echo $row_post['post_id']; ?>" href="#">
                        <img class="img-responsive "  id="photos_img"
                             src="images/posts/<?php echo $row_post['post_title']; ?>/<?php echo $row_post['post_image']; ?>" alt="">
                    </a>
                </div>
    <?php
}
?> 
            <?php
            $obj_m_post = new post();
            $result_m_p = $obj_m_post->get_posts();
            while ($row_m_p = $result_m_p->fetch_array()) {
                // print_r($row_m_p);
                ?>
                <!--Modal For image details-->
                <div style="top:10%;"class="modal fade" id="<?php echo $row_m_p['post_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!--             <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                               <h4 class="modal-title" id="myModalLabel"><?php echo $row_m_p['post_title']; ?></h4>
                                         </div>-->
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <img width="100%" height="500px"  src="images/posts/<?php echo $row_m_p['post_title']; ?>/<?php echo $row_m_p['post_image']; ?>" alt=""> 
                            </div>
                            <div class="modal-footer">
                                <h4 class="modal-title pull-left" id="myModalLabel"><?php echo $row_m_p['post_title']; ?></h4>
                            </div>  
                        </div>
                    </div>
                </div>

    <?php
}
?>

            <!--pagination--
            <div class="col-md-12">
            <ul class="pagination">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
            </ul>
            </div>
            <!--pagination-->

        </div>
    </div>
    <!---Product Close-->

    <!-- Footer -->
    <hr>
<?php
require_once "./views/footer.php";
?>

    <!--Footer-->
</body>

</html>
