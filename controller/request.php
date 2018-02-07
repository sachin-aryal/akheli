<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 4:28 PM
 */
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";

include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
if(!isset($_SESSION)){session_start();} ;

if(isset($_POST['Submit'])) {
    $product_name = $_POST["product_name"];
    $email= $_POST['email'];

    $imageName = "Not Available";
    $errorMessage = "no error";
    if (isset($_FILES['uploads'])) {
        $target_dir = "../assets/images/";

        $uploadOk = 1;
        $imageName = getRandomString(25).".jpg";
        $target_file = $target_dir.$imageName;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (file_exists($target_file)) {
            $errorMessage =  "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["uploads"]["size"] > 500000) {
            $errorMessage =  "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $errorMessage =  "Sorry, your file was not uploaded.";

        } else {
            if (!move_uploaded_file($_FILES["uploads"]["tmp_name"], $target_file)) {
                $errorMessage =  "Sorry, there was an error uploading your file.";
            }
        }

    } else {
        $errorMessage = "Image not found";
    }
    if($errorMessage !="no error"){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = $errorMessage;
        header("Location:../index.php");

        return;
    }

    $stmt= $conn->prepare('Insert into '.REQUEST_QUOTATION.'(product_name,email,image) VALUES (?,?,?)');
    $stmt->bind_param('sss', $product_name,$email,$imageName);
    if($stmt->execute()){

        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "New Product Created Successfully.";
        header("Location:../index.php");
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while creating new product.";
    header("Location:../index.php");

    return;
}
if(isset($_GET['delete'])){
    $id=$_GET['id'];
    $quotation= getQuotation($conn,$id);
    $imageName = $quotation['image'];

    $stmt = $conn->prepare("DELETE FROM ".REQUEST_QUOTATION." WHERE id= ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if(file_exists("../assets/images/")){
            unlink("../assets/images/".$imageName);
        }

        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Deleted Successfully.";
        header("Location:../user/request.php");
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while deleting quotation.";
    header("Location:../user/request.php");


}