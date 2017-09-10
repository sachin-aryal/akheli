<?php
include_once "_header.php";
?>

    <div class="container">

        <div class="new-section col-lg-3 clearfix">
            <div class="container-flude">
                <div class="row">
                    <div class="item-list">
                        <legend>New Arrival</legend>
                        <ul class="list-unstyled">
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe1.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe2.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li>
                                <a href="#">See more...</a>
                            </li>
                        </ul>
                    </div>
                    <div class="item-list">
                        <legend>Best Seller</legend>
                        <ul class="list-unstyled">
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe1.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe2.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li>
                                <a href="#">See more...</a>
                            </li>
                        </ul>
                    </div>
                    <div class="item-list">
                        <legend>Random</legend>
                        <ul class="list-unstyled">
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe1.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="public/img/shoe2.png" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#">Oakley Kickback</a></h4>
                                    <span>Rs 15/-</span>
                                </div>
                            </li>
                            <li>
                                <a href="#">See more...</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9 clearfix">

            <div class="col-md-12">
               <div class="featured-wrapper"></div>
                    <div class="featured-product">
                        <div class="clearfix">
                        <h2 class="no-margin pull-left">Red Pants</h2>
                            <h3 class="no-margin pull-right">Rs 300/-</h3>
                        </div>

                        <p class="margin-vertical"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                        <button class="btn btn-primary"><span class="fa fa-shopping-cart"></span>&nbsp; Order</button>
                    </div>

                <div class="product-view-image new-section">
                    <img src="public/img/pant1.jpg" alt="">
                </div>
            </div>

            <div class="new-section">
                <h2 class="title"><span>New Arrival</span></h2>
                <div class="container-fluid">
                    <div class="row">
                        <?php $latest_productList = getLatestProduct($conn);
                        foreach ($latest_productList as $latestProduct) {


                            $latestProductDetaills = getProductDetails($conn, $latestProduct['id']);
                            ?>
                            <div class="col-md-4">
                                <div class="product-wrapper">
                                    <div class="product-image">
                                        <img src="assets/images/.'<?php echo $latestProduct['image'] ?>'" alt="">
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name"><?php echo $latestProduct['product_name'] ?></h4>
                                        <ol class="breadcrumb text-center">
                                            <?php $sizeArray = explode(',', $latestProductDetaills['size']);
                                            foreach ($sizeArray as $size) {
                                                ?>
                                                <li>
                                                    <a href="#"><?php echo $size ?></a>
                                                </li>
                                            <?php } ?>
                                        </ol>
                                        <p>
                                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp;
                                            <b>Rs <?php echo $latestProduct['price'] ?>/-</b>
                                        </p>
                                        <div class="text-center">
                                            <button class="btn btn-view">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/pant2.jpg" alt="">
                                </div>
                                <div class="product-description">
                                    <h4 class="product-name">Korean Pant</h4>
                                    <ol class="breadcrumb text-center">
                                        <li>
                                            <a href="#">S</a>
                                        </li>
                                        <li>
                                            <a href="#">M</a>
                                        </li>
                                        <li>
                                            <a href="#">L</a>
                                        </li>
                                        <li>
                                            <a href="#">XXL</a>
                                        </li>
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
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/pant3.jpg" alt="">
                                </div>
                                <div class="product-description">
                                    <h4 class="product-name">Korean Pant</h4>
                                    <ol class="breadcrumb text-center">
                                        <li>
                                            <a href="#">S</a>
                                        </li>
                                        <li>
                                            <a href="#">M</a>
                                        </li>
                                        <li>
                                            <a href="#">L</a>
                                        </li>
                                        <li>
                                            <a href="#">XL</a>
                                        </li>
                                        <li>
                                            <a href="#">XXL</a>
                                        </li>
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
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/pant4.jpg" alt="">
                                </div>
                                <div class="product-description">
                                    <h4 class="product-name">Korean Pant</h4>
                                    <ol class="breadcrumb text-center">
                                        <li>
                                            <a href="#">S</a>
                                        </li>
                                        <li>
                                            <a href="#">M</a>
                                        </li>
                                        <li>
                                            <a href="#">L</a>
                                        </li>
                                        <li>
                                            <a href="#">XL</a>
                                        </li>
                                        <li>
                                            <a href="#">XXL</a>
                                        </li>
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
                    </div>
                </div>
            </div>
            <div class="new-section">
                <h2 class="title"><span>Most Popular</span></h2>
                <div class="container-fluid">
                    <div class="row">
                        <?php $latest_productList = getMostViewProduct($conn);
                        foreach ($latest_productList as $latestProduct) {

                            $productInfo = getProductInfo($conn, $latestProduct['product_id']);

                            $latestProductDetaills = getProductDetails($conn, $latestProduct['product_id']);
                            ?>
                            <div class="col-md-4">
                                <div class="product-wrapper">
                                    <div class="product-image">
                                        <img src="assets/images/.'<?php echo $productInfo['image'] ?>'" alt="">
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name"><?php echo $productInfo['product_name'] ?></h4>
                                        <ol class="breadcrumb text-center">
                                            <li>
                                                <a href="#"><?php echo $latestProductDetaills['size'] ?></a>
                                            </li>
                                            <li>
                                                <a href="#">M</a>
                                            </li>
                                            <li>
                                                <a href="#">L</a>
                                            </li>
                                            <li>
                                                <a href="#">XL</a>
                                            </li>
                                            <li>
                                                <a href="#">XXL</a>
                                            </li>
                                        </ol>
                                        <p>
                                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp;
                                            <b>Rs <?php echo $productInfo['price'] ?>/-</b>
                                        </p>
                                        <div class="text-center">
                                            <button class="btn btn-view">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/pant2.jpg" alt="">
                                </div>
                                <div class="product-description">
                                    <h4 class="product-name">Korean Pant</h4>
                                    <ol class="breadcrumb text-center">
                                        <li>
                                            <a href="#">S</a>
                                        </li>
                                        <li>
                                            <a href="#">M</a>
                                        </li>
                                        <li>
                                            <a href="#">L</a>
                                        </li>
                                        <li>
                                            <a href="#">XL</a>
                                        </li>
                                        <li>
                                            <a href="#">XXL</a>
                                        </li>
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
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/pant3.jpg" alt="">
                                </div>
                                <div class="product-description">
                                    <h4 class="product-name">Korean Pant</h4>
                                    <ol class="breadcrumb text-center">
                                        <li>
                                            <a href="#">S</a>
                                        </li>
                                        <li>
                                            <a href="#">M</a>
                                        </li>
                                        <li>
                                            <a href="#">L</a>
                                        </li>
                                        <li>
                                            <a href="#">XL</a>
                                        </li>
                                        <li>
                                            <a href="#">XXL</a>
                                        </li>
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
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/pant4.jpg" alt="">
                                </div>
                                <div class="product-description">
                                    <h4 class="product-name">Korean Pant</h4>
                                    <ol class="breadcrumb text-center">
                                        <li>
                                            <a href="#">S</a>
                                        </li>
                                        <li>
                                            <a href="#">M</a>
                                        </li>
                                        <li>
                                            <a href="#">L</a>
                                        </li>
                                        <li>
                                            <a href="#">XL</a>
                                        </li>
                                        <li>
                                            <a href="#">XXL</a>
                                        </li>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once "_footer.php";
?>