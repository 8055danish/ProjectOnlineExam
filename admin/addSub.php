<?php
session_start();
require("../conn.php");

?>
<!doctype html>
<html>
<head>
  <title>Add Subject</title>
  <link rel="stylesheet" href="../css/style.css">
  <script LANGUAGE="JavaScript">
    function validate() {
      subname=document.form1.subname.value;
      if (subname.length<1) {
        alert("Please Enter Subject Name");
        document.form1.subname.focus();
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <?php include("header.php"); ?>
  <?php

  if (!isset($_SESSION['alogin']))
  {
    echo "<p>You are not logged in.</p>";
    echo "<a href=index.php>Click Here for Login</a>";
    exit();
  }

  if(isset($_POST['submit']) || strlen(isset($_POST['subname']))>0 )
  {
    $subname = $_POST['subname'];
    $result1=mysqli_query($conn,"SELECT * FROM exam_subject WHERE sub_name='$subname'");
    if (mysqli_num_rows($result1)>0)
    {
      echo "<br><div align=center>Subject is Already Exists</div>";
      exit;
    }
    mysqli_query($conn,"INSERT INTO exam_subject(sub_name) VALUES ('$subname')") or die(mysql_error());
    echo "<p align=center>Subject <strong>{$subname}</strong> Added Successfully.</p>";
    $_POST['submit']=='';
  }
  ?>
  
  <br><br><br>
  <h3><div align=center>Add Subject</div></h3>
  <form name="form1" method="post" onSubmit="return validate();">
    <table align="center">
      <tr>
        <td><div align="center"><strong>Enter&nbsp;Subject&nbsp;Name </strong></div></td>
        <td width="2%" height="5"> 
          <input name="subname" placeholder="enter subname name" type="text" id="subname">
        </td>
      </tr>
      <tr>
        <td align=center><input  type="submit" name="submit" value="Add" ></td>
      </tr>
    </table>
  </form>
</body>
</html>


