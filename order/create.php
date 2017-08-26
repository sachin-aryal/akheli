<?php
include_once "../shared/auth.php";
redirectIfNotClient();
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
            <?php include_once "_order_form.php" ?>
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
