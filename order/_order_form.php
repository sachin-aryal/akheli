<div class="form-group">
    <div class="col-md-6" style="margin-left: -13px;margin-bottom: 15px">
        <label for="size">Size: </label>
        <?php
        $size = explode(",", $order_product_details["size"]);
        $color = explode(",", $order_product_details["color"]);
        foreach ($size as $s) {
            ?>
            <?php echo $s; ?>&nbsp;<input class="checkbox-inline" type="checkbox" id="size" name="size[]"  value="<?php echo $s; ?>"/>
        <?php } ?>
    </div>
    <div class="col-md-6" style="margin-bottom: 15px">
        <label for="color">Color: </label>
        <?php
        foreach ($color as $c) {
            ?>
            <?php echo $c; ?>&nbsp;<input class="checkbox-inline" type="checkbox" id="color" name="color[]" value="<?php echo $c; ?>"/>
            <?php
        }
        ?>
    </div>
</div>

<div class="form-group" style="margin-top: 10px">
    <label for="quantity">Quantity</label>
    <input class="form-control" type="text" name="quantity" id="quantity"
           value="<?php echo $edit_order['quantity'] ?>"/>
</div>


<div class="form-group">
    <label for="description">Order Note</label>
    <input class="form-control" type="text" name="description" id="description"
           value="<?php echo $edit_order["description"] ?>"/>
</div>

<input type="hidden" name="product_id" id="product_id" value="<?php echo $productId ?>"/>