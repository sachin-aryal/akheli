<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 9:54 PM
 */
?>
<label>Name:</label>
<input type="text" name="name" id="name" required value="<?php echo $client["name"] ?>" />
<span class="error_name" id="error_name"></span>

<label>Email:</label>
<input type="Email" name="email" id="email" required  value="<?php echo $user["email"] ?>"/>
<span class="error_email" id="error_email"></span>

<label>Password:</label>
<input type="Password" name="password" id="password"/>
<span id="error_password"></span>

<label>Shop Name:</label>
<input type="text" name="shop_name" id="shop_name" required value="<?php echo $client["shop_name"] ?>"/>
<span id="error_shop"></span>

<label>Contact Number:</label>
<input type="text" name="phone_no" id="phone_no" required value="<?php echo $client["phone_no"] ?>"/>
<span id="error_phone"></span>

<label>Location:</label>
<input type="text" name="location" required value="<?php echo $client["location"] ?>"/>
<span id="error"></span>

<label>Image:</label>
<input type="file" name="user_image" required>

