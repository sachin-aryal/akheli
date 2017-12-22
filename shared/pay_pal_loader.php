<?php

require_once "../vendor/autoload.php";
$head_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$site_url = "http://localhost/~sachin/akheli/order/pay.php";
define('SITE_URL', $site_url);
define('SHIPPING_COST', 18);
$pay_pal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AdIKMCxevPFfNQtQasz3xNQRlJvYpKcz8MEOtfILIXu6v2C3oGQieMcTAAWe-0fyqkkqT48KjwwSVEwx',
        "ENLWyEXu1eGoSdF9lTzl4S-9IS3Pv0bkA9QSwY_8QWPeT7vdjvOrsMTKJmBNvGvGcjDkSGdbAnXoN3NS")
);
