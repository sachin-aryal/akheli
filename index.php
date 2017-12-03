<?php
include_once "_header.php";
$random_category = getRandomCategory($conn);
$topCategories = getTopCategories($conn, 8);
$topSellers = getTopSellerUsers($conn, 8);
$latestProduct = getLatestProduct($conn, 8);
$newArrivals = getLatestProduct($conn, 8);
$topOrderedProducts = getMostOrderedProduct($conn, 8);
?>
    <div class="container" style="width: 95%;margin: 0 auto">
        <div class="row" style="padding: 20px;height: 100%">
            <div id="outer-categories-slider" class="col-md-12">
                <div class="col-md-3">
                    <span><i style="font-size: 25px;" class="fa fa-shopping-cart fa-lg category-icon" aria-hidden="true"></i>MY MARKETS</span>
                    <ul id="my-market-li">
                        <?php
                        foreach($random_category as $category){
                            echo '<li><a href="product/index.php?category='.$category["category"].'">'.$category["category"].'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div id="thumbnail-preview-indicators" class="carousel slide marginBtm40" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#thumbnail-preview-indicators" data-slide-to="0" class="active">
                            </li>
                            <li data-target="#thumbnail-preview-indicators" data-slide-to="1">
                            </li>
                            <li data-target="#thumbnail-preview-indicators" data-slide-to="2">
                            </li>
                        </ol>
                        <div class="carousel-inner ">
                            <div class="item slides active">
                                <div class="slide-1"></div>
                                <div class="container">
                                    <!--<div class="carousel-caption">
                                        <p><a class="btn btn-lg btn-link" href="#" role="button">New Arrivals</a></p>
                                    </div>-->
                                </div>
                            </div>
                            <div class="item slides">
                                <div class="slide-2"></div>
                                <div class="container">
                                </div>
                            </div>
                            <div class="item slides">
                                <div class="slide-3"></div>
                                <div class="container">
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#thumbnail-preview-indicators" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#thumbnail-preview-indicators" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 20px;">
            <div class="custom-wrapper col-md-12">
                <div class="col-md-3">
                    <img class="img-thumbnail" src="assets/images/5rWajm6tgfofQldsMHUI9XOkm.jpg"/>
                </div>
                <div class="col-md-9">
                    <ul class="nav nav-tabs" id="home-tabes">
                        <li class="active"><a data-toggle="tab" href="#new-arrival">Top Categories</a></li>
                        <li><a data-toggle="tab" href="#top-sellers">Top Sellers</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="new-arrival" class="tab-pane fade in active">
                            <?php
                            foreach ($topCategories as $category){
                                ?>
                                <div class="well col-md-3" style="text-align: center;margin: 10px 4px 0 0;width: 24%;">
                                    <a style="color: #337ab7 !important;" href="product/index.php?category=<?php echo $category["category"] ?>"/> <?php echo $category["category"] ?></a>
                                    <br><span>Total Products:
                                        <?php
                                        echo getTotalProductsByCategory($conn, $category["category"])
                                        ?>
                                    </span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="top-sellers" class="tab-pane fade">
                            <?php
                            foreach ($topSellers as $sellers){
                                $client = getClient($conn, $sellers["user_id"]);
                                ?>
                                <div class="well col-md-3" style="text-align: center;margin: 10px 20px 0 0;width: 22%">
                                    <span>
                                        <?php
                                        echo '<p>'.$client["shop_name"].'</p>';
                                        echo '<p style="font-size: 12px">'.$client["location"]. ' / ' .$client["phone_no"].'</p>';
                                        ?>
                                    </span>
                                    <form action="product/index.php" method="POST">
                                        <input type="hidden" name="identifier" id="identifier" value="<?php echo my_encrypt($client['user_id'])?>"/>
                                        <button class="btn btn-primary" name="product_by_user" value="view_products">View Products</button>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 20px">
            <div class="col-md-5">
                <h3 style="font-weight: bold;">
                    <span>FEATURED PRODUCTS <small>Selected Products</span>
                </h3>
            </div>
            <div class="col-md-7 label-line">
            </div>
        </div>
        <div class="row custom-wrapper" style="padding: 20px">
            <?php
            foreach ($latestProduct as $product) {
                ?>
                <div class="col-sm-3">
                    <article class="col-item">
                        <div class="photo">
                            <a href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
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
                                <div class="text-center view-detail">
                                    <a class="btn btn-primary" href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>
            <?php }
            ?>
        </div>
        <div class="row " style="padding: 20px">
            <div class="col-md-5">
                <h3 style="font-weight: bold;">
                    <span>NEW ARRIVALS <small>New Products in Market</span>
                </h3>
            </div>
            <div class="col-md-7 label-line">
            </div>
        </div>
        <div class="row custom-wrapper" style="padding: 20px">
            <?php
            foreach ($newArrivals as $product) {
                ?>
                <div class="col-sm-3">
                    <article class="col-item">
                        <div class="photo">
                            <a href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
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
                                <div class="text-center view-detail">
                                    <a class="btn btn-primary" href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>
            <?php }
            ?>
        </div>
        <div class="row" style="padding: 20px">
            <div class="col-md-5">
                <h3 style="font-weight: bold;">
                    <span>MOST POPULAR <small>Most Popular Products</span>
                </h3>
            </div>
            <div class="col-md-7 label-line">
            </div>
        </div>
        <div class="row custom-wrapper" style="padding: 20px">
            <?php
            foreach ($topOrderedProducts as $products) {
                $product = getProductInfo($conn, $products["product_id"]);
                ?>
                <div class="col-sm-3">
                    <article class="col-item">
                        <div class="photo">
                            <a href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
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
                                <div class="text-center view-detail">
                                    <a class="btn btn-primary" href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>
            <?php }
            ?>
        </div>
    </div>
<?php
include_once "_footer.php";
?>