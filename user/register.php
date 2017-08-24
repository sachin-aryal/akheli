<?php
session_start();
include_once "../shared/auth.php";
redirectIfLoggedIn("../index.php")
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<?php include_once "../shared/_header.php"?>
<form method="post" action="../controller/user.php" enctype="multipart/form-data">
    <?php
    include_once '_client_form.php';
    ?>
<input type="submit" name="register" value="Register">
</form>
</body>
</html>
