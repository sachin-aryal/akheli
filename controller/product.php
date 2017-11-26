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

if(isset($_POST['save_product'])) {
    redirectIfNotSeller();
    $product_name = $_POST["product_name"];
    $category= $_POST['category'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $min_order = $_POST['min_order'];
    $price = $_POST['price'];
    $imageName = "Not Available";
    $errorMessage = "no error";
    $user_id = $_SESSION["user_id"];
    if (isset($_FILES['product_image'])) {
        $target_dir = "../assets/images/";

        $uploadOk = 1;
        $imageName = getRandomString(25).".jpg";
        $target_file = $target_dir.$imageName;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (file_exists($target_file)) {
            $errorMessage =  "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["product_image"]["size"] > 500000) {
            $errorMessage =  "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $errorMessage =  "Sorry, your file was not uploaded.";

        } else {
            if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $errorMessage =  "Sorry, there was an error uploading your file.";
            }
        }

    } else {
        $errorMessage = "Image not found";
    }
    if($errorMessage !="no error"){
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = $errorMessage;
        header("Location:../product/create.php");
        return;
    }

    $stmt= $conn->prepare('Insert into '.PRODUCT_TABLE.'(product_name,category,description,min_order,image,price,user_id) VALUES (?,?,?,?,?,?,?)');
    $stmt->bind_param('ssssssi', $product_name,$category,$description,$min_order,$imageName,$price,$user_id);
    if($stmt->execute()){
        $product_id = $conn->insert_id;
        $length = count($_POST['size']);

        for($i=0;$i<$length;$i++){
            $stmt= $conn->prepare('Insert into '.PRODUCT_DETAIL_TABLE.'(size,color,product_id) VALUES (?,?,?)');
            $stmt->bind_param('ssi', $size[$i],$color[$i],$product_id);
            $stmt->execute();
        }
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "New Product Created Successfully.";
        header("Location:../product/create.php");
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while creating new product.";
    header("Location:../product/create.php");
    return;
}
if(isset($_POST['edit_product'])){
    redirectIfNotSeller();
    $id = $_POST['id'];
    $product = getProductInfo($conn,$id);
    if($product["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
    header("Location:../product/edit.php?id=$id");
    return;
}
if(isset($_POST['delete_product'])){
    redirectIfNotSeller();
    $id = $_POST['id'];
    $product = getProductInfo($conn,$id);
    if($product["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
    if(deleteProduct($conn,$id)){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Product Deleted successfully.";
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while deleting product.";
    }
    header("Location:../product/index.php");

}

if(isset($_POST['update_product'])) {
    redirectIfNotSeller();
    $product_id = $_POST['id'];
    $product_name = $_POST["product_name"];
    $imageLocation= getProductInfo($conn,$product_id);
    if($imageLocation["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
    $category= $_POST['category'];
    $description = $_POST['description'];
    $min_order = $_POST['min_order'];
    $imageName = $imageLocation['image'];
    $price = $_POST['price'];
    $errorMessage = "no error";

    if (!file_exists($_FILES['product_image']['tmp_name']) || !is_uploaded_file($_FILES['product_image']['tmp_name'])) {
        $imageName = $imageLocation["image"];
    }else{
        $target_dir = "../assets/images/";

        $uploadOk = 1;
        $imageName = getRandomString(25).".jpg";
        $target_file = $target_dir.$imageName;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (file_exists($target_file)) {
            $errorMessage =  "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["product_image"]["size"] > 500000) {
            $errorMessage =  "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $errorMessage =  "Sorry, your file was not uploaded.";

        } else {
            if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $errorMessage =  "Sorry, there was an error uploading your file.";
            }
        }
        if($errorMessage !="no error"){
            $_SESSION["messageType"] = "error";
            $_SESSION["message"] = $errorMessage;
            header("Location:../product/edit.php?id=$product_id");
            return;
        }else{
            try{
                if(file_exists("../assets/images/".$imageLocation["image"])){
                    unlink("../assets/images/".$imageLocation["image"]);
                }
            }catch (Exception $exception){

            }
        }
    }

    $stmt= $conn->prepare('Update '.PRODUCT_TABLE.' set product_name = ?, category=?, description=?, min_order=?, image=?, price = ? WHERE id= ?');
    $stmt->bind_param('ssssssi', $product_name,$category,$description,$min_order,$imageName,$price,$product_id);

    if($stmt->execute()) {

        $length = count($_POST['size']);
        $detail_id = $_POST['detail_id'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        removeProductDetailsByPId($conn,$product_id);
        for($i=0;$i<$length;$i++){
            $stmt= $conn->prepare('Insert into '.PRODUCT_DETAIL_TABLE.'(size,color,product_id) VALUES (?,?,?)');
            $stmt->bind_param('ssi', $size[$i],$color[$i],$product_id);
            $stmt->execute();
        }
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Product Updated Successfully.";
        header("Location:../product/edit.php?id=$product_id");
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while updating product.";
    header("Location:../product/edit.php?id=$product_id");
    return;
}


?>

