<?php
if(!isset($_SESSION)){session_start();} ;

function getUserList($conn){
    $users = $conn->query("SELECT *FROM ".USER_TABLE);
    if ($users->num_rows > 0) {
        return mysqli_fetch_all($users,MYSQLI_ASSOC);
    }
    return [];
}

function getClient($conn,$user_id){
    $client = $conn->query("SELECT *FROM ".CLIENT_TABLE." WHERE user_id = $user_id");
    if($client->num_rows > 0){
        return mysqli_fetch_assoc($client);
    }
    return [];
}

function getUser($conn,$condition){
    $user = $conn->query("SELECT *FROM ".USER_TABLE." WHERE $condition");
    if($user->num_rows > 0){
        return mysqli_fetch_assoc($user);
    }
    return [];
}

function checkEmail($conn,$email){
    $stmt = $conn->prepare("SELECT *FROM ".USER_TABLE." WHERE email = ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return true;
    }
    return false;
}

function checkEmailEdit($conn,$email,$user_id){
    $stmt = $conn->prepare("SELECT *FROM ".USER_TABLE." WHERE email = ? and id != ?");
    $stmt->bind_param('si',$email,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return true;
    }
    return false;
}

function checkUser($conn,$username,$password) {
    $stmt = $conn->prepare("SELECT *FROM ".USER_TABLE." WHERE email = ? and password = ?");
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

    $products = $conn->query("SELECT * FROM ".PRODUCT_TABLE);
    if ($products->num_rows > 0) {
        return mysqli_fetch_all($products,MYSQLI_ASSOC);
    }
    return [];
}
function getProductDetails($conn,$id){
    $stmt=$conn->prepare("SELECT *FROM ".PRODUCT_DETAIL_TABLE." where product_id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $product_details = $stmt->get_result();
        if ($product_details->num_rows > 0) {
            return mysqli_fetch_assoc($product_details)  ;
        } else {
            return [];
        }
    }
    return [];


}
function getProductInfo($conn,$id){
    $stmt= $conn->prepare("Select *FROM ".PRODUCT_TABLE." where id=?");
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
    echo $id;
    $product= getProductInfo($conn,$id);
    $imageName = $product['image'];

    $stmt = $conn->prepare("DELETE FROM ".PRODUCT_TABLE." WHERE id= ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if(file_exists("../assets/images/")){
            unlink("../assets/images/".$imageName);
        }
        return true;
    }
    return false;

}

function getDistinctCategory($conn, $limit = 0){
    if($limit == 0){
        $productCategory = $conn->query("SELECT distinct(category) as category from ".PRODUCT_TABLE);
    }else{
        $productCategory = $conn->query("SELECT distinct(category) as category from ".PRODUCT_TABLE." LIMIT $limit");
    }
    if($productCategory->num_rows > 0){
        return mysqli_fetch_all($productCategory,MYSQLI_ASSOC);
    }
    return [];

}

