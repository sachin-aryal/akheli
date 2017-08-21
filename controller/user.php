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
    $stmt = $conn->prepare("SELECT *FROM USERS WHERE email = ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        header("Location:../user/register.php?error=email address already used.");
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
            header("Location:../user/register.php?error=Error while creating user.");
        }
    }else{
        header("Location:../user/register.php?error=$conn->error");
        return;
    }

}
 ?>