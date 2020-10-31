<?php
session_start();
include("conn.php");
?>
<!doctype html>
<html>
<head>
<title>Test List</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include("header.php");
$subid = $_GET['subid'];
$query1 = "SELECT * FROM exam_subject WHERE sub_id=$subid";
$result1 = mysqli_query($conn,$query1);
$row1=mysqli_fetch_array($result1);
echo "<h1 align=center><font color=blue> $row1[1]</font></h1>";

if(mysqli_num_rows($result1)<1)
{
	echo "<br><br><h2 align=center> No Quiz for this Subject </h2>";
	exit;
}
echo "<h2 align=center> Select Test Name to Give Test </h2>";
echo "<table align=center>";
$result2 = mysqli_query($conn,"SELECT * FROM exam_test where sub_id=$subid");
while($row=mysqli_fetch_row($result2))
{
	echo "<tr><td align=center ><a href=exam.php?testid=$row[0]&subid=$subid>$row[2]</a></td></tr>";
}
echo "</table>";
?>
</body>
</html>
