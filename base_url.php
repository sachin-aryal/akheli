<?php
if ($_SERVER["HTTP_HOST"] == "localhost"){
    define("BASE_URL","http://localhost/~sachin/akheli/");
}else{
    define("BASE_URL","http://akhely.com/");
}
define("PROJECT_PATH",__DIR__);