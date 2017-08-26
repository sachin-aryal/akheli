<?php
include_once "../shared/common.php";
include_once "../shared/dbconnect.php";

$user = getUser($conn,$_POST["user_id"]);
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
    <form method="post" action="controller/user.php" enctype="multipart/form-data">
        <?php
        include_once '_client_form.php';
        ?>
        <input type="hidden" name="id" value="<?php echo $user["id"] ?>"/>
        <input type="submit" name="update" value="Update">
    </form>
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

