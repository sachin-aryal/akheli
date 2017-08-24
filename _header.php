<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Akheli</title>
    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/jquery/jquery.min.js"></script>
    <script src="public/jquery/jquery-ui.min.js"></script>
    <script src="public/bootstrap/dist/js/bootstrap.min.js"></script>
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
                <form action="controller/user.php" method="post">
                    <input class="btn-form-input" type="submit" name="logout" value="Logout"/>
                </form>
                <?php } else { ?>
                <form action="controller/user.php" method="post">
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
    <div class="row margin-vertical">
        <div class="col-md-6">
            <div class="feature main-feature">
                <img src="public/img/1.jpg" alt="">
                <div class="overlay">
                    <h2 class="overlay-title">Mens Clothing</h2>
                </div>
                <div class="absolute-center offer">
                    50%
                    Off
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="feature sub-feature">
                <img src="public/img/2.jpg" alt="">
                <div class="overlay">
                    <h2 class="overlay-title">Mens Clothing</h2>
                </div>
                <div class="absolute-center offer">
                    50%
                    Off
                </div>
            </div>
            <div class="clearfix sub-feature-wrapper">
                <div class="col-md-6">
                    <div class="feature sub-feature">
                        <img src="public/img/3.jpg" alt="">
                        <div class="overlay">
                            <h2 class="overlay-title">Mens Clothing</h2>
                        </div>
                        <div class="absolute-center offer">
                            50%
                            Off
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature sub-feature">
                        <img src="public/img/3.jpg" alt="">
                        <div class="overlay">
                            <h2 class="overlay-title">Mens Clothing</h2>
                        </div>
                        <div class="absolute-center offer">
                            50%
                            Off
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="new-section bg-gray">
    <h2 class="title">New Arrival</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="product-wrapper">
                    <div class="product-image">
                        <img src="public/img/pant1.jpg" alt="">
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

