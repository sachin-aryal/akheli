<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../shared/auth.php";
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .valid {
            color: red;
            background-color: pink;
        }

        .invalid {
            display: none;
        }
    </style>

    <title>Reset Password</title>
</head>
<body>
<?php include_once "../shared/_header.php" ?>


<div class="page-title-wrapper register-page-wrapper padding">
    <h3 class="page-title">Reset Password<small>Change your password here</small></h3>
</div>
<div class="container">
    <div class="bg-white shadow padding">
        <form class="custom-form" method="post" id="user_form_1" action="../controller/user.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Email:</label>
                <input class="form-control" type="Email" name="email" id="email" placeholder="Enter your email here" required />
            </div>
            <input type="submit" class="btn btn-primary" name="changePassword" value="Change Password">
        </form>
    </div>
</div>
</body>
</html>
