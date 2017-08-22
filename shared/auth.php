<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/22/17
 * Time: 9:31 PM
 */

function redirectIfLoggedIn($redirectPath){
    if(isset($_SESSION["username"])){
        header("Location:$redirectPath");
        return;
    }
}