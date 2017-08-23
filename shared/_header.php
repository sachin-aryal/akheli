<header>
    <a href="../index.php">Home</a>
    <?php
if(isset($_SESSION["username"])) {
    ?>
    <h2>Welcome <?php echo $_SESSION["username"] ?></h2>
    <form action="../controller/user.php" method="post">
        <input type="submit" name="logout" value="Logout"/>
    </form>
    <?php if(checkIfAdmin()){ ?>
    <a href="../controller/user.php">User List</a>
    <a href="../controller/product.php">Product List</a>
<?php }} else { ?>
    <form action="../controller/user.php" method="post">
        <input type="submit" name="login" value="Login"/>
        <input type="submit" name="register" value="Register"/>
    </form>
<?php } ?>
</header>

