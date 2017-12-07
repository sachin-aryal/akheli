<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../shared/auth.php";
redirectIfNotSeller();

include_once '../shared/dbconnect.php';
include_once '../shared/common.php';

$product = getProductInfo($conn, $_GET['id']);
if($product["user_id"] != $_SESSION["user_id"]){
    redirectToDash();
    return;
}
$productDetails = getProductDetails($conn, $_GET['id']);
include_once "../_header.php";
?>
<script type="text/javascript">
    $(document).ready(function(){
        validateProduct();
    });
</script>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="page-title">
                    <h3><span class="fa fa-pencil-square-o"></span> Edit Product Detail
                        <small>Edit product details here</small>
                    </h3>
                </div>
                <form action="controller/product.php" id="product_form_1" class="custom-form" enctype="multipart/form-data" method="post">
                    <?php include_once "_product_form.php" ?>
                    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                    <input type="submit" name="update_product" class="btn btn-primary margin" value="Update">
                </form>
                <img class="pull-right" src="assets/images/<?php echo $product["image"] ?>" width="200" height="200"/>
                <input type="hidden" id="page_id" value="product_edit"/>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>
