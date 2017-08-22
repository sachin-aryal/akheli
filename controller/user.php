<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:03 AM
 */

include '../shared/dbconnect.php';
include '../shared/common.php';
session_start();
if (isset($_POST["register"])) {
    if(!isset($_POST["name"])){
        header("Location:../user/register.php");
        return;
    }
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $shop_name=$_POST['shop_name'];
    $phone_no=$_POST['phone_no'];
    $location=$_POST['location'];
    $password = hash('sha256', $password);
    $role = "akheli_client";
    $enabled = 1;
    if(checkEmail($conn,$email)){
        header("Location:../user/register.php?message=email address already used.");
        return;
    }
    $stmt = $conn->prepare('INSERT INTO USERS(email,password,role,enabled) VALUES (?,?,?,?)');
    $stmt->bind_param('sssi', $email,$password,$role,$enabled);
    if($stmt->execute()){
        $user_id = $conn->insert_id;
        $stmt = $conn->prepare("INSERT INTO CLIENTS(name,shop_name,phone_no,location,user_id) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi",$name,$shop_name,$phone_no,$location,$user_id);
        if($stmt->execute()){
            header("Location:../user/login.php");
        }else{
            $stmt = $conn->prepare("DELETE FROM USERS WHERE email = ?");
            $stmt->bind_param('s',$email);
            $stmt->execute();
            header("Location:../user/register.php?message=message while creating user.");
        }
    }else{
        header("Location:../user/register.php?message=$conn->error");
        return;
    }

}else if($_POST["update"]){
    $user_id = $_POST["id"];
    $allowed = false;
    if(isset($_SESSION["user_id"])){
        if($_SESSION["user_id"] == $user_id){
            $allowed = true;
        }
    }
    if(!$allowed){
        header("Location:../index.php");
        return;
    }
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $shop_name=$_POST['shop_name'];
    $phone_no=$_POST['phone_no'];
    $location=$_POST['location'];

    if(checkEmailEdit($conn,$email,$user_id)){
        header("Location:../user/edit.php?message=email address already used.");
        return;
    }
    $user = getUser($conn,$user_id);
    if($password == ""){
        $password = $user["password"];
    }else{
        $password = hash('sha256', $password);
    }
    $stmt = $conn->prepare("UPDATE USERS SET email = ?, password = ? WHERE id = ?");
    $stmt->bind_param('ssi',$email,$password,$user_id);
    if($stmt->execute()){
        $stmt = $conn->prepare("UPDATE CLIENTS set name = ?, shop_name = ?, phone_no = ?, location = ? WHERE user_id = ?");
        $stmt->bind_param("ssssi",$name,$shop_name,$phone_no,$location,$user_id);
        if($stmt->execute()){
            header("Location:../user/edit.php?message=user information updated successfully.");
            return;
        }else{
            header("Location:../user/edit.php?message=some error occurred updating user information.");
            return;
        }
    }else{
        header("Location:../user/edit.php?message=some error occurred updating user information.");
        return;
    }

}else if($_POST["login"]){
    if(!isset($_POST["username"])){
        header("Location:../user/login.php");
        return;
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password = hash("sha256",$password);
    $userResult = checkUser($conn,$username,$password);
    if($userResult){
        $user = mysqli_fetch_assoc($userResult);
        if($user["enabled"] == 0){
            header("Location:../user/login.php?message = user is disabled.");
            return;
        }
        $_SESSION["username"] = $user["email"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["user_id"] = $user["id"];
        header("Location:../index.php");
        return;
    }
    header("Location:../user/login.php?message = username and password did not match.");
    return;
}else if($_POST["logout"]){
    session_destroy();
    header("Location:../index.php");
    return;
}
?>