<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<form method="post" action="../controller/user.php" enctype="multipart/form-data">
    <?php
    include '_client_form.php';
    ?>
<input type="submit" name="register" value="Register">
<input type="reset" name="reset" value="Reset">
</form>
</body>
</html>