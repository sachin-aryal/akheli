<?php
include_once "../shared/auth.php";
include_once '../shared/dbconnect.php';
include_once '../shared/common.php';

if(isset($_POST["order_id"])){
    $order_id = $_POST["order_id"];
}else if(isset($_GET["order_id"])){
    $order_id = $_GET["order_id"];
}else{
    redirectToDash();
    return;
}
$edit_order = getOrder($conn,$order_id);
$productId = $edit_order["product_id"];
$order_product = getProductInfo($conn,$productId);
$order_product_details = getProductDetails($conn,$order_product["id"]);
$shipping_details = getShippingDetails($conn, $order_id);
if(isAdmin()){
    redirectToDash();
    return;
}else if(isBuyer()){
    if($edit_order["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
}else if(isSeller()){
    if($order_product["user_id"] != $_SESSION["user_id"]){
        redirectToDash();
        return;
    }
}else{
    redirectToDash();
    return;
}
include_once "../_header.php";
?>
<script type="text/javascript">
    $(function(){
        <?php
        $size = explode(",",$edit_order["size"]);
        $color = explode(",",$edit_order["color"]);
        foreach ($size as $s){
        ?>
        var sizeCheck = $("input[id='size'][value='<?php echo $s ?>']");
        if(sizeCheck.length !== 0){
            $(sizeCheck).attr("checked",true);
        }
        <?php } foreach ($color as $c){ ?>
        var colorCheck = $("input[id='color'][value='<?php echo $c ?>']");
        if(colorCheck.length !== 0){
            $(colorCheck).attr("checked",true);
        }
        <?php } ?>
    });
</script>
<div class="container" style="width: 100%;margin: 0 auto;height: auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="page-title clearfix">
                    <h3 style="display: inline-block"><span class="fa fa-shopping-bag"></span> Order Detail
                    </h3>
                    <form style="display: inline-block;float: right" action="order/edit.php" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $edit_order['id'] ?>"/>
                        <input class="btn btn-primary" type="submit" name="edit_order" value="Edit Order"/>
                    </form>
                </div>
                <div class="col-md-12" >
                    <div class="col-md-4" >
                        <div class="detail-component">
                            <h6 class="title">Status</h6>
                            <h4 title="Name">
                                <ol class="breadcrumb">
                                    <li>
                                        <?php echo $edit_order['status'] ?>
                                    </li>
                                </ol>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="detail-component">
                            <h6 class="title">Size</h6>
                            <h4 title="Size">
                                <ol class="breadcrumb">
                                    <li>
                                        <?php echo $edit_order['size'] ?>
                                    </li>
                                </ol>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-component">
                            <h6 class="title">Color</h6>
                            <h4 title="Color">
                                <ol class="breadcrumb">
                                    <li>
                                        <?php echo $edit_order['color'] ?>
                                    </li>
                                </ol>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-component">
                            <h6 class="title">Quantity</h6>
                            <h4 title="Quantity">
                                <ol class="breadcrumb">
                                    <li>
                                        <?php echo $edit_order['quantity'] ?>
                                    </li>
                                </ol>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-component">
                            <h6 class="title">Ordered Date</h6>
                            <h4 title="Quantity">
                                <ol class="breadcrumb">
                                    <li>
                                        <?php echo $edit_order['created_at'] ?>
                                    </li>
                                </ol>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-component">
                            <h6 class="title">Order Note</h6>
                            <h4 title="Quantity">
                                <ol class="breadcrumb">
                                    <li>
                                        <?php echo $edit_order['description'] ?>
                                    </li>
                                </ol>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12 page-title clearfix">
                            <h3 style="display: inline-block"><span class="fa fa-truck"></span> Shipping Details
                            </h3>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-component">
                                <h6 class="title">Address</h6>
                                <h4 title="Quantity">
                                    <ol class="breadcrumb">
                                        <li>
                                            <?php echo $shipping_details['address'] ?>
                                        </li>
                                    </ol>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-component">
                                <h6 class="title">Country</h6>
                                <h4 title="Quantity">
                                    <ol class="breadcrumb">
                                        <li>
                                            <?php echo $shipping_details['country'] ?>
                                        </li>
                                    </ol>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-component">
                                <h6 class="title">City</h6>
                                <h4 title="Quantity">
                                    <ol class="breadcrumb">
                                        <li>
                                            <?php echo $shipping_details['city'] ?>
                                        </li>
                                    </ol>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-component">
                                <h6 class="title">Province</h6>
                                <h4 title="Quantity">
                                    <ol class="breadcrumb">
                                        <li>
                                            <?php echo $shipping_details['province'] ?>
                                        </li>
                                    </ol>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-component">
                                <h6 class="title">Postal Code</h6>
                                <h4 title="Quantity">
                                    <ol class="breadcrumb">
                                        <li>
                                            <?php echo $shipping_details['postal_code'] ?>
                                        </li>
                                    </ol>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12 page-title clearfix">
                            <h3 style="display: inline-block"><span class="fa fa-eye"></span> Product Detail
                            </h3>
                        </div>
                        <div class="col-md-4 product-image-wrapper">
                            <img class="img-thumbnail" src="assets/images/<?php echo $order_product['image'] ?>">
                        </div>
                        <div class="col-md-8">

                            <div class="col-lg-4">
                                <div class="detail-component">
                                    <h6 class="title">Price</h6>
                                    <h4 title="Name">
                                        <ol class="breadcrumb">
                                            <li>
                                                Rs. <?php echo $order_product['price'] ?>
                                            </li>
                                        </ol>
                                    </h4>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="detail-component">
                                    <h6 class="title">Category</h6>
                                    <h4 title="Category">
                                        <ol class="breadcrumb">
                                            <li>
                                                <?php echo $order_product['category'] ?>
                                            </li>
                                        </ol>
                                    </h4>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="detail-component">
                                    <h6 class="title">Minimum Order</h6>
                                    <h4 title="Category">
                                        <ol class="breadcrumb">
                                            <li>
                                                <?php echo $order_product['category'] ?>
                                            </li>
                                        </ol>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-component">
                                    <h6 class="title">Color</h6>
                                    <h4 title="Color">
                                        <ol class="breadcrumb">
                                            <li><?php
                                                echo $order_product_details['color'] ?>
                                            </li>
                                        </ol>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-component">
                                    <h6 class="title">Size</h6>
                                    <h4 title="Size">
                                        <ol class="breadcrumb">
                                            <li><?php
                                                echo $order_product_details['size'] ?>
                                            </li>
                                        </ol>
                                    </h4>
                                </div>
                            </div>
                            <?php
                            $products_info = getProductAddInfo($conn,$productId);
                            foreach ($products_info as $product_info){
                            ?>
                            <div class="col-md-4">
                                <div class="detail-component">
                                    <h6 class="title"><?php echo $product_info['field_name'] ?></h6>
                                    <h4 title="Size">
                                        <ol class="breadcrumb">
                                            <li><?php echo $product_info['field_value'] ?></li>
                                        </ol>
                                    </h4>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="detail-component">
                                <h6 class="title">Description</h6>
                                <div style="margin-top: 10px" class="well" title="Category"><?php echo $order_product['description'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>
