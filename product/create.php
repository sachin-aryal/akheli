<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfNotAdmin();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create a product</title>
</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    ?>
    <div class="content-wrapper clearfix" id="main_content">
        <div class="page-title">
            <h3><span class="fa fa-plus"></span> Add Product <small>Add new products here</small></h3>
        </div>
        <div id="page_content" class="page-content clearfix">
            <form action="controller/product.php" class="custom-form" enctype="multipart/form-data" method="post">
                <?php
                $productDetails = [];
                include_once "_product_form.php";
                ?>
                <input type="submit" class="btn btn-primary pull-left margin-vertical" name="save_product" value="Save">
            </form>
        </div>
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