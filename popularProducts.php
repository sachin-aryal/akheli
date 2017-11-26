
<html>
<head>
    <title>Products</title>
</head>
<body>
<?php
include_once "_header.php";
if (isset($_GET["category"])) {
    $category = $_GET["category"];
    $productList = getProductsByCategory($conn, $_GET["category"]);
} else {
    $mostViewProducts=getMostViewProduct($conn,0);

}
?>
<div class="wrapper">
    <div class="content-wrapper clearfix" id="main_content">
        <div class="page-title">
            <h3><span class="fa fa-tag"></span> Product List
                <small>Popular products</small>
            </h3>
        </div>
        <?php
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
<?php
include "_footer.php";
?>
</body>
</html>