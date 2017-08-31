<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../shared/auth.php";
include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
redirectIfNotLoggedIn();

$user_id = $_SESSION["user_id"];
if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];
}
$user = getUser($conn, "id=" . $user_id);
$client = getClient($conn, $user_id);
?>

<html>
<head>
    <title>My Profile</title>
    <script type="text/javascript">
        function sendMessage(){
            var message = $("#message").val();
            var receiver_id = '<?php echo $user["id"] ?>';
            $.ajax({
                type: 'POST',
                url: 'controller/chat.php',
                data: {message:message,receiver_id:receiver_id},
                success:function(data){
                    if(data === "success"){
                        $("#messages_box").append("<?php echo $client['name'] ?>: "+message+"<br>")
                    }else{
                        $.notify('Error sending message','error');
                    }
                },error:function(err){
                    $.notify('Error sending message','error');
                }

            })
        }

    </script>
</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    ?>
    <div class="content-wrapper clearfix" id="main_content">

        <div class="page-title">
            <h3><span class="fa fa-user"></span> My Profile
                <small>Profile details here</small>
            </h3>
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="assets/upload/<?php echo $client['user_image'] ?>">
                    </div>
                </div>

                <div class="col-md-8 clearfix">
                    <div class="col-lg-4">
                        <div class="detail-component">
                            <h6 class="title">Name</h6>
                            <h4 title="Name"><?php echo $client[name]; ?></h4>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="detail-component">
                            <h6 class="title">Shop Name</h6>
                            <h4 title="Name"><?php echo $client[shop_name]; ?></h4>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="detail-component">
                            <h6 class="title">Location</h6>
                            <h4 title="Name"><?php echo $client[location]; ?></h4>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="detail-component">
                            <h6 class="title">Emai</h6>
                            <h4 title="Name"><?php echo $user[email]; ?></h4>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="detail-component">
                            <h6 class="title">Phone</h6>
                            <h4 title="Name"><?php echo $client[phone_no]; ?></h4>
                        </div>
                    </div>

                </div>
            </div>
            <?php if($_SESSION["user_id"] == $user["id"]){ ?>
                <form method='post' action='user/edit.php'>
                    <input class="btn btn-primary btn-edit-profile" type='submit' value='Edit Profile'/>
                </form>
            <?php } ?>
            <?php if($_SESSION["user_id"] != $user["id"]){

                $allMessages = getAllMessages($conn,$_SESSION['user_id'],$user["id"]);
                $user2 = getUser($conn,"id=".$_SESSION['user_id']);
                $client2 = getClient($conn,$user2["id"]);
                ?>
                <div class="row">
                    <h2>Conversation History</h2>
                    <div id="messages_box">
                        <?php
                        foreach ($allMessages as $message) {
                            if($message["sender"] == $user2["id"]){
                                echo $client2["name"].": ".$message["message"]."<br>";
                            }else{
                                echo $client["name"].": ".$message["message"]."<br>";
                            }
                        } ?>
                    </div>
                    <div id="chat_field">
                        <textarea name="messsage" id="message" class="form-control"></textarea>
                        <button onclick="sendMessage()">Send Message</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- The Right Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Content of the sidebar goes here -->
    </aside>
    <!-- The sidebar's background -->
    <!-- This div must placed right after the sidebar for it to work-->
    <div class="control-sidebar-bg">asdfadsf</div>
</div>
</body>
</html>

