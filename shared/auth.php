<?php
if(file_exists("base_url.php")){
    include_once "base_url.php";
}else{
    include_once "../base_url.php";
}
define("ROLE_ADMIN","akheli_admin");
define("ROLE_BUYER","akheli_buyer");
define("ROLE_SELLER","akheli_seller");
define ("DASHBOARD",BASE_URL."dashboard.php");

//define ("ADMIN_DASHBOARD",BASE_URL."admin.php");
define ("NOLOGIN_DASHBOARD",BASE_URL."index.php");
define("ORDER_STATUS_REQUESTED","REQUESTED");
define("ORDER_STATUS_PROCESSING","PROCESSING");
define("ORDER_STATUS_COMPLETED","COMPLETED");
if(!isset($_SESSION)){session_start();} ;

function redirectIfLoggedIn(){
    if(isset($_SESSION["username"])){
        redirectToDash();
    }
}
function isAdmin(){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == ROLE_ADMIN){
            return true;
        }
    }
    return false;
}

function redirectToDash(){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == ROLE_BUYER || $_SESSION["role"] == ROLE_SELLER || $_SESSION["role"] == ROLE_ADMIN){
            header("Location:".DASHBOARD);
            return;
        }
    }
    header("Location:".NOLOGIN_DASHBOARD);
    return;
}

function redirectIfNotAdmin(){
    if($_SESSION["role"] != ROLE_ADMIN){
        redirectToDash();
    }
}

function redirectIfNotSeller(){
    if($_SESSION["role"] != ROLE_SELLER){
        redirectToDash();
    }
}

function redirectIfNotBuyerOrSeller(){
    if($_SESSION["role"] != ROLE_BUYER && $_SESSION["role"] != ROLE_SELLER){
        redirectToDash();
    }
}

function redirectIfNotBuyer(){
    if($_SESSION["role"] != ROLE_BUYER){
        redirectToDash();
    }
}

function isLoggedIn(){
    if(isset($_SESSION["username"])){
        return true;
    }
    return false;
}

function isBuyer(){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == ROLE_BUYER){
            return true;
        }
    }
    return false;
}

function isSeller(){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == ROLE_SELLER){
            return true;
        }
    }
    return false;
}

function redirectIfNotLoggedIn(){
    if(!isset($_SESSION["username"])) {
        redirectToDash();
        return;
    }
}