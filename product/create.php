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
        <div id="page_content">
            <form action="controller/product.php" enctype="multipart/form-data" method="post">
                <?php
                $productDetails = [];
                include_once "_product_form.php";
                ?>
                <input type="submit" name="save_product" value="Save">
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