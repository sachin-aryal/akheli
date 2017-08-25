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
$productDetails=getProductDetails($conn,$_GET['id']);

?>
<html>
<head>

</head>
<body>
<?php include_once "../shared/_header.php"?>
<a href="create.php">Product Details</a>
<h2>Product Detail</h2>
<ul style="list-style: none">
    <img src="assets/images/<?php echo $product['image'] ?>" height="200" width="200">
    <li><?php echo $product['category'] ?></li>
    <li><?php echo $product['min_order'] ?></li>
    <li><?php echo $product['description'] ?></li>
    <?php
        foreach ($productDetails as $productDetail){
    ?>
    <li><?php echo $productDetail['size'] ?></li>
    <li><?php echo $productDetail['price'] ?></li>
    <li><?php echo $productDetail['color'] ?></li>
    <?php } ?>

</ul>
<form method="post" action="../controller/product.php">
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <input type="submit" name="edit_product" value="Edit"/>
    <input type="submit" name="delete_product" value="Delete"/>
</form>



</body>
</html>
