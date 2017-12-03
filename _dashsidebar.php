<style>
    #dashboard-li li{
        list-style:none;
    }
</style>
<div class="col-md-2">
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
    <?php } ?>
</div>