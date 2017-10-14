<?php
include_once "_header.php";
?>

    <div id="thumbnail-preview-indicators" class="carousel slide marginBtm40" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#thumbnail-preview-indicators" data-slide-to="0" class="active">
            </li>
            <li data-target="#thumbnail-preview-indicators" data-slide-to="1">
            </li>
            <li data-target="#thumbnail-preview-indicators" data-slide-to="2">
            </li>
        </ol>
        <div class="carousel-inner">
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

    <div class="container new-section">
        <div class="new-section col-lg-3 clearfix">
            <div class="container-flude">
                <div class="row">
                    <div class="item-list">
                        <legend>New Arrival</legend>
                        <ul class="list-unstyled">
                            <?php $latestProducts=getLatestProduct($conn,3);
                            foreach ($latestProducts as $latestProduct){

                                ?>
                                <li class="clearfix">
                                    <div class="item-img has-img">
                                        <img src="../assets/images/<?php echo $latestProduct["image"]?>" alt="">
                                    </div>

                                    <div class="item-info">
                                        <h4 class="item-name no-margin"><a href="#"><?php echo $latestProduct["product_name"]?></a></h4>
                                        <span>Rs <?php echo $latestProduct["price"]?>/-</span>
                                    </div>
                                </li>
                            <?php } ?>

                            <li>
                                <a href="#">See more...</a>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="item-list">
                        <legend>Best Seller</legend>
                        <ul class="list-unstyled">
                            <?php $mostViewProducts=getMostViewProduct($conn,3);
                            foreach ($mostViewProducts as $mostViewProduct){
                                $productDetail=getProductDetails($conn,$mostViewProduct['product_id'])

                                ?>
                                <li class="clearfix">
                                    <div class="item-img has-img">
                                        <img src="../assets/images/<?php echo $productDetail["image"]?>" alt="">
                                    </div>

                                    <div class="item-info">
                                        <h4 class="item-name no-margin"><a href="#"><?php echo $productDetail["product_name"]?></a></h4>
                                        <span>Rs <?php echo $productDetail["price"]?>/-</span>
                                    </div>
                                </li>
                            <?php } ?>

                            <li>
                                <a href="#">See more...</a>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="item-list">
                        <legend>Random</legend>
                        <ul class="list-unstyled">
                            <?php $randomProducts=getRandomProduct($conn,3);
                            foreach ($randomProducts as $randomProduct){

                                ?>
                                <li class="clearfix">
                                    <div class="item-img has-img">
                                        <img src="../assets/images/<?php echo $randomProduct["image"]?>" alt="">
                                    </div>

                                    <div class="item-info">
                                        <h4 class="item-name no-margin"><a href="#"><?php echo $randomProduct["product_name"]?></a></h4>
                                        <span>Rs <?php echo $randomProduct["price"]?>/-</span>
                                    </div>
                                </li>
                            <?php } ?>

                            <li>
                                <a href="#">See more...</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-success text-center text-uppercase text-underline"><strong> New Arrival </strong></h2>
        <hr>
        <div class="col-md-9 clearfix">
            <div class="row">
                <?php $latestProducts=getLatestProduct($conn,6);
                foreach ($latestProducts as $latestProduct){

                    ?>
                    <div class="col-sm-4">
                        <article class="col-item">
                            <div class="photo">
                                <a href="#"> <img src="../assets/images/<?php echo $latestProduct["image"]?>" class="img-responsive" alt="" /> </a>
                            </div>
                            <div class="info">
                                <div class="row">
                                    <div class="price-details col-md-6">
                                        <p class="details">
                                        <ol class="breadcrumb text-center">
                                            <?php
                                            $productDetail=getProductDetails($conn,$latestProduct['id']);
                                            $sizes = explode(',',$productDetail['size']);

                                            foreach ($sizes as $size){

                                                ?>
                                                <li>
                                                    <a href="#"><?php echo $size ?></a>
                                                </li>
                                            <?php } ?>
                                        </ol>
                                        <h4 class="text-center"><?php echo $latestProduct["name"] ?></h4>
                                        <p class="price-new">
                                            <strike>Rs 1700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs <?php echo $latestProduct["price"] ?>/-</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="separator clear-left">
                                    <p class="btn-add">
                                        <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                    </p>
                                    <p class="btn-details">
                                        <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                <?php } ?>

                <!--<div class="col-sm-4">
                    <article class="col-item">
                        <div class="photo">
                            <a href="#"> <img src="public/img/2.jpg" class="img-responsive" alt="Product Image" /> </a>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price-details col-md-6">
                                    <p class="details">
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
                                    <h4 class="text-center">Skirt</h4>
                                    <p class="price-new">
                                        <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                                    </p>
                                </div>
                            </div>
                            <div class="separator clear-left">
                                <p class="btn-add">
                                    <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                </p>
                                <p class="btn-details">
                                    <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>


                <div class="col-sm-4">
                    <article class="col-item">
                        <div class="photo">
                            <a href="#"> <img src="public/img/3.jpg" class="img-responsive" alt="Product Image" /> </a>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price-details col-md-6">
                                    <p class="details">
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
                                    <h4 class="text-center">Korean Shop</h4>
                                    <p class="price-new">
                                        <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                                    </p>
                                </div>
                            </div>
                            <div class="separator clear-left">
                                <p class="btn-add">
                                    <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                </p>
                                <p class="btn-details">
                                    <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>

                <div class="col-sm-4">
                    <article class="col-item">
                        <div class="photo">
                            <a href="#"> <img src="public/img/slider3.jpg" class="img-responsive" alt="Product Image" /> </a>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price-details col-md-6">
                                    <p class="details">
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
                                    <h4 class="text-center">One Piece</h4>
                                    <p class="price-new">
                                        <strike>Rs 1000/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 800/-</b>
                                    </p>
                                </div>
                            </div>
                            <div class="separator clear-left">
                                <p class="btn-add">
                                    <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                </p>
                                <p class="btn-details">
                                    <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>


                <div class="col-sm-4">
                    <article class="col-item">
                        <div class="photo">
                            <a href="#"> <img src="public/img/slider2.jpg" class="img-responsive" alt="Product Image" /> </a>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price-details col-md-6">
                                    <p class="details">
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
                                    <h4 class="text-center">Korean Set</h4>
                                    <p class="price-new">
                                        <strike>Rs 1700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 1200/-</b>
                                    </p>
                                </div>
                            </div>
                            <div class="separator clear-left">
                                <p class="btn-add">
                                    <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                </p>
                                <p class="btn-details">
                                    <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                </div>
    -->            </div> <!--row-->

        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="item-list">
                    <legend>Categories</legend>
                    <ul class="list-unstyled">
                        <?php $categoryLists=getCategoryItems($conn);
                        foreach ($categoryLists as $categoryList){

                            ?>
                            <li class="clearfix">
                                <div class="item-img has-img">
                                    <img src="../assets/images/<?php echo $categoryList["image"]?>" alt="">
                                </div>

                                <div class="item-info">
                                    <h4 class="item-name no-margin"><a href="#"><?php echo $categoryList["category"]?></a></h4>
                                    <span><?php echo $categoryList["total_quantity"]?> items</span>
                                </div>
                            </li>
                        <?php } ?>
                        <!-- <li class="clearfix">
                             <div class="item-img has-img">
                                 <img src="public/img/women.jpg" alt="">
                             </div>

                             <div class="item-info">
                                 <h4 class="item-name no-margin"><a href="#">Women</a></h4>
                                 <span>150 items</span>
                             </div>
                         </li>
                         <li class="clearfix">
                             <div class="item-img has-img">
                                 <img src="public/img/men.jpg" alt="">
                             </div>

                             <div class="item-info">
                                 <h4 class="item-name no-margin"><a href="#">Men</a></h4>
                                 <span>100 items</span>
                             </div>
                         </li>

                         <li class="clearfix">
                             <div class="item-img has-img">
                                 <img src="public/img/accessories.jpg" alt="">
                             </div>

                             <div class="item-info">
                                 <h4 class="item-name no-margin"><a href="#">Accessories</a></h4>
                                 <span>200 items</span>
                             </div>
                         </li>

                         <li class="clearfix">
                             <div class="item-img has-img">
                                 <img src="public/img/electronics.jpg" alt="">
                             </div>

                             <div class="item-info">
                                 <h4 class="item-name no-margin"><a href="#">Electronics</a></h4>
                                 <span>100 items</span>
                             </div>
                         </li>
                         <li class="clearfix">
                             <div class="item-img has-img">
                                 <img src="public/img/sports.jpg" alt="">
                             </div>

                             <div class="item-info">
                                 <h4 class="item-name no-margin"><a href="#">Sports</a></h4>
                                 <span>50 items</span>
                             </div>
                         </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="text-success text-center text-uppercase text-underline"><strong> Most Popular</strong></h2>
                <hr>
                <div class="col-md-12 clearfix">
                    <div class="row">
                        <?php $popularProducts=getMostViewProduct($conn,6);
                        foreach ($popularProducts as $popularProduct){

                            ?>
                            <div class="col-sm-4">
                                <article class="col-item">
                                    <div class="photo">
                                        <a href="#"> <img src="assets/images/<?php echo $popularProduct['image'] ?>" class="img-responsive" alt="" /> </a>
                                    </div>
                                    <div class="info">
                                        <div class="row">
                                            <div class="price-details col-md-6">
                                                <p class="details">
                                                <ol class="breadcrumb text-center">
                            <?php
                            $productDetail=getProductDetails($conn,$popularProduct['id']);
                            $sizes = explode(',',$productDetail['size']);

                            foreach ($sizes as $size){

                                ?>
                                                    <li>
                                                        <a href="#"><?php echo $size ?></a>
                                                    </li>
<?php } ?>
                                                </ol>
                                                <h4 class="text-center"><?php echo $popularProduct['category'] ?></h4>
                                                <p class="price-new">
                                                    <strike>Rs 1700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs <?php echo $popularProduct['price']?>/-</b>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="separator clear-left">
                                            <p class="btn-add">
                                                <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                            </p>
                                            <p class="btn-details">
                                                <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            </div>
                        <?php } ?>


                        <!--<div class="col-sm-4">
                            <article class="col-item">
                                <div class="photo">
                                    <a href="#"> <img src="public/img/2.jpg" class="img-responsive" alt="Product Image" /> </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price-details col-md-6">
                                            <p class="details">
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
                                            <h4 class="text-center">Skirt</h4>
                                            <p class="price-new">
                                                <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                        <p class="btn-details">
                                            <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        </div>


                        <div class="col-sm-4">
                            <article class="col-item">
                                <div class="photo">
                                    <a href="#"> <img src="public/img/3.jpg" class="img-responsive" alt="Product Image" /> </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price-details col-md-6">
                                            <p class="details">
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
                                            <h4 class="text-center">Korean Shop</h4>
                                            <p class="price-new">
                                                <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                        <p class="btn-details">
                                            <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        </div>

                        <div class="col-sm-4">
                            <article class="col-item">
                                <div class="photo">
                                    <a href="#"> <img src="public/img/slider3.jpg" class="img-responsive" alt="Product Image" /> </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price-details col-md-6">
                                            <p class="details">
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
                                            <h4 class="text-center">One Piece</h4>
                                            <p class="price-new">
                                                <strike>Rs 1000/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 800/-</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                        <p class="btn-details">
                                            <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        </div>


                        <div class="col-sm-4">
                            <article class="col-item">
                                <div class="photo">
                                    <a href="#"> <img src="public/img/slider2.jpg" class="img-responsive" alt="Product Image" /> </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price-details col-md-6">
                                            <p class="details">
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
                                            <h4 class="text-center">Korean Set</h4>
                                            <p class="price-new">
                                                <strike>Rs 1700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 1200/-</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a>
                                        </p>
                                        <p class="btn-details">
                                            <a href="#" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart"></i></a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        </div>-->

                    </div>
                </div>
            </div>
        </div> <!--row-->
        <!-- <div class="col-md-12">
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
                 <img src="public/img/1.jpg" alt="">
             </div>
         </div>-->
        <!--
        <div class="new-section">
                <h2 class="title"><span>New Arrival</span></h2>
                <div class="container-fluid">
                    <div class="row">
                        <?php /*$latest_productList = getLatestProduct($conn);
                        foreach ($latest_productList as $latestProduct) {
                                $latestProductDetaills = getProductDetails($conn, $latestProduct['id']);
                            */?>
                            <div class="col-md-4">
                                <div class="product-wrapper">
                                    <div class="product-image">
                                        <img src="assets/images/.'<?php /*echo $latestProduct['image'] */?>'" alt="">
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name"><?php /*echo $latestProduct['product_name'] */?></h4>
                                        <ol class="breadcrumb text-center">
                                            <?php /*$sizeArray = explode(',', $latestProductDetaills['size']);
                                            foreach ($sizeArray as $size) {

                                                */?>
                                                <li>
                                                    <a href="#"><?php /*echo $size */?></a>
                                                </li>
                                            <?php /*} */?>
                                        </ol>
                                        <p>
                                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp;
                                            <b>Rs <?php /*echo $latestProduct['price'] */?>/-</b>
                                        </p>
                                        <div class="text-center">
                                            <button class="btn btn-view">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php /*} */?>
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/2.jpg" alt="">
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
                                    <img src="public/img/3.jpg" alt="">
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
                                    <img src="public/img/3.jpg" alt="">
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
                        <?php /*$latest_productList = getMostViewProduct($conn);
                        foreach ($latest_productList as $latestProduct) {

                            $productInfo = getProductInfo($conn, $latestProduct['product_id']);

                            $latestProductDetaills = getProductDetails($conn, $latestProduct['product_id']);
                            */?>
                            <div class="col-md-4">
                                <div class="product-wrapper">
                                    <div class="product-image">
                                        <img src="assets/images/.'<?php /*echo $productInfo['image'] */?>'" alt="">
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name"><?php /*echo $productInfo['product_name'] */?></h4>
                                        <ol class="breadcrumb text-center">
                                            <li>
                                                <a href="#"><?php /*echo $latestProductDetaills['size'] */?></a>
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
                                            <b>Rs <?php /*echo $productInfo['price'] */?>/-</b>
                                        </p>
                                        <div class="text-center">
                                            <button class="btn btn-view">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php /*} */?>
                       <!-- <div class="col-md-4">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img src="public/img/2.jpg" alt="">
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
                                    <img src="public/img/3.jpg" alt="">
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
                                    <img src="public/img/1.jpg" alt="">
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
                        </div>-->
    </div>
    </div>
    </div>-->

    </div>

<?php
include_once "_footer.php";
?>