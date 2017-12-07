<?php
include_once "../_header.php";
$product_chain = "N/A";
$pagination = array();
$limit = 16;
$page = 0;
$offset = 0;
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
if($page > 1){
    $offset = ($page*$limit)-$limit;
}
if (isset($_GET["category"])) {
    $category = $_GET["category"];
    if($category == "myp" && isSeller()){
        $productList = getSellersProducts($conn, $limit, $offset);
        $product_count = getSellersProducts($conn);
        $product_chain = "My Products";
        $total_pages = ceil($product_count/$limit);
        for($i=1;$i<=$total_pages;$i++){
            if($page == $i){
                $class="active";
            }
            array_push($pagination,"<a class='$class' href='product/index.php?page=$i&category=myp'>$i</a>");
            $class = "";
        }
    }else{
        $category = $_GET["category"];
        $productList = getProductsByCategory($conn, $category,$limit,$offset);
        $product_count = getProductsByCategoryCount($conn, $category);
        $product_chain = $_GET["category"];
        $total_pages = ceil($product_count/$limit);
        for($i=1;$i<=$total_pages;$i++){
            if($page == $i){
                $class="active";
            }
            array_push($pagination,"<a class='$class' href='product/index.php?page=$i&category=$category'>$i</a>");
            $class = "";
        }
    }
} elseif (isset($_POST["product_by_user"])){
    $identifier = $_POST["identifier"];
    $user_id = my_decrypt($identifier);
    $client = getClient($conn, $user_id);
    $productList = getProductByUser($conn, $user_id,$limit,$offset);
    $product_count = getProductByUserCount($conn, $user_id);
    $product_chain = $client["shop_name"];
    $total_pages = ceil($product_count/$limit);
    for($i=1;$i<=$total_pages;$i++){
        if($page == $i){
            $class="active";
        }
        array_push($pagination,"<a class='$class' href='product/index.php?page=$i&u_identifier=$identifier'>$i</a>");
        $class = "";
    }
}elseif(isset($_GET["u_identifier"])){
    $identifier = $_GET["u_identifier"];
    $user_id = my_decrypt($identifier);
    $client = getClient($conn, $user_id);
    $productList = getProductByUser($conn, $user_id,$limit,$offset);
    $product_count = getProductByUserCount($conn, $user_id);
    $product_chain = $client["shop_name"];
    $total_pages = ceil($product_count/$limit);
    for($i=1;$i<=$total_pages;$i++){
        if($page == $i){
            $class="active";
        }
        array_push($pagination,"<a class='$class' href='product/index.php?page=$i&u_identifier=$identifier'>$i</a>");
        $class = "";
    }
}
else {
    $productList = getProductList($conn,$limit,$offset);
    $product_count = getProductListCount($conn);
    $product_chain = "All Products";
    $total_pages = ceil($product_count/$limit);
    for($i=1;$i<=$total_pages;$i++){
        if($page == $i){
            $class="active";
        }
        array_push($pagination,"<a class='$class' href='product/index.php?page=$i'>$i</a>");
        $class = "";
    }
}

?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="page-title">
                    <h3><span class="fa fa-tag"></span> Product List
                        <small>Available products</small>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 15px">
                        <div class="product-chain"><ul>
                                <li class=""><a href="index.php" title="Home">Home</a></li>
                                <li class=""><a href="product/index.php" title="Products">Products</a></li>
                                <li class="last-child"><?php echo $product_chain ?></li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    foreach ($productList as $product) {
                        ?>
                        <div class="col-sm-3">
                            <article class="col-item">
                                <div class="photo">
                                    <a href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-responsive" alt="" /> </a>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price-details col-md-6">
                                            <ol class="breadcrumb text-center">
                                                <?php
                                                $productDetails_index = getProductDetails($conn, $product['id']);
                                                $sizeArray=explode(',',$productDetails_index['size']);
                                                foreach ($sizeArray as $size) {
                                                    ?>
                                                    <li><?php echo $size ?></li>
                                                    <?php
                                                }
                                                ?>
                                            </ol>
                                            <h4 class="text-center"><?php echo $product["product_name"] ?></h4>
                                            <p class="price-new">
                                                <?php echo "Rs. ".$product["price"] ?>
                                            </p>
                                        </div>
                                    </div>


                                    <?php if(isAdmin()){ ?>
                                        <div class="view-detail">
                                            <table>
                                                <td><a style="margin-left: 8px;" class="btn btn-primary" href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>">Details</a></td>

                                                <?php
                                                $feature=featured_Product($conn,$product['id']);
                                                if($feature['product_id'] == $product['id']){

                                                    ?>
                                                    <td>

                                                        <form method="post" action="controller/product.php" style="margin-left: 1px">
                                                            <input type="hidden" name="featured_id" value="<?php echo $feature['featured_id']?>">
                                                            <button title="Remove from Featured" type="submit" class="btn btn-danger" name="remove_feature" >
                                                                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Featured
                                                            </button>
                                                        </form>
                                                    </td>

                                                <?php }else{ ?>
                                                    <td>
                                                        <form method="post" action="controller/product.php" style="margin-left: 1px">
                                                            <input type="hidden" name="product_id" value="<?php echo $product['id']?>">
                                                            <button title="Remove from Featured" type="submit" class="btn btn-info" name="set_feature" >
                                                                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Featured
                                                            </button>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    <?php }else{ ?>
                                        <div class=" view-detail text-center ">
                                            <a class="btn btn-primary" href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                        </div>
                                    <?php } ?>


                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="row">
                    <div class="custom-pagination col-md-12" style="float: right">
                        <hr>
                        <?php
                        if(sizeof($pagination) > 1){
                            foreach ($pagination as $page){
                                echo $page;
                            }
                        }
                        ?>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>

