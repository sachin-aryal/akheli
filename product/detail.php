<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 11:00 PM
 */

session_start();
include "../shared/auth.php";
redirectIfNotAdmin("../index.php");

include '../shared/dbconnect.php';
include '../shared/datatable.php';
include '../shared/common.php';

$product=getProductInfo($conn,$_GET['id']);

?>
<html>
<head>

</head>
<body>
<?php include "../shared/_header.php"?>
<a href="create.php">Create Product</a>
<h2>Product Detail</h2>
<ul style="list-style: none">
    <img src="../assets/images/<?php echo $product['image'] ?>" height="200" width="200">
    <li><?php echo $product['category'] ?></li>
    <li><?php echo $product['size'] ?></li>
    <li><?php echo $product['price'] ?></li>
    <li><?php echo $product['min_order'] ?></li>
    <li><?php echo $product['color'] ?></li>
    <li><?php echo $product['description'] ?></li>

</ul>
<form method="post" action="../controller/product.php">
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <input type="submit" name="edit_product" value="Edit"/>
    <input type="submit" name="delete_product" value="Delete"/>
</form>



</body>
</html>
