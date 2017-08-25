<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 11:00 PM
 */

if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
include_once '../shared/dbconnect.php';
include_once '../shared/datatable.php';
include_once '../shared/common.php';

$product=getProductInfo($conn,$_GET['id']);

?>
<html>
<head>
<title>Product Detail</title>
</head>
<body>
<?php include_once "../_dashboardHeader.php"?>
<a href="product/create.php">Crete Product</a>
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
<form method="post" action="controller/product.php">
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <input type="submit" name="edit_product" value="Edit"/>
    <input type="submit" name="delete_product" value="Delete"/>
</form>
<input type="text" id="page_id" value="product_details"/>
</body>
</html>
