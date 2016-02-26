<?php
require_once './views/top.php';
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
    require_once './views/slider.php';
    ?> 
    <!--Coursal-->
    <!-- Page Content -->



    <div class="container">
        <!--Middle Nav-->

        <?php
//require_once './views/middle_nav.php';
        ?>        
        <!--Middle Nav close-->

        <div class="col-md-7">
            <br>
            <iframe id="google_map" src="https://www.google.com/maps/embed/v1/place?q=London,+United+Kingdom&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU" 
                    width="600" height="450" frameborder="2" style="border:0" allowfullscreen>

            </iframe>

        </div>
        <div class="col-md-4">
            <br>	
            <h4>Owner Info :</h4>
			<div class="col-md-12">
			<div class="col-sm-5 col-lg-5 col-md-5">
			<img class="img-responsive thumbnail" src="images/user.png">
			</div>
			<div class="col-md-7">
			<label class="control-label">Aydan Aleydin</label><br>
			<label class="control-label">CEO</label><br>
			<label class="control-label">Microprocesor Engineer</label><br>
			<label class="control-label">Live in London,UK</label><br>
			</div>
			</div>
        </div>





    </div>

    <!-- Footer -->
    <hr>
    <?php
    require_once "./views/footer.php";
    ?>

    <!--Footer-->
</body>

</html>
