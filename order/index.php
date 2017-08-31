<?php
include_once "../shared/auth.php";
redirectIfNotLoggedIn();
?>
<html>
<head>
    <title>Orders</title>
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
</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    if(isBuyer()){
        $orders = getBuyersOrders($conn);
    }else if(isSeller()){
        $orders = getSellersOrders($conn);
    } else{
        $orders = getAllOrders($conn);
    }
    ?>
    <div class="content-wrapper clearfix" id="main_content">
        <div id="page_content">
            <div class="page-title">
                <h3><span class="fa fa-user"></span> Order List <small>All Orders</small></h3>
            </div>

            <table id="orderList" class="table table-responsive table-bordered custom-table bg-white shadow">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Ordered Date</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Total Price(NRs)</th>
                    <?php if(isAdmin()) { ?>
                        <th>Product Owner</th>
                        <th>Ordered By</th>
                    <?php } ?>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($orders as $order) {
                $product_info = getProductInfo($conn,$order["product_id"])
                ?>
                <tr>
                    <td><a href="product/detail.php?id=<?php echo $product_info["id"] ?>"><?php echo $product_info["product_name"] ?></a></td>
                    <td><?php echo $product_info["category"] ?></td>
                    <td><?php echo $product_info["price"] ?></td>
                    <td><?php echo $order["created_at"] ?></td>
                    <td><?php echo $order["size"] ?></td>
                    <td><?php echo $order["color"] ?></td>
                    <td><?php echo $order["status"] ?></td>
                    <td><?php echo $order["quantity"] ?></td>
                    <td><?php echo $order["quantity"]*$product_info["price"] ?></td>
                    <?php if(isAdmin()) {
                        $productOwner = getClient($conn,$product_info["user_id"]);
                        $orderBy = getClient($conn,$order["user_id"]);
                        ?>
                        <td><a href="user/profile.php?user_id=<?php echo $product_info['user_id']?>"><?php echo $productOwner["name"] ?></a></td>
                        <td><a href="user/profile.php?user_id=<?php echo $order['user_id']?>"><?php echo $orderBy["name"] ?></a></td>
                    <?php } ?>
                    <td>
                        <?php if($order["status"] == ORDER_STATUS_REQUESTED && isBuyer()){
                            include_once '_edit_action.php';
                        }else if(isSeller() && $product_info["user_id"]){
                            include_once '_edit_action.php';
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
