
<div class="form-group">
<label for="description">Description</label>
<input class="form-control" type="text" name="description" required id="description" value="<?php echo $edit_order["description"] ?>"/>
    <span class="error_description" id="error_description"></span>
</div>

<div class="form-group">
<label for="size">Size</label>
<?php
    $size = explode(",",$order_product_details["size"]);
    $color = explode(",",$order_product_details["color"]);
    foreach ($size as $s) {
        ?>
        <?php echo $s; ?>&nbsp;<input type="checkbox" id="size" name="size[]"  value="<?php echo $s; ?>"/>
    <?php } ?>
    <span class="error_size" id="error_size"></span>
    <br><label for="color">Color</label>
    <?php
    foreach ($color as $c){
        ?>
        <?php echo $c; ?>&nbsp;<input type="checkbox" id="color" name="color[]" value="<?php echo $c; ?>"/>
    <?php }{?>
    <span class="error_color" id="error_color"></span>
</div>

<div class="form-group">
<label for="quantity">Quantity</label>
<input class="form-control" type="text" name="quantity" id="quantity" value="<?php echo $edit_order['quantity'] ?>"/>
    <span class="error_quantity" id="error_quantity"></span>
</div>
    <?php } ?>

<input type="hidden" name="product_id" id="product_id" value="<?php echo $productId ?>"/>