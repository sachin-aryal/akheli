<?php
if(!isset($_SESSION)){session_start();} ;
ob_start();
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
include_once "../shared/auth.php";
redirectIfNotLoggedIn();
include_once '../shared/pay_pal_loader.php';
include_once '../_header.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

if(isset($_SESSION["cart_items"])){

    if(!isset($_SESSION["shipping_address"]["country"])){
        $_SESSION["message"] = "Shipping country is required field.";
        $_SESSION["messageType"] = "error";
        header("Location:cart.php");
        return;
    }
    $country = $_SESSION["shipping_address"]["country"];
    if($country == "Nepal"){
        $description = $_POST["order_note"];
        $success_order = 0;
        foreach ($_SESSION["cart_items"] as $product_id=>$quantity){
            $details = array();
            $details["product_id"] = $product_id;
            $details["description"] = $description;
            $details["quantity"] = $quantity;
            if(insertIntoOrder($conn, $details) !== false){
                $success_order+=1;
            }
        }
        $_SESSION["message"] = "$success_order Products Ordered Successfully. Please pay on delivery.";
        $_SESSION["messageType"] = "info";
        header("Location:cart.php");
        return;
    }else{
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $items_array = array();
        $sub_total = 0;
        $weight = 0;
        $order_id_concat = "";
        foreach ($_SESSION["cart_items"] as $product_id=>$quantity){
            $product_info = getProductInfo($conn, $product_id);
            if($product_info){
                $details = array();
                $description = $_POST["order_note"];
                $details["product_id"] = $product_id;
                $details["description"] = $description;
                $details["quantity"] = $quantity;
                $insertIntoOrder = insertIntoOrder($conn, $details);
                if($insertIntoOrder !== false){
                    $order_id_concat.="$insertIntoOrder"."sep";
                    $price = $product_info["price"]/100; //todo: Replace with dynamic dollar rate.
                    $sub_total+=($price*$quantity);
                    $weight+=($product_info["weight"]*$quantity);
                    $item = new Item();
                    $item->setName($product_info["product_name"])
                        ->setCurrency('USD')
                        ->setQuantity($quantity)
                        ->setSku($product_id) // Similar to `item_number` in Classic API
                        ->setPrice($price);
                    array_push($items_array, $item);
                }
            }
        }
        if($order_id_concat !== ""){
            $order_id_concat = substr($order_id_concat, 0, -3);
        }
        $itemList = new ItemList();
        $itemList->setItems($items_array);

        if($weight <= 0.5){
            $shipping_cost = SHIPPING_COST;
        }else{
            $shipping_cost= SHIPPING_COST;
            do{
                $shipping_cost+=5;
                $weight-=0.5;
            }while($weight > 0.5);
        }

        $details = new Details();
        $details->setShipping($shipping_cost)
            ->setSubtotal($sub_total);

        $total = $shipping_cost+$sub_total;
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Akheli Product Payment.")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(SITE_URL."?success=true&request_param=$order_id_concat")
            ->setCancelUrl(SITE_URL."?success=false");


        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        try {
            $payment->create($pay_pal);
        } catch (Exception $ex) {
            $_SESSION["message"] = "Error accessing the paypal server";
            $_SESSION["messageType"] = "error";
            header("Location:cart.php");
            return;
        }
        header("Location:".$payment->getApprovalLink());
    }

}else{
    die();
}