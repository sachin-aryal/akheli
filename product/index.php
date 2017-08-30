<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 11:00 PM
 */
if (!isset($_SESSION)) {
    session_start();
};
include_once "../shared/auth.php";
include_once '../shared/dbconnect.php';
include_once '../shared/common.php';
if (isset($_GET["category"])) {
    $category = $_GET["category"];
    if($category == "myp" && isSeller()){
        $productList = getSellersProducts($conn);
    }else{
        $productList = getProductsByCategory($conn, $_GET["category"]);
    }
} else {
    $productList = getProductList($conn);
}

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
        <div class="page-title">
            <h3><span class="fa fa-tag"></span>Product List
                <small>Available products</small>
            </h3>
        </div>
        <?php
        foreach ($productList as $product) {
            ?>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <a href="product/detail.php?id=<?php echo $product['id'] ?>"><img
                                    src="assets/images/<?php echo $product['image'] ?>"> </a>
                    </div>
                    <div class="product-description">
                        <h4 class="product-name"><?php echo $product["product_name"] ?></h4>
                        <ol class="breadcrumb text-center">
                            <?php $productDetails_index = getProductDetails($conn, $product['id']);
                            $sizeArray=explode(',',$productDetails_index['size']);
                            foreach ($sizeArray as $size){
                                ?>
                                <li>
                                    <a href="#"><?php echo $size  ?></a>
                                </li>
                            <?php } ?>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
        ?>
    </div>
</div>

</body>
</html>

