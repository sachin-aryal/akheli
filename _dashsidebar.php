<style>
    #dashboard-li li{
        list-style:none;
    }
</style>
<div class="col-md-3" style="border-right: 3px solid #eee">
    <?php if(isBuyer() || isSeller() || isAdmin()){ ?>
        <span><i style="font-size: 18px;padding: 0 3px" class="fa fa-dashboard "></i>Dashboard</span>
        <ul id="dashboard-li" data-widget="tree">
            <?php if(isAdmin()){ ?>
                <li id="order_li"><a href="order/"><i class="fa fa-shopping-bag"></i> <span><i></i> Orders</span><?php echo getOrderCount($conn); ?></a></li>
                <li class="active" id="user_li"><a href="user/index.php"><i class="fa fa-user"></i> <span>User</span></a></li>
            <?php }else { ?>
                <li id="order_li"><a href="order/"><i class="fa fa-shopping-bag"></i> <span><i></i>Orders</span></a></li>
            <?php } ?>
            <li class="treeview" id="product_li">
                <a href="#"><i class="fa fa-cubes"></i> <span>Product</span>
                    <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="product/"><i class="fa fa-eye" aria-hidden="true"></i>All Products</a></li>
                    <?php if (isSeller()) {?>
                        <li><a href="product/create.php"><i class="fa fa-plus" aria-hidden="true"></i>Add Product</a></li>
                        <li><a href="product/index.php?category=myp"><i class="fa fa-user-circle" aria-hidden="true"></i>My Product</a></li>
                    <?php }?>
                </ul>
            </li>
            <li id="chat_li"><a href="product/chat.php"><i class="fa fa-comments"></i> <span><i></i>Chat</span></a></li>
        </ul>
        <?php
        $featured_product = getFeaturedList($conn, 1);
        echo '<h3 style="font-weight: bold;margin-top: 30px"><i style="font-size: 18px;padding: 0 3px" class="fa fa-star-o"></i>Featured Products</h3>';
        foreach ($featured_product as $feature){
            $product = getProductInfo($conn, $feature["product_id"]);
            ?>
            <hr>
            <div class="col-md-12">
                <article class="col-item">
                    <div class="photo">
                        <a href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
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
                                <p class="price-new">
                                    <a class="btn btn-primary text-center" href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                </p>
                            </div>
                        </div>
                </article>
            </div>
            <?php
        }
        ?>
    <?php } else{
        $featured_product = getFeaturedList($conn, 2);
        echo '<h3 style="font-weight: bold"><i style="font-size: 18px;padding: 0 3px" class="fa fa-star-o"></i>Featured Products</h3>';
        foreach ($featured_product as $feature){
            $product = getProductInfo($conn, $feature["product_id"]);
            ?>
            <hr>
            <div class="col-md-12">
                <article class="col-item">
                    <div class="photo">
                        <a href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
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
                                <p class="price-new">
                                    <a class="btn btn-primary text-center" href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                </p>
                            </div>
                        </div>
                </article>
            </div>
            <?php
        }
    }
    ?>
</div>