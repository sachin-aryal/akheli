<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/22/17
 * Time: 9:31 PM
 */
define("ROLE_ADMIN","akheli_admin");
define("ROLE_CLIENT","akheli_client");
define("ROOT_URL","http://localhost/project/akheli/");
define ("CLIENT_DASHBOARD",ROOT_URL."dashboard.php");
define ("ADMIN_DASHBOARD",ROOT_URL."admin.php");
define ("NOLOGIN_DASHBOARD",ROOT_URL."index.php");
define("ORDER_STATUS_REQUESTED","REQUESTED");
define("ORDER_STATUS_PROCESSING","PROCESSING");
define("ORDER_STATUS_COMPLETED","COMPLETED");
if(!isset($_SESSION)){session_start();} ;

function redirectIfLoggedIn(){
    if(isset($_SESSION["username"])){
        redirectToDash();
    }
}
function checkIfAdmin(){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == ROLE_ADMIN){
            return true;
        }
    }
    return false;
}

function redirectToDash(){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == ROLE_CLIENT){
            header("Location:".CLIENT_DASHBOARD);
            return;
        }else if($_SESSION["role"] == ROLE_ADMIN){
            header("Location:".ADMIN_DASHBOARD);
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

function redirectIfNotClient(){
    if($_SESSION["role"] != ROLE_CLIENT){
        redirectToDash();
    }
}

function isLoggedIn(){
    if(isset($_SESSION["username"])){
        return true;
    }
    return false;
}

function isOrderAllowed(){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == ROLE_CLIENT){
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