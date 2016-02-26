<?php
require_once 'views/top.php';
require_once '../models/ads.php';

$obj_ad = new ads();
$result_ad = $obj_ad->get_ad();


if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<title>Admin Panel || Ads</title>
</head>
<body>
    <!--logo Area-->
    <?php
    require_once 'views/header.php';
    ?>
    <!--logo area closed-->
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <h2>Active Ad's</h2>
            <div class="col-lg-8">
                <form class="form-horizontal" role="form" method="Get">
                    <label class="control-label col-sm-3" for="email">Search Ads:</label>
                    <div class="col-sm-7">  
                        <input class="form-control" type="search" placeholder="Enter Ad ID or Ad Name">
                    </div>
                </form>
                <button class="btn btn-primary"><a href="insert/add_ad.php" class="bg-primary">Create Ad</a></button>
            </div>
        </div>
        <hr>            
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>  
                    <th>Ad Name</th>
                    <th>Ad Description</th>
                    <th>Ad Image</th>
                    <th>Status</th>
                    <th>Edit Adt</th>
                    <th>Delete Ad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row_ad = $result_ad->fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>  
                        <td><?php echo $row_ad["ad_name"]; ?></td>
                        <td><?php echo $row_ad["ad_description"]; ?></td>
                        <td><img class="img-responsive" id="product_img"  
                                 src="../images/ads/<?php echo $row_ad['ad_name']; ?>/<?php echo $row_ad['ad_image']; ?>"></td>
                        <td><?php echo $row_ad["status"]; ?></td>
                        <td><a href="update/edit_ad.php?ad_ID=<?php echo $row_ad["ad_ID"]; ?>">Edit</a></td>
                        <td><a href="delete/delete_ad.php?ad_ID=<?php echo $row_ad["ad_ID"]; ?>">Delete</a></td>
                    </tr>
                    <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!---page content-->       
    <!-- Footer -->
    <?php
    require_once './views/footer.php';
    ?>
    <!-- /.footer -->



</body>

</html>
