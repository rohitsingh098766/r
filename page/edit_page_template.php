<?php
session_start();
include '../connection.php';
  if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


if(isset($_POST['submitted'])){
    
   $date = mysqli_real_escape_string($connection,$_POST['date']);
$year = mysqli_real_escape_string($connection,$_POST['year']);
    
//    echo $date.$year;
//    exit();

    $query = "INSERT INTO yaarme.about (`user`, `about_code`,  `position`, `my_opinion`) VALUES ( {$_SESSION['id']}, 8,  '{$date}','{$year}');";
// echo $query;
if(mysqli_query($connection,$query)){
    
}  


    

header('Location: ../account');
exit;
    
}
  

          ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add other social media </title>
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
        <div class="main-login hide" id="login-form"></div>
        <div class="main-signup " id="signup-form">
             <div class="header">
                <img src="../icons/logo/logo_transparent.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">YAARIII</b><b></b>
                </div>

            </div>
            <h2 class="heading" style="font-size: 1.25em;">Sign Up</h2>
            <div class="progress-bar">
                <span class="number finished" id="n-1">1</span>
                <span class="line" id="l-1"></span>
                <span class="number" id="n-2">2</span>

            </div>
            <div class="multi-stage">
                <form action="" class="forms" autocomplete="off" spellcheck="false">
                    <div class="form-heading">
                        <span class="svg-icon pers"></span>
                        <span>Name</span>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="first_name" name="first_name" required>
                        <span class="label">First name</span>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="fields " id="last_name" name="last_name" required>
                        <span class="label">Last name</span>
                    </div>

                    <div class="button-wrap">
                        <div data-id="1" class="continue">Continue</div>
                    </div>
                </form>

                <form action="" class="forms" autocomplete="off" spellcheck="false" id="signup_username">
                    <div class="form-heading">
                        <span class="svg-icon account"></span>
                        <span>Set up login Details </span>
                    </div>
                    <span class="note note-plus">Please take a username for sign up.</span>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="uname" name="uname" required>
                        <span class="label">Username</span>
                    </div>
                    <span class="note" id="warning"> Username can use only letters, numbers, underscore and dot. </span>
                    <span class="note note-check"> this is unavailable</span>
                    <div class="input-wrap">
                        <input type="password" class="fields password" id="pass" name="upass" required>
                        <span class="label">Password</span>
                    </div>

                    <div class="button-wrap">
                        <div data-id="1" class="previous">Previous</div>
                        <input type="submit" class="signup-button" value="Sign up">
                    </div>
                    <br>
                </form>








            </div>
        </div>
    </div>




    <div class="hide load_anything"></div>
    <script src="js/about.js"></script>




</body>

</html>