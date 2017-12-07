<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
include_once '../shared/dbconnect.php';
include_once '../shared/common.php';
redirectIfNotLoggedIn();
?>
<script type="text/javascript">
    (function defer() {
        if (window.jQuery) {
            if (!$.fn.dataTableExt) {
                setTimeout(function () {
                    defer()
                }, 50);
            } else {
                $("#orderList").DataTable();
            }
        } else {
            setTimeout(function () {
                defer()
            }, 50);
        }
    })();
</script>
<?php
if(isBuyer()){
    $orders = getBuyersOrders($conn);
}else if(isSeller()){
    $orders = getSellersOrders($conn);
} else if(isAdmin()){
    $orders = getAllOrders($conn);
}else{
    redirectToDash();
}
include_once "../_header.php";
?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="page-title">
                    <h3><span class="fa fa-shopping-basket"></span> Order List
                        <?php
                            if(isSeller()){
                                echo "<small>Received Ordered</small>";
                            }else if(isBuyer()){
                                echo "<small>My Orders</small>";
                            }else{
                                echo "<small>All Orders</small>";
                            }
                        ?>
                    </h3>
                </div>
                <table id="orderList" class="table table-responsive table-bordered custom-table bg-white shadow">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Ordered Date</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Total Price(NRs)</th>
                        <th>Product Owner</th>
                        <th>Ordered By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($orders as $order) {
                        $product_info = getProductInfo($conn,$order["product_id"])
                        ?>
                        <tr>
                            <td><a style="color: blue;" href="product/detail.php?name=<?php echo $product_info["product_name"] ?>&id=<?php echo my_encrypt($product_info["id"]) ?>"><?php echo $product_info["product_name"] ?></a></td>
                            <td><?php echo $product_info["price"] ?></td>
                            <td><?php echo $order["created_at"] ?></td>
                            <td><?php echo $order["status"] ?></td>
                            <td><?php echo $order["quantity"] ?></td>
                            <td><?php echo $order["quantity"]*$product_info["price"] ?></td>
                            <?php
                            $productOwner = getClient($conn,$product_info["user_id"]);
                            $orderBy = getClient($conn,$order["user_id"]);
                            ?>
                            <td><a href="user/profile.php?user_id=<?php echo $product_info['user_id']?>"><?php echo $productOwner["name"] ?></a></td>
                            <td><a href="user/profile.php?user_id=<?php echo $order['user_id']?>"><?php echo $orderBy["name"] ?></a></td>
                            <td>
                                <?php if($order["status"] == ORDER_STATUS_REQUESTED && isBuyer()){
                                    include '_edit_action.php';
                                }else if(isSeller() && $product_info["user_id"] == $_SESSION["user_id"]){
                                    include '_edit_action.php';
                                }else{?>
                                    N/A
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>
