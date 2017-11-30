<?php
include_once "../shared/auth.php";
redirectIfNotBuyer();
if(isset($_POST["product_id"])){
    $productId = $_POST["product_id"];
}else if(isset($_GET["product_id"])){
    $productId = $_GET["product_id"];
}else{
    redirectToDash();
    return;
}
include_once "../_header.php";
?>
<script type="text/javascript">
    $(document).ready(function(){
        validateOrder();
    });
</script>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <?php
            $order_product = getProductInfo($conn,$productId);
            $order_product_details = getProductDetails($conn,$order_product["id"]);
            ?>
            <div class="col-md-10">
                <div class="page-title">
                    <h3><span class="fa fa-eye"></span>Order Product
                        <small>View detail and order produce</small>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-4 product-image-wrapper">
                        <img src="assets/images/<?php echo $order_product['image'] ?>">
                    </div>

                    <div class="col-md-8">

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Price</h6>
                                <h4 title="Name"><?php echo $order_product['price'] ?></h4>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Category</h6>
                                <h4 title="Category"><?php echo $order_product['category'] ?></h4>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Minimum Order</h6>
                                <h4 title="Category"><?php echo $order_product['min_order'] ?></h4>
                            </div>
                        </div>




                        <div class="col-md-12">
                            <div class="detail-component">
                                <h6 class="title">Description</h6>
                                <h4 title="Category"><?php echo $order_product['description'] ?></h4>
                            </div>
                        </div>


                        <div class="col-md-12">

                            <form action="controller/order.php" id="order_form_1" class="custom-form" method="post">
                                <?php include_once "_order_form.php" ?>
                                <input class="btn btn-primary" type="submit" name="save_order" value="Order"/>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
