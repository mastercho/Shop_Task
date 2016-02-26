<?php
require_once 'views/top.php';
?>
</head>
<body>
    <div class="container">
        <!--logo Area-->
        <?php
        require_once 'views/header.php';
        ?>
        <!--logo area closed-->
        <hr>
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>  
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>country</th>
                        <th>Status</th>
                        <th>Edit User</th>
                        <th>Delete USer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>  
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>America</td>
                        <td>Active</td>
                        <td><a href="#">Edit</a></td>
                        <td><a href="#">Delete</a></td>
                    </tr>
                    <tr>
                        <td>2</td> 
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>America</td>
                        <td>Active</td>
                        <td><a href="#">Edit</a></td>
                        <td><a href="#">Delete</a></td>
                    </tr>
                    <tr>
                        <td>3</td>  
                        <td>July</td>
                        <td>Dooley</td>
                        <td>july@example.com</td>
                        <td>America</td>
                        <td>Active</td>
                        <td><a href="#">Edit</a></td>
                        <td><a href="#">Delete</a></td>
                    </tr>
                    <tr>
                        <td>4</td>  
                        <td>Saad</td>
                        <td>Test</td>
                        <td>SaadTest@example.com</td>
                        <td>UK</td>
                        <td>Active</td>
                        <td><a href="#">Edit</a></td>
                        <td><a href="#">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!---page content-->       
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="col-sm-12">
                    <div class="panel">    
                        <p>Copyright &copy; Online Shop 2015</p>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->



</body>

</html>
