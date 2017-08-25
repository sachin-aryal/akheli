<label for="category">Category:</label>
<input type="text" name="category" value="<?php echo $product['category']?>">

<label for="description">Description:</label>
<input type="text" name="description" value="<?php echo $product['description']?>" >

<label for="min_order">Min-order:</label>
<input type="text" name="min_order" value="<?php echo $product['min_order']?>">

<hr>
<?php

foreach ($productDetails as $productDetail){
    ?>
    <input type="hidden" name="detail_id[]" value=value="<?php echo $productDetail['id']?>">

    <label for="size">Size:</label>
    <input type="text" name="size[]"  value="<?php echo $productDetail['size']?>">

    <label for="color">Color:</label>
    <input type="text" name="color[]"  value="<?php echo $productDetail['color']?>">

    <label for="price">Price:</label>
    <input type="text" name="price[]" value="<?php echo $productDetail['price']?>">
    <hr>
<?php } ?>

<input type="file" name="product_image">