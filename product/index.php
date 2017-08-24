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

$productList=getProductList($conn);
?>
<html>
<head>

</head>
<body>
<?php include "../shared/_header.php"?>
<a href="create.php">Create Product</a>
<h2>Product List</h2>
<?php
foreach ($productList as $product){
    ?>
    <a href="detail.php?id=<?php echo $product['id'] ?>"><img src="../assets/images/<?php echo $product['image'] ?>" height="100" width="100"> </a>

<?php } ?>



</body>
</html>

