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
                    <span id="my-market"><i style="font-size: 25px;" class="fa fa-shopping-cart fa-lg category-icon" aria-hidden="true"></i>MY MARKETS</span>
                    <button id="my-market-mobile" data-toggle="collapse" data-target="#my-market-li-device"><i class="fa fa-bars" aria-hidden="true"></i></button>
                    <ul id="my-market-li-device" class="collapse" style="background-color: white;">
                        <?php
                        foreach($random_category as $category){
                            if($category != ""){
                                echo '<li style="background-color: #6b9dbb"><a style="color: whitesmoke !important;" href="product/index.php?category='.$category["category"].'">'.$category["category"].'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                    <ul id="my-market-li">
                        <?php
                        foreach($random_category as $category){
                            if($category != ""){
                                echo '<li><a href="product/index.php?category='.$category["category"].'">'.$category["category"].'</a></li>';
                            }
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
            $featured_Lists=getFeaturedList($conn, 8);
            foreach ($featured_Lists as $featured_List) {
                $product_details=getProductInfo($conn,$featured_List['product_id']);
                ?>
                <div class="col-sm-3">
                    <article class="col-item">
                        <div class="photo">
                            <a href="product/detail.php?name=<?php echo $product_details["product_name"] ?>&id=<?php echo my_encrypt($product_details['id']) ?>"> <img src="assets/images/<?php echo $product_details['image'] ?>" class="img-thumbnail" alt="" /> </a>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price-details col-md-6">
                                    <p class="details">
                                    <ol class="breadcrumb text-center">
                                        <?php
                                        $productDetails_index = getProductDetails($conn, $featured_List['product_id']);
                                        $sizeArray=explode(',',$productDetails_index['size']);
                                        foreach ($sizeArray as $size) {
                                            ?>
                                            <li><?php echo $size ?></li>
                                            <?php
                                        }
                                        ?>
                                    </ol>
                                    <h4 class="text-center"><?php echo $product_details["product_name"] ?></h4>
                                    <p class="price-new">
                                        <?php echo "Rs. ".$product_details["price"] ?>
                                    </p>
                                </div>
                                <div class="text-center view-detail">
                                    <button class="btn btn-primary" onclick="addToCart('<?php echo my_encrypt($product_details["id"]) ?>')">Add to Cart</button>
<!--                                    <a class="btn btn-primary" href="product/detail.php?name=--><?php //echo $product_details["product_name"] ?><!--&id=--><?php //echo my_encrypt($product_details['id']) ?><!--">Details</a>-->
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
                            <a href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
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
                                    <a class="btn btn-primary" href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>">Details</a>
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
                            <a href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
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
                                    <a class="btn btn-primary" href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>">Details</a>
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