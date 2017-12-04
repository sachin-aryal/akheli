<?php
if(!isset($_SESSION)){session_start();} ;
define("KEY",'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU');

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

        }
    }
    return [];
}
function changeViewStatus($conn,$id){
    $stmt=$conn->prepare('Update '.ORDER_TABLE.' set view=? where id=?');
    $stmt->bind_param('ii',1,$id);
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
    }
    return[];
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
    }
    return[];
}
function getMostOrderedProduct($conn,$limit=0){
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
    }
    return[];
}
function getCategoryItems($conn){
    $stmt=$conn->prepare("Select count(category) as total_quantity,category,image from ".PRODUCT_TABLE." GROUP by category ORDER BY category DESC");
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return[];
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

function getAllMessages($conn,$user_id1,$user_id2, $last_id){
    $query = "SELECT *FROM ".CHAT_TABLE." where ((sender = ? and receiver = ?) or (sender = ?  and receiver = ?)) and id > ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiiii", $user_id1,$user_id2,$user_id2,$user_id1, $last_id);
    if ($stmt->execute()) {
        $chats = $stmt->get_result();
        if ($chats->num_rows > 0) {
            return mysqli_fetch_all($chats,MYSQLI_ASSOC);

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

function getTopCategories($conn, $limit = 0){
    $query = "SELECT sum(".ORDER_TABLE.".quantity) as total_quantity,category from ".ORDER_TABLE." INNER JOIN ".PRODUCT_TABLE." on ".ORDER_TABLE.".product_id=".PRODUCT_TABLE.".id GROUP by ".PRODUCT_TABLE.".category ORDER BY total_quantity DESC";
    if($limit == 0){
        $stmt=$conn->prepare($query);
    }else{
        $query = $query." LIMIT ".$limit;
        $stmt=$conn->prepare($query);
    }
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return[];

}

function getTotalProductsByCategory($conn, $category){
    $query = "SELECT count(*) as total_count from ".PRODUCT_TABLE." where category = '$category'";
    $stmt=$conn->prepare($query);
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_assoc($result)["total_count"];
        }
    }
    return 0;
}

function getTopSellerUsers($conn, $limit = 0){
    $query = "SELECT sum(".ORDER_TABLE.".quantity) as total_quantity,".PRODUCT_TABLE.".user_id from ".ORDER_TABLE." INNER JOIN ".PRODUCT_TABLE." on ".ORDER_TABLE.".product_id=".PRODUCT_TABLE.".id GROUP by ".PRODUCT_TABLE.".user_id ORDER BY total_quantity DESC";

    if($limit == 0){
        $stmt=$conn->prepare($query);
    }else{
        $query = $query." LIMIT ".$limit;
        $stmt=$conn->prepare($query);
    }
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return[];
}

function getProductByUser($conn, $user_id, $limit = 0){
    $query = "SELECT *FROM ".PRODUCT_TABLE." where user_id=?";
    if($limit != 0){
        $query .= " LIMIT ".$limit;
    }
    $stmt= $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $productInfo = $stmt->get_result();
        if ($productInfo->num_rows > 0) {
            return mysqli_fetch_all($productInfo,MYSQLI_ASSOC);

        }
    }
    return [];
}

function my_encrypt($data) {
    $encryption_key = base64_decode(KEY);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_url_encode(base64_encode($encrypted . '::' . $iv));
}

function base64_url_encode($input) {
    return strtr(base64_encode($input), '+/=', '._-');
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '._-', '+/='));
}

function my_decrypt($data) {
    $encryption_key = base64_decode(KEY);
    $data = base64_url_decode($data);
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function getTopProductOfUser($conn, $user_id, $limit = 0){
    $query = "Select sum(quantity) as total_quantity,product_id from ".ORDER_TABLE." INNER JOIN ".PRODUCT_TABLE." on ".ORDER_TABLE.".product_id=".PRODUCT_TABLE.".id WHERE ".PRODUCT_TABLE.".user_id=? GROUP by product_id ORDER BY total_quantity DESC";
    if($limit == 0){
        $stmt=$conn->prepare($query);
    }else{
        $query = $query." LIMIT ".$limit;
        $stmt=$conn->prepare($query);
    }
    $stmt->bind_param("i",$user_id);
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
    return[];
}

function getTotalProductCount($conn, $user_id){
    $query = "SELECT COUNT(*) as total_count FROM ".PRODUCT_TABLE." WHERE user_id = ?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$user_id);
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows > 0){
            return mysqli_fetch_assoc($result)["total_count"];
        }
    }
    return 0;
}

function getCategories($conn,$user_id){
    $stmt= $conn->prepare("Select DISTINCT(category) FROM ".PRODUCT_TABLE." where user_id=?");
    $stmt->bind_param("i", $user_id);
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

function getDistinctSender($conn, $user_id){
    $query = "SELECT DISTINCT(sender) FROM ".CHAT_TABLE." where receiver = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $chats = $stmt->get_result();
        if ($chats->num_rows > 0) {
            return mysqli_fetch_all($chats,MYSQLI_ASSOC);

        }
    }
    return [];
}

function getDistinctReceiver($conn, $user_id){
    $query = "SELECT DISTINCT(receiver) FROM ".CHAT_TABLE." where sender = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $chats = $stmt->get_result();
        if ($chats->num_rows > 0) {
            return mysqli_fetch_all($chats,MYSQLI_ASSOC);

        }
    }
    return [];
}
