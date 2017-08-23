<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 8/22/2017
 * Time: 11:00 PM
 */
include '../shared/dbconnect.php';
include '../shared/resource.php';
include '../shared/common.php';

$productList=getProductList($conn);
?>
<html>
    <head>

    </head>
    <body>
        <h2>Product List</h2>

        <?php
            foreach ($productList as $product){
        ?>
                <a href="detail.php?id=<?php echo $product['id'] ?>"><img src="../<?php echo $product['image'] ?>" height="100" width="100"> </a>

        <?php } ?>



    </body>
</html>

