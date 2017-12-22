<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
include_once '../shared/dbconnect.php';
include_once '../shared/common.php';
include_once "../_header.php";
?>
<link href="assets/css/cart.css" type="text/css" rel="stylesheet"/>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9 clearfix">
                <div class="page-title clearfix">
                    <h3><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Items in Cart
                    </h3>
                </div>
                <!--                <table id="orderList" class="table table-responsive table-bordered custom-table bg-white shadow">-->
                <!--                    <thead>-->
                <!--                    <tr>-->
                <!--                        <th>Shopping Cart</th>-->
                <!--                        <th>Price</th>-->
                <!--                        <th>Quantity</th>-->
                <!--                    </tr>-->
                <!--                    </thead>-->
                <!--                    <tbody>-->
                <!--                    --><?php
                //                    foreach ($_SESSION["cart_items"] as $cart_item){
                //                        $product_info = getProductInfo($conn, $cart_item);
                //                        if($product_info){
                //                    ?>
                <!--                    <tr>-->
                <!--                        <td>-->
                <!--                            --><?php //echo $product_info["product_name"] ?>
                <!--                        </td>-->
                <!--                        <td>--><?php //echo $product_info["price"] ?><!--</td>-->
                <!--                        <td>-->
                <!--                            <form method="post" action="controller/cart.php">-->
                <!--                                <input type="hidden" name="pid" value="--><?php //echo my_encrypt($product_info['id']) ?><!--"/>-->
                <!--                                <button class="btn btn-danger" name="remove_from_cart">Remove</button>-->
                <!--                            </form>-->
                <!--                        </td>-->
                <!--                    </tr>-->
                <!--                    --><?php //}} ?>
                <!--                    </tbody>-->
                <!--                </table>-->
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal(Rs.)</th>
                        <th style="width:10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    if(isset($_SESSION["cart_items"])){
                    foreach ($_SESSION["cart_items"] as $cart_item=>$val){
                        $product_info = getProductInfo($conn, $cart_item);
                        if($product_info) {
                            $id = my_encrypt($product_info['id']);
                            $sub_total = $product_info['price']*$val;
                            $total+=$sub_total;
                            ?>
                            <tr>
                                <td data-th="Product">
                                    <div class="row clearfix">
                                        <div class="col-sm-2 hidden-xs"><img src="assets/images/<?php echo $product_info['image'] ?>"
                                                                             class="img-responsive"/></div>
                                        <div class="col-sm-10">
                                            <h4 class="nomargin"><?php echo $product_info['product_name'] ?></h4>
                                            <p><?php echo $product_info['description'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price" id="price-<?php echo $id ?>"><?php echo $product_info['price'] ?></td>
                                <td data-th="Quantity">
                                    <input type="number" id="quantity-<?php echo $id ?>"
                                           onkeyup='calculateAmount("<?php echo $id ?>")' onmouseup='calculateAmount("<?php echo $id ?>")'
                                           class="form-control text-center" value="<?php echo $val ?>">
                                </td>
                                <td data-th="Subtotal" id="subtotal-<?php echo $id ?>" class="text-center subtotal"><?php echo $sub_total ?></td>
                                <td class="actions" data-th="">
                                    <form method="post" action="controller/cart.php">
                                        <input type="hidden" name="pid" value="<?php echo $id ?>"/>
                                        <button class="btn btn-danger btn-sm" name="remove_from_cart"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    }
                    ?>

                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="0">
                         <button type="submit" id="location">
                             Add Location
                         </button>
                            <form action="controller/location.php" id="add_location" class="custom-form"  method="post" >
                                <?php
                                include_once "../location/_location_form.php";
                                ?>
                                <input type="submit" class="btn btn-primary pull-left margin-vertical" name="save_location" value="Save">
                            </form>
                        </td>
                    </tr>

                    <tr>

                        <td><a id="continue-shopping" href="product/index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                        <td colspan="2" class="hidden-xs"></td>
                        <td class="hidden-xs text-center"><strong id="total-price">Rs. <?php echo $total ?></strong></td>
                        <td>
                            <?php if(isLoggedIn()){ ?>
                            <a id="checkout-link" href="order/checkout.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a>
                            <?php }else{?>
                                <p style="color: red;">Please login to order items. Cart items will be stored for 24 hours.</p>
                            <?php }?>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {
        $('#location').click(function () {
            $('#add_location').show();
        })

    })
</script>

<?php
include_once "../_footer.php";
?>
