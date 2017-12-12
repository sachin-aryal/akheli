<?php
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfNotSeller();
include_once "../_header.php";
?>
<script type="text/javascript">
    $(document).ready(function(){
        validateProduct();
    });
</script>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="page-title">
                    <h3><span class="fa fa-plus"></span> Add Product <small>Add new products here</small></h3>
                </div>
                <form action="controller/product.php" id="product_form_1" class="custom-form" enctype="multipart/form-data" method="post">
                    <?php
                    $productDetails = [];
                    include_once "_product_form.php";
                    ?>
                    <input type="submit" class="btn btn-primary pull-left margin-vertical" name="save_product" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>