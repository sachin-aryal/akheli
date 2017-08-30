<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 8/30/2017
 * Time: 8:08 PM
 */

@include "_header.php";
?>

<div class="main-wrapper">

    <div class="new-section bg-gray">
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

</div>
<?php
@include "_footer.php";
?>