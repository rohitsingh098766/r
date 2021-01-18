<?php
session_start();
include '../connection.php';
  if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


if(isset($_POST['submitted'])){
$login_password = mysqli_real_escape_string($connection,$_POST['pass']);
    $login_password = password_hash($login_password, PASSWORD_DEFAULT);
     $query = "UPDATE yaarme.users SET
`key_` = '{$login_password}'
WHERE `id` = {$_SESSION['id']};";
if(mysqli_query($connection,$query)){
    $id = $_SESSION['id'];
    setcookie("user_id[$id]", $login_password, time() + (86400 * 364),'/');
header('Location: ./settings');
exit(0);
}
    
}
  

          ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link rel="icon" type="image/x-icon" href="CSS/Images/Yaarme-logo.png">

    <link rel="stylesheet" href="../CSS/spin_loader.css">
    <link rel="stylesheet" href="../login/CSS/style.css">
    <link rel="stylesheet" href="../edit_profile/CSS/style.css">

    <!--icons-->
    <link rel="apple-touch-icon" sizes="57x57" href="../icons/icons/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="../icons/icons/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="../icons/icons/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../icons/icons/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="../icons/icons/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../icons/icons/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="../icons/icons/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../icons/icons/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/icons/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="../icons/icons/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/icons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="../icons/icons/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/icons/favicon-16x16.png" />
    <link rel="manifest" href="../icons/icons/manifest.json" />
    <meta name="msapplication-TileColor" content="#0073b1" />
    <meta name="msapplication-TileImage" content="../icons/icons/ms-icon-144x144.png" />
    <meta name="theme-color" content="#0073b1" />
</head>

<body>
    <div class="container">
        <div class="loader">
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="main-login hide" id="login-form">

        </div>
        <div class="main-signup " id="signup-form">
            <div class="header">
                <img src="../edit_profile/CSS/Images/Yaarme-logo.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">Yaar</b><b>Me</b>
                </div>

            </div>
          
            <form class="multi-stage" autocomplete="off" id="form" method="post" onsubmit="return validateForm()" name="myForm">
               

              
                
                <div class="forms">
                    <div class="input-wrap">
                        <input type="password" class="fields password" name="pass" id="login_password" title=" Password" required>
                        <span class="label">Password</span>
                    </div>
                     <div class="input-wrap">
                        <input type="password" class="fields password" name="repass" id="login_password_again" title="Repeat Password" required>
                        <span class="label">Repeat Password</span>
                    </div>
                   

                    <label class="button-wrap" for="submit">
                       <input type="hidden" name="submitted" value="oiuygf">
                        <button class="continue" name="submitted" type="submit" id="submit">Save</button>
                    </label>
                    <br>
                </div>
               
            </form>
        </div>
    </div>
    <div class="hide load_anything"></div>
    
    <script>
    function validateForm() {
  var x = document.forms["myForm"]["pass"].value;
  var y = document.forms["myForm"]["repass"].value;
  if (x != y) {
    alert("Passwords are not same");
    return false;
  }
}
    </script>
    
</body>
</html>