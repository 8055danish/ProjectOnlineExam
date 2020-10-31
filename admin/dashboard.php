<?php
session_start();
?>
<!doctype html>
<html>
<head>
	<title>Online Exam Sytem</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
	if(isset($_POST['submit']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		include("../conn.php");

		$query1 = "SELECT * FROM admin WHERE email='$email' or password='$password'";
		$result1 = mysqli_query($conn,$query1);

		if(mysqli_num_rows($result1)<1)
		{
			echo "<h3> Invalid User Name or Password <h3>"; exit;

		}

		$_SESSION['alogin']="true";
		

	}
	else if(!isset($_SESSION['alogin']))
	{
		header("location:index.php");
	}

	?>
	<?php include 'header.php'; ?>


</body>
</html>
