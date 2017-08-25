<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 11:00 PM
 */
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfNotAdmin("../index.php");

include_once '../shared/dbconnect.php';
include_once '../shared/datatable.php';
include_once '../shared/common.php';

$productList=getProductList($conn);

?>
<html>
<head>

</head>
<body>
<?php include_once "../shared/_header.php"?>
<a href="create.php">Create Product</a>
<h2>Product List</h2>
<?php
foreach ($productList as $product){
    ?>
    <a href="detail.php?id=<?php echo $product['id'] ?>"><img src="../assets/images/<?php echo $product['image'] ?>" height="100" width="100"> </a>
    <?php $productdetails=getProductDetails($conn,$product['id']);
    foreach ($productdetails as $product_detail){
        ?>
        <ul>
        <li><?php echo $product_detail['size'] ?></li>
        </ul>
        <?php
    }
    ?>
<?php } ?>



</body>
</html>

