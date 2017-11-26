<?php
include_once "../shared/dbconnect.php";
include_once "../shared/common.php";
include_once "../shared/auth.php";
redirectIfNotLoggedIn();
$user = getUser($conn,"id=".$_SESSION['user_id']);
$client = getClient($conn,$user["id"]);
include_once "../_header.php"
?>
<script type="text/javascript">
    $(document).ready(function(){
        validateRegister();
    });
</script>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-10">
                <div class="page-title">
                    <h3><span class="fa fa-pencil"></span> Edit Profile <small>change your profile details</small></h3>
                </div>
                <form class="custom-forms" method="post" id="user_form_1" action="controller/user.php" enctype="multipart/form-data">
                    <?php
                    include_once '_client_form.php';
                    ?>
                    <input type="hidden" name="id" value="<?php echo $user["id"] ?>"/>
                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                </form>
            </div>
        </div>
    </div>
</div>

