<?php

if(!isset($_SESSION)){session_start();} ;

include_once "../shared/auth.php";
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
if(isset($_POST['save_order'])){
    redirectIfNotBuyer();
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
}else if(isset($_POST["edit_order"])){
    $order_id = $_POST["order_id"];
    $edit_order = getOrder($conn,$order_id);
    if($edit_order["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
    $order = getOrder($conn,$order_id);
    $description = $_POST["description"];
    $size = implode(",",$_POST["size"]);
    $color = implode(",",$_POST["color"]);
    $quantity = $_POST["quantity"];
    $product_id = $order["product_id"];
    $user_id = $_SESSION["user_id"];
    $viewed = $order["viewed"];
    $status = $order["status"];
    $stmt = $conn->prepare("UPDATE orders set description = ?, size = ?,color = ?,quantity = ? WHERE id = ?");
    $stmt->bind_param("ssssi",$description,$size,$color,$quantity,$order_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Order updated successfully.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while ordering.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }
}else if(isset($_POST["edit_order_admin"])){
    if(!isSeller()){
        redirectToDash();
        return;
    }
    $order_id = $_POST["order_id"];
    $status = $_POST["status"];
    $stmt = $conn->prepare("UPDATE orders set status = ? where id = ?");
    $stmt->bind_param("si",$status,$order_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Order updated successfully.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while ordering.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }
}