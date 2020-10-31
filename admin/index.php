<!doctype html>
<html>
<head>
  <title>Online Exam System</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <section class="header">Adminitration Panel</section>
  
  <div class="main">
    <h1 style="text-align: center;">Admin Login</h1>
    <div class="segment">
      <form action="dashboard.php" method="post">
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
  

   </div>

 </div>

 <?
 include 'footer.php';
 ?>