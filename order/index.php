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
    if(isOrderAllowed()){
        $orders = getMyOrders($conn);
    }else{
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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($orders as $order) {
                    $product_info = getProductInfo($conn,$order["product_id"])
                    ?>
                    <tr>
                        <td><?php echo $product_info["product_name"] ?></td>
                        <td><?php echo $product_info["category"] ?></td>
                        <td><?php echo $product_info["price"] ?></td>
                        <td><?php echo $order["created_at"] ?></td>
                        <td><?php echo $order["size"] ?></td>
                        <td><?php echo $order["color"] ?></td>
                        <td><?php echo $order["status"] ?></td>
                        <td><?php echo $order["quantity"] ?></td>
                        <td><?php echo $order["quantity"]*$product_info["price"] ?></td>
                        <td>
                            <?php if($order["status"] == ORDER_STATUS_REQUESTED && isOrderAllowed()){
                                include_once '_edit_action.php';
                            }else if(checkIfAdmin()){
                                include_once '_edit_action.php';
                            }?>
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
