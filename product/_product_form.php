<script>
    $(function () {
        $('#test').val('<?php echo $product['category']; ?>');
    })
</script>
<div class="form-group">
    <label for="product_name">Product Name:</label>
    <input class="form-control" type="text" id="product_name" name="product_name" value="<?php echo $product['product_name'] ?>">
    <span class="error_product_name" id="error_product_name"></span>
</div>

<div class="form-group">
    <label for="category">Category:</label>
    <div id="billdesc">
        <select id="test" class="form-control" name="category">
            <?php $categories=getCategories($conn,$_SESSION['user_id']);
            foreach ($categories as $category){
            ?>
            <option class="non"><?php echo $category['category'] ?></option>
<?php }?>
            <option class="editable" >Add Other Category</option>
        </select>
        <input class="editOption form-control" name="category" style="display:none;">
    </div>


    <!--<input class="form-control" type="text" id="category" name="category" value="<?php /*echo $product['category'] */?>">
    <span class="error_category" id="error_category"></span>-->
</div>

<div class="form-group">
    <label for="min_order">Min-order:</label>
    <input class="form-control" type="number" id="min_order" name="min_order" value="<?php echo $product['min_order'] ?>">
    <span class="error_min_order" id="error_min_order"></span>
</div>

<div class="form-group">
    <label for="price">Price:</label>
    <input class="form-control" type="number" id="price" name="price" value="<?php echo $product['price'] ?>">
    <span class="error_price" id="error_price"></span>
</div>
<div id="product_details_form" class="row clearfix">
    <?php
    if (sizeof($productDetails) != 0) {
            ?>
            <div id="<?php echo $productDetail['id'] ?>">
                <input type="hidden" name="detail_id[]" value=value="<?php echo $productDetails['id']?>">

                <div class="form-group col-md-6">
                    <label for="size">Size:</label>
                    <input class="form-control" type="text" name="size[]" value="<?php echo $productDetails['size'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="color">Color:</label>
                    <input class="form-control" type="text" name="color[]" value="<?php echo $productDetails['color'] ?>">
                </div>
            </div>
        <?php }else{ ?>

        <div class="form-group col-md-6">
            <label for="size">Size:</label>
            <input class="form-control" type="text" name="size[]" id="size">
            <span class="error_size" id="error_size"></span>
        </div>

        <div class="form-group col-md-6">
            <label for="color">Color:</label>
            <input class="form-control" type="text" name="color[]" id="color">
            <span class="error_color" id="error_color"></span>
        </div>
    <?php } ?>
</div>


<div class="form-group">
    <label for="description">Description:</label>
    <textarea name="description" id="description" cols="30" rows="10" ><?php echo $product['description'] ?></textarea>
    <span class="error_description" id="error_description"></span>
</div>

<input type="file" name="product_image">
<!--<button type="button" class="btn btn-primary" onclick="addMoreProductDetails()">Add Detail</button>-->
<script>
    var initialText = $('.editable').val();
    $('.editOption').val(initialText);

    $('#test').change(function(){
        var selected = $('option:selected', this).attr('class');
        var optionText = $('.editable').text();

        if(selected == "editable"){
            $('.editOption').show();


            $('.editOption').keyup(function(){
                var editText = $('.editOption').val();
                $('.editable').val(editText);
                $('.editable').html(editText);
            });

        }else{
            $('.editOption').hide();
        }
    });
</script>