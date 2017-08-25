<div class="form-group">
    <label for="product_name">Product Name:</label>
    <input class="form-control" type="text" name="product_name" value="<?php echo $product['product_name'] ?>">
</div>

<div class="form-group">
    <label for="category">Category:</label>
    <input class="form-control" type="text" name="category" value="<?php echo $product['category'] ?>">
</div>

<div class="form-group">
    <label for="min_order">Min-order:</label>
    <input class="form-control" type="number" name="min_order" value="<?php echo $product['min_order'] ?>">
</div>

<div class="form-group">
    <label for="price">Price:</label>
    <input class="form-control" type="number" name="price" value="<?php echo $product['price'] ?>">
</div>
<div id="product_details_form" class="row clearfix">
    <?php
    if (sizeof($productDetails) != 0) {
        foreach ($productDetails as $productDetail) {
            ?>
            <input type="hidden" name="detail_id[]" value=value="<?php echo $productDetail['id'] ?>">

            <div class="form-group col-md-6">
                <label for="size">Size:</label>
                <input class="form-control" type="text" name="size[]" value="<?php echo $productDetail['size'] ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="color">Color:</label>
                <input class="form-control" type="text" name="color[]" value="<?php echo $productDetail['color'] ?>">
            </div>
            <hr>
        <?php }
    } else { ?>

        <div class="form-group col-md-6">
            <label for="size">Size:</label>
            <input class="form-control" type="text" name="size[]">
        </div>

        <div class="form-group col-md-6">
        <label for="color">Color:</label>
        <input class="form-control" type="text" name="color[]">
        </div>
    <?php } ?>
</div>


<div class="form-group">
    <label for="description">Description:</label>
    <textarea name="description" id="" cols="30" rows="10" value="<?php echo $product['description'] ?>"></textarea>
</div>

<input type="file" name="product_image">