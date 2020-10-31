  <?php
  session_start();

  $notify = array();
  require("../conn.php");
  if (!isset($_SESSION['alogin']))
  {
   echo "<p>You are not logged in</p>";
   echo "<a href=index.php>Click Here for Login</a>";
   exit();
 }

 if(isset($_POST['submit'] ))
 {
  $subid = $_POST['subid'];
  $testname = $_POST['testname'];
  $totque = $_POST['totque'];

  mysqli_query($conn,"INSERT INTO exam_test(sub_id,test_name,total_que) VALUES ('$subid','$testname','$totque')");
  array_push($notify, "Added Successful");
  $_POST['submit'] ='';

  
}
?>
<!doctype html>
<html>
<head>
  <title>Add Test</title>
  <link rel="stylesheet" href="../css/style.css">
  <script LANGUAGE="JavaScript">
    function validate() {
      testname=document.form1.testname.value;
      if (testname.length<1) {
        alert("Please Enter Test Name");
        document.form1.testname.focus();
        return false;
      }
      tq=document.form1.totque.value;
      if(tq.length<1) {
        alert("Please Enter Total Question");
        document.form1.totque.value;
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <?php

  include("header.php");

  ?>

  <h3><div align=center>Add Test</div></h3>
  <form name="form1" method="post" onSubmit="return validate();">
    <table align="center">
      <tr>
        <td><strong>Enter&nbsp;Subject</strong></div></td>
        <td>  
          <td><select name="subid">

            <?php
            $result1=mysqli_query($conn,"SELECT * FROM exam_subject order by  sub_name");
            while($row=mysqli_fetch_array($result1))
            {
              echo "<option value='$row[0]' selected>$row[1]</option>";

            }
            ?>
          </select>
          
          <tr>
            <td><strong> Enter&nbsp;Test&nbsp;Name </strong></td>
            <td>&nbsp;</td>
            <td><input name="testname" type="text" id="testname"></td>
          </tr>
          <tr>
            <td><strong>Enter&nbsp;Total&nbsp;Question </strong></td>
            <td>&nbsp;</td>
            <td><input name="totque" type="text" id="totque"></td>
          </tr>
          <tr>
            <td></td>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Add" ></td>
          </tr>
        </table>
      </form>
      <?php  if (count($notify) > 0) : ?>
        <div>
          <?php foreach ($notify as $noti) : ?>
            <p align='center'><?php echo $noti ?></p>
          <?php endforeach ?>
        </div>
      <?php  endif ?>

    </body>
    </html>