function removeProductDetailsByPId($conn,$product_id){
    $stmt = $conn->prepare("DELETE FROM ".PRODUCT_DETAIL_TABLE." where product_id = ?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();

}

function getBuyersOrders($conn){
    $stmt = $conn->prepare("SELECT *FROM ".ORDER_TABLE." WHERE user_id = ?");
    $stmt->bind_param("i",$_SESSION["user_id"]);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return [];
}

function getOrdersByProduct($conn,$product_id){
    $stmt = $conn->prepare("SELECT *FROM ".ORDER_TABLE." WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return [];
}

function getSellersOrders($conn){
    $stmt= $conn->prepare("Select *FROM ".PRODUCT_TABLE." where user_id=?");
    $stmt->bind_param("i", $_SESSION["user_id"]);
    if ($stmt->execute()) {
        $productInfo = $stmt->get_result();
        if ($productInfo->num_rows > 0) {
            $sellerProducts =  mysqli_fetch_all($productInfo,MYSQLI_ASSOC);
            $data = [];$index = 0;
            foreach ($sellerProducts as $sellerP){
                $orders = getOrdersByProduct($conn,$sellerP["id"]);
                foreach ($orders as $order){
                    $data[$index++] = $order;
                }
            }
            return $data;
        } else {
            return [];
        }
    }
    return [];
}

function getAllOrders($conn){
    $stmt = $conn->prepare("SELECT *FROM ".ORDER_TABLE);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return [];
}

function getSellersProducts($conn){
    $stmt= $conn->prepare("Select *FROM ".PRODUCT_TABLE." where user_id=?");
    $stmt->bind_param("i", $_SESSION["user_id"]);
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

function getProductsByCategory($conn,$category){
    $stmt= $conn->prepare("Select *FROM ".PRODUCT_TABLE." where category=?");
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
    $stmt=$conn->prepare('Update '.ORDER_TABLE.' set view=? where id=?');
    $stmt=bind_param('ii',1,$id);
    if($stmt->execute()){

    }
}
function getOrderCount($conn)
{
    $query = "select COUNT(*) from ".ORDER_TABLE." where viewed=0";
    $result = $conn->query($query);
    if($result->num_rows >0){
        $tCount = mysqli_fetch_assoc($result);
        return $tCount['count'];
    }
    return 0;
}
function getLatestProduct($conn,$limit= 0){
    if($limit == 0){
        $stmt=$conn->prepare("Select * from ".PRODUCT_TABLE." ORDER BY id DESC");
    }else{
        $stmt=$conn->prepare("Select * from ".PRODUCT_TABLE." ORDER BY id DESC limit $limit");
    }
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC) ;
        }
        return[];
    }
}
function getRandomProduct($conn,$limit=0){
    if($limit==0){
        $stmt=$conn->prepare("Select * from ".PRODUCT_TABLE." ORDER BY rand()");
    }else{
        $stmt=$conn->prepare("Select * from ".PRODUCT_TABLE." ORDER BY rand() DESC limit $limit");
    }
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC) ;
        }
        return[];
    }
}
function getMostViewProduct($conn,$limit=0){
    if($limit==0){
        $stmt=$conn->prepare("Select sum(quantity) as total_quantity,product_id from ".ORDER_TABLE." GROUP by product_id ORDER BY total_quantity DESC");
    }else{
        $stmt=$conn->prepare("Select sum(quantity) as total_quantity,product_id from ".ORDER_TABLE." GROUP by product_id ORDER BY total_quantity DESC limit $limit");
    }
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        return[];
    }
}
function getCategoryItems($conn){
    $stmt=$conn->prepare("Select count(category) as total_quantity,category,image from ".PRODUCT_TABLE." GROUP by category ORDER BY category DESC");
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        return[];
    }
}


function getOrder($conn,$id){
    $stmt = $conn->prepare("SELECT *FROM ".ORDER_TABLE." WHERE id = ?");
    $stmt->bind_param("i",$id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_assoc($result);
        }
    }
    return [];
}
function getSearchProducts($conn,$product_name){
    $search_name = "%".$product_name."%";

    $stmt = $conn->prepare("SELECT * FROM ".PRODUCT_TABLE." WHERE description like ? or product_name like ? ");
    $stmt->bind_param("ss", $search_name,$search_name);
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

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function getAllMessages($conn,$user_id1,$user_id2){
    $query = "SELECT *FROM ".CHAT_TABLE." where (sender = ? and receiver = ?) or (sender = ?  and receiver = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiii", $user_id1,$user_id2,$user_id2,$user_id1);
    if ($stmt->execute()) {
        $chats = $stmt->get_result();
        if ($chats->num_rows > 0) {
            return mysqli_fetch_all($chats,MYSQLI_ASSOC);

        } else {
            return [];
        }
    }
    return [];
}
function getProductAddInfo($conn,$id){

    $stmt = $conn->prepare("SELECT *FROM akh_add_product_details WHERE product_id = ?");
    $stmt->bind_param("i",$id);
    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows > 0){

            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return [];
}

function getRandomCategory($conn){
    $productCategory = $conn->query("SELECT distinct(category) as category from ".PRODUCT_TABLE." ORDER BY rand() limit 8");
    if($productCategory->num_rows > 0){
        return mysqli_fetch_all($productCategory,MYSQLI_ASSOC);
    }
    return [];
}
