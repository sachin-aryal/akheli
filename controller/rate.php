<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
redirectIfNotAdmin();

if(isset($_POST['update_rate'])){
    $id=1;
    $rate=$_POST['rate'];
    $stmt=$conn->prepare("update ".RATE_TABLE." set doller_rate=? where rate_id=?");
    $stmt->bind_param('ii',$rate,$id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Rate updated successfully.";
        header("Location:../rate/rate.php");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Some error occurred updating Rate information.";
        header("Location:../rate/rate.php");
        return;
    }
}

?>