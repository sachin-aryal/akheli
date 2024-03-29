<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../_header.php";
redirectIfNotLoggedIn();

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
if(isset($_POST["identifier"])){
    $user_id = my_decrypt($_POST["identifier"]);
    ?>
    <script type="text/javascript">
        $(function(){
            var chat_with_user = $('#chat-wth-user');
            console.log(chat_with_user.has('option').length);
            if(chat_with_user.has('option').length === 1 ) {
                <?php
                    $chat_with_user = getClient($conn, $user_id);
                    $option = '<option value='.$chat_with_user["user_id"].'>'.$chat_with_user["name"].'</option>';
                ?>
                chat_with_user.append("<?php echo $option ?>");
            }
            chat_with_user.val(<?php echo $user_id ?>);
            fetchMessage();
        });
    </script>
    <?php
}
?>

<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 100%">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="col-md-4">
                    <label for="chat-wth-user">Select User</label>
                    <select class="form-control" id="chat-wth-user" onchange="fetchMessage()">
                        <option>Select User...</option>
                        <?php
                        for ($i=0;$i<sizeof($users);$i++){
                            echo '..'.$users[$i];
                            $client = getClient($conn, $users[$i]);
                            if($client["name"] != ""){
                                ?>
                                <option value="<?php echo $client["user_id"] ?>"><?php echo $client["name"] ?></option>
                                <?php
                            }
                        }
                        $client = []
                        ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="page-title">
                        <h3 style="display: inline-block"><span class="fa fa-comment"></span> Conversation History
                            <small style="color: green" id="loading-text"></small>
                        </h3>
                    </div>
                    <div class="pre-scrollable" id="chat-box-wrapper">
                        <script type="text/javascript">
                            function sendMessage(){
                                var message = $("#message").val();
                                $("#message").val("");
                                var receiver_id = $("#chat-wth-user").val();
                                if(receiver_id){
                                    $.ajax({
                                        type: 'POST',
                                        url: 'controller/chat.php',
                                        data: {message:message,receiver_id:receiver_id},
                                        success:function(data){
                                            if(data === "success"){
                                                var chat_box_wrapper    = $('#chat-box-wrapper');
                                                var height = chat_box_wrapper[0].scrollHeight;
                                                chat_box_wrapper.scrollTop(height);
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
                            var first_time = true, last_id = -1;
                            function fetchMessage(){
                                $("#loading-text").text("loading messages.....");
                                setInterval(function(){
                                    $.ajax({
                                        type: 'POST',
                                        url: 'controller/chat.php',
                                        data: {fetch_message: true,other_user: $("#chat-wth-user").val(), last_id: last_id},
                                        success:function(data){
                                            var json_data = $.parseJSON(data);
                                            for (var i = 0; i < json_data.length-1; i++) {
                                                $("#messages_box").append(json_data[i]+"<br>");
                                            }
                                            last_id = json_data[json_data.length-1];
                                            if(first_time === true){
                                                var chat_box_wrapper    = $('#chat-box-wrapper');
                                                var height = chat_box_wrapper[0].scrollHeight;
                                                chat_box_wrapper.scrollTop(height);
                                                first_time = false;
                                            }
                                        },error:function(err){
                                            $.notify('Error sending message','error');
                                        }, complete: function () {
                                            $("#loading-text").text("");
                                        }

                                    })
                                }, 1000);
                            }
                        </script>
                        <div id="messages_box">
                        </div>
                    </div>
                    <div id="chat_field" style="margin-top: 20px">
                        <textarea name="messsage" id="message" class="form-control"></textarea><br>
                        <button class="btn btn-success" onclick="sendMessage()">Send Message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>
