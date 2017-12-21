<?php
session_start();
include_once "../shared/common.php";
if(isset($_POST["add_to_cart"]) && isset($_POST["pid"])) {
    $pid = my_decrypt($_POST["pid"]);
    if (!isset($_SESSION["cart_items"])) {
        $_SESSION["cart_items"] = array();
    }
    if (!array_key_exists($pid, $_SESSION["cart_items"])){
        $_SESSION["cart_items"][$pid] = 1;
        echo "Item Successfully added to the cart.";
    }else{
        echo "Item already added to the cart.";
    }
}
elseif(isset($_POST["remove_from_cart"]) && isset($_POST["pid"])){
    $pid = my_decrypt($_POST["pid"]);
    if ( array_key_exists($pid, $_SESSION["cart_items"]) ) {
        unset( $_SESSION["cart_items"][$pid] );
    }
    header("Location:../order/cart.php");
}
elseif (isset($_POST["update_quantity"]) && isset($_POST["product_id"]) && $_POST["quantity"]){
    $product_id = my_decrypt($_POST["product_id"]);
    $_SESSION["cart_items"][$product_id] = $_POST["quantity"];
}