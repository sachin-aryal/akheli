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
<h2>Product Detail</h2>


    <ul style="list-style: none">
       <img src="../<?php echo $product['image'] ?>" height="200" width="200">
        <li><?php echo $product['category'] ?></li>
        <li><?php echo $product['size'] ?></li>
        <li><?php echo $product['price'] ?></li>
        <li><?php echo $product['min_order'] ?></li>
        <li><?php echo $product['color'] ?></li>
        <li><?php echo $product['description'] ?></li>

    </ul>
    <form method="get" action="../controller/product.php">
        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
        <button type="submit" name="edit">Edit</button>
        <button type="submit" name="delete">Delete</button>
    </form>





</body>
</html>
