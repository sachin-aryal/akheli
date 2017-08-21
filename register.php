<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<form method="post" action="register.php" enctype="multipart/form-data">
	<label>Name:</label>
	<input type="text" name="name" required />

	<label>Email:</label>
	<input type="Email" name="email" required />

	<label>Password:</label>
	<input type="Password" name="password" required />

	<label>Shop Name:</label>
	<input type="text" name="shop_name" required />

	<label>Contact Number:</label>
	<input type="number" name="phone_no" required />

	<label>Location:</label>
	<input type="text" name="location" required />

<input type="submit" name="Register">
<input type="reset" name="Reset">
</form>
</body>
</html>

<?php 
include 'controller/dbconnect.php';
if (isset($_POST) && !empty($_POST)) {
	# code...
	//get from form
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$shop_name=$_POST['shop_name'];
	$phone_no=$_POST['phone_no'];
	$location=$_POST['location'];

//password encryption
 $password = hash('sha256', $password);


//insert into users table
$query1="Insert into users (email,password,role,enabled) values ('$email','$password','client',1); ";
$retval = mysql_query( $query1, $conn );

//get user_id from user table
$get_id= "select * from users where email ='$email' ";
    $res=mysql_query($get_id);
   $row=mysql_fetch_array($res);
   $user_id=$row['id'];


//insert into clients table with user_id
$query2="Insert into clients (name,shop_name,phone_no,location,user_id) values ('$name','$shop_name','$phone_no','$location','$user_id')";
$retval2 = mysql_query( $query2, $conn );
}
 ?>
