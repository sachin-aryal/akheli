<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 10:05 AM
 */

if(isset($_SESSION["username"])) {
    ?>
    <h2>Welcome <?php echo $_SESSION["username"] ?></h2>
    <form action="controller/user.php" method="post">
        <input type="submit" name="logout" value="Logout"/>
    </form>
    <?php } else { ?>
    <form action="controller/user.php" method="post">
        <input type="submit" name="login" value="Login"/>
    </form>
    <form action="controller/user.php" method="post">
        <input type="submit" name="register" value="Register"/>
    </form>
    <?php } ?>