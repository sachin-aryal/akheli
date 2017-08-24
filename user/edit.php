<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:36 PM
 */
include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
include_once "../shared/datatable.php";

$user = getUser($conn,"id=9");
$client = getClient($conn,$user["id"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
<?php include_once "../shared/_header.php"?>
<form method="post" action="../controller/user.php" enctype="multipart/form-data">
    <?php
    include_once '_client_form.php';
    ?>
    <input type="hidden" name="id" value="<?php echo $user["id"] ?>"/>
    <input type="submit" name="update" value="Update">
</form>
</body>
</html>

