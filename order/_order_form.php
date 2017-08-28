
<div class="form-group">
<label for="description">Description</label>
<input class="form-control" type="text" name="description" id="description" value="<?php echo $edit_order["description"] ?>"/>
</div>

<div class="form-group">
<label for="size">Size</label>
<?php
    $size = explode(",",$order_product_details["size"]);
    $color = explode(",",$order_product_details["color"]);
    foreach ($size as $s) {
        ?>
        <?php echo $s; ?>&nbsp;<input type="checkbox" id="size" name="size[]" value="<?php echo $s; ?>"/>
    <?php } ?>
    <br><label for="color">Color</label>
    <?php
    foreach ($color as $c){
        ?>
        <?php echo $c; ?>&nbsp;<input type="checkbox" id="color" name="color[]" value="<?php echo $c; ?>"/>
    <?php } }?>

</div>

<div class="form-group">
<label for="quantity">Quantity</label>
<input class="form-control" type="text" name="quantity" id="quantity" value="<?php echo $edit_order['quantity'] ?>"/>
</div>
    <?php } ?>
<br><label for="quantity">Quantity</label>
<input type="text" name="quantity" id="quantity" value="<?php echo $edit_order['quantity'] ?>"/>
<input type="hidden" name="product_id" id="product_id" value="<?php echo $productId ?>"/>