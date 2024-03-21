<?php
   include("db.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from 
      $myusername = mysqli_real_escape_string($con, $_POST['email']);
      $mypassword = mysqli_real_escape_string($con, $_POST['password']); 
      
      $sql = "SELECT id FROM register WHERE email = '$myusername' and password= '$mypassword'";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result); // Removed MYSQLI_ASSOC
      
      $count = mysqli_num_rows($result);
     
      if($count == 1) {
         header("location: ../solution.php");
      } else {
         // Check if the user is not found and redirect to signup page
         echo "<script type='text/javascript'>alert('Your Login Name or Password is invalid. Redirecting to signup page.')</script>";
         echo "<script>setTimeout(function(){ window.location.href = 'signup.php'; }, 2000);</script>";
      }
   }
?>



<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./login.css">
    <!-- <link rel="stylesheet" href="signup.html"> -->
  </head>
  <body>
    <div class="center">
      <h3>Login</h3>
      <form  method="post" action="./login.php">

        <div class="txt_field">
          <input type="text" name="email"  required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password"  required >
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">
          <input type="submit" name="" value="Login">
          <h6><a href="#"> Forgot Password?</a></h6>
        </div>
        <div class="signup_link">
          Not a member? <a href="./signup.php">Signup</a>
        </div>
      </form>
    </div>

    

  </body>
</html>
