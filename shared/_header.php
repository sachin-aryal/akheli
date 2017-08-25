<?php
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Akheli</title>
    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="../public/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="../public/jquery/jquery.min.js"></script>
    <script src="../assets/js/javascript.js"></script>
    <script src="../public/jquery/jquery-ui.min.js"></script>
    <script src="../public/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/notify.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            <?php if(isset($_SESSION["message"])){?>
            $.notify('<?php echo $_SESSION["message"] ?>','<?php echo $_SESSION['messageType'] ?>');

            <?php unset($_SESSION["message"]);unset($_SESSION["messageType"]); } ?>

        });
    </script>
</head>
<body>
<div class="top-info-bar clearfix">
    <div class="container">
        <div class="pull-left">
            <span>9860068421</span>
        </div>
        <div class="pull-right">

            <?php
            if(isset($_SESSION["username"])) {
                ?>
                <h2>Welcome <?php echo $_SESSION["username"] ?></h2>
                <form action="../controller/user.php" method="post">
                    <input class="btn-form-input" type="submit" name="logout" value="Logout"/>
                </form>
                <?php } else { ?>
                <form action="../controller/user.php" method="post">
                    <input class="btn-form-input" type="submit" name="login" value="Login"/>
                    <input class="btn-form-input" type="submit" name="register" value="Register"/>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<nav class="navbar main-menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Akheli</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <?php if(checkIfAdmin()) { ?>
                    <li><a href="controller/user.php">User List</a></li>
                    <li><a href="controller/product.php">Product List</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>

