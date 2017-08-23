<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/22/17
 * Time: 9:31 PM
 */
define("ROLE_ADMIN","akheli_admin");
define("ROLE_CLIENT","akheli_client");

function redirectIfLoggedIn($redirectPath){
    if(isset($_SESSION["username"])){
        header("Location:$redirectPath");
        return;
    }
}

function redirectIfNotAdmin($redirectPath){
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] != ROLE_ADMIN){
            header("Location:$redirectPath");
            return;
        }
    }else{
        header("Location:$redirectPath");
        return;
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
