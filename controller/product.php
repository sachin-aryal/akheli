<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 4:28 PM
 */
include "../shared/common.php";
include "../shared/dbconnect.php";

if(isset($_REQUEST['submit'])) {
    $category= $_REQUEST['category'];
    $size = $_REQUEST['size'];
    $color = $_REQUEST['color'];
    $description = $_REQUEST['description'];
    $min_order = $_REQUEST['min_order'];
    $price = $_REQUEST['price'];
    if (isset($_REQUEST['product_image'])) {
        $target_dir = "assets/images/";

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        echo $imageFileType;
        $target_file = $target_dir.getRandomString().$imageFileType;



// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["product_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

        } else {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                echo "The file has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    } else {
        echo "Image not found";
    }

    $stmt= $conn->prepare('Insert into products(category,size,color,description,min_order,price,image) VALUES (?,?,?,?,?,?,?)');

    $stmt->bind_param('sssssss', $category,$size,$color,$description,$min_order,$price,$image);

    if($stmt->execute()){
        echo "data inserted";
    }else{
        echo "data not inserted";
    }
    echo $this->db->conn->error_list;



}
?>