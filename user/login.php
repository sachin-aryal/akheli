<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:32 PM
 */
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfLoggedIn("../index.php")
?>
<html>
<head>
    <title>Login - Akheli</title>
    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet">

    <link rel="stylesheet" href="../public/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
<div class="login-wrapper">
    <img src="../public/img/login-back.png" alt="">


    <div class="absolute-center">
        <div class="col-md-6 no-padding">
            <img src="../public/img/ecommerce.jpg" alt="">
        </div>
        <div class="col-md-6 clearfix">
            <div class="absolute-center">
            <h2 class="title">Akheli</h2>
            <form method="post" action="../controller/user.php">
                <div class="form-group">
                    <label for="username">Username</label>
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
                <input class="btn btn-view btn-block" type="submit" name="login" value="Login"/>
            </form>
                <div class="pull-left">
                    <a href="#">Forgot Password</a>
                </div>
                <div class="pull-right">
                    <a href="#">Register</a>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
