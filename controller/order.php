<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/25/2017
 * Time: 6:02 PM
 */
session_start();
include_once "../shared/auth.php";
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
if(isset($_POST['save_order'])){

    $description = $_POST["description"];
    $size = implode(",",$_POST["size"]);
    $color = implode(",",$_POST["color"]);
    $quantity = $_POST["quantity"];
    $product_id = $_POST["product_id"];
    $user_id = $_SESSION["user_id"];
    $viewed = 0;
    $status = ORDER_STATUS_REQUESTED;
    $stmt = $conn->prepare("INSERT INTO orders(description,size,color,quantity,user_id,status,viewed,product_id) 
                          VALUES(?,?,?,?,?,?,?,?) ");
    $stmt->bind_param("ssssisii",$description,$size,$color,$quantity,$user_id,$status,$viewed,$product_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Ordered Successfully.";
        header("Location:../order/create.php?product_id=$product_id");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while ordering.";
        header("Location:../order/create.php?product_id=$product_id");
        return;
    }
}