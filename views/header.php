<?php
$obj_post = new post();
$result = $obj_post->get_posts();
$row_post = $result->fetch_array();
$obj_product = new product();
$result_product = $obj_product->get_products();

$obj_user = new User();
$result = $obj_user->get_username();
$user_row = $result->fetch_array();


$user_id = $obj_user->get_user_ID();
$ID = $user_id->fetch_array();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
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
            <a id="logo" class="navbar-brand" href="<?php echo (BASE_URL); ?>">
                <!--<span class="glyphicon glyphicon-shopping-cart"></span>-->     
                Online Shop
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="">
                    <a href="<?php echo(BASE_URL); ?>index.php">  
                        <span class="glyphicon glyphicon-home"></span>    
                        Home
                    </a>
                </li>
                <li class="dropdown ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-gift"></span>    
                        Products 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo(BASE_URL); ?>products/new_products.php">
                                <span class="glyphicon glyphicon-triangle-right"></span>   
                                New Products
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo(BASE_URL); ?>products/special_products.php">
                                <span class="glyphicon glyphicon-triangle-right"></span>   
                                Special Products
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo(BASE_URL); ?>products/Featured.php">
                                <span class="glyphicon glyphicon-triangle-right"></span>   
                                Featured
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo(BASE_URL); ?>contact_us.php">
                        <span class="glyphicon glyphicon-phone-alt"></span>     
                        Contact Us
                    </a>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
                    ?>
                    <li>
                        <a href="<?php echo(BASE_URL); ?>signup.php">
                            <span class="glyphicon glyphicon-lock"></span> Sign Up
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo(BASE_URL); ?>login.php">
                            <span class="glyphicon glyphicon-log-in"></span> Login
                        </a>
                    </li>
                    <li>
                    <a href="<?php echo(BASE_URL); ?>products/shopping_cart.php">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart 
                        <?php
                        if (isset($_SESSION['items']) & $_SESSION['items'] > 0) {
                            ?>
                            <span class="badge"><?php echo $_SESSION['items']; ?></span> 
                            <?php
                        } else {
                            ?>
                            <span class="glyphicon glyphicon-plus-sign"></span> 
                            <?php
                        }
                        ?>
                    </a>
                </li>	                				
                    <?php
                } else {
                    ?>
                <li>
                    <a href="<?php echo(BASE_URL); ?>products/shopping_cart.php">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart 
                        <?php
                        if (isset($_SESSION['items']) & $_SESSION['items'] > 0) {
                            ?>
                            <span class="badge"><?php echo $_SESSION['items']; ?></span> 
                            <?php
                        } else {
                            ?>
                            <span class="glyphicon glyphicon-plus-sign"></span> 
                            <?php
                        }
                        ?>
                    </a>
                </li>						
					<li class="dropdown ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo(BASE_URL); ?>profile.php?uname=<?php echo $user['username']; ?>">
						<span class="glyphicon glyphicon-user"></span>    
                            <?php
                            if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
                                
                            } else {
                                echo "<span class='text-capitalize'>" . $user['username'] . "</span>";
                            }
                            ?>

                            <?php
                            if ($row_post['user_id'] == $ID['userID'] && $result->num_rows > 0) {
                                ?>
                                <span class="badge"><?php echo $row_post = mysqli_num_rows($result); ?></span>
                                <?php
                            } else {
                                ?>

                                <?php
                            }
                            ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo(BASE_URL); ?>profile.php?uname=<?php  echo $user['username'];?>">
                            <span class="glyphicon glyphicon-briefcase"></span> Profile
                            </a>
                        </li>
						<li class="divider"></li>
                        <li>
                            <a href="<?php echo(BASE_URL); ?>profile.php?uname=<?php  echo $user['username'];?>">
                            <span class="glyphicon glyphicon-cog"></span> Settings
                            </a>
                        </li>
                        <li class="divider"></li>						
					    <li>
                            <a href="<?php echo(BASE_URL); ?>process/process_logout.php">
                            <span class="glyphicon glyphicon-log-out"></span> Logout
                            </a>
                        </li>
                        
                    </ul>
                </li>
                    <li>
                        

                        </a>
                    </li>
                    <li>
                        
                    </li>
                    <?php
                }
                ?>




            </ul>
        </div>
    </div>

</nav>
