<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../shared/auth.php";
redirectIfNotAdmin();

include_once '../shared/dbconnect.php';
include_once '../shared/common.php';

$product = getProductInfo($conn, $_GET['id']);
$productDetails = getProductDetails($conn, $_GET['id']);

?>
<html>
<head>

</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            validateProduct();
        });
    </script>
    <div class="content-wrapper clearfix" id="main_content">
        <div class="page-title">
            <h3><span class="fa fa-pencil-square-o"></span> Edit Product Detail
                <small>Edit product details here</small>
            </h3>
        </div>

        <div id="page_content" class="page-content clearfix">
            <form action="controller/product.php" id="product_form_1" class="custom-form" enctype="multipart/form-data" method="post">
                <?php include_once "_product_form.php" ?>
                <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                <input type="submit" name="update_product" class="btn btn-primary margin" value="Update">
            </form>
            <img class="pull-right" src="assets/images/<?php echo $product["image"] ?>" width="200" height="200"/>
            <input type="hidden" id="page_id" value="product_edit"/>
        </div>
        <!-- The Right Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Content of the sidebar goes here -->
        </aside>
        <!-- The sidebar's background -->
        <!-- This div must placed right after the sidebar for it to work-->
        <div class="control-sidebar-bg">asdfadsf</div>
    </div>
</div>

</body>
</html>
