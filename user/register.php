<?php
include_once "../_header.php";
redirectIfLoggedIn();
?>
<script type="text/javascript">
    $(document).ready(function(){
        validateRegister();
    });
</script>
<div class="container" style="width: 50%;margin: 0 auto">
    <div class="row" id="register-form">
        <h2 class="title">Create new account - Akhely</h2>
        <hr>
        <form class="custom-form" method="post" id="user_form_1" action="controller/user.php" enctype="multipart/form-data">
            <?php
            $createUser = true;
            include_once '_client_form.php';
            ?>
            <input type="submit" class="btn btn-primary" name="register" value="Register">
        </form>
    </div>
</div>
<?php
include_once "../_footer.php";
?>