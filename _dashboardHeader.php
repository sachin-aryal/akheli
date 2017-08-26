<?php
define("BASE_URL","http://localhost/akheli/");
define("PROJECT_PATH",__DIR__);
include_once PROJECT_PATH."/shared/dbconnect.php";
include_once PROJECT_PATH."/shared/common.php";
include_once PROJECT_PATH."/shared/auth.php";

getOrderCount($conn);
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo BASE_URL ?>"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Akheli: Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="public/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">

    <script src="public/jquery/jquery.min.js"></script>
    <script src="public/jquery/jquery-ui.min.js"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
    <script src="public/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/notify.min.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var page_id = $("#page_id");
            if(page_id.length !== 0){
                page_id = $("#page_id").val();
                if(page_id.indexOf("product") !== -1){
                    $("#product_li").addClass("active");
                    $("#user_li").removeClass("active");
                    $("#order_li").removeClass("active");
                    return;
                }else if(page_id.indexOf("order") !== -1){
                    $("#product_li").removeClass("active");
                    $("#user_li").removeClass("active");
                    $("#order_li").addClass("active");
                    return;
                }else if(page_id.indexOf("user") !== -1){
                    $("#product_li").removeClass("active");
                    $("#user_li").addClass("active");
                    $("#order_li").removeClass("active");
                    return;
                }
            }
            $("#product_li").removeClass("active");
            $("#user_li").removeClass("active");
            $("#order_li").removeClass("active");
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            <?php if(isset($_SESSION["message"])){?>
            $.notify('<?php echo $_SESSION["message"] ?>','<?php echo $_SESSION['messageType'] ?>');

            <?php unset($_SESSION["message"]);unset($_SESSION["messageType"]); } ?>
        });
    </script>

</head>
<body class="skin-blue sidebar-mini">

<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>A</b>KHELI</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                <li>
                                    <!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <!-- end message -->
                            </ul>
                            <!-- /.menu -->
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li>
                                    <!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <!-- Task title and progress text -->
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <!-- The progress bar -->
                                        <div class="progress xs">
                                            <!-- Change the css width attribute to simulate progress -->
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <?php
                        if(isset($_SESSION["username"])) {
                        $clientInfo = getClient($conn,$_SESSION["user_id"]);
                        ?>
                        <span><?php echo $_SESSION["username"] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                <?php
                                echo $clientInfo["name"].'-'.$clientInfo["shop_name"]
                                ?>
                                <small><?php echo $clientInfo["location"] ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <form action="user/profile.php" method="post">
                                    <input class="btn btn-primary" type="submit" name="profile" value="My Profile"/>
                                </form>
                            </div>
                            <div class="pull-right">
                                <form action="controller/user.php" method="post">
                                    <input class="btn btn-primary" type="submit" name="logout" value="Logout"/>
                                </form>
                            </div>
                        </li>
                    </ul>
                    <?php } ?>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="text-center">
                <span><?php echo $_SESSION["username"] ?></span>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree" id="side_menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <?php if(checkIfAdmin()){ ?>
                <li id="order_li"><a href="order/"><i class="fa fa-shopping-bag"></i> <span><i></i> Orders</span><?php echo getOrderCount($conn); ?></a></li>
                <li class="active" id="user_li"><a href="user/index.php"><i class="fa fa-user"></i> <span>User</span></a></li>
                <li class="treeview" id="product_li">
                    <a href="#"><i class="fa fa-cubes"></i> <span>Product</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="product/create.php">Add Product</a></li>
                        <?php
                        $products_header = getDistinctCategory($conn);
                        foreach ($products_header as $product_header) {
                            ?>
                            <li><a href="product/index.php?category=<?php echo $product_header["category"] ?>"><?php echo $product_header["category"] ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>

            <?php } ?>
            <?php if(isOrderAllowed()){ ?>
                <li class="treeview" id="product_li">
                    <a href="#"><i class="fa fa-cubes"></i> <span>Product</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="product/">View Product</a></li>
                        <?php
                        $products_header = getDistinctCategory($conn);
                        foreach ($products_header as $product_header) {
                            ?>
                            <li><a href="product/index.php?category=<?php echo $product_header["category"] ?>"><?php echo $product_header["category"] ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <li id="order_li"><a href="order/"><i class="fa fa-shopping-bag"></i> <span><i></i>My Orders</span></a></li>
            <?php } ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

</body>
</html>