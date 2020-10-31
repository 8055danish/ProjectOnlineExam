<?php
$errors = array();

if (isset($_POST['submit'])){
	include 'conn.php';

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if(empty($name) || empty($username) || empty($password)||empty($email)) 
	{

		array_push($errors,"All field must be filled");
	}

	$user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";

	$result = mysqli_query($conn, $user_check_query);

	$user = mysqli_fetch_assoc($result);


	if ($user) { // if user exists
		if ($user['username'] === $username) {
			array_push($errors, "Username already exists");
		}

		if ($user['email'] === $email) { 
			array_push($errors, "Email already exists");
		}
	}

	if (count($errors) == 0) {

		$query = "INSERT INTO user (name,username, password,email) 
		VALUES ('$name','$username','$password','$email' )";
		
		mysqli_query($conn, $query);

		$conn->close();

		array_push($errors,"Registration Successful.");
	}
}

?>
<!doctype html>
<html>
<head>
	<title>Online Exam System</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
	include "header.php";
	?>
	<div class="main">
		<h1 style="text-align: center;">User Registration</h1>
		<div class="segment">
			<form action="" method="post" novalidate>
				<table style="padding-top: 40px">
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" id="name" required="" placeholder="Enter Name"></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td><input name="username" type="text" id="username" required="" placeholder="Enter Username"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" id="password" required="" placeholder="Enter Password"></td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td><input name="email" id="email" type="text" required="" placeholder="Enter Email"></td>
					</tr>
					<tr>
						<td></td>
						<td class="button_class"><input type="submit" name="submit" value="Register">
						</td>
					</tr>
				</table>
			</form>
			<br/>
			<?php  if (count($errors) > 0) : ?>
				<div>
					<?php foreach ($errors as $error) : ?>
						<p style="color:red;text-align: center;"><?php echo $error ?></p>
					<?php endforeach ?>
				</div>
			<?php  endif ?>
		</div>

	</div>
	<?php
	include 'footer.php';
	?>