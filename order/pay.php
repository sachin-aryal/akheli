<?php
include_once '../shared/pay_pal_loader.php';

if(isset($_GET["success"], $_GET["paymentId"], $_GET["PayerID"])){
    if((bool)$_GET["success"] === true){
        $paymentId = $_GET["paymentId"];
        $payerId = $_GET["PayerID"];

        $payment = \PayPal\Api\Payment::get($paymentId, $pay_pal);
        $execute = new \PayPal\Api\PaymentExecution();
        $execute->setPayerId($payerId);

        try{
            $result = $payment->execute($execute, $pay_pal);
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