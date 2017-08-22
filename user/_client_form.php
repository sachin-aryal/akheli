<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 8/21/17
 * Time: 9:54 PM
 */
?>
<label>Name:</label>
<input type="text" name="name" required value="<?php echo $client["name"] ?>" />

<label>Email:</label>
<input type="Email" name="email" required  value="<?php echo $user["email"] ?>"/>

<label>Password:</label>
<input type="Password" name="password" required"/>

<label>Shop Name:</label>
<input type="text" name="shop_name" required value="<?php echo $client["shop_name"] ?>"/>

<label>Contact Number:</label>
<input type="text" name="phone_no" required value="<?php echo $client["phone_no"] ?>"/>

<label>Location:</label>
<input type="text" name="location" required value="<?php echo $client["location"] ?>"/>
