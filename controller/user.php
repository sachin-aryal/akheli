<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:03 AM
 */

if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfLoggedIn();
include_once '../shared/dbconnect.php';
include_once '../shared/common.php';

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
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Email address already used.";
        header("Location:../user/register.php");
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
            $_SESSION["messageType"] = "error";
            $_SESSION["message"] = "Error while creating user.";
            header("Location:../user/register.php");
        }
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = $conn->error;
        header("Location:../user/register.php");
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
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Email address already used.";
        header("Location:../user/edit.php");
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
            $_SESSION["messageType"] = "success";
            $_SESSION["message"] = "User information updated successfully.";
            header("Location:../user/edit.php");
            return;
        }else{
            $_SESSION["messageType"] = "error";
            $_SESSION["message"] = "Some error occurred updating user information.";
            header("Location:../user/edit.php");
            return;
        }
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Some error occurred updating user information.";
        header("Location:../user/edit.php");
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
            $_SESSION["messageType"] = "error";
            $_SESSION["message"] = "User is disabled.";
            header("Location:../user/login.php");
            return;
        }
        $_SESSION["username"] = $user["email"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["user_id"] = $user["id"];
        redirectToDash();
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "username and password did not match.";
    header("Location:../user/login.php");
    return;
}else if($_POST["logout"]){
    session_destroy();
    header("Location:../index.php");
    return;
}else{
    header("Location:../user/index.php");
}
?>