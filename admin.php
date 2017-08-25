<?php
if(!isset($_SESSION)){session_start();} ;
include_once "shared/auth.php";
include_once "shared/dbconnect.php";
include_once "shared/common.php";
redirectIfNotAdmin();
?>

<html>
<head>
    <title>Admin: Dashboard</title>
</head>
<body>
<?php
include_once "_dashboardHeader.php";
echo $_SERVER['DOCUMENT_ROOT'];
echo __DIR__;
?>
</body>
</html>
