
<div class="form-group">
    <label>First Name:</label>
    <input class="form-control" type="text" name="name" id="name" required value="<?php echo $client["name"] ?>"/>
    <span class="error_name" id="error_name"></span>
</div>

<div class="form-group">
    <label>Last Name:</label>
    <input class="form-control" type="text" name="last_name" id="last_name" required
           value="<?php echo $client["last_name"] ?>"/>
    <span id="error_shop"></span>
</div>
<div class="form-group">
    <label>Email:</label>
    <input class="form-control" type="Email" name="email" id="email" required value="<?php echo $user["email"] ?>"/>
    <span class="error_email" id="error_email"></span>
</div>

<div class="form-group">
    <label>Password:</label>
    <input class="form-control" type="Password" name="password" id="register_password"/>
    <span id="error_register_password"></span>
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
    <span id="error_location"></span>
</div>

<?php if ($createUser) {?>
    <div class="form-group">
        <label>User Type:</label>
        <select name="role" class="form-control">
            <option value="C">Buyer</option>
            <option value="S">Seller</option>
        </select>
        <span id="error"></span>
    </div>
<?php } ?>
<div class="form-group">
    <label>Image:</label>
    <input type="file" name="user_image">
</div>