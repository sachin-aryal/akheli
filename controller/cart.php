<?php
session_start();
include_once "../shared/common.php";
if(isset($_POST["add_to_cart"]) && isset($_POST["pid"])) {
    $pid = my_decrypt($_POST["pid"]);
    if (!isset($_SESSION["cart_items"])) {
        $_SESSION["cart_items"] = array();
    }
    if (!in_array($pid, $_SESSION["cart_items"])){
        array_push($_SESSION["cart_items"], $pid);
        echo "Item Successfully added to the cart.";
    }else{
        echo "Item already added to the cart.";
    }
}
elseif(isset($_POST["remove_from_cart"]) && isset($_POST["pid"])){
    $pid = my_decrypt($_POST["pid"]);
    $index = array_search($pid, $_SESSION["cart_items"]);
    if ( $index !== false ) {
        unset( $_SESSION["cart_items"][$index] );
    }
    header("Location:../order/cart.php");
}