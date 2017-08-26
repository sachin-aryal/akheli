<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:03 AM
 */

if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";

include_once '../shared/dbconnect.php';
include_once '../shared/common.php';

if (isset($_POST["register"])) {
    redirectIfLoggedIn();
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

    if (isset($_FILES['user_image'])) {

        $target_dir = "../assets/upload/";

        $uploadOk = 1;
        $imageName = getRandomString(25).".jpg";
        $target_file = $target_dir.$imageName;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $errorMessage="no error";
        echo $target_file;
        if (file_exists($target_file)) {
            $errorMessage =  "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["user_image"]["size"] > 500000) {
            $errorMessage =  "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $errorMessage =  "Sorry, your file was not uploaded.";

        } else {
            if (!move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
                $errorMessage =  "Sorry, there was an error uploading your file.";
            }
        }

    } else {
        $errorMessage = "Image not found";
    }
    if($errorMessage !="no error"){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = $errorMessage;
        header("Location:../user/register.php");
        return;
    }

    $stmt = $conn->prepare('INSERT INTO USERS(email,password,role,enabled) VALUES (?,?,?,?)');
    $stmt->bind_param('sssi', $email,$password,$role,$enabled);
    if($stmt->execute()){
        $user_id = $conn->insert_id;
        $stmt = $conn->prepare("INSERT INTO CLIENTS(name,shop_name,phone_no,location,user_id,user_image) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssis",$name,$shop_name,$phone_no,$location,$user_id,$imageName);
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
    $user = getUser($conn,"id=".$user_id);
    if($password == ""){
        $password = $user["password"];
    }else{
        $password = hash('sha256', $password);
    }
    if (isset($_FILES['user_image'])) {

        $target_dir = "../assets/upload/";

        $uploadOk = 1;
        $imageName = getRandomString(25).".jpg";
        $target_file = $target_dir.$imageName;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $errorMessage="no error";
        echo $target_file;
        if (file_exists($target_file)) {
            $errorMessage =  "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["user_image"]["size"] > 500000) {
            $errorMessage =  "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $errorMessage =  "Sorry, your file was not uploaded.";

        } else {
            if (!move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
                $errorMessage =  "Sorry, there was an error uploading your file.";
            }
        }

    } else {
        $errorMessage = "Image not found";
    }
    if($errorMessage !="no error"){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = $errorMessage;
        header("Location:../user/register.php");
        return;
    }

    $stmt = $conn->prepare("UPDATE USERS SET email = ?, password = ? WHERE id = ?");
    $stmt->bind_param('ssi',$email,$password,$user_id);
    if($stmt->execute()){
        $stmt = $conn->prepare("UPDATE CLIENTS set name = ?, shop_name = ?, phone_no = ?, location = ?, user_image = ? WHERE user_id = ?");
        $stmt->bind_param("sssssi",$name,$shop_name,$phone_no,$location,$imageName,$user_id);
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
    redirectIfLoggedIn();
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
        return;
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