<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 11:00 PM
 */
include '../shared/dbconnect.php';
include '../shared/resource.php';
include '../shared/common.php';

$product=getProductInfo($conn,$_GET['id']);

?>
<html>
<head>

</head>
<body>
<h2>Edit Product Detail</h2>
<form action="../controller/product.php" enctype="multipart/form-data" >

    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <label for="category">Category:</label>
    <input type="text" name="category" value="<?php echo $product['category']?>">

    <label for="size">Size:</label>
    <input type="text" name="size"  value="<?php echo $product['size']?>">

    <label for="color">Color:</label>
    <input type="text" name="color"  value="<?php echo $product['color']?>">

    <label for="description">Description:</label>
    <input type="text" name="description" value="<?php echo $product['description']?>" >

    <label for="min_order">Min-order:</label>
    <input type="text" name="min_order" value="<?php echo $product['min_order']?>">

    <label for="price">Price:</label>
    <input type="text" name="price" value="<?php echo $product['price']?>">



    <input type="file" name="product_image">


    <input type="submit" name="save" value="save">
</form>






</body>
</html>
