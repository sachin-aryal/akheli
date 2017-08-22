<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:38 PM
 */

include "../shared/common.php";
include "../shared/dbconnect.php";
include "../shared/resource.php";

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
    $(document).ready(function(){
        $("#userList").DataTable();
    })
</script>
</head>
<body>
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

