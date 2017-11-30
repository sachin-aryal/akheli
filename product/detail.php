<?php

if (!isset($_SESSION)) {
    session_start();
};
include_once "../_header.php";
$product_info_details = getProductInfo($conn, $_GET['id']);
$productDetails_details = getProductDetails($conn, $_GET['id']);
?>

<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-10">
                <div class="page-title">
                    <h3><span class="fa fa-eye"></span> Product Detail
                        <small>View detail and order produce</small>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-4 product-image-wrapper">
                        <img src="assets/images/<?php echo $product_info_details['image'] ?>">
                    </div>

                    <div class="col-md-8">

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Price</h6>
                                <h4 title="Name"><?php echo $product_info_details['price'] ?></h4>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Category</h6>
                                <h4 title="Category"><?php echo $product_info_details['category'] ?></h4>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Minimum Order</h6>
                                <h4 title="Category"><?php echo $product_info_details['min_order'] ?></h4>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-component">
                                <h6 class="title">Color</h6>
                                <h4 title="Size">
                                    <ol class="breadcrumb">
                                        <li><?php
                                            echo $productDetails_details['color'] ?>
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
                                            echo $productDetails_details['size'] ?>
                                        </li>
                                    </ol>
                                </h4>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="detail-component">
                                <h6 class="title">Description</h6>
                                <h4 title="Category"><?php echo $product_info_details['description'] ?></h4>
                            </div>
                        </div>
                    </div>

                    <?php if (isSeller() && $product_info_details["user_id"] == $_SESSION['user_id']) { ?>
                        <form method="post" action="controller/product.php">
                            <input type="hidden" name="id" value="<?php echo $product_info_details['id'] ?>"/>
                            <input type="submit" name="edit_product" value="Edit"/>
                            <input type="submit" name="delete_product" value="Delete"/>
                        </form>
                        <br>
                        <h3>Product Details</h3>
                        <?php
                            $product_infos=getProductAddInfo($conn,$_GET['id']);
                            foreach ($product_infos as $product_info){
                        ?>

                                <div class="col-md-5">
                                    <?php if(isset($_GET['edit_detail'])){ ?>
                                    <form method="post" action="controller/product.php">
                                        <input type="hidden" name="product_id" value="<?php echo $product_info['product_id'] ?>"/>
                                        <input type="hidden" name="detail_id" value="<?php echo $product_info['detail_id'] ?>"/>
                                        <div class="form-group col-md-4">
                                            <label for="detail_name">Detail Name</label>
                                            <input class="form-control" type="text" name="detail_name" value="<?php echo $product_info['field_name'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="detail_value">Detail Value:</label>
                                            <input class="form-control" type="text" name="detail_value" value="<?php echo $product_info['field_value'] ?>" >
                                        </div>
                                        <input type="submit" class="btn btn-primary pull-left margin-vertical col-sm-2" name="update_detail" value="Save">
                                    </form>
                                    <?php } else { ?>
                                    <div class="field_name col-sm-4"><?php echo $product_info['field_name'] ?></div>
                                    <div class="field_value col-sm-4"><?php echo $product_info['field_value'] ?></div>
                                        <a href="product/detail.php?id=<?php echo $_GET['id'] ?>&edit_detail=true" class="btn btn-success col-sm-2 ">Edit</a>

                                        <form action="controller/product.php" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $product_info['product_id'] ?>"/>
                                            <input type="hidden" name="detail_id" value="<?php echo $product_info['detail_id'] ?>"/>
                                            <button class="btn btn-success " name="delete_detail">Delete</button>
                                        </form>

                                    <?php } ?>
                                </div>
                         <?php } ?>
<br>
                        <a href="product/detail.php?id=<?php echo $_GET['id'] ?>&add_detail=true" class="btn btn-default">Add more detail</a>
                        <br>
                        <?php if(isset($_GET['add_detail'])){ ?>
                            <form method="post" action="controller/product.php">
                                <input type="hidden" name="product_id" value="<?php echo $product_info_details['id'] ?>"/>
                                <div class="form-group col-md-6">
                                    <label for="detail_name">Detail Name</label>
                                    <input class="form-control" type="text" name="detail_name" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="detail_value">Detail Value:</label>
                                    <input class="form-control" type="text" name="detail_value" >
                                </div>
                                <input type="submit" class="btn btn-primary pull-left margin-vertical" name="save_detail" value="Save">
                            </form>
                        <?php } ?>
                    <?php } ?>
                    <?php if (isBuyer()) { ?>
                        <div>
                            <form action="order/create.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product_info_details['id'] ?>"/>
                                <button class="btn btn-primary order-button">Order</button>
                            </form>
                        </div>
                    <?php } ?>
                    <input type="hidden" id="page_id" value="product_details"/>
                </div>
            </div>
        </div>
    </div>
</div>
