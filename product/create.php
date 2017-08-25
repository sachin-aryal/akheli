<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfNotAdmin();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create a product</title>
</head>
<body>
<?php include_once "../_dashboardHeader.php"?>
<form action="controller/product.php" enctype="multipart/form-data" method="post">
    <?php include_once "_product_form.php"?>
    <input type="submit" name="save_product" value="Save">
</form>
</body>
</html>