<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:03 AM
 */

include '../shared/dbconnect.php';
include '../shared/common.php';
if (isset($_POST["register"])) {

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
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $shop_name=$_POST['shop_name'];
    $phone_no=$_POST['phone_no'];
    $location=$_POST['location'];

    $user_id = $_POST["id"];
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

}
?>