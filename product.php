<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 8/30/2017
 * Time: 8:08 PM
 */
@include "_header.php";
if (isset($_POST["category"])) {
    $productList = getProductsByCategory($conn, $_POST["category"]);
} else {
    $productList = getProductList($conn);
}


?>

    <div class="main-wrapper">

    <div class="new-section bg-gray">
    <div class="container">
    <div class="row">
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
<?php
@include "_footer.php";
?>