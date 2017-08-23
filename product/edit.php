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
include '../shared/resource.php';
include '../shared/common.php';

$product=getProductInfo($conn,$_GET['id']);

?>
<html>
<head>

</head>
<body>
<?php include "../shared/_header.php"?>
<a href="create.php">Create Product</a>
<h2>Edit Product Detail</h2>
<form action="../controller/product.php" enctype="multipart/form-data" method="post">
    <?php include "_product_form.php"?>
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <input type="submit" name="update_product" value="Update">
</form>
<img src="../assets/images/<?php echo $product["image"] ?>" width="200" height="200"/>






</body>
</html>
