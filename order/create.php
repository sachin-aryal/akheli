<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/25/2017
 * Time: 5:20 PM
 */
?>
<html>
<head>

</head>
<body>
<form action="../controller/order.php" method="post">
    <label for="quantity">Quantity:</label>
    <input type="text" name="quantity">

    <label for="description">Description:</label>
    <input type="text" name="description">

    <input type="checkbox" name="size" value="36">36<br>
    <input type="checkbox" name="size" value="37"> 37<br>
    <input type="checkbox" name="size" value="38">38<br>

    <input type="checkbox" name="color" value="36">36<br>
    <input type="checkbox" name="color" value="37"> 37<br>
    <input type="checkbox" name="color" value="38">38<br>

    <input type="submit" name="submit" >


</form>
</body>
</html>
