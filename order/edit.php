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
    (function defer() {
        if (window.jQuery) {
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
        } else {
            setTimeout(function () {
                defer()
            }, 50);
        }
    })();
</script>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-10">
                <img src="assets/images/<?php echo $order_product['image'] ?>" height="200" width="200">
                <li>Category: <?php echo $order_product['category'] ?></li>
                <li>Minimum Order:<?php echo $order_product['min_order'] ?></li>
                <li>Description: <?php echo $order_product['description'] ?></li>
                <li>Price: <?php echo $order_product['price'] ?></li>
                <li>Status: <?php echo $edit_order['status'] ?></li>
                <?php if (isBuyer()){?>
                    <form action="controller/order.php" method="post" id="edit_order_form">
                        <?php include_once '_order_form.php'?>
                        <input type="hidden" name="order_id" value="<?php echo $order_id ?>"/>
                        <input type="submit" name="edit_order" value="Update"/>
                    </form>
                <?php } else if(isAdmin()){
                    $status_array = array(ORDER_STATUS_REQUESTED,ORDER_STATUS_PROCESSING,ORDER_STATUS_COMPLETED);
                    ?>
                    <li>Size: <?php echo $edit_order['size'] ?></li>
                    <li>Color: <?php echo $edit_order['color'] ?></li>
                    <li>Quantity: <?php echo $edit_order['quantity'] ?></li>
                    <form action="controller/order.php" method="post">

                        <select name="status" id="status">
                            <?php
                            foreach ($status_array as $sa){
                                if($sa == $edit_order["status"]){
                                    echo '<option selected="selected" value='.$sa.'>'.$sa.'</option>';
                                }else{
                                    echo '<option value='.$sa.'>'.$sa.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" name="order_id" value="<?php echo $order_id ?>"/>
                        <input type="submit" name="edit_order_admin" value="Update"/>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
