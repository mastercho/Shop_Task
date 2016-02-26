<?php
require_once 'views/top.php';

?>
<title>Admin Panel || Login</title>
</head>
<body>
    <!--logo Area-->
      <?php
      require_once 'views/header.php';
      ?>
      <!--logo area closed-->
    <!-- Page Content -->
        <div class="container">
            <div class="col-md-12">
               <div class="page-header">
                <h3>Admin Login</h3>
               </div>
                <div class="col-lg-8">
                    <form class="form-horizontal" role="form" action="process/process_admin_login.php" method="post">
                        <div class="form-group">
                            <label class="control-label col-md-2">Email :</label>
                            <div class="form-group col-md-8">
                                <input class="form-control" type="text" name="admin_name" placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Password :</label>
                            <div class="form-group col-md-8">
                                <input class="form-control" type="password" name="admin_password" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="form-group col-md-8">
                                <button class="btn btn-primary form-control" >Login</button>
                            </div>
                        </div>
                    
                    </form>
                    
                </div>
            </div>
        </div>
    <!---page content-->       
<!-- Footer -->
<?php
  require_once './views/footer.php';
?>
    <!-- /.container -->



</body>

</html>
