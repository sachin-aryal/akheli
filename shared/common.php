<?php
if(!isset($_SESSION)){session_start();} ;

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
            return mysqli_fetch_all($product_details,MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    return [];


}
function getProductInfo($conn,$id){
    $stmt= $conn->prepare("Select *FROM products where id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $productInfo = $stmt->get_result();
        if ($productInfo->num_rows > 0) {
            return mysqli_fetch_assoc($productInfo);
        } else {
            return [];
        }
    }
    return [];
}

function deleteProduct($conn,$id){
    $product= getProductInfo($conn,$id);
    $imageName = $product['image'];

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

function getDistinctCategory($conn){
    $productCategory = $conn->query("SELECT distinct(category) from products");
    if($productCategory->num_rows > 0){
        return mysqli_fetch_all($productCategory,MYSQLI_ASSOC);
    }
    return [];

}

function removeProductDetailsByPId($conn,$product_id){
    $stmt = $conn->prepare("DELETE FROM product_details where product_id = ?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();

}

function getMyOrders($conn){
    $stmt = $conn->prepare("SELECT *FROM ORDERS WHERE user_id = ?");
    $stmt->bind_param("i",$_SESSION["user_id"]);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return [];
}

function getAllOrders($conn){
    $stmt = $conn->prepare("SELECT *FROM ORDERS");
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return [];
}

function getProductsByCategory($conn,$category){
    $stmt= $conn->prepare("Select *FROM products where category=?");
    $stmt->bind_param("s", $category);
    if ($stmt->execute()) {
        $productInfo = $stmt->get_result();
        if ($productInfo->num_rows > 0) {
            return mysqli_fetch_all($productInfo,MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    return [];
}
function changeViewStatus($conn,$id){
    $stmt=$conn->prepare('Update orders set view=? where id=?');
    $stmt=bind_param('ii',1,$id);
    if($stmt->execute()){

    }
}
function getOrderCount($conn)
{
    $query = "select COUNT(*) from orders where viewed=0";
    $result = $conn->query($query);
    if($result->num_rows >0){
        $tCount = mysqli_fetch_assoc($result);
        return $tCount['count'];
    }
    return 0;
}

function getOrder($conn,$id){
    $stmt = $conn->prepare("SELECT *FROM ORDERS WHERE id = ?");
    $stmt->bind_param("i",$id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_assoc($result);
        }
    }
    return [];
}




