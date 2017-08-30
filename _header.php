<?php

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
    <div class="container clearfix">
        <div class="pull-left">
            <span>9860068421</span>
        </div>

        <div class="pull-right clearfix">

            <?php
            if (isset($_SESSION["username"])) {
                ?>
                <form class="pull-right" action="controller/user.php" method="post">
                    <input class="btn-form-input" type="submit" name="logout" value="Logout"/>
                </form>

                <span class="pull-right">Welcome <?php echo $_SESSION["username"] ?></span>

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
                                    <a href="#">Forgot Password</a>
                                </div>
                                <!--                                    <div class="pull-right">-->
                                <!--                                        <a href="#">Register</a>-->
                                <!--                                    </div>-->
                            </div>
                        </ul>
                    </li>

                    <li class="btn-form-input dropdown">
                        <a class="dropdown-toggle" href="user/register.php">Register</a>
                        <ul class="dropdown-menu login-wrapper">
                            <div>
                                <h2 class="title">Akheli - Login</h2>
                                <form method="post" action="../controller/user.php">
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
                                    <a href="#">Forgot Password</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#">Register</a>
                                </div>
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
<div class="clearfix">
<div class="col-md-3">

            <ul class="main-menu">
                <li><h1 class="brand">Akheli</h1></li>
                <?php $categoryList = getDistinctCategory($conn);

                for($i=0; $i<12; $i++){
                foreach ($categoryList as $category) {
                    ?>
                    <li class="active">
                        <form method="post" action="product.php">
                            <input type="hidden" name="category" value="<?php echo $category['category'] ?>">
                            <input class="menu-btn" type="submit" value="<?php echo $category['category'] ?>">
                        </form>
                    </li>
                <?php }
                }?>
            </ul>

</div>


