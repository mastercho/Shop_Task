<?php
require_once 'views/top.php';
require_once '../models/user.php';
$objuser = new User();
$result = $objuser->get_all_users();



if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    die(header("Location: login.php"));
}
?>
<title>Admin Panel || Users</title>
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

            <h2>Active Users</h2>
            <div class="col-lg-8">
                <form class="form-horizontal" role="form" method="Get">
                    <label class="control-label col-sm-2" for="email">Search User:</label>
                    <div class="col-sm-7">  
                        <input class="form-control" type="search" placeholder="Enter User ID or Email">
                    </div>
                </form>
            </div>
        </div>
        <hr>            
        <table class="table table-hover table-striped">
            <thead>

                <tr>
                    <th>#</th>  
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Edit User</th>
                    <th>Delete User</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = $result->fetch_array()) {
                    ?>            
                    <tr>
                        <td><?php echo $counter; ?></td>  
                        <td><?php echo $row["first_name"]; ?></td>
                        <td><?php echo $row["last_name"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["country"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>

                        <td><a href="#">Edit</a></td>
                        <td><a href="delete/delete_user.php?userID=<?php echo $row['userID']; ?>">Delete</a></td>
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
    require_once 'views/footer.php';
    ?>
    <!-- Footer -->

    <!-- /.container -->



</body>

</html>
