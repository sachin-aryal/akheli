<?php
include_once "../shared/auth.php";
if(isset($_POST["product_id"])){
    $productId = $_POST["product_id"];
}else if(isset($_GET["product_id"])){
    $productId = $_GET["product_id"];
}else{
    redirectToDash();
    return;
}
?>
<html>
<head>
    <title>Make Order:</title>
</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    $order_product = getProductInfo($conn,$productId);
    $order_product_details = getProductDetails($conn,$order_product["id"]);
    ?>
    <div class="content-wrapper clearfix" id="main_content">
        <img src="assets/images/<?php echo $order_product['image'] ?>" height="200" width="200">
        <li>Category: <?php echo $order_product['category'] ?></li>
        <li>Minimum Order:<?php echo $order_product['min_order'] ?></li>
        <li>Description: <?php echo $order_product['description'] ?></li>
        <li>Price: <?php echo $order_product['price'] ?></li>
        <form action="controller/order.php" method="post">
            <label for="description">Description</label>
            <input type="text" name="description" id="description"/><br>
            <label for="size">Size</label>
            <?php
            foreach ($order_product_details as $order_product_detail) {
                $size = explode(",",$order_product_detail["size"]);
                $color = explode(",",$order_product_detail["color"]);
                foreach ($size as $s) {
                    ?>
                    <?php echo $s; ?>&nbsp;<input type="checkbox" id="size" name="size[]" value="<?php echo $s; ?>"/>
                <?php } ?>
                <br><label for="color">Color</label>
                <?php
                foreach ($color as $c){
                    ?>
                    <?php echo $c; ?>&nbsp;<input type="checkbox" id="color" name="color[]" value="<?php echo $c; ?>"/>
                <?php } }?>
            <br><label for="quantity">Quantity</label>
            <input type="text" name="quantity" id="quantity"/>
            <input type="hidden" name="product_id" id="product_id" value="<?php echo $productId ?>"/>
            <input type="submit" name="save_order" value="Order"/>
        </form>
    </div>

    <!-- The Right Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Content of the sidebar goes here -->
    </aside>
    <!-- The sidebar's background -->
    <!-- This div must placed right after the sidebar for it to work-->
    <div class="control-sidebar-bg">asdfadsf</div>
</div>
</body>
</html>
