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
    $role=$_POST['role'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $last_name=$_POST['last_name'];
    $phone_no=$_POST['phone_no'];
    $location=$_POST['location'];
    $pan_number=$_POST['pan_number'];
    $password = hash('sha256', $password);
    if($role == "S"){
        $role = ROLE_SELLER;
    }else if($_POST["role"] == 'C'){
        $role = ROLE_BUYER;
    }
    $enabled = 1;
    if(checkEmail($conn,$email)){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Email address already used.";
        header("Location:../user/register.php");
        return;
    }
    if(!file_exists($_FILES['user_image']['tmp_name']) || !is_uploaded_file($_FILES['user_image']['tmp_name'])){
        $errorMessage = "Image not found";
    } else{
        $target_dir = "../assets/upload/";

        $uploadOk = 1;
        $imageName = getRandomString(25).".jpg";
        $target_file = $target_dir.$imageName;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $errorMessage="no error";
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

    }
    if($errorMessage !="no error"){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = $errorMessage;
        header("Location:../user/register.php");
        return;
    }

    $stmt = $conn->prepare('INSERT INTO '.USER_TABLE.'(email,password,role,enabled) VALUES (?,?,?,?)');
    $stmt->bind_param('sssi', $email,$password,$role,$enabled);
    if($stmt->execute()){
        $user_id = $conn->insert_id;
        $stmt = $conn->prepare("INSERT INTO ".CLIENT_TABLE."(name,last_name,phone_no,location,pan_number,user_id,user_image) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssis",$name,$last_name,$phone_no,$location,$pan_number,$user_id,$imageName);
        if($stmt->execute()){
            header("Location:../user/index.php");
        }else{
            $stmt = $conn->prepare("DELETE FROM ".USER_TABLE." WHERE email = ?");
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
    $last_name=$_POST['last_name'];
    $phone_no=$_POST['phone_no'];
    $location=$_POST['location'];
    $pan_number=$_POST['pan_number'];

    if(checkEmailEdit($conn,$email,$user_id)){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Email address already used.";
        header("Location:../user/edit.php");
        return;
    }
    $user = getUser($conn,"id=".$user_id);
    $client = getClient($conn,$user["id"]);
    if($password == ""){
        $password = $user["password"];
    }else{
        $password = hash('sha256', $password);
    }
    $errorMessage="no error";
    if(!file_exists($_FILES['user_image']['tmp_name']) || !is_uploaded_file($_FILES['user_image']['tmp_name'])){
        $imageName = $client["user_image"];
    }else{
        $target_dir = "../assets/upload/";
        $uploadOk = 1;
        $imageName = getRandomString(25).".jpg";
        $target_file = $target_dir.$imageName;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
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

    }
    if($errorMessage != "no error"){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = $errorMessage;
        header("Location:../user/edit.php");
        return;
    }

    $stmt = $conn->prepare("UPDATE ".USER_TABLE." SET email = ?, password = ? WHERE id = ?");
    $stmt->bind_param('ssi',$email,$password,$user_id);
    if($stmt->execute()){
        $stmt = $conn->prepare("UPDATE ".CLIENT_TABLE." set name = ?, last_name = ?, phone_no = ?, location = ?, user_image = ?,pan_number=? WHERE user_id = ?");
        $stmt->bind_param("sssssi",$name,$last_name,$phone_no,$location,$imageName,$pan_number,$_SESSION["user_id"]);
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
        header("Location:../index.php");
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
            header("Location:../index.php");
            return;
        }
        $_SESSION["username"] = $user["email"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["user_id"] = $user["id"];
        if($_POST["redirect_to"]){
            header("Location:".$_POST["redirect_to"]);
        }else{
            redirectToDash();
        }
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "username and password did not match.";
    header("Location:../index.php");
    return;
}
if($_POST['changePassword']){
    $email=$_POST['email'];
    $randomPassword= randomPassword();
    $stmt= $conn->prepare("update ".USER_TABLE." set password = ? where email=?");
    $stmt->bind_param("ss",$randomPassword, $email);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Password successfully Reset!";
        header("Location:../user/reset_password.php");
        return;
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Email not Found! Password reset fail.";
        header("Location:../user/reset_password.php");
        return;
    }
}else if($_GET["l"]){
    if(my_decrypt($_GET['l']) == 'pleaselogout'){
        unset($_SESSION["username"]);
        unset($_SESSION["role"]);
        unset($_SESSION["user_id"]);
        header("Location:../index.php");
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Invalid Request.";
    header("Location:../index.php");
    return;
}else{
    header("Location:../user/index.php");
}


?>