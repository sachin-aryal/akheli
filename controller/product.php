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
    redirectIfNotAdmin();
    $category= $_POST['category'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $min_order = $_POST['min_order'];
    $price = $_POST['price'];
    $imageName = "Not Available";
    $errorMessage = "no error";
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

    $stmt= $conn->prepare('Insert into products(category,description,min_order,image) VALUES (?,?,?,?)');
    $stmt->bind_param('ssss', $category,$description,$min_order,$imageName);
    if($stmt->execute()){
        $product_id = $conn->insert_id;
        $stmt= $conn->prepare('Insert into product_details(size,color,product_id,price) VALUES (?,?,?,?)');
        $stmt->bind_param('ssis', $size,$color,$product_id,$price);
        if($stmt->execute()){
            $_SESSION["messageType"] = "success";
            $_SESSION["message"] = "New Product Created Successfully.";
            header("Location:../product/create.php");
            return;
        }
    }
    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while creating new product.";
    header("Location:../product/create.php");
    return;
}
if(isset($_POST['edit_product'])){
    redirectIfNotAdmin();
    $id = $_POST['id'];
    header("Location:../product/edit.php?id=$id");
    return;
}
if(isset($_POST['delete_product'])){
    redirectIfNotAdmin();
    $id = $_POST['id'];
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
    redirectIfNotAdmin();
    $id = $_POST['id'];
    $imageLocation= getProductInfo($conn,$id);
    $category= $_POST['category'];
    $description = $_POST['description'];
    $min_order = $_POST['min_order'];
    $imageName = $imageLocation['image'];
    $errorMessage = "no error";

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
        $imageName = $imageLocation["image"];
        header("Location:../product/edit.php?id=$id");
        return;
    }else{
        unlink("../assets/images/".$imageLocation["image"]);
    }

    $stmt= $conn->prepare('Update products set category=?,description=?,min_order=?,image=? WHERE id= ?');
    $stmt->bind_param('ssssi', $category,$description,$min_order,$imageName,$id);

    if($stmt->execute()) {
        $length=count($_POST['detail_id']);
        $detail_id=$_POST['detail_id'];

        $size = $_POST['size'];
        $color = $_POST['color'];
        $price = $_POST['price'];


        for($i=0;$i<$length;$i++){
            echo $detail_id[$i];
            echo $size[$i];

            $stmt = $conn->prepare('Update product_details set size=?,color=?,price=? WHERE id= ?');
            $stmt->bind_param('sssi',$size[$i],$color[$i],$price[$i],$detail_id[$i]);

            if ($stmt->execute()) {

                $_SESSION["messageType"] = "success";
                $_SESSION["message"] = "Product Updated Successfully.";
//                header("Location:../product/edit.php?id=$id");
                return;
            }
        }

    }


    $_SESSION["messageType"] = "error";
    $_SESSION["message"] = "Error while updating product.";
//    header("Location:../product/edit.php?id=$id");
    return;
}


?>

