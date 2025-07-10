
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up page</title>
    <link rel="stylesheet" href="loginpage.css">
 </head>
 <body>
    <div class="signupdiv">
        <body class="body_fom">
            <p class="welcome_note">Account Registration</p>  
            <p class= "fill_details">To sign up, kindly fill the form below</p>
            <form action="" method="post" class="login_form">
               <label for="username" class="usernamelabel">Username</label><br><br>
               <input type="text" name="username" placeholder="Enter Username/Employee No" required class="usernameplaceholder"><br><br>
               <label for="email" class="emaillabel">Enter your email</label><br><br>
               <input type="email" name = "email" placeholder="Enter your email"required class="emailplaceholder" >  <br><br>
               <label for="password" class="passwordlabel" >Password</label><br><br>
               <input type="password" name = "password" placeholder="Enter your password" required class="passwordplaceholder" minlength="5" maxlength="12">  <br><br>
             <label for="password" class="passwordlabel">Confirm your password</label><br><br>
               <input type="password" name = "confirmpassword" placeholder="Confirm your password" required class="passwordplaceholder" minlength="5" maxlength="12">  <br><br>
               
               <label for="Role">Role</label><br>
            <select id="Role" name="Role" class="roleselect">
                <option value="student">Student</option>
                <option value="employee">Lecturer</option>
                <option value="admin">Admin</option>
            </select><br><br>
               
               <button class="submit" name="save">submit</button> <br><br>

            

            <p>Already have an account? <a href="login.php">   <span class="signinredirection">Sign in </span></a> </p>
                
               </form>
<?php
if(isset($_POST['save'])){
   include 'db.php';
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $confirmpassword = $_POST['confirmpassword']; 
   $Role = $_POST['Role'];

   // Check if passwords match
   if($password === $confirmpassword){

  // Insert user into the appropriate table based on role
  if($Role === 'student') {
    $qry = "INSERT INTO users (username, email, password, Role) VALUES ('$username', '$email', '$password','$Role')";
} elseif($Role === 'employee') {
    $qry = "INSERT INTO employee (username, email, password, Role) VALUES ('$username', '$email', '$password','$Role')";
} 

elseif($Role === 'admin') {
    $qry = "INSERT INTO admins (username, email, password, Role) VALUES ('$username', '$email', '$password','$Role')";
} 

else {
    echo "<script>alert('Invalid role');</script>";
    exit();
}

      
       $result = $conn->query($qry);


       
       if($result == TRUE){
           echo "<script>alert('Signup successful'); window.location.href='login.php';</script>";
       } else {
           echo "<script>alert('Signup not successful'); window.location.href='signup.php';</script>";
       }
   } else {
      
       echo "<script>alert('Passwords do not match'); window.location.href='signup.php';</script>";
   }
}
?>

    </div>
   
 </body>
 </html>