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

$product_info_details = getProductInfo($conn,$_GET['id']);
$productDetails_details = getProductDetails($conn,$_GET['id']);

?>
<html>
<head>
    <title>Product Detail</title>
</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    ?>
    <div class="content-wrapper clearfix" id="main_content">
        <a href="product/create.php">Crete Product</a>
        <h2>Product Detail</h2>
        <ul style="list-style: none">
            <img src="assets/images/<?php echo $product_info_details['image'] ?>" height="200" width="200">
            <li>Category: <?php echo $product_info_details['category'] ?></li>
            <li>Minimum Order:<?php echo $product_info_details['min_order'] ?></li>
            <li>Description: <?php echo $product_info_details['description'] ?></li>
            <li>Price: <?php echo $product_info_details['price'] ?></li>
            <?php
            foreach ($productDetails_details as $productDetail){
                ?>
                <li>Size: <?php echo $productDetail['size']." Color:".$productDetail['color'] ?></li>
            <?php } ?>

        </ul>
        <form method="post" action="controller/product.php">
            <input type="hidden" name="id" value="<?php echo $product_info_details['id'] ?>"/>
            <input type="submit" name="edit_product" value="Edit"/>
            <input type="submit" name="delete_product" value="Delete"/>
        </form>
        <input type="hidden" id="page_id" value="product_details"/>
        <!-- The Right Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Content of the sidebar goes here -->
        </aside>
        <!-- The sidebar's background -->
        <!-- This div must placed right after the sidebar for it to work-->
        <div class="control-sidebar-bg">asdfadsf</div>
    </div>
</div>
</body>
</html>
