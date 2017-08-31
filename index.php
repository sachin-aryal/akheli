<?php
include_once "_header.php";
?>


<div id="myCarousel" class="carousel slide slider" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="public/img/1.jpg" alt="Los Angeles">
        </div>

        <div class="item">
            <img src="public/img/2.jpg" alt="Chicago">
        </div>

        <div class="item">
            <img src="public/img/3.jpg" alt="New york">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container">
    <div class="row margin-vertical shadow">
<!--        <div class="col-md-6">-->
<!--            <div class="feature main-feature">-->
<!--                <img src="public/img/1.jpg" alt="">-->
<!--                <div class="overlay">-->
<!--                    <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                </div>-->
<!--                <div class="absolute-center offer">-->
<!--                    50%-->
<!--                    Off-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!--            <div class="feature sub-feature">-->
<!--                <img src="public/img/2.jpg" alt="">-->
<!--                <div class="overlay">-->
<!--                    <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                </div>-->
<!--                <div class="absolute-center offer">-->
<!--                    50%-->
<!--                    Off-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="clearfix sub-feature-wrapper">-->
<!--                <div class="col-md-6">-->
<!--                    <div class="feature sub-feature">-->
<!--                        <img src="public/img/3.jpg" alt="">-->
<!--                        <div class="overlay">-->
<!--                            <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                        </div>-->
<!--                        <div class="absolute-center offer">-->
<!--                            50%-->
<!--                            Off-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-6">-->
<!--                    <div class="feature sub-feature">-->
<!--                        <img src="public/img/3.jpg" alt="">-->
<!--                        <div class="overlay">-->
<!--                            <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                        </div>-->
<!--                        <div class="absolute-center offer">-->
<!--                            50%-->
<!--                            Off-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <form method="post" action="product.php">
            <input type="hidden" name="category" value="<?php echo $category['category'] ?>">
            <button type="submit"><?php echo $category['category'] ?></button>
        </form>
        <div class="col-md-11 no-padding">
            <form class="general-search-form" action="searchResult.php" method="post">
                <div class="form-group no-margin">
                    <input type="search" class="form-control text-center" id="search" name="search" placeholder="Search product here...">
                </div>
            </form>
        </div>
        <div class="col-md-1 bg-white no-padding text-center"><span class="fa fa-search general-search-icon"></span></div>


    </div>
</div>

<div class="new-section bg-gray">
    <h2 class="title">New Arrival</h2>
    <div class="container">
        <div class="row">
            <?php $latest_productList=getLatestProduct($conn);
            foreach ($latest_productList as $latestProduct){



                $latestProductDetaills=getProductDetails($conn,$latestProduct['id']);
                ?>
                <div class="col-md-3">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="assets/images/.'<?php echo $latestProduct['image'] ?>'" alt="">
                        </div>
                        <div class="product-description">
                            <h4 class="product-name"><?php echo $latestProduct['product_name'] ?></h4>
                            <ol class="breadcrumb text-center">
                                <?php $sizeArray=explode(',',$latestProductDetaills['size']);
                                foreach ($sizeArray as $size){
                                    ?>
                                    <li>
                                        <a href="#"><?php echo $size  ?></a>
                                    </li>
                                <?php } ?>
                            </ol>
                            <p>
                                <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs <?php echo $latestProduct['price'] ?>/-</b>
                            </p>
                            <div class="text-center">
                                <button class="btn btn-view">View</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
<div class="col-md-3">
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
<div class="col-md-3">
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
<div class="col-md-3">
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
<div class="new-section bg-white">
    <h2 class="title">Most Popular</h2>
    <div class="container">
        <div class="row">
            <?php $latest_productList=getMostViewProduct($conn);
            foreach ($latest_productList as $latestProduct){

                $productInfo=getProductInfo($conn,$latestProduct['product_id']);

                $latestProductDetaills=getProductDetails($conn,$latestProduct['product_id']);
                ?>
                <div class="col-md-3">
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
                                <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs <?php echo $productInfo['price'] ?>/-</b>
                            </p>
                            <div class="text-center">
                                <button class="btn btn-view">View</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            <div class="col-md-3">
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

<?php
include_once "_footer.php";
?>