<?php
    session_start();
    include("db.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $uname = $_POST['name'];
        $gmail = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['Confirmpassword'];

        // Ensure email is in the correct format
        if (!empty($gmail) && filter_var($gmail, FILTER_VALIDATE_EMAIL) && (strstr($gmail, '@gmail.com') !== false || strstr($gmail, '@giet.edu') !== false) && !empty($pass) && !is_numeric($gmail) && ($pass == $cpass)) {
            
            // No password hashing in this version
            
            // Use prepared statements to prevent SQL injection
            $query = "INSERT INTO register (name, email, password, confirmpassword) VALUES (?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'ssss', $uname, $gmail, $pass, $cpass); // Don't hash the password
            mysqli_stmt_execute($stmt);

            echo "<script type='text/javascript'>alert('Successfully Registered')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Please enter valid information or make sure email and passwords match')</script>";
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="login.php">
    <title>Signup</title>
</head>
<body>
   
<div class="center">
<h3>Signup</h3>
<form  method="post">
      <div class="txt_field">
        <input type="text" name="name" required >
        <span></span>
        <label>Username</label>
      </div>

      <div class="txt_field">
        <input type="text" name="email"  required >
        <span></span>
        <label>Email</label>
      </div>

      <div class="txt_field">
        <input type="password" name="password"  required >
        <span></span>
        <label>Password</label>
      </div>
    <div class="txt_field">
        <input type="password" name="Confirmpassword"  required >
        <span></span>
        <label>Confirm Password</label>
        </div>
        <div>
        <input type="submit" name="" value="signup">
        </div>
      <div class="signup_link">
      Already have Account?<a href="login.php">Login</a>
      </div>
    </form>
  </div>
</body>
</html>