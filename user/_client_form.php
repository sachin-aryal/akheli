<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 9:54 PM
 */
?>

<div class="form-group">
    <label>Name:</label>
    <input class="form-control" type="text" name="name" id="name" required value="<?php echo $client["name"] ?>"/>
    <span class="error_name" id="error_name"></span>
</div>

<div class="form-group">
    <label>Email:</label>
    <input class="form-control" type="Email" name="email" id="email" required value="<?php echo $user["email"] ?>"/>
    <span class="error_email" id="error_email"></span>
</div>

<div class="form-group">
    <label>Password:</label>
    <input class="form-control" type="Password" name="password" id="password"/>
    <span id="error_password"></span>
</div>


<div class="form-group">
    <label>Shop Name:</label>
    <input class="form-control" type="text" name="shop_name" id="shop_name" required
           value="<?php echo $client["shop_name"] ?>"/>
    <span id="error_shop"></span>
</div>

<div class="form-group">
    <label>Contact Number:</label>
    <input class="form-control" type="text" name="phone_no" id="phone_no" required
           value="<?php echo $client["phone_no"] ?>"/>
    <span id="error_phone"></span>
</div>

<div class="form-group">
    <label>Location:</label>
    <input class="form-control" type="text" name="location" required value="<?php echo $client["location"] ?>"/>
    <span id="error"></span>
</div>

<div class="form-group">
    <label>Image:</label>
    <input type="file" name="user_image">
</div>