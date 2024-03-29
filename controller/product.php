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
    $weight = $_POST['weight'];
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

    $stmt= $conn->prepare('Insert into '.PRODUCT_TABLE.'(product_name,category,description,weight,image,price,user_id) VALUES (?,?,?,?,?,?,?)');
    $stmt->bind_param('ssssssi', $product_name,$category,$description,$weight,$imageName,$price,$user_id);
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
        header("Location:../product/detail.php?id=".$product_id);
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while creating new product.";
    header("Location:../product/create.php");
    return;
}
if(isset($_POST['save_detail'])){
    $product_id=$_POST['product_id'];
    $detail_name=$_POST['detail_name'];
    $detail_value=$_POST['detail_value'];
    $stmt= $conn->prepare('Insert into akh_add_product_details(field_name,field_value,product_id) VALUES (?,?,?)');
    $stmt->bind_param('ssi',$detail_name,$detail_value,$product_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "New Detail Created Successfully.";
        header("Location:../product/detail.php?id=".$product_id);
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while adding new detail.";
    header("Location:../product/detail.php?id=".$product_id);
    return;


}
if(isset($_POST['update_detail'])){
    $detail_id = my_decrypt($_POST['detail_id']);
    $product_id = my_decrypt($_POST['product_id']);
    $detail_name=$_POST['detail_name'];
    $detail_value=$_POST['detail_value'];
    $stmt= $conn->prepare('Update akh_add_product_details set field_name=?,field_value=? where detail_id=?');
    $stmt->bind_param('ssi',$detail_name,$detail_value,$detail_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Detail Updated Successfully.";
        header("Location:../product/detail.php?id=".my_encrypt($product_id));
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while Updating product detail.";
    header("Location:../product/detail.php?id=".my_encrypt($product_id));
    return;
}
if(isset($_POST['cancel_detail'])){
    $product_id = $_POST["product_id"];
    header("Location:../product/detail.php?id=".$product_id);
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
if(isset($_POST['delete_detail'])){
    redirectIfNotSeller();
    $product_id = my_decrypt($_POST['product_id']);
    $detail_id = my_decrypt($_POST['detail_id']);

    $stmt=$conn->prepare("Delete from akh_add_product_details where detail_id=?");
    $stmt->bind_param("i", $detail_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Detail Deleted successfully.";
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while deleting detail.";
    }
    header("Location:../product/detail.php?id=".my_encrypt($product_id));

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
    $weight = $_POST['weight'];
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

    $stmt= $conn->prepare('Update '.PRODUCT_TABLE.' set product_name = ?, category=?, description=?, weight=?, image=?, price = ? WHERE id= ?');
    $stmt->bind_param('ssssssi', $product_name,$category,$description,$weight,$imageName,$price,$product_id);

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
if(isset($_POST['set_feature'])){
    $product_id=$_POST['product_id'];
    $stmt=$conn->prepare("INSERT into ".FEATURED_TABLE."(product_id) VALUES(?)");
    $stmt->bind_param('i',$product_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Successfully marked as Featured Product.";
        header("Location:../product/index.php");
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while setting as Featured Product.";
    header("Location:../product/index.php");
    return;
}
if(isset($_POST['remove_feature'])){
    redirectIfNotAdmin();
    $featured_id = $_POST['featured_id'];
   $stmt=$conn->prepare("Delete from ".FEATURED_TABLE." where featured_id=?");
   $stmt->bind_param('i',$featured_id);
   if($stmt->execute()){
       $_SESSION["messageType"] = "success";
       $_SESSION["message"] = "Successfully Removed from featured Product.";
   }else{
       $_SESSION["messageType"] = "error";
       $_SESSION["message"] = "Error while Removing Featured Product.";
   }

    header("Location:../product/index.php");

}
if(isset($_POST['save_image'])){

    redirectIfNotSeller();
    $product_id=$_POST['product_id'];

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
        if ($_FILES["product_image"]["size"] > 1000000) {
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
        header("Location:../product/detail.php?id=".my_encrypt($product_id));

        return;
    }
    $stmt=$conn->prepare("INSERT into ".PRODUCT_IMAGE_TABLE."(product_image,product_id) VALUES(?,?)");
    $stmt->bind_param('si',$imageName,$product_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Successfully marked as Featured Product.";
        header("Location:../product/detail.php?id=".my_encrypt($product_id));
        return;
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while setting as Featured Product.";
    header("Location:../product/detail.php?id=".my_encrypt($product_id));

    return;
}
if(isset($_POST['delete_image'])){
    redirectIfNotSeller();
    $product_id=my_decrypt($_POST['product_id']);
    $image_id=my_decrypt($_POST['image_id']);
    $stmt=$conn->prepare("Delete from ".PRODUCT_IMAGE_TABLE." where image_id=?");
    $stmt->bind_param('i',$image_id);
    if($stmt->execute()){
        $_SESSION["messageType"] = "success";
        $_SESSION["message"] = "Successfully Removed Image from Product.";
        header("Location:../product/detail.php?id=".my_encrypt($product_id));
    }else{
        $_SESSION["messageType"] = "error";
        $_SESSION["message"] = "Error while Removing Image.";
        header("Location:../product/detail.php?id=".my_encrypt($product_id));
    }

    header("Location:../product/detail.php?id=".my_encrypt($product_id));
}


?>

