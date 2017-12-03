<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../_header.php";

$sender_id = $_SESSION["user_id"];
$sender_user = getUser($conn, "id=" . $sender_id);
$sender_client = getClient($conn, $sender_id);
$receiver = getDistinctReceiver($conn, $_SESSION["user_id"]);
$sender = getDistinctSender($conn, $_SESSION["user_id"]);
$users = array();
$index = 0;
foreach ($receiver as $user){
    if(!in_array($user["receiver"], $users)){
        $users[$index++] = $user["receiver"];
    }
}
foreach ($sender as $user){
    if(!in_array($user["sender"], $users)){
        $users[$index++] = $user["sender"];
    }
}
?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 100%">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-10">
                <div class="col-md-4">
                    <label for="chat-wth-user">Select User</label>
                    <select class="form-control" id="chat-wth-user" onchange="fetchMessage()">
                        <option>Select User...</option>
                        <?php
                        for ($i=0;$i<sizeof($users);$i++){
                            echo '..'.$users[$i];
                            $client = getClient($conn, $users[$i]);
                            ?>
                            <option value="<?php echo $client["user_id"] ?>"><?php echo $client["name"] ?></option>
                            <?php
                        }
                        $client = []
                        ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="pre-scrollable">
                        <script type="text/javascript">
                            function sendMessage(){
                                var message = $("#message").val();
                                $("#message").val("");
                                var receiver_id = $("#chat-wth-user").val();
                                if(receiver_id){
                                    var receiver_name = $("#list option[value="+receiver_id+"]").text();
                                    $.ajax({
                                        type: 'POST',
                                        url: 'controller/chat.php',
                                        data: {message:message,receiver_id:receiver_id},
                                        success:function(data){
                                            if(data === "success"){
                                                $("#messages_box").append(receiver_name+":"+message+"<br>")
                                            }else{
                                                $.notify('Error sending message','error');
                                            }
                                        },error:function(err){
                                            $.notify('Error sending message','error');
                                        }

                                    });
                                }
                            }
                        </script>
                        <script type="text/javascript">
                            function fetchMessage(){
                                $("#loading-text").text("loading messages.....");
                                setInterval(function(){
                                    $.ajax({
                                        type: 'POST',
                                        url: 'controller/chat.php',
                                        data: {fetch_message: true,other_user: $("#chat-wth-user").val()},
                                        success:function(data){
                                            $("#messages_box").empty();
                                            var json_data = $.parseJSON(data);
                                            for (var i = 0; i < json_data.length; i++) {
                                                $("#messages_box").append(json_data[i]+"<br>");
                                            }
                                        },error:function(err){
                                            $.notify('Error sending message','error');
                                        }, complete: function () {
                                            $("#loading-text").text("");
                                        }

                                    })
                                }, 3000);
                            }
                        </script>
                        <div class="page-title">
                            <h3 style="display: inline-block"><span class="fa fa-comment"></span> Conversation History
                            <small style="color: green" id="loading-text"></small>
                            </h3>
                        </div>
                        <div id="messages_box">
                        </div>
                        <div id="chat_field" style="margin-top: 10px">
                            <textarea name="messsage" id="message" class="form-control"></textarea><br>
                            <button class="btn btn-success" onclick="sendMessage()">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
