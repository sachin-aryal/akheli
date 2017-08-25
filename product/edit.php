<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfNotAdmin();

include_once '../shared/dbconnect.php';
include_once '../shared/common.php';

$product=getProductInfo($conn,$_GET['id']);
$productDetails=getProductDetails($conn,$_GET['id']);

?>
<html>
<head>

</head>
<body>
<?php include_once "../_dashboardHeader.php"?>
<a href="product/create.php">Create Product</a>
<h2>Edit Product Detail</h2>
<form action="controller/product.php" enctype="multipart/form-data" method="post">
    <?php include_once "_product_form.php"?>
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <input type="submit" name="update_product" value="Update">
</form>
<img src="assets/images/<?php echo $product["image"] ?>" width="200" height="200"/>






</body>
</html>
