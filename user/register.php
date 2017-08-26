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
    <script src="../assets/js/javascript.js"></script>
    <style>
        .valid {
            color: red;
            background-color: pink;
        }

        .invalid {
            display: none;
        }
    </style>
    <title>Register</title>
</head>
<body>
<?php include_once "../shared/_header.php" ?>

<div class="container">
    <form class="custom-form" method="post" action="../controller/user.php" enctype="multipart/form-data">
        <?php
        include_once '_client_form.php';
        ?>
        <input type="submit" name="register" value="Register">
    </form>
</div>
</body>
</html>
