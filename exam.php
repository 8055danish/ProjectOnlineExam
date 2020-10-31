<?php
session_start();
include("conn.php");


if(isset($_GET['subid']) && isset($_GET['testid']))
{
	$subid=$_GET['subid'];
	$testid=$_GET['testid'];
	$_SESSION['sid']=$subid;
	$_SESSION['tid']=$testid;

}
if(!isset($_SESSION['sid']) || !isset($_SESSION['tid']))
{
	header("location: index.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Online Exam</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
	include("header.php");

	$query1 = "SELECT * FROM exam_question WHERE test_id=".$_SESSION['tid'];
	
	$result=mysqli_query($conn,$query1) or die(mysqli_error());

	if(!isset($_SESSION['qn']))
	{
		$_SESSION['qn']=0;
		$_SESSION['trueans']=0;

	}
	else
	{	
		if(isset($_POST['next']) && isset($_POST['ans']))
		{
			mysqli_data_seek($result,$_SESSION['qn']);
			$row= mysqli_fetch_row($result);	
			if($_POST['ans']==$row[7])
			{
				$_SESSION['trueans']=$_SESSION['trueans']+1;
			}
			$_SESSION['qn']=$_SESSION['qn']+1;
		}
		
		else if(isset($_POST['result']) && isset($_POST['ans']))
		{
			mysqli_data_seek($result,$_SESSION['qn']);
			$row= mysqli_fetch_row($result);	
			
			if($_POST['ans']==$row[7])
			{
				$_SESSION['trueans']=$_SESSION['trueans']+1;
			}
			$_SESSION['qn']=$_SESSION['qn']+1;

			echo "<h1 align=center>Result</h1>";
			echo "<h3 align=center>Total Question : ".$_SESSION['qn']."</h3>";
			echo "<h3 align=center><td>True Answer : ".$_SESSION['trueans']."</h3>";
			$wrongans=$_SESSION['qn']-$_SESSION['trueans'];
			echo "<h3 align=center>Wrong Answer : ".$wrongans."</h3> "; 
			if ($_SESSION['trueans']>=$wrongans){
				echo "<br><h2 align=center>Your are passed in exam.</h2>";
			}
			unset($_SESSION['qn']);
			unset($_SESSION['sid']);
			unset($_SESSION['tid']);
			unset($_SESSION['trueans']);
			exit;
		}
	}
	$rs=mysqli_query($conn,$query1) or die(mysqli_error());
	
	if($_SESSION['qn']>mysqli_num_rows($rs)-1)
	{
		unset($_SESSION['qn']);
		echo "<h1 align=center>Some Error  Occured</h1>";
		session_destroy();
		echo "Please <a href=index.php> Start Again</a>";
		exit;
	}
	mysqli_data_seek($rs,$_SESSION['qn']);
	$row= mysqli_fetch_row($rs);
	echo "<form name=myfm method=post action=exam.php>";
	echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
	$n=$_SESSION['qn']+1;
	echo "<tr><td><span class=style2>Que ".  $n .": $row[2]</style>";
	echo "<tr><td class=style8><input type=radio name=ans value=1>$row[3]";
	echo "<tr><td class=style8> <input type=radio name=ans value=2>$row[4]";
	echo "<tr><td class=style8><input type=radio name=ans value=3>$row[5]";
	echo "<tr><td class=style8><input type=radio name=ans value=4>$row[6]";

	if($_SESSION['qn']<mysqli_num_rows($rs)-1){
		echo "<tr><td><input type=submit name='next' value='Next Question'></td></tr></form>";
	}
	else{
		echo "<tr><td><input type=submit name='result' value='Get Result'></form>";
	}
	echo "</table></table>";
	?>
</body>
</html>