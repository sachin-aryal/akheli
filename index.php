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
                                        <img src="assets/images/<?php echo $latestProduct["image"]?>" alt="">
                                    </div>

                                    <div class="item-info">
                                        <h4 class="item-name no-margin"><a href="#"><?php echo $latestProduct["product_name"]?></a></h4>
                                        <span>Rs <?php echo $latestProduct["price"]?>/-</span>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <ul class="list-unstyled">
                            <li>
                                <a href="<?php echo $purl ?>">See more..</a>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="item-list">
                        <legend>Best Seller</legend>
                        <ul class="list-unstyled">
                            <?php
                            $mostViewProducts=getMostViewProduct($conn,3);
                            foreach ($mostViewProducts as $mostViewProduct){
                                $productDetail=getProductInfo($conn,$mostViewProduct['product_id'])

                                ?>
                                <li class="clearfix">
                                    <div class="item-img has-img">
                                        <img src="assets/images/<?php echo $productDetail["image"]?>" alt="">
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
                                        <img src="assets/images/<?php echo $randomProduct["image"]?>" alt="">
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
                                <a href="#"> <img src="assets/images/<?php echo $latestProduct["image"]?>" class="img-responsive" alt="" /> </a>
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
                                                    <?php echo $size ?>
                                                </li>
                                            <?php } ?>
                                        </ol>
                                        <h4 class="text-center"><?php echo $latestProduct["product_name"] ?></h4>
                                        <p class="price-new">
                                             <b>Rs <?php echo $latestProduct["price"] ?>/-</b>
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

                   </div>

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

                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="text-success text-center text-uppercase text-underline"><strong> Most Popular</strong></h2>
                <hr>
                <div class="col-md-12 clearfix">
                    <div class="row">
                        <?php
                        $mostViewProducts=getMostViewProduct($conn,6);
                        foreach ($mostViewProducts as $mostViewProduct){
                            $popularProduct=getProductInfo($conn,$mostViewProduct['product_id'])

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
                                                            <?php echo $size ?>
                                                        </li>
                                                    <?php } ?>
                                                </ol>
                                                <h4 class="text-center"><?php echo $popularProduct['product_name'] ?></h4>
                                                <p class="price-new">
                                                    &nbsp;&nbsp;&nbsp; <b>Rs <?php echo $popularProduct['price']?>/-</b>
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