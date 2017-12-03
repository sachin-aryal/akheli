<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 8/30/2017
 * Time: 8:08 PM
 */
include_once "_header.php";
if (isset($_POST['search']) && !empty($_POST['search'])) {

    $productList = getSearchProducts($conn,$_POST['search']);

} else {
    $productList = getProductList($conn);
}

?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "_dashsidebar.php"?>
            <div class="col-md-10">
                <div class="page-title">
                    <h3><span class="fa fa-tag"></span> Product List
                        <small>Available products</small>
                    </h3>
                </div>
                <div class="row">
                    <?php
                    foreach ($productList as $product) {
                        ?>
                        <div class="col-sm-4">
                            <article class="col-item">
                                <div class="photo">
                                    <a href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-responsive" alt="" /> </a>
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
                                        <a href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>">View</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
