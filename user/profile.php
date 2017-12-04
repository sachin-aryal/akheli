<?php
if (!isset($_SESSION)) {
    session_start();
};
include_once "../shared/auth.php";
include_once "../shared/common.php";
include_once "../shared/dbconnect.php";
redirectIfNotLoggedIn();

$user_id = $_SESSION["user_id"];
$user = getUser($conn, "id=" . $user_id);
$client = getClient($conn, $user_id);
include_once "../_header.php";
?>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-10">
                <div class="page-title">
                    <h3><span class="fa fa-user"></span> My Profile
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="assets/upload/<?php echo $client['user_image'] ?>" style="width: 300px;height: 250px">
                        </div>
                    </div>

                    <div class="col-md-8 clearfix">
                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Name</h6>
                                <h4 title="Name"><?php echo $client[name]; ?></h4>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Shop Name</h6>
                                <h4 title="Name"><?php echo $client[shop_name]; ?></h4>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="detail-component">
                                <h6 class="title">Location</h6>
                                <h4 title="Name"><?php echo $client[location]; ?></h4>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="detail-component">
                                <h6 class="title">Email</h6>
                                <h4 title="Name"><?php echo $user[email]; ?></h4>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="detail-component">
                                <h6 class="title">Phone</h6>
                                <h4 title="Name"><?php echo $client[phone_no]; ?></h4>
                            </div>
                        </div>

                    </div>
                </div>
                <?php if($_SESSION["user_id"] == $client["user_id"]){ ?>
                    <form method='post' action='user/edit.php'>
                        <input class="btn btn-primary btn-edit-profile" type='submit' value='Edit Profile'/>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
