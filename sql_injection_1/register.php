<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>SQL Injection Sample</title>
      <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="css/custom.css" rel="stylesheet">
   </head>
   <body>
      
      
      <div class="sidenav">
         <div class="login-main-text">
            <h2>UIT NT205.K21 Forum<br> Registration Page</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form method="post" action="register.php">
                  <?php 
                     $error_message = '';
                     if($error_message != ''){ 
                  ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <!-- <strong>Error!</strong>  -->
                    <?php
                         
                        echo $error_message != '' ? $error_message : ''; 
                     ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php } ?>

                  <?php
                        $success_message = '';
                        if($success_message != '') {
                  ?>

                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <!-- <strong>Error!</strong>  -->
                    <?php
                         
                        echo $success_message != '' ? $success_message : ''; 
                     ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <?php 
                        }
                   ?>
      

                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" placeholder="User Name" name="username">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" placeholder="Password" name="password">
                  </div>
                  <div class="form-group">
                     <label>Confirm Password</label>
                     <input type="password" class="form-control" placeholder="Password" name="confirm_password">
                  </div>
                  <!-- <button type="submit" class="btn btn-secondary">Go to Login Page</button> -->
                  <a class="btn btn-secondary" href="login.php">Go to Login Page</a>
                  <button type="submit" name="submitBtn" class="btn btn-black">Register Here</button>
               </form>
               <?php
                  $conn = mysqli_connect("localhost", "root", "", "hacking_db");
                  if(!$conn){
                     die("connection error");
                  }

                  if(isset($_POST['submitBtn'])) {
                     $username = $_POST['username'];
                     $password = $_POST['password'];
                     
                     $confirm_password = $_POST['confirm_password']; 
                     if(trim($username) == '') {
                        $error_message = "Username can not be left empty!<br>";
                     }
                     else if(trim($password) == '') {
                        $error_message .= "Password can not be left empty!<br>";
                     }
                     else if(trim($confirm_password) == '') {
                        $error_message .= "Confirm password can not be left empty!<br>";
                     }
                     else if($password != $confirm_password) {
                        $error_message .= "Password and confirm password must be same!<br>";
                     } else {
                        // $password = password_hash($_POST['password'], PASSWORD_BCRYPT) ;
                        $insert_sql = "insert into `users`(username,password) values('$username','$password')";
                        mysqli_query($conn,$insert_sql);
                        if(mysqli_affected_rows($conn) > 0){
                           $success_message = "User registered successfully!<br>";
                        }
                        else{
                           $error_message .= "Error registering user, please try again later<br>";
                        }
                     } 
                  }
               ?>
            </div>
         </div>
      </div>
      
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      
   </body>
</html>