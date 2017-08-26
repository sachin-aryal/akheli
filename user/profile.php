<?php
if (!isset($_SESSION)) {
    session_start();
};
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
    $user = getUser($conn, "id=" . $_SESSION['user_id']);
    $client = getClient($conn, $_SESSION['user_id']);

    ?>
    <div class="content-wrapper clearfix" id="main_content">

        <div class="page-title">
            <h3><span class="fa fa-user"></span> My Profile
                <small>Profile details here</small>
            </h3>
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="assets/upload/<?php echo $client['user_image'] ?>">
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
                            <h6 class="title">Emai</h6>
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

            <form method='post' action='user/edit.php'>
                <input class="btn btn-primary btn-edit-profile" type='submit' value='Edit Profile'/>
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
</div>
</body>
</html>

