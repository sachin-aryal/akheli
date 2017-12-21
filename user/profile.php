<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../shared/auth.php";
include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
redirectIfNotLoggedIn();

$user_id = $_SESSION["user_id"];
if($_GET["user_id"]){
    $user_id = $_GET["user_id"];
}
$user = getUser($conn, "id=" . $user_id);
$client = getClient($conn, $user_id);
include_once "../_header.php";
?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="page-title">
                        <h3><span class="fa fa-user"></span> My Profile
                        </h3>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets/upload/<?php echo $client['user_image'] ?>" style="width: 300px;height: 250px">
                            </div>
                            <div class="col-md-4">
                                <h1><?php echo $client[name]; ?> <?php echo $client[last_name]; ?> </h1>
                                <p><?php echo $client[location]; ?></p>
                                <p><?php echo $client[email]; ?></p>
                                <p><?php echo $client[phone_no]; ?></p>
                                <p><?php if($_SESSION["user_id"] != $client["user_id"]){ ?>
                                <form method='post' action='product/chat.php'>
                                    <input type="hidden" name="identifier" id="identifier" value="<?php echo my_encrypt($client['user_id'])?>"/>
                                    <button class="btn btn-primary" name="chat" value="start-chat">Contact</button>
                                </form>
                                <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7" style="margin-top: 20px">
                    <h3 style="font-weight: bold;">
                        <span>PRODUCTS BY USER <small>Other Products by this User</span>
                    </h3>
                </div>
                <div class="col-md-12 label-line" style="margin-top: 0;margin-bottom: 20px">
                </div>
                <?php
                $otherProducts = getProductByUser($conn, $client["user_id"], 4);
                foreach ($otherProducts as $product) {
                    ?>
                    <div class="col-sm-3">
                        <article class="col-item">
                            <div class="photo">
                                <a href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>"> <img src="assets/images/<?php echo $product['image'] ?>" class="img-thumbnail" alt="" /> </a>
                            </div>
                            <div class="info">
                                <div class="row">
                                    <div class="price-details col-md-6">
                                        <p class="details">
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
                                    <div class="text-center view-detail">
                                        <a class="btn btn-primary" href="product/detail.php?name=<?php echo $product["product_name"] ?>&id=<?php echo my_encrypt($product['id']) ?>">Details</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                <?php }
                ?>
                <?php if($_SESSION["user_id"] == $client["user_id"]){ ?>
                    <form method='post' action='user/edit.php'>
                        <input class="btn btn-primary btn-edit-profile" type='submit' value='Edit Profile'/>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../_footer.php";
?>
