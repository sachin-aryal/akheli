<label for="product_name">Product Name:</label>
<input type="text" name="product_name" value="<?php echo $product['product_name']?>">

<label for="category">Category:</label>
<input type="text" name="category" value="<?php echo $product['category']?>">

<label for="description">Description:</label>
<input type="text" name="description" value="<?php echo $product['description']?>" >

<label for="min_order">Min-order:</label>
<input type="text" name="min_order" value="<?php echo $product['min_order']?>">

<label for="price">Price:</label>
<input type="text" name="price" value="<?php echo $product['price']?>">

<hr>
<div id="product_details_form">
    <?php
    if(sizeof($productDetails) != 0){
        foreach ($productDetails as $productDetail){
            ?>
            <input type="hidden" name="detail_id[]" value=value="<?php echo $productDetail['id']?>">

            <label for="size">Size:</label>
            <input type="text" name="size[]"  value="<?php echo $productDetail['size']?>">

            <label for="color">Color:</label>
            <input type="text" name="color[]"  value="<?php echo $productDetail['color']?>">
            <hr>
        <?php }}else{ ?>

        <label for="size">Size:</label>
        <input type="text" name="size[]">

        <label for="color">Color:</label>
        <input type="text" name="color[]">
        <hr>
    <?php } ?>
</div>
<input type="file" name="product_image">