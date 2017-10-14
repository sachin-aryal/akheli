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
            <h3><span class="fa fa-tag"></span> Product List
                <small>Available products</small>
            </h3>
        </div>
        <?php
        foreach ($productList as $product) {
        ?>
        <div class="row">
            <div class="col-sm-4">
                <article class="col-item">
                    <div class="photo">
                        <a href="product/detail.php?id=<?php echo $product['id'] ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-responsive" alt="" /> </a>
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price-details col-md-6">
                                <p class="details">
                                <ol class="breadcrumb text-center">
                                    <?php
                                    $productDetails_index = getProductDetails($conn, $product['id']);
                                    $sizeArray=explode(',',$productDetails_index['size']);
                                    foreach ($sizeArray as $size) {
                                        ?>
                                        <li><?php echo $size ?></li>
                                        <?php
                                    }
                                    ?>
                                </ol>
                                <h4 class="text-center"><?php echo $product["product_name"] ?></h4>
                                <p class="price-new">
                                    <?php echo "Rs. ".$product["price"] ?>
                                </p>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="product/detail.php?id=<?php echo $product['id'] ?>">View</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </article>
            </div>

            <?php }
            ?>
        </div>
    </div>

</body>
</html>

