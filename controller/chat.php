<?php
include_once "../shared/auth.php";
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
redirectIfNotLoggedIn();

if(isset($_POST["message"]) && isset($_POST["receiver_id"])){
   $message = $_POST["message"];
   $receiver_id = $_POST["receiver_id"];
   $stmt = $conn->prepare("INSERT INTO chats(sender,receiver,message) VALUES (?,?,?)");
   $stmt->bind_param("iis",$_SESSION["user_id"],$receiver_id,$message);
   if($stmt->execute()){
       echo "success";
   }else{
       echo "failed";
   }
}else{
    echo "failed";
}