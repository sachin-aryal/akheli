<?php

if (!isset($_SESSION)) {
    session_start();
};
include_once "../_header.php";

$product_id = my_decrypt($_GET['id']);
$product_info_details = getProductInfo($conn, $product_id);
if(sizeof($product_info_details) == 0){
    $product_id = $_GET['id'];
    $product_info_details = getProductInfo($conn, $product_id);
}
$productDetails_details = getProductDetails($conn, $product_id);
$otherProducts = getProductByUser($conn, $product_info_details["user_id"], 4);
$detail_id = my_decrypt($_GET['detail_id']);

$client = getClient($conn, $product_info_details["user_id"]);

?>
    <div class="container" style="width: 100%;margin: 0 auto">
        <div class="row" style="padding: 20px;height: 100%">
            <div id="outer-categories-slider" class="col-md-12">
                <?php include_once "../_dashsidebar.php"?>
                <div class="col-md-10">
                    <div class="page-title">
                        <h3 style="display: inline-block"><span class="fa fa-eye"></span> Product Detail
                            <small>View detail and order produce</small>
                        </h3>
                        <?php if (isSeller() && $product_info_details["user_id"] == $_SESSION['user_id']) { ?>
                            <button style="float: right" type="button" class="btn btn-info" data-toggle="modal" data-target="#add-addition-detail-modal">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add More Detail
                            </button>
                            <form style="display: inline-block;float: right" method="post" action="controller/product.php">
                                <input type="hidden" name="id" value="<?php echo $product_info_details['id'] ?>"/>
                                <button class="btn btn-primary" name="edit_product">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit
                                </button>
                                <button class="btn btn-danger" name="delete_product">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete
                                </button>&nbsp;
                            </form>
                            <div id="add-addition-detail-modal" class="modal fade col-md-12" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add Product Detail</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="controller/product.php" id="additional-details-form">
                                                <input type="hidden" name="product_id" value="<?php echo $product_info_details['id'] ?>"/>
                                                <div class="form-group">
                                                    <label for="detail_name">Detail Name</label>
                                                    <input class="form-control" type="text" name="detail_name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="detail_value">Detail Value:</label>
                                                    <input class="form-control" type="text" name="detail_value" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" name="save_detail" value="Save">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="home-tabes">
                                <li class="active"><a data-toggle="tab" href="#product-details">Product Details</a></li>
                                <li><a data-toggle="tab" href="#company-profile">Company Profile</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="product-details" class="tab-pane fade in active">
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
                                    </div>
                                    <div class="col-md-4">
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

                                    <div class="col-md-4">
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
                                    <?php
                                    $products_info = getProductAddInfo($conn,$product_id);
                                    foreach ($products_info as $product_info){
                                        ?>
                                        <div class="col-md-4">
                                            <?php if(isset($_GET['edit_detail']) && $detail_id == $product_info['detail_id']){ ?>
                                                <form method="post" action="controller/product.php">
                                                    <input type="hidden" name="product_id" value="<?php echo my_encrypt($product_info['product_id']) ?>"/>
                                                    <input type="hidden" name="detail_id" value="<?php echo my_encrypt($product_info['detail_id']) ?>"/>
                                                    <div class="form-group">
                                                        <label for="detail_name">Detail Name</label>
                                                        <input class="form-control" type="text" name="detail_name" value="<?php echo $product_info['field_name'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="detail_value">Detail Value:</label>
                                                        <input class="form-control" type="text" name="detail_value" value="<?php echo $product_info['field_value'] ?>" >
                                                    </div>
                                                    <input type="submit" class="btn btn-primary" name="update_detail" value="Update">
                                                    <input type="submit" class="btn btn-primary" name="cancel_detail" value="Cancel">
                                                </form>
                                            <?php } else { ?>
                                                <div class="detail-component">
                                                    <h6 class="title"><?php echo $product_info['field_name'] ?></h6>
                                                    <h4 title="Size">
                                                        <ol class="breadcrumb">
                                                            <li><?php echo $product_info['field_value'] ?></li>
                                                        </ol>
                                                    </h4>
                                                </div>
                                                <?php if (isSeller() && $product_info_details["user_id"] == $_SESSION['user_id']) { ?>
                                                    <a href="product/detail.php?id=<?php echo my_encrypt($product_id) ?>&detail_id=<?php echo my_encrypt($product_info['detail_id']) ?>&edit_detail=true" class="btn btn-primary col-sm-2 ">Edit</a>
                                                    <form action="controller/product.php" method="post">
                                                        <input type="hidden" name="product_id" value="<?php echo my_encrypt($product_info['product_id']) ?>"/>
                                                        <input type="hidden" name="detail_id" value="<?php echo my_encrypt($product_info['detail_id']) ?>"/>
                                                        &nbsp;<button class="btn btn-danger" name="delete_detail">Delete</button>
                                                    </form>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-10">
                                        <div class="detail-component">
                                            <h6 class="title">Description</h6>
                                            <div style="margin-top: 10px" class="well" title="Category"><?php echo $product_info_details['description'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="company-profile" class="tab-pane fade">
                                    <div class="col-md-12 profile">
                                        <h3 class="information-title">Basic Information</h3>
                                        <div class="col-md-4 product-image-wrapper">
                                            <img src="assets/images/<?php echo $client['user_image'] ?>">
                                        </div>
                                        <div class="col-md-2" style="border-right: 1px olive double;height: 400px"></div>
                                        <div class="col-md-6">
                                            <table class="content-table">
                                                <tbody>
                                                <tr>
                                                    <th>Shop Name:</th>
                                                    <td class="col-value"><?php echo $client["shop_name"] ?></td>
                                                    <td class="col-verify"></td>
                                                </tr>
                                                <tr>
                                                    <th>Main Products:</th>
                                                    <td>
                                                        <?php
                                                        $topProducts = getTopProductOfUser($conn,$client["user_id"],3);
                                                        $index = 1;
                                                        foreach($topProducts as $product){
                                                            $product_id = $product["product_id"];
                                                            $product_information = getProductInfo($conn, $product_id);
                                                            ?>
                                                            <a href="<?php echo "product/detail.php?id=".my_encrypt($product_id) ?>">
                                                                <?php
                                                                echo $product_information["product_name"];
                                                                if($index < sizeof($topProducts)){
                                                                    echo ",";
                                                                    $index++;
                                                                }
                                                                ?>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="col-verify"></td>
                                                </tr>
                                                <tr>
                                                    <th>Location:</th>
                                                    <td class="col-value"><?php echo $client["location"] ?></td>
                                                    <td class="col-verify"></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number:</th>
                                                    <td class="col-value"><?php echo $client["phone_no"] ?></td>
                                                    <td class="col-verify"></td>
                                                </tr>
                                                <tr>
                                                    <th>Total Products:</th>
                                                    <td class="col-value">
                                                        <?php
                                                        echo getTotalProductCount($conn, $client["user_id"]);
                                                        ?>
                                                    </td>
                                                    <td class="col-verify"></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <form action="product/index.php" method="POST" class="view-product-by-user">
                                                            <input type="hidden" name="identifier" id="identifier" value="<?php echo my_encrypt($client['user_id'])?>"/>
                                                            <button class="btn-link" name="product_by_user" value="view_products">View All Products</button>
                                                        </form>
                                                    </th>
                                                    <th>
                                                        <form action="product/chat.php" method="POST" class="view-product-by-user">
                                                            <input type="hidden" name="identifier" id="identifier" value="<?php echo my_encrypt($client['user_id'])?>"/>
                                                            <button class="btn-link" name="chat" value="start-chat">Talk with Product Owner</button>
                                                        </form>
                                                    </th>
                                                </tr>
                                                <tr>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11"></div>
                        <div class="col-md-1">
                            <?php if (isBuyer()) { ?>
                                <div>
                                    <form action="order/create.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product_info_details['id'] ?>"/>
                                        <button class="btn btn-success order-button">Order</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 20px">
            <div class="col-md-5">
                <h3 style="font-weight: bold;">
                    <span>OTHER PRODUCTS <small>Other Products by this Company</span>
                </h3>
            </div>
            <div class="col-md-7 label-line">
            </div>
        </div>
        <div class="row" style="padding: 20px">
            <div class="custom-wrapper col-md-12">
                <?php
                foreach ($otherProducts as $product) {
                    ?>
                    <div class="col-sm-3">
                        <article class="col-item">
                            <div class="photo">
                                <a href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
                            </div>
                            <div class="info">
                                <div class="row">
                                    <div class="price-details col-md-6">
                                        <p class="details">
                                        <ol class="breadcrumb text-center">
                                            <?php
                                            $productDetails_index = getProductDetails($conn, $product['id']);
                                            $sizeArray=explode(',',$productDetails_index['size']);
                                            foreach ($sizeArray as $size) {
                                                ?>
                                                <li><?php echo $size ?></li>
                                                <?php
                                            }
                                            ?>
                                        </ol>
                                        <h4 class="text-center"><?php echo $product["product_name"] ?></h4>
                                        <p class="price-new">
                                            <?php echo "Rs. ".$product["price"] ?>
                                        </p>
                                    </div>
                                    <div class="text-center view-detail">
                                        <a class="btn btn-primary" href="product/detail.php?id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
<?php
include_once "../_footer.php";
?>