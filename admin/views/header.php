<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>    
            <a id="logo" class="navbar-brand" href="<?php echo(BASE_URL); ?>">Online Shop</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo(BASE_URL); ?>admin/home.php">Dash Board</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">Configration 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo(BASE_URL); ?>admin/category.php">Category</a></li>
                        <li><a href="<?php echo(BASE_URL); ?>admin/products.php">Products</a></li>
                        <li class=""><a href="<?php echo(BASE_URL); ?>admin/ads.php">Ad's</a></li>
                        <li class=""><a href="<?php echo(BASE_URL); ?>admin/brands.php">Brands</a></li>
                        <li class=""><a href="<?php echo (BASE_URL); ?>admin/search.php">Search</a></li>            
                    </ul>
                </li>
                <li class=""><a href="<?php echo (BASE_URL); ?>admin/orders.php">Order Management</a></li>
                <li class=""><a href="<?php echo(BASE_URL); ?>admin/customers.php">Customers</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
                    ?>
                    <li>
                        <a href="<?php echo(BASE_URL); ?>admin/login.php">
                            <span class="glyphicon glyphicon-log-in"></span> Login
                        </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <a href="#" class="text-capitalize ">
                            <span class="glyphicon"><img id="profile_img_top" class="img-responsive" src="<?php echo(BASE_URL); ?>images/admin.png"></span> 
                            <?php
                            if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
                                
                            } else {
                                echo $_SESSION['admin_user'];
                            }
                            ?>
                        </a>
                    </li>   
                    <li>
                        <a href="<?php echo(BASE_URL); ?>admin/logout.php">
                            <span class="glyphicon glyphicon-log-out"></span> Logout
                        </a>
                    </li>            
                    <?php
                }
                ?>    
            </ul> 
            <!--        
                  <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo(BASE_URL); ?>signup.php">
                         <span class="glyphicon glyphicon-user"></span> Sign Up
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo(BASE_URL); ?>login.php">
                            <span class="glyphicon glyphicon-log-in"></span> Login
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Cart 
                            <span class="badge">7</span> 
                        </a>
                    </li>
                  </ul>-->
        </div>
    </div>
</nav>
<!--navigation-->
<!--logo area-
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-xs-6">
        <img id="logo_img" class="img-responsive" src="<?php echo(BASE_URL); ?>images/logo.gif" >
        </div>
        <div class="col-sm-5">
            <h1>
             
<?php
if (!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])) {
    ?>
                       Admin Panel
    <?php
} else {
    $_SESSION['email'] = "Aydan";
    echo 'Welcome ';
    echo $_SESSION['email'];
}
?>
            </h1>
            
        </div>
<!--              <div class="col-sm-4 ">
                  <span> 
                      <img id="cart_logo" class="img-responsive" src="<?php echo(BASE_URL); ?>images/shopping_cart_logo.png">
                  <!--<h3>Items in your Cart <span class="badge cart_item">5</span></h3>-->
<!--                  </span>     <button type="button" id="item-cart" class="btn">Items in your Cart <span class="badge">7</span></button>
                 
-->                 

