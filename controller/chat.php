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
    $last_id = $_POST["last_id"];
    $allMessages = getAllMessages($conn, $_SESSION['user_id'], $other_user, $last_id);
    $client1 = getClient($conn, $_SESSION['user_id']);
    $client2 = getClient($conn, $other_user);

    $messages = [];
    $index = 0;
    foreach ($allMessages as $message) {
        if ($message["sender"] == $client1["user_id"]) {
            $messages[$index++] = $client1["name"] . ": " . $message["message"];
        } else {
            $messages[$index++] = $client2["name"] . ": " . $message["message"];
        }
        $last_id = $message["id"];
    }
    $messages[$index] = $last_id;
    echo json_encode($messages);
}
else{
    echo "failed";
}