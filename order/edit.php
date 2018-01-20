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
<div class="container" style="width: 100%;height:100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="page-title clearfix">
                    <h3 style="display: inline-block"><span class="fa fa-shopping-bag"></span> Edit Order
                    </h3>
                </div>
                <?php if (isBuyer()){?>
                    <div class="col-md-12" style="padding-left: 0">
                        <div class="col-md-4" style="padding-left: 0">
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
                    </div>
                    <form action="controller/order.php" method="post" id="edit_order_form">
                        <?php include_once '_order_form.php'?>
                        <input type="hidden" name="order_id" value="<?php echo $order_id ?>"/>
                        <input class="btn btn-primary" type="submit" name="edit_order" value="Update"/>
                    </form>
                <?php } else if(isSeller() and $order_product["user_id"] == $_SESSION["user_id"]){
                    $status_array = array(ORDER_STATUS_REQUESTED,ORDER_STATUS_PROCESSING,ORDER_STATUS_COMPLETED);
                    ?>
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
                        <div class="col-md-12">
                            <form class="form-inline" action="controller/order.php" method="post">

                                <select class="form-control" name="status" id="status">
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
                                <input class="btn btn-primary" type="submit" name="edit_order_admin" value="Update"/>
                            </form>
                        </div>
                    </div>
                <?php } ?>
                <?php if(isBuyer()){ ?>
                    <div class="col-md-12" style="margin-top: 15px">
                        <div class="page-title clearfix">
                            <h3 style="display: inline-block"><span class="fa fa-shopping-bag"></span> Edit Shipping Details
                            </h3>
                        </div>
                        <div class="col-md-12">
                            <form action="controller/order.php" method="post">
                                <?php include_once "../location/db_location_form.php"?>
                                <input type="hidden" name="order_id" value="<?php echo $order_id ?>"/>
                                <input class="btn btn-primary" type="submit" name="edit_order_shipping" value="Update"/>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>
