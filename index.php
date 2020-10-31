<?php
session_start();

if (isset($_SESSION['login'])){

  header("location:sublist.php");
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

  $errors = array();

  if(isset($_POST['submit'])){
    include'conn.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if( empty($email)|| empty($password)) 
    {

      array_push($errors,"All field must be filled");
    }

    $user_check_query = "SELECT * FROM user WHERE email='$email' and password='$password'";
    
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $conn->close();

    if($user['email']==$email and $user['password']==$password){
      $_SESSION['login'] = $user['user_id'];
      $_SESSION['name'] = $user['name'];
      header("location:sublist.php");

      
    }
    else{
      array_push($errors, "Email or Password Incorrect");
    }
  }

  ?>
  <?php include 'header.php';?>


  <div class="main">
    <h1 style="text-align: center;">User Login</h1>
    <div class="segment">
      <form action="" method="post" novalidate>
        <table class="tbl" style=" padding-top: 40px">
         <tr>
           <td>E-mail:</td>
           <td><input name="email" id="email" type="text" required="" placeholder="Enter Email"></td>
         </tr>
         <tr>
           <td>Password:</td>
           <td><input name="password" id="password" type="password" required="" placeholder="Enter Password"></td>
         </tr>
         <tr>
          <td>
           <td class="button_class"><input name="submit" type="submit" value="Login">
           </td>
         </tr>
       </table>
     </form>

     <br/>
     <?php if (count($errors) > 0) : ?>
      <div>
        <?php foreach ($errors as $error) : ?>
          <p style="color:red;text-align: center;"><?php echo $error ?></p>
        <?php endforeach ?>
      </div>
    <?php  endif ?>

  </div>

</div>

<?
include 'footer.php';
?>