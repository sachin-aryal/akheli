<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:32 PM
 */
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectToDash();
?>
<html>
<head>
    <title>Login - Akheli</title>
    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet">
    <script src="../public/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
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
<div class="login-wrapper">
    <img src="../public/img/login-back.png" alt="">


    <div class="absolute-center">
<!--        <div class="col-md-6 no-padding">-->
<!--            <img src="../public/img/ecommerce.jpg" alt="">-->
<!--        </div>-->
        <div class="col-md-6 clearfix">
            <div class="absolute-center">
            <h2 class="title">Akheli</h2>
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
        </div>
    </div>


</body>
</html>
