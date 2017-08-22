<?php
session_start();
include "../shared/auth.php";
redirectIfLoggedIn("../index.php")
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<?php include "../_header.php"?>
<form method="post" action="../controller/user.php" enctype="multipart/form-data">
    <?php
    include '_client_form.php';
    ?>
<input type="submit" name="register" value="Register">
</form>
</body>
</html>
