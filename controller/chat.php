<?php
include_once "../shared/auth.php";
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
redirectIfNotLoggedIn();

if(isset($_POST["message"]) && isset($_POST["receiver_id"])){
   $message = $_POST["message"];
   $receiver_id = $_POST["receiver_id"];
   $stmt = $conn->prepare("INSERT INTO ".CHAT_TABLE."(sender,receiver,message) VALUES (?,?,?)");
   $stmt->bind_param("iis",$_SESSION["user_id"],$receiver_id,$message);
   if($stmt->execute()){
       echo "success";
   }else{
       echo "failed";
   }
} else if($_POST["fetch_message"]) {
    $other_user = $_POST["other_user"];
    $allMessages = getAllMessages($conn, $_SESSION['user_id'], $other_user);
    $user2 = getUser($conn, "id=" . $_SESSION['user_id']);
    $client2 = getClient($conn, $other_user);
    $messages = [];
    $index = 0;
    foreach ($allMessages as $message) {
        if ($message["sender"] == $user2["id"]) {
            $messages[$index++] = $client2["name"] . ": " . $message["message"];
        } else {
            $messages[$index++] = $client["name"] . ": " . $message["message"];
        }
    }
    echo json_encode($messages);
}
else{
    echo "failed";
}