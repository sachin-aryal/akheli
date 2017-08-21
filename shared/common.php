<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:03 AM
 */
function getUserList($conn){
    $users = $conn->query("SELECT *FROM USERS");
    if ($users->num_rows > 0) {
       return mysqli_fetch_all($users,MYSQLI_ASSOC);
    }
    return [];
}

function getClient($conn,$user_id){
    $client = $conn->query("SELECT *FROM CLIENTS WHERE user_id = $user_id");
    if($client->num_rows > 0){
        return mysqli_fetch_assoc($client);
    }
    return [];
}