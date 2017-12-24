<?php
if(!isset($_SESSION)){session_start();} ;
include_once '../shared/pay_pal_loader.php';
include_once '../shared/auth.php';
include_once '../shared/common.php';
include_once '../shared/dbconnect.php';

if(isset($_GET["success"], $_GET["paymentId"], $_GET["PayerID"], $_GET['request_param'])){
    if((bool)$_GET["success"] === true){
        $paymentId = $_GET["paymentId"];
        $payerId = $_GET["PayerID"];
        $request_param = $_GET['request_param'];
        $payment = \PayPal\Api\Payment::get($paymentId, $pay_pal);
        $execute = new \PayPal\Api\PaymentExecution();
        $execute->setPayerId($payerId);

        try{
            $result = $payment->execute($execute, $pay_pal);

            $order_ids = explode("sep", $request_param);
            foreach ($order_ids as $order_id){
                $details = array();
                $details["payment_id"] = $paymentId;
                $details["payer_id"] = $payerId;
                $details["order_id"] = $order_id;
                insertIntoPaypal($conn, $details);
            }
            $_SESSION["cart_items"] = array();
            $_SESSION["message"] = "Payment made successfully.";
            $_SESSION["messageType"] = "success";
            header("Location:cart.php");
            return;
        }catch (Exception $ex){
            $_SESSION["message"] = "Unable to process the payment request.";
            $_SESSION["messageType"] = "error";
            header("Location:cart.php");
            return;
        }

    }else{
        $_SESSION["message"] = "Payment process canceled by user.";
        $_SESSION["messageType"] = "error";
        header("Location:../cart.php");
        return;
    }
}else{
    $_SESSION["message"] = "Unable to process the payment request.";
    $_SESSION["messageType"] = "error";
    header("Location:../cart.php");
    return;
}