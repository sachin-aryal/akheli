<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:32 PM
 */
session_start();
include "../shared/auth.php";
redirectIfLoggedIn("../index.php")
?>
<html>
<head>
<title>Login - Akheli</title>
</head>
<body>
<?php include "../shared/_header.php"?>
<form method="post" action="../controller/user.php">
    <label for="username">Username</label>
    <input type="text" name="username" id="username"/>
    <label for="password">Password</label>
    <input type="password" name="password" id="password"/>
    <input type="submit" name="login" value="Login"/>
</form>
</body>
</html>
