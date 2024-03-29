<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
include_once '../shared/dbconnect.php';
include_once '../shared/common.php';
include_once "../_header.php";
?>
<link href="assets/css/cart.css" type="text/css" rel="stylesheet"/>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: auto">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9 clearfix">
                <div class="page-title clearfix">
                    <h3><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Items in Cart
                    </h3>
                </div>
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal(NRs.)</th>
                        <th style="width:10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    if(isset($_SESSION["cart_items"])){
                        $show = false;
                    foreach ($_SESSION["cart_items"] as $cart_item=>$val){
                        $product_info = getProductInfo($conn, $cart_item);
                        if($product_info) {
                            $show = true;
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
                    if($show){
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: center">Total (NRs.)</td>
                        <td colspan="3" class="hidden-xs text-center"><strong id="total-price"><?php echo $total ?></strong></td>
                    </tr>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#demo">Shipping Details</button>
                            <div id="demo" class="collapse" style="margin-top: 15px">

                                <?php
                                include_once "../location/_location_form.php";
                                ?>

                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <form action="order/checkout.php" method="post" id="order-form">
                                <label for="order-note">Order Note</label>
                                <textarea name="order_note" id="order-note" cols="110" rows="5"></textarea>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><a id="continue-shopping" href="product/index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                        <td colspan="2" class="hidden-xs"></td>
                        <td>
                            <?php if(isLoggedIn()){
                                if(isBuyer()){
                                ?>
                                <button id="checkout-link" class="btn btn-success btn-block" onclick="saveLocation()">Checkout <i class="fa fa-angle-right"></i></button>
                            <?php }}else{?>
                                <p style="color: red;">Please login to order items. Cart items will be stored for 24 hours.</p>
                            <?php }?>
                        </td>
                    </tr>
                    </tfoot>
                    <?php
                    }else{
                        echo "<tr><td style='text-align: center' colspan='4'>No Items in cart.</td></tr>";
                    }}
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include_once "../_footer.php";
?>
