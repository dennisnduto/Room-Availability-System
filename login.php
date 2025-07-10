<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="loginpage.css">
</head>

<body class="body_fom">
   
 <div class="signupdiv">
 
    <p class="welcome_note">Hi, welcome back</p>  
    <p class= "fill_details">please fill in your details to log in</p>
    <form action="" method="post" class="login_form">
       <label for="username" class="usernamelabel">Username</label><br><br>
       <input type="text" name="username" placeholder="Enter Username/Employee No" required class="usernameplaceholder" minlength="2" maxlength="20"> <br><br>
       <label for="password" class="passwordlabel">Password</label><br><br>
       <input type="password" name = "password" placeholder="Enter your password"  required class="passwordplaceholder" minlength="4" maxlength="20">  <br><br>
      
        
            <label for="Role">Role</label><br>
            <select id="Role" name="Role" class="roleselect">
                <option value="student">Student</option>
                <option value="employee">Lecturer</option>
                <option value="admin">Admin</option>
            </select><br><br>
       
       <input type="checkbox" > Remember me
       <a href="resetpassword.html"> Forgot password?</a> <br><br>
       <button class="sign_inbtn" name="log">sign In</button>
       <p>Don't have an account?<a href="signup.php" class="signupspan" > Sign up</span></p>
    </form>
    <?php
session_start();

if(isset($_POST['log'])){
    include 'db.php';

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $Role = $conn->real_escape_string($_POST['Role']);

    // Determine the table based on the selected role
    $table = ($Role == 'student') ? 'users' : (($Role == 'employee') ? 'employee' : 'admins');
$qry = "SELECT * FROM $table WHERE username = '$username'";

    $result = $conn->query($qry);

   
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        // Verify password 
        if($password === $row['password']){
            
            $_SESSION['username'] = $username;
            if($row['Role'] == 'student') {
                header("Location: studentpage.php");
            } elseif($row['Role'] == 'employee') {
                header("Location: lecturerside.php");
            } 
            elseif($row['Role'] == 'admin') {
                header("Location: admin\index.php");
            }
            else {
                
                echo "<script>alert('Unknown role');window.location.href='login.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Incorrect username or password');window.location.href='login.php';</script>";
    }
}
?>

    </div>
</body>
</html>