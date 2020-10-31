<?php
session_start();
?>
<!doctype html>
<html>
<head>
	<title>Subject List</title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	
	<?php
	include("header.php");
	include("conn.php");


	$query = "SELECT * from exam_subject";

	$result=mysqli_query($conn,$query);

	echo "<h3 style='margin-left:10px;text-align:center'> Select Subject</h3>";
	echo "<table align=center>";
	while($row=mysqli_fetch_row($result))
	{
		echo "<tr><td align=center ><a href=showTest.php?subid=$row[0]>$row[1]</td></a></tr>";
	}
	echo "</table>";
	?>

</body>
</html>