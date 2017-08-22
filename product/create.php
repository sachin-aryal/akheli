
<!DOCTYPE html>
<html>
<head>
    <title>Create a product</title>
</head>
<body>
<form action="../controller/product.php" enctype="multipart/form-data" method="post">
    <label for="category">Category:</label>
    <input type="text" name="category">

    <label for="size">Size:</label>
    <input type="text" name="size">

    <label for="color">Color:</label>
    <input type="text" name="color">

    <label for="description">Description:</label>
    <input type="text" name="description">

    <label for="min_order">Min-order:</label>
    <input type="text" name="min_order">

    <label for="price">Price:</label>
    <input type="text" name="price">



    <input type="file" name="product_image">


    <input type="submit" name="submit">
</form>
</body>
</html>