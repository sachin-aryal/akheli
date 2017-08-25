<?php
if(!isset($_SESSION)){session_start();} ;
include_once "shared/auth.php";
redirectIfNotClient();
include_once "_dashboardHeader.php";