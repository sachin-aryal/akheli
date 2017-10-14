<?php
include_once 'base_url.php';
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
if (!isset($_SESSION)) {
    session_start();
}
include_once "shared/dbconnect.php";
include_once "shared/common.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Akheli</title>
    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <script src="public/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="public/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <script src="public/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/notify.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            <?php if(isset($_SESSION["message"])){?>
            $.notify('<?php echo $_SESSION["message"] ?>', '<?php echo $_SESSION['messageType'] ?>');
            <?php unset($_SESSION["message"]);unset($_SESSION["messageType"]); } ?>

        });
    </script>
</head>
<?php
include_once "shared/auth.php";
?>
<body>

<div class="top-info-bar">
    <div class="container-fluid clearfix">
        <div class="pull-left">
            <span><i class="fa fa-bell-o"></i> 9860068421</span>
        </div>


        <div class="pull-right clearfix">

            <?php
            if (isset($_SESSION["username"])) {
                ?>
                <form class="pull-right" action="controller/user.php" method="post">
                    <input class="btn-form-input" type="submit" name="logout" value="Logout"/>
                </form>

                <span class="pull-right text-primary"><strong>Welcome <?php echo $_SESSION["username"]  ?> </strong></span>

            <?php } else { ?>
                <!--                <form action="controller/user.php" method="post">-->
                <!--                    <input class="btn-form-input" type="submit" name="login" value="Login"/>-->
                <!--                    <input class="btn-form-input" type="submit" name="register" value="Register"/>-->
                <!--                </form>-->

                <ul class="list-inline top-bar-login-register no-margin">
                    <li class="btn-form-input dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login</a>
                        <ul class="dropdown-menu login-wrapper">
                            <div>
                                <h2 class="title">Akheli - Login</h2>
                                <form method="post" action="controller/user.php">
                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <div>
                                            <input class="form-control" type="text" name="username" id="username"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div>
                                            <input class="form-control" type="password" name="password" id="password"/>
                                        </div>
                                    </div>
                                    <input class="btn btn-login btn-block" type="submit" name="login" value="Login"/>
                                </form>
                                <div class="pull-left">
                                    <a href="user/reset_password.php">Forgot Password</a>
                                </div>
                                <!--                                    <div class="pull-right">-->
                                <!--                                        <a href="#">Register</a>-->
                                <!--                                    </div>-->
                            </div>
                        </ul>
                    </li>

                    <li class="btn-form-input dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Register</a>
                        <ul class="dropdown-menu register-wrapper">
                            <div>
                                <h2 class="title">Akheli - Register</h2>
                                <form class="custom-form" method="post" id="user_form_1" action="controller/user.php" enctype="multipart/form-data">
                                    <?php
                                    $createUser = true;
                                    include_once 'user/_client_form.php';
                                    ?>
                                    <input type="submit" class="btn btn-primary" name="register" value="Register">
                                </form>
                            </div>
                        </ul>
                    </li>

                    <!--                    <input class="btn-form-input" type="submit" name="login" value="Login"/>-->
                    <!--                    <input class="btn-form-input" type="submit" name="register" value="Register"/>-->
                </ul>
            <?php } ?>
        </div>
    </div>
</div>

<div class="bg-white shadow clearfix menu-wrapper">
    <div class="col-md-9 clearfix">
        <ul class="main-menu list-inline">
            <li><h4 class="logo">Akheli</h4></li>
            <?php $categoryList = getDistinctCategory($conn, 10);

            foreach ($categoryList as $category) {
                ?>
                <li>
                    <a href="product/index.php?category=<?php echo $category["category"] ?>" class="menu"><?php echo $category["category"] ?></a>
                </li>

                <?php
            } ?>
        </ul>
    </div>
    <div class="col-md-3 border-search">
        <div class="col-md-11 no-padding">
            <form class="general-search-form" action="#">
                <div class="form-group no-margin">
                    <input type="search" class="form-control text-center" placeholder="Search product here...">
                </div>
            </form>
        </div>
        <div class="col-md-1 no-padding text-center bg-white"><span class="fa fa-search general-search-icon"></span>
        </div>
    </div>
</div>




