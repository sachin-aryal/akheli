<?php
include_once "../_header.php";
?>
<style>
    .valid {
        color: red;
        background-color: pink;
    }

    .invalid {
        display: none;
    }
</style>
<div class="container" style="width: 100%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "../_dashsidebar.php"?>
            <div class="col-md-10">
                <div class="page-title">
                    <h3><span class="fa fa-tag"></span> Reset Password
                        <small>Change your password here</small>
                    </h3>
                </div>
                <form class="custom-form" method="post" id="user_form_1" action="../controller/user.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email:</label>
                        <input class="form-control" type="Email" name="email" id="email" placeholder="Enter your email here" required />
                    </div>
                    <input type="submit" class="btn btn-primary" name="changePassword" value="Change Password">
                </form>
            </div>
        </div>
    </div>
</div>
