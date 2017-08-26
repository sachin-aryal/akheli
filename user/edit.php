<?php
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
include_once "../shared/auth.php";
redirectIfNotLoggedIn();
$user = getUser($conn,"id=".$_SESSION['user_id']);
$client = getClient($conn,$user["id"]);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
<?php include_once "../_dashboardHeader.php"?>
<div class="content-wrapper clearfix" id="main_content">

    <div class="page-title">
        <h3><span class="fa fa-pencil"></span> Edit Profile <small>change your profile details</small></h3>
    </div>
    <div class="page-content">
    <form class="custom-forms" method="post" action="controller/user.php" enctype="multipart/form-data">
        <?php
        include_once '_client_form.php';
        ?>
        <input type="hidden" name="id" value="<?php echo $user["id"] ?>"/>
        <input class="btn btn-primary" type="submit" name="update" value="Update">

    </form>
    </div>
</div>

<!-- The Right Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Content of the sidebar goes here -->
</aside>
<!-- The sidebar's background -->
<!-- This div must placed right after the sidebar for it to work-->
<div class="control-sidebar-bg">asdfadsf</div>
</body>
</html>

