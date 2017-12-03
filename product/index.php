<?php
include_once "../_header.php";
if (isset($_GET["category"])) {
    $category = $_GET["category"];
    if($category == "myp" && isSeller()){
        $productList = getSellersProducts($conn);
    }else{
        $productList = getProductsByCategory($conn, $_GET["category"]);
    }
} elseif (isset($_POST["product_by_user"])){
    $user_id = my_decrypt($_POST["identifier"]);
    $productList = getProductByUser($conn, $user_id);
}
else {
    $productList = getProductList($conn);
}

?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
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
                        <div class="col-sm-3">
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


                                    <?php if(isAdmin()){ ?>
                                        <div class="view-detail">
                                            <table>
                                                <td><a class="btn btn-primary" href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>">Details</a></td>

                                                <?php
                                                $feature=featured_Product($conn,$product['id']);
                                                if($feature['product_id'] == $product['id']){

                                                    ?>
                                                    <td>

                                                        <form method="post" action="controller/product.php" class="col-md-5">
                                                            <input type="hidden" name="featured_id" value="<?php echo $feature['featured_id']?>">
                                                            <button type="submit" class="btn btn-primary" name="remove_feature" >Remove Featured</button>
                                                        </form>
                                                    </td>

                                                <?php }else{ ?>
                                                    <td>
                                                        <form method="post" action="controller/product.php" class="col-md-5" >
                                                            <input type="hidden" name="product_id" value="<?php echo $product['id']?>">
                                                            <button type="submit" class="btn btn-primary" name="set_feature" >Set Featured</button>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    <?php }else{ ?>
                                        <div class=" view-detail text-center ">
                                            <a class="btn btn-primary" href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                        </div>
                                    <?php } ?>


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

