<?php

if(!isset($_SESSION)){session_start();} ;
ob_start();
include_once "../shared/auth.php";
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
if(isset($_POST['save_order'])){
    redirectIfNotBuyer();
    $description = $_POST["description"];
    $size = "N/A";
    if($_POST["size"]){
        $size = implode(",",$_POST["size"]);
    }
    $color = "N/A";
    if($_POST["color"]) {
        $color = implode(",", $_POST["color"]);
    }
    $quantity = $_POST["quantity"];
    $product_id = $_POST["product_id"];
    $user_id = $_SESSION["user_id"];
    $status = ORDER_STATUS_REQUESTED;
    $stmt = $conn->prepare("INSERT INTO ".ORDER_TABLE."(description,size,color,quantity,user_id,status,product_id) 
                          VALUES(?,?,?,?,?,?,?,?) ");
    $stmt->bind_param("ssssisi",$description,$size,$color,$quantity,$user_id,$status,$product_id);
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
    $order = getOrder($conn,$order_id);
    if($order["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
    $description = $_POST["description"];
    $size = "N/A";
    if($_POST["size"]){
        $size = implode(",",$_POST["size"]);
    }
    $color = "N/A";
    if($_POST["color"]) {
        $color = implode(",", $_POST["color"]);
    }
    $quantity = $_POST["quantity"];
    $product_id = $order["product_id"];
    $stmt = $conn->prepare("UPDATE ".ORDER_TABLE." set description = ?, size = ?,color = ?,quantity = ? WHERE id = ?");
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
    $stmt = $conn->prepare("UPDATE ".ORDER_TABLE." set status = ? where id = ?");
    $stmt->bind_param("si",$status,$order_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Order updated successfully.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while updating order.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }
}
else if (isset($_POST["delete"])){
    $order_id = my_decrypt($_POST["order_id"]);
    $order = getOrder($conn,$order_id);
    if($order["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
    if(removeOrder($conn, $order_id)){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Order deleted successfully.";
        header("Location:../order/index.php");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while deleting ordering.";
        header("Location:../order/index.php");
        return;
    }
}else if(isset($_POST["edit_order_shipping"])){
    if (!isset($_SESSION["shipping_address"])) {
        $_SESSION["shipping_address"] = array();
    }
    $address = $_POST["address"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $postal_code = $_POST["postal_code"];
    $country = $_POST["country"];
    $order_id = $_POST["order_id"];

    $query = "UPDATE ".LOCATION_TABLE." set address = ?, city = ?, province = ?, postal_code = ?, country = ? WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $address, $city, $province, $postal_code, $country, $order_id);
    if($stmt->execute()){

        if (!isset($_SESSION["shipping_address"])) {
            $_SESSION["shipping_address"] = array();
        }
        if(isset($_POST['address'])){
            $_SESSION["shipping_address"]["address"]=$address;
        }
        if(isset($_POST['city'])){
            $_SESSION["shipping_address"]["city"]=$city;
        }
        if(isset($_POST['province'])){
            $_SESSION["shipping_address"]["province"]=$province;
        }
        if(isset($_POST['postal_code'])){
            $_SESSION["shipping_address"]["postal_code"]=$postal_code;
        }
        if(isset($_POST['country'])){
            $_SESSION["shipping_address"]["country"]=$country;
        }
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Order updated successfully.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while updating order.";
        header("Location:../order/edit.php?order_id=$order_id");
        return;
    }

}