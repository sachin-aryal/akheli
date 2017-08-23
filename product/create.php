<?php
session_start();
include "../shared/auth.php";
redirectIfNotAdmin("../index.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create a product</title>
</head>
<body>
<?php include "../shared/_header.php"?>
<form action="../controller/product.php" enctype="multipart/form-data" method="post">
    <?php include "_product_form.php"?>
    <input type="submit" name="save_product" value="Save">
</form>
</body>
</html>