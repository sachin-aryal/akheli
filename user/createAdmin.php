<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/25/17
 * Time: 9:06 AM
 */
//ini_set('display_errors','Off');
//ini_set('error_reporting', E_ALL );
//define('WP_DEBUG', false);
//define('WP_DEBUG_DISPLAY', false);
include_once '../shared/auth.php';
include_once '../shared/dbconnect.php';

$email = "iamadmin";
$password = hash("sha256","admin");
echo $password;
$role = ROLE_ADMIN;
$enabled = 1;
$name = "admin";
$shop_name = "admin";
$phone_no = "admin";
$location = "admin";
$imageName = "test.jpg";

$stmt = $conn->prepare('INSERT INTO USERS(email,password,role,enabled) VALUES (?,?,?,?)');
$stmt->bind_param('sssi', $email,$password,$role,$enabled);
if($stmt->execute()){
    $user_id = $conn->insert_id;
    $stmt = $conn->prepare("INSERT INTO CLIENTS(name,shop_name,phone_no,location,user_image,user_id) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("sssssi",$name,$shop_name,$phone_no,$location,$imageName,$user_id);
    if($stmt->execute()){
        header("Location:../index.php");
        return;
    }else{
        $stmt = $conn->prepare("DELETE FROM USERS WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();

    }
}else{
    header("Location:../index.php");
    return;
}