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
include_once '../shared/common.php';

$productList=getProductList($conn);
?>
<html>
<head>

</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    ?>
    <div class="content-wrapper clearfix" id="main_content">
        <a href="product/create.php">Create Product</a>
        <h2>Product List</h2>
        <?php
        foreach ($productList as $product){
            ?>
            <a href="product/detail.php?id=<?php echo $product['id'] ?>"><img src="assets/images/<?php echo $product['image'] ?>" height="100" width="100"> </a>
            <span>Product: <?php echo $product["product_name"] ?></span><br>
            <?php $productDetails = getProductDetails($conn,$product['id']);
            if(sizeof($productDetails)){
                echo "<span>Size Available:</span><br>";
                foreach ($productDetails as $productDetail){
                    ?>
                    <ul>
                        <li><?php echo $productDetail['size'] ?></li>
                    </ul>
                    <?php
                }
                ?>
            <?php }} ?>
    </div>
    <!-- The Right Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Content of the sidebar goes here -->
    </aside>
    <!-- The sidebar's background -->
    <!-- This div must placed right after the sidebar for it to work-->
    <div class="control-sidebar-bg">asdfadsf</div>
</div>

</body>
</html>

