<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="icon" type="image/png" href="img/aside-logo.png">
    <title>Login</title>
        <style>
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 66%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .field {
            position: relative;
        }
    </style>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              include("./auth/connect.php");
              if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($conn,$_POST['email']);
                $password = mysqli_real_escape_string($conn,$_POST['password']);

                $result = mysqli_query($conn,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['id'] = $row['Id'];
                }else{
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['valid'])){
                    header("Location: home.php");
                }
              }else{

            
            ?>
            <div class="col-12">
                <div class="message" style="font-size: 25px; font-weight: bold;">
                    <p>GTM DATA</p>
                </div>
            </div>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
      <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.textContent = '👁‍🗨'; // Change icon to indicate password is visible
            } else {
                passwordField.type = 'password';
                toggleIcon.textContent = '👁'; // Change icon to indicate password is hidden
            }
        }
    </script>
</body>
</html>