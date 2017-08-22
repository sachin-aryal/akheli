<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/22/17
 * Time: 9:31 PM
 */
define("ROLE_ADMIN","admin");
define("ROLE_CLIENT","client");
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