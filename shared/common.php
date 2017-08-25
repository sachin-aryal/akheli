<?php


function getUserList($conn){
    $users = $conn->query("SELECT *FROM USERS");
    if ($users->num_rows > 0) {
        return mysqli_fetch_all($users,MYSQLI_ASSOC);
    }
    return [];
}

function getClient($conn,$user_id){
    $client = $conn->query("SELECT *FROM CLIENTS WHERE user_id = $user_id");
    if($client->num_rows > 0){
        return mysqli_fetch_assoc($client);
    }
    return [];
}

function getUser($conn,$condition){
    $user = $conn->query("SELECT *FROM USERS WHERE $condition");
    if($user->num_rows > 0){
        return mysqli_fetch_assoc($user);
    }
    return [];
}

function checkEmail($conn,$email){
    $stmt = $conn->prepare("SELECT *FROM USERS WHERE email = ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return true;
    }
    return false;
}

function checkEmailEdit($conn,$email,$user_id){
    $stmt = $conn->prepare("SELECT *FROM USERS WHERE email = ? and id != ?");
    $stmt->bind_param('si',$email,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return true;
    }
    return false;
}

function checkUser($conn,$username,$password) {
    $stmt = $conn->prepare("SELECT *FROM USERS WHERE email = ? and password = ?");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        $user = $stmt->get_result();
        if ($user->num_rows > 0) {
            return $user;
        } else {
            return false;
        }
    }
    return false;
}
function getRandomString($l = 15){
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $result = '';
    for ($i = 0; $i < $l; $i++){
        $result .= $characters[mt_rand(0, 61)];
    }
    return $result;
}
function getProductList($conn){

    $products = $conn->query("SELECT * FROM products");
    if ($products->num_rows > 0) {
        return mysqli_fetch_all($products,MYSQLI_ASSOC);
    }
    return [];
}
function getProductDetails($conn,$id){
    $stmt=$conn->prepare("Select * from product_details where product_id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $product_details = $stmt->get_result();
        if ($product_details->num_rows > 0) {
            return $product_details;
        } else {
            return false;
        }
    }
    return false;


}
function getProductInfo($conn,$id){
    $stmt= $conn->prepare("Select * FROM products where id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $productInfo = $stmt->get_result();
        if ($productInfo->num_rows > 0) {
            return mysqli_fetch_assoc($productInfo);
        } else {
            return false;
        }
    }
    return false;
}

function deleteProduct($conn,$id){
    $imageLocation= getProductInfo($conn,$id);
    $imageName = $imageLocation['image'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id= ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if(file_exists("../assets/images/")){
            unlink("../assets/images/".$imageName);
        }
        return true;
    }
    return false;

}

function getProductByCategory($conn){
    $productCategory = $conn->query("SELECT distinct(category) from products");
    if($productCategory->num_rows > 0){
        return mysqli_fetch_all($productCategory,MYSQLI_ASSOC);
    }
    return [];

}
