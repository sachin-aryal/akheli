<?php

require_once "../vendor/autoload.php";
$head_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$site_url = $head_link."/order/pay.php";
define('SITE_URL', $site_url);
define('SHIPPING_COST', 18);
$pay_pal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential('client_id', "client_secret")
);
