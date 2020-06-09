<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>SQL Injection Sample</title>
   </head>
   <body>
      <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="css/custom.css" rel="stylesheet">
      <script src="js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      <div class="sidenav">
         <div class="login-main-text">
            <h2>UIT NT205.K21 Forum<br> Login Page</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form method="post" action="login.php">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" placeholder="User Name" name="username">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" placeholder="Password" name="password">
                  </div>
                  <button type="submit" class="btn btn-black" name="loginBtn">Login Here</button>
                  <a class="btn btn-secondary" href="register.php">Go to Register Page</a>

                  <a href="forgot_password.php?message=Email" class="btn btn-link">Forgot Your Password?</a>
               </form>
               <?php
                  if(isset($_POST['loginBtn'])) {
                     $conn = mysqli_connect("localhost", "root", "", "hacking_db");
                     if(!$conn){
                        die("connection error");
                     }
                     $username = $_POST['username'];
                     $password = $_POST['password'];
                     
                     if(trim($username) == '') {
                        echo "Username can not be left empty!";
                     }
                     else if(trim($password) == '') {
                        echo "Password can not be left empty!";
                     }
                        
                     else{
                        // $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT) ;
                        $verify_sql = "select * from `users` where username='$username' and password='$password'";
                        $result = mysqli_query($conn,$verify_sql);
                        
                        $row = mysqli_fetch_array($result);
                        
                        if(mysqli_num_rows($result) > 0){

                           // if (password_verify($password, $row['password'])) {
                              $_SESSION['session_username'] = $username;
                              header('Location: dashboard.php');
                           // }
                           /*else {
                              echo 'Incorrect password, please try again!';
                           }*/
                        }
                        else{
                           echo "No user exists, please register to continue!";
                        }
                        mysqli_close($conn);
                        echo $verify_sql;

                     }
                  }
               ?>
            </div>
         </div>
      </div>
   </body>
</html>