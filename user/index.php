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
<?php
include_once "../_header.php";
?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-10">
                <div class="page-title">
                    <h3><span class="fa fa-user"></span> User List <small>List of all users</small></h3>
                </div>

                <table id="userList" class="table table-responsive table-bordered custom-table bg-white shadow">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Shop Name</th>
                        <th>Phone No</th>
                        <th>Action</th>
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
                            <td><?php echo $clientList[$i]["shop_name"] ?></td>
                            <td><?php echo $clientList[$i++]["phone_no"] ?></td>
                            <td><span class="fa fa-pencil-square-o"></span> &nbsp; <span class="fa fa-user-times"></span></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

