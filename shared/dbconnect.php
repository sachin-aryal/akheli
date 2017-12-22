<?php


define("USER_TABLE","akh_users");
define("CLIENT_TABLE","akh_clients");
define("ORDER_TABLE","akh_orders");
define("PRODUCT_TABLE","akh_products");
define("FEATURED_TABLE","akh_featured_products");
define("PRODUCT_DETAIL_TABLE","akh_product_details");
define("PRODUCT_IMAGE_TABLE","akh_add_product_image");
define("CHAT_TABLE","akh_chats");
define("RATE_TABLE","akh_rates");
define("LOCATION_TABLE","akh_delivery_location");

error_reporting( ~E_DEPRECATED & ~E_NOTICE );
// but I strongly suggest you to use PDO or MySQLi.
define('DBHOST', 'localhost');
if ($_SERVER["HTTP_HOST"] == "localhost"){
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'akheli');
}else{
    define('DBUSER', 'akhely_production_user');
    define('DBPASS', '@khely12345');
    define('DBNAME', 'akhely_akheli');
}
$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

if ( !$conn ) {
    die("Connection failed : " . $conn->error);
}
?>