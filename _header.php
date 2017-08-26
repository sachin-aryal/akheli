<?php

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
if(!isset($_SESSION)){session_start();}
include_once "shared/dbconnect.php";
include_once "shared/common.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Akheli</title>
    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <script src="public/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="public/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <script src="public/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/notify.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            <?php if(isset($_SESSION["message"])){?>
            $.notify('<?php echo $_SESSION["message"] ?>','<?php echo $_SESSION['messageType'] ?>');

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
            if(isset($_SESSION["username"])) {
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
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Register</a>
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
                <?php $categoryList=getDistinctCategory($conn);
                foreach ($categoryList as $category){
                ?>
                <li class="active"><a href="#"><?php echo $category['category'] ?></a></li>
                <?php } ?>
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

<div id="myCarousel" class="carousel slide slider" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="public/img/1.jpg" alt="Los Angeles">
        </div>

        <div class="item">
            <img src="public/img/2.jpg" alt="Chicago">
        </div>

        <div class="item">
            <img src="public/img/3.jpg" alt="New york">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container">
    <div class="row margin-vertical shadow">
<!--        <div class="col-md-6">-->
<!--            <div class="feature main-feature">-->
<!--                <img src="public/img/1.jpg" alt="">-->
<!--                <div class="overlay">-->
<!--                    <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                </div>-->
<!--                <div class="absolute-center offer">-->
<!--                    50%-->
<!--                    Off-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!--            <div class="feature sub-feature">-->
<!--                <img src="public/img/2.jpg" alt="">-->
<!--                <div class="overlay">-->
<!--                    <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                </div>-->
<!--                <div class="absolute-center offer">-->
<!--                    50%-->
<!--                    Off-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="clearfix sub-feature-wrapper">-->
<!--                <div class="col-md-6">-->
<!--                    <div class="feature sub-feature">-->
<!--                        <img src="public/img/3.jpg" alt="">-->
<!--                        <div class="overlay">-->
<!--                            <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                        </div>-->
<!--                        <div class="absolute-center offer">-->
<!--                            50%-->
<!--                            Off-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-6">-->
<!--                    <div class="feature sub-feature">-->
<!--                        <img src="public/img/3.jpg" alt="">-->
<!--                        <div class="overlay">-->
<!--                            <h2 class="overlay-title">Mens Clothing</h2>-->
<!--                        </div>-->
<!--                        <div class="absolute-center offer">-->
<!--                            50%-->
<!--                            Off-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="col-md-11 no-padding">
            <form class="general-search-form" action="#">
                <div class="form-group no-margin">
                    <input type="search" class="form-control text-center" placeholder="Search product here...">
                </div>
            </form>
        </div>
        <div class="col-md-1 bg-white no-padding text-center"><span class="fa fa-search general-search-icon"></span></div>


    </div>
</div>

<div class="new-section bg-gray">
    <h2 class="title">New Arrival</h2>
    <div class="container">
        <div class="row">
            <?php $latest_productList=getLatestProduct($conn);
            foreach ($latest_productList as $latestProduct){



                $latestProductDetaills=getProductDetails($conn,$latestProduct['id']);
                ?>
                <div class="col-md-3">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="assets/images/.'<?php echo $latestProduct['image'] ?>'" alt="">
                        </div>
                        <div class="product-description">
                            <h4 class="product-name"><?php echo $latestProduct['product_name'] ?></h4>
                            <ol class="breadcrumb text-center">
                                <?php $sizeArray=explode(',',$latestProductDetaills['size']);
                                foreach ($sizeArray as $size){
                                    ?>
                                    <li>
                                        <a href="#"><?php echo $size  ?></a>
                                    </li>
                                <?php } ?>
                            </ol>
                            <p>
                                <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs <?php echo $latestProduct['price'] ?>/-</b>
                            </p>
                            <div class="text-center">
                                <button class="btn btn-view">View</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="public/img/pant2.jpg" alt="">
                    </div>
                    <div class="product-description">
                        <h4 class="product-name">Korean Pant</h4>
                        <ol class="breadcrumb text-center">
                            <li>
                                <a href="#">S</a>
                            </li>
                            <li>
                                <a href="#">M</a>
                            </li>
                            <li>
                                <a href="#">L</a>
                            </li>
                            <li>
                                <a href="#">XL</a>
                            </li>
                            <li>
                                <a href="#">XXL</a>
                            </li>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="public/img/pant3.jpg" alt="">
                    </div>
                    <div class="product-description">
                        <h4 class="product-name">Korean Pant</h4>
                        <ol class="breadcrumb text-center">
                            <li>
                                <a href="#">S</a>
                            </li>
                            <li>
                                <a href="#">M</a>
                            </li>
                            <li>
                                <a href="#">L</a>
                            </li>
                            <li>
                                <a href="#">XL</a>
                            </li>
                            <li>
                                <a href="#">XXL</a>
                            </li>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="public/img/pant4.jpg" alt="">
                    </div>
                    <div class="product-description">
                        <h4 class="product-name">Korean Pant</h4>
                        <ol class="breadcrumb text-center">
                            <li>
                                <a href="#">S</a>
                            </li>
                            <li>
                                <a href="#">M</a>
                            </li>
                            <li>
                                <a href="#">L</a>
                            </li>
                            <li>
                                <a href="#">XL</a>
                            </li>
                            <li>
                                <a href="#">XXL</a>
                            </li>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new-section bg-white">
    <h2 class="title">Most Popular</h2>
    <div class="container">
        <div class="row">
            <?php $latest_productList=getMostViewProduct($conn);
            foreach ($latest_productList as $latestProduct){

                $productInfo=getProductInfo($conn,$latestProduct['product_id']);

                $latestProductDetaills=getProductDetails($conn,$latestProduct['product_id']);
            ?>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="assets/images/.'<?php echo $productInfo['image'] ?>'" alt="">
                    </div>
                    <div class="product-description">
                        <h4 class="product-name"><?php echo $productInfo['product_name'] ?></h4>
                        <ol class="breadcrumb text-center">
                            <li>
                                <a href="#"><?php echo $latestProductDetaills['size'] ?></a>
                            </li>
                            <li>
                                <a href="#">M</a>
                            </li>
                            <li>
                                <a href="#">L</a>
                            </li>
                            <li>
                                <a href="#">XL</a>
                            </li>
                            <li>
                                <a href="#">XXL</a>
                            </li>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs <?php echo $productInfo['price'] ?>/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="public/img/pant2.jpg" alt="">
                    </div>
                    <div class="product-description">
                        <h4 class="product-name">Korean Pant</h4>
                        <ol class="breadcrumb text-center">
                            <li>
                                <a href="#">S</a>
                            </li>
                            <li>
                                <a href="#">M</a>
                            </li>
                            <li>
                                <a href="#">L</a>
                            </li>
                            <li>
                                <a href="#">XL</a>
                            </li>
                            <li>
                                <a href="#">XXL</a>
                            </li>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="public/img/pant3.jpg" alt="">
                    </div>
                    <div class="product-description">
                        <h4 class="product-name">Korean Pant</h4>
                        <ol class="breadcrumb text-center">
                            <li>
                                <a href="#">S</a>
                            </li>
                            <li>
                                <a href="#">M</a>
                            </li>
                            <li>
                                <a href="#">L</a>
                            </li>
                            <li>
                                <a href="#">XL</a>
                            </li>
                            <li>
                                <a href="#">XXL</a>
                            </li>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="public/img/pant4.jpg" alt="">
                    </div>
                    <div class="product-description">
                        <h4 class="product-name">Korean Pant</h4>
                        <ol class="breadcrumb text-center">
                            <li>
                                <a href="#">S</a>
                            </li>
                            <li>
                                <a href="#">M</a>
                            </li>
                            <li>
                                <a href="#">L</a>
                            </li>
                            <li>
                                <a href="#">XL</a>
                            </li>
                            <li>
                                <a href="#">XXL</a>
                            </li>
                        </ol>
                        <p>
                            <strike>Rs 700/-</strike>&nbsp;&nbsp;&nbsp; <b>Rs 500/-</b>
                        </p>
                        <div class="text-center">
                            <button class="btn btn-view">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>

