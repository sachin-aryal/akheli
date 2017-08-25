<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:38 PM
 */
if (!isset($_SESSION)) {session_start();};
include_once "../shared/auth.php";
redirectIfNotAdmin();

include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
$usersList = getUserList($conn);
$clientList = [];
$i = 0;
foreach ($usersList as $user) {
    $clientList[$i++] = getClient($conn, $user["id"]);
}
?>

<html>
<head>
    <script type="text/javascript">
        (function defer() {
            if (window.jQuery) {
                if (!$.fn.dataTableExt) {
                    setTimeout(function () {
                        defer()
                    }, 50);
                } else {
                    $("#userList").DataTable();
                }
            } else {
                setTimeout(function () {
                    defer()
                }, 50);
            }
        })();

    </script>
</head>
<body>
<div class="wrapper">
    <?php
    include_once "../_dashboardHeader.php";
    ?>
    <div class="content-wrapper clearfix" id="main_content">
        <div id="page_content">
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
                foreach ($usersList as $user) {
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
        </div>
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

