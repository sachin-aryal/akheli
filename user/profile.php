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
    $client = getClient($conn,$_SESSION['user_id']);

    ?>
    <div class="content-wrapper clearfix" id="main_content">
   

   Name: <?php echo $client[name]; ?> 
   <br>
   Shop Name: <?php echo $client[shop_name]; ?>
   <br>
   Location: <?php echo $client[location]; ?>
   <br>
   Phone Number: <?php echo $client[phone_no]; ?>
   <br>
   Email: <?php echo $user[email]; ?>
   <br>
        Profile: <img src="assets/upload/<?php echo $client['user_image'] ?>" >
   <form method='post' action='user/edit.php'>
    <input type='submit' value='Edit Profile' />
    </form>

    
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

