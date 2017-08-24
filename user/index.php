<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:38 PM
 */
if(!isset($_SESSION)){session_start();} ;
include_once "../shared/auth.php";
redirectIfNotAdmin("../index.php");

include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
$usersList = getUserList($conn);
$clientList = [];
$i=0;
foreach ($usersList as $user){
    $clientList[$i++] = getClient($conn,$user["id"]);
}
?>

<html>
<head>
    <script type="text/javascript">
        (function defer() {
            if (window.jQuery) {
                if (!$.fn.dataTableExt) {
                    setTimeout(function() { defer() }, 50);
                } else {
                    $("#userList").DataTable();
                }
            } else {
                setTimeout(function() { defer() }, 50);
            }
        })();

    </script>
</head>
<body>
<?php
include_once "../shared/_header.php";
include_once "../shared/datatable.php";
?>

<table id="userList">
    <thead>
    <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Shop Name</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    foreach ($usersList as $user){
        ?>
        <tr>
            <td><?php echo $user["email"] ?></td>
            <td><?php echo $clientList[$i]["name"] ?></td>
            <td><?php echo $clientList[$i++]["shop_name"] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>

