<?php
if (!isset($_SESSION)) {session_start();};
include_once "../shared/auth.php";
redirectIfNotLoggedIn();
?>

<html>
<head>
    <title>My Profile</title>
</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    $user = getUser($conn,"id=".$_SESSION['user_id']);
    $client = getClient($conn,$_SESSION['user_id'])
    ?>
    <div class="content-wrapper clearfix" id="main_content">

    </div>

    <!-- The Right Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Content of the sidebar goes here -->
    </aside>
    <!-- The sidebar's background -->
    <!-- This div must placed right after the sidebar for it to work-->
    <div class="control-sidebar-bg">asdfadsf</div>
</div>
</body>
</html>

