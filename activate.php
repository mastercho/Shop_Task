<?php
require_once './views/top.php';
require_once './models/user.php';
if(!isset($_REQUEST['uname'])){
    header("location:index.php");
}

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
    //require_once './views/slider.php';
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
        <div class="col-sm-9" id="product_area">


            <div class="col-md-12" >
                <h2 class="page-header">Activate User</h2>
            </div>
            <div class="col-md-12">
                <div class="col-md-5"> 
                    <label><h3> ACTIVATE MY ACCOUNT</h3>
                        Click on the button to activate
                    </label>
                </div><br>
                <div class="col-md-5">
                    <form class="form-horizontal" method="post" action="process/process_signup.php?action=activate">
                        <input class="form-control" type="hidden" name="username" value="<?php echo $_REQUEST['uname']; ?>">
                        <input class="form-control" type="hidden" name="status" value="Active"> 
                        <input class="form-control btn-primary" type="submit" value="Activate my Account"> 
                    </form>
                </div>
            </div>

        </div>
        <!---Product Close-->
    </div>
    <!-- Footer -->
    <hr>
    <?php
    require_once "./views/footer.php";
    ?>

    <!--Footer-->
</body>

</html>
