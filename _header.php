<?php
ob_start();
include_once 'base_url.php';
include_once PROJECT_PATH."/shared/dbconnect.php";
include_once PROJECT_PATH."/shared/common.php";
include_once PROJECT_PATH."/shared/auth.php";
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
if (!isset($_SESSION)) {
    session_start();
}
require_once 'php-graph-sdk-5.x/src/Facebook/autoload.php';
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Akhely</title>
    <base href="<?php echo BASE_URL ?>"/>
    <link href="https://fonts.googleapis.com/css?family=Cagliostro|Open+Sans+Condensed:300" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
    <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <script src="public/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="public/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <script src="public/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/notify.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            <?php if(isset($_SESSION["message"])){?>
            $.notify('<?php echo $_SESSION["message"] ?>', '<?php echo $_SESSION['messageType'] ?>');
            <?php unset($_SESSION["message"]);unset($_SESSION["messageType"]); } ?>

            $("#categories-header, #categories-on-hover").on("mouseover", function(){
                $("#categories-on-hover").removeClass("hide");
                $(".category-icon").css("color","#ff6a00");
            });
            $("#categories-header, #categories-on-hover").on("mouseout", function(){
                $("#categories-on-hover").addClass("hide");
                $(".category-icon").css("color","#A0A2AD");
            })
        });
    </script>
</head>
<?php

$unique_categories = getDistinctCategory($conn);
?>
<body>
<div id="main-row">
    <div class="container-fluid" style="margin-bottom: 14px;">
        <div class="navbar-header" style="width: 100%;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="#"><img src="public/img/logo.jpg" height="40px" width="200px">
            </a>
            <ul class="nav navbar-left" id="top-head-left-li">
                <li><a href="index.php">Home</a></li>
                <li><a href="order/cart.php">Cart</a></li>
                <?php
                if(isAdmin()){
                    echo "<li><a href='rate/rate.php'>Rate</a></li>";
                }
                if(isLoggedIn()){
                    echo "<li><a href='dashboard.php'>Dashboard</a></li>";
                }
                ?>
            </ul>
            <ul class="nav navbar-right" id="top-head-li">
                <?php
                if (isLoggedIn()) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["username"]  ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="user/profile.php">My Profile</a></li>
                            <li><a href="controller/user.php?l=<?php echo my_encrypt('pleaselogout')?>">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="btn-form-input dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            Login
                        </a>
                        <ul class="dropdown-menu login-wrapper">
                            <h2 class="title">Akhely - Login</h2>
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
                                <input type="hidden" name="redirect_to" value="<?php echo $actual_link ?>"/>
                                <input class="btn btn-primary btn-login btn-block" type="submit" name="login" value="Login"/>
                            </form>
                            <div class="pull-left">
                                <a href="user/reset_password.php">Forgot Password</a>
                            </div>
                            <br>
                            <?php
                            $fb=new Facebook\Facebook([
                                'app_id'=>'1528184763897930',
                                'app_secret'=>'8439c6e14b5df2efdc2449ef536d752e',
                                'default_graph_version'=>'v2.5'

                            ]);
                            $redirect='http://localhost/akheli/index.php';

                            $helper= $fb->getRedirectLoginHelper();
                            try{
                                $access_token=$helper->getAccessToken();
                            }catch (\Facebook\Exceptions\FacebookResponseException $e){
                                echo 'Faceboook SDK returned an error: '.$e->getMessage();
                                exit;
                            }
                            if(!isset($access_token)){
                                $permission=['email'];
                                $loginurl=$helper->getLoginUrl($redirect,$permission);
                                echo '<a href="'.$loginurl.'">Login with Facebook</a>';
                            }else{
                                $fb->setDefaultAccessToken($access_token);
                                $response=$fb->get('/me?fields=email,name,first_name,last_name');
                                $usernode=$response->getGraphUser();

                                $user_id=$usernode->getId();
                                $username=$usernode->getName();
                                $name=$usernode->getFirstName();
                                $lastname=$usernode->getLastName();
                                $email=$usernode->getField('email');
                                $user_id1=(string)$user_id;

                                    if(getUserAvailable($conn,$user_id)== false){
                                        $role = ROLE_BUYER;
                                        $enabled = 1;
                                        $stmt = $conn->prepare('INSERT INTO '.USER_TABLE.'(role,enabled,facebook_id) VALUES (?,?,?)');
                                        $stmt->bind_param('sis', $role,$enabled,$user_id1);
                                        if($stmt->execute()){
                                            echo 'ahs';
                                            $id = $conn->insert_id;
                                            $stmt = $conn->prepare("INSERT INTO ".CLIENT_TABLE."(name,last_name,user_id) VALUES (?,?,?)");
                                            $stmt->bind_param("ssi",$name,$lastname,$id);
                                            if($stmt->execute()){
                                                $_SESSION["username"] = $name;
                                                $_SESSION["role"] =ROLE_BUYER;
                                                $_SESSION["user_id"] = $id;
                                                if($actual_link != ''){
                                                    header("Location:".$actual_link);
                                                }else{
                                                    redirectToDash();
                                                }
                                                return;
                                            }
                                        }
                                    }else{
                                        $user=getUserAvailable($conn,$user_id);

                                        $_SESSION["username"] = $name;
                                        $_SESSION["role"] =ROLE_BUYER;
                                        $_SESSION["user_id"] = $user['id'];

                                        header("Location:".$actual_link);

                                        return;
                                    }

                            }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <a href="user/register.php">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            Register
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
        <div  class="navbar-collapse collapse" id="second-nav-bar">
            <ul class="nav navbar-nav">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#" id="categories-header">
                                <div>
                                    <i class="fa fa-list fa-lg category-icon" aria-hidden="true"></i>
                                    <span>Categories</span>
                                    <i class="fa fa-caret-down category-icon" aria-hidden="true"></i>
                                </div>
                                <div id="categories-on-hover" class="hide">
                                    <?php
                                    $i=0;
                                    for ($j=0;$j<sizeof($unique_categories);$j++){
                                        echo '<div class="categories-link">';
                                        $category = $unique_categories[$j++]["category"];
                                        echo '<a href="product/index.php?category='.$category.'">'.$category.'</a>';
                                        if($unique_categories[$j]["category"]){
                                            $category = $unique_categories[$j++]["category"];
                                            echo ' / <a href="product/index.php?category='.$category.'">'.$category.'</a>';
                                        }
                                        if($unique_categories[$j]["category"]) {
                                            $category = $unique_categories[$j]["category"];
                                            echo ' / <a href="product/index.php?category='.$category.'">' . $category . '</a>';
                                        }
                                        echo "</div>";

                                    }
                                    ?>
                                </div>
                            </a>
                        </li>
                        <div class="col-sm-8 col-md-8" id="nav-with-search">
                            <form action="searchResult.php" role="search">
                                <div class="row">
                                    <div class="col-md-8" id="top-search">
                                        <input id="search-product-header" type="text" class="form-control" placeholder="Search" name="q"/>
                                    </div>
                                    <div class="col-md-2 custom-button">
                                        <button class="btn btn-default" id="search-button" type="submit"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </ul>
                </div>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<body>





