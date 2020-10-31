<?php
session_start();

$notify = array();

require("../conn.php");
include("header.php");

if (!isset($_SESSION['alogin']))
{
  echo "<h2 align=center>You are not logged in.</h2>";
  echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
  exit();
}

if(isset($_POST['submit']))
{
  $ques_desc = $_POST['ques_desc'];
  $ans1 = $_POST['ans1'];
  $ans2 = $_POST['ans2'];
  $ans3 = $_POST['ans3'];
  $ans4 = $_POST['ans4'];
  $true_ans = $_POST['true_ans'];
  $test_id = $_POST['testid'];

  $query1 = "INSERT INTO exam_question(test_id,que_desc,ans1,ans2,ans3,ans4,true_ans) VALUES ('$test_id','$ques_desc','$ans1','$ans2','$ans3','$ans4','$true_ans')";
  mysqli_query($conn,$query1);
  array_push($notify,"Question Added Successfully.");
}
?>
<!doctype html>
<html>
<head>
  <title>Add Question</title>
  <link rel="stylesheet" href="../css/style.css">
  <script LANGUAGE="JavaScript">
    function validate() {
      mt=document.form1.ques_desc.value;
      if (mt.length<1) {
        alert("Please Enter Question");
        document.form1.addque.focus();
        return false;
      }
      a1=document.form1.ans1.value;
      if(a1.length<1) {
        alert("Please Enter Answer1");
        document.form1.ans1.focus();
        return false;
      }
      a2=document.form1.ans2.value;
      if(a1.length<1) {
        alert("Please Enter Answer2");
        document.form1.ans2.focus();
        return false;
      }
      a3=document.form1.ans3.value;
      if(a3.length<1) {
        alert("Please Enter Answer3");
        document.form1.ans3.focus();
        return false;
      }
      a4=document.form1.ans4.value;
      if(a4.length<1) {
        alert("Please Enter Answer4");
        document.form1.ans4.focus();
        return false;
      }
      at=document.form1.true_ans.value;
      if(at.length<1) {
        alert("Please Enter True Answer");
        document.form1.true_ans.focus();
        return false;
      }
      return true;
    }
  </script>
  
</head>
<body>

  <h3 style='text-align:center'>Add Question</h3>

  <div>
    <form name="form1" method="post" onSubmit="return validate();">
      <table align="center">
        <tr>
          <td><div align="center"><strong>Select&nbsp;Test&nbsp;Name </strong></div></td>
          <td>  
            <td>
              <select name="testid" id="testid">
                <?php
                $query2 = "SELECT * FROM exam_test order by test_name";
                $result2=mysqli_query($conn,$query2);
                while($row=mysqli_fetch_array($result2))
                {

                  echo "<option value='$row[0]' selected>$row[2]</option>";
                }

                ?>
              </select>
            </td>
          </td>
        </tr>

        <tr>
          <td><strong> Enter&nbsp;Question </strong></td>
          <td>&nbsp;</td>
          <td><textarea name="ques_desc" cols="40" rows="2" id="addque"></textarea></td>
        </tr>
        <tr>
          <td><strong>Enter&nbsp;Answer1 </strong></td>
          <td>&nbsp;</td>
          <td><input name="ans1" type="text" id="ans1" size="43" maxlength="85"></td>
        </tr>
        <tr>
          <td><strong>Enter&nbsp;Answer2 </strong></td>
          <td>&nbsp;</td>
          <td><input name="ans2" type="text" id="ans2" size="43" maxlength="85"></td>
        </tr>
        <tr>
          <td><strong>Enter&nbsp;Answer3 </strong></td>
          <td>&nbsp;</td>
          <td><input name="ans3" type="text" id="ans3" size="43" maxlength="85"></td>
        </tr>
        <tr>
          <td><strong>Enter&nbsp;Answer4</strong></td>
          <td>&nbsp;</td>
          <td><input name="ans4" type="text" id="ans4" size="43" maxlength="85"></td>
        </tr>
        <tr>
          <td><strong>Enter True Answer </strong></td>
          <td>&nbsp;</td>
          <td><input name="true_ans" type="text" id="anstrue" size="5" maxlength="50"></td>
        </tr>
        <tr>
          <td><input type="submit" name="submit" value="Add" ></td>
        </tr>
      </table>
    </form>
  </div>
  <?php  if (count($notify) > 0) : ?>
    <div>
      <?php foreach ($notify as $noti) : ?>
        <p align='center'><?php echo $noti ?></p>
      <?php endforeach ?>
    </div>
  <?php  endif ?>

</body>
</html>