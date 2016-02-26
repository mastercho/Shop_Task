<?php
require_once './views/top.php';
require_once './models/user.php';
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    die(header("Location: login.php"));
} else {
    $user = $_SESSION['user'];
}

$objuser = new User();
$objuser->username = $user['username'];
$result_user = $objuser->get_username();
$row_user = $result_user->fetch_array();
//print_r ($row_user);

$obj_chat = new chat();
if (!empty($_REQUEST['chatID'])) {
    $obj_chat->chatID = $_REQUEST['chatID'];
    $chat = $obj_chat->get_chat_by_chatID();
    $chatID = $chat->fetch_array();
}

$chat_msg = $obj_chat->get_messages_by_chatID();
$row = $chat_msg->fetch_array();

//print_r($chatID);
//print_r($row);

/*
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
*/      
?>
<link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/jquery.cssemoticons.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function (e) {


        $("#chat_box").animate({scrollTop: $('#chat_box').prop("scrollHeight")}, 1000);
        $("#msg").keypress(function (event) {
            if (event.which == 13) {
                var userID = $("#userID").val();
                var chatID = $("#chatID").val();
                var msg = $("#msg").val();
                $.post("process/process_chat.php?action=send", {userID: userID, chatID: chatID, msg: msg}, function (data)
                {
                    $("#chat_box").load(document.URL + ' #chat');
                    $("#msg").val("");
//                      $('#chat_box').scrollTop($('#chat_box')[0].scrollHeight);
                    $("#chat_box").animate({scrollTop: $('#chat_box').prop("scrollHeight")}, 1000);

                });

            }
        });
        setInterval(function ()
        {
            var userID = $("#chat_user").val();
            var chatID = $("#chatID").val();
            $.post("process/process_chat.php?action=recieve", {userID: userID, chatID: chatID}, function (data)
            {
                $("#chat_box").load(document.URL + ' #chat');
//                      $('#chat_box').scrollTop($('#chat')[0].scrollHeight);
                $("#chat_box").animate({scrollTop: $('#chat_box').prop("scrollHeight")}, 1000);
            });
        }, 5000);



    });


</script>
</head>
<body>
    <!--logo Area-->
<?php
require_once './views/header.php';
?>
    <!--logo area closed-->

    <!-- Page Content -->
    <div class="container">
        <div class="page-header">
            <h2>Messages

            </h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-md-3">
                <div class="navbar row">
                    <ul class="nav nav-tabs nav-stacked">
                        <li data-toggle="collapse" data-target="#user" 
                            id="" class="list-group-item list-group-item-heading active h4 ">Users
                            <span data-toggle="usermenu" data-target="#demo" class="pull-right glyphicon glyphicon-user"></span>
                        </li>
                        <div id="user" class="usermenu text-capitalize">
<?php
$objuser = new User();
$result_users = $objuser->get_all_users();
while ($row_users = $result_users->fetch_array()) {
    if ($row_users['userID'] != $user['userID']) {
        ?>                        
                                    <a href="process/process_chat.php?action=create_chat&id=<?php echo $row_users['userID'] ?>"
                                       class="">
                                        <li class="list-group-item" >
                                            <img class="img-responsive img-thumbnail" id="chat_user_img" height="50" width="50"
                                                 src="images/users/<?php echo $row_users['username']; ?>/<?php echo $row_users['profile_image']; ?>">    
                                            <strong class=""><?php echo $row_users['username']; ?></strong>
                                            
                                            <?php 
											if($row_users['status']=="online"){
											?>    
											<span class="pull-right"><img src="images/icon_active.gif"></span>
											<?php
											}
											?>
                                        </li>
                                    </a>           
        <?php
    } else {
        echo "";
    }
}
?>
                        </div>
                    </ul>
                </div>    
            </div>

            <div class="col-md-8">        
                <div id="message_panel" class="panel panel-primary">
                    <div class="panel-heading">Messages
<?php if (isset($_SESSION['msg'])) { ?>
                            by <?php echo $_SESSION['msg'] ?> 
<?php } ?>
                        <button type="button" class="close" 
                                data-target="#message_panel" 
                                data-dismiss="alert">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>  
                    </div>
                    <div class="panel-body overflow-chat " id="chat_box" >
<?php
if (isset($_SESSION['msg'])) {
    ?> 
                            You have started a conversation with "<?php echo $_SESSION['msg'] ?>" 
    <?php
}
?>
                        <br>
                        <div class="col-md-12" id="chat">
                            <input type="hidden" id="msg_count" value="<?php echo $chat_msg->num_rows; ?>">               
                        <?php
                        if (isset($_REQUEST['chatID'])) {
                            while ($row_msg = $chat_msg->fetch_array()) {
                                if ($row_msg['userID'] != $user['userID']) {
                                    ?>

                                        <div class="pull-left col-md-8 " id="chat_usermsg">
                                            <div class="col-md-2" >
                                                <img class="img-rounded" height="40" width="40" src="images/2.jpg">
                                            </div>
                                            <div class="col-md-10 clearfix">
                                                <blockquote class="bg-success ">
            <?php echo $row_msg['message']; ?>   
                                                </blockquote>
                                                <span class="text-muted h6 ">
            <?php
            $time = strtotime($row_msg["sent_date"]);
            $myFormatForView = date("jS,F Y  H:i:s", $time);
            //echo $row_post["created_date"];
            echo $myFormatForView;
            ?>
                                                </span>

                                            </div>

                                        </div><br>
                                                    <?php
                                                } else {
                                                    ?>
                                        <div class="pull-right col-md-8 " id="usermsg">
                                            <div class="pull-right col-md-2">
                                                <img class="img-rounded" height="40" width="40" src="images/2.jpg">
                                            </div>
                                            <div class="col-md-10 clearfix">
                                                <blockquote class="bg-info blockquote-reverse" >
                                        <?php echo $row_msg['message']; ?>
                                                </blockquote>
                                                <span class="text-muted h6 col-md-offset-3 ">
            <?php
            $time = strtotime($row_msg["sent_date"]);
            $myFormatForView = date("jS,F Y H:i:s", $time);
            //echo $row_post["created_date"];
            echo $myFormatForView;
            ?>
                                                </span>

                                            </div>
                                        </div><br>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>                    
                        </div>        
                    </div>
                    <div class="panel-footer">
                        <form class="form-horizontal" method="post" action="process/process_chat.php?action=send">
                            <input type="hidden" name="userID" id="userID" value="<?php echo $user['userID']; ?>">
                            <input type="hidden" name="chatID" id="chatID" value="<?php echo $chatID['chatID']; ?>">
                            <input type="hidden" name="chat_user" id="chat_user" value="<?php echo $chatID['reciever']; ?>">

                            <div class="form-group row ">   
                                <div class="col-md-12">
                                    <textarea class="form-control" name="msg" id="msg"
                                              placeholder="Press Enter Key to Send"></textarea>
                                    <!--<input type="text" name="msg">-->

                                </div>
                                <!--<div class="col-md-2">-->    
                                <!--<button class="btn btn-danger" type="button" id="send">Send</button>-->
                                <!--</div>-->
                            </div>     
                        </form>
                    </div>
                </div>
                <br>

            </div>
        </div>



    </div>


    <!-- Footer -->

<?php
require_once "./views/footer.php";
?>

    <!--Footer-->
</body>

</html>
