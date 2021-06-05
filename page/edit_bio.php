<?php
session_start();
include '../connection.php';
  if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


if(isset($_POST['submitted'])){
$bio = mysqli_real_escape_string($connection,$_POST['bio']);
     $query = "UPDATE yaarme.users SET
`status_mini_bio` = '{$bio}'
WHERE `id` = {$_SESSION['id']};";
if(mysqli_query($connection,$query)){
header('Location: ../account?edit=1');
exit;
}
    
}
  

          ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | YaarMe</title>
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
                <img src="../icons/logo/logo_transparent.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">YAARIII</b><b></b>
                </div>

            </div>
          
            <form class="multi-stage" autocomplete="off" id="form" method="post" >
               

              
                
                <div class="forms">
                    <div class="form-heading">
                        <span class="svg-icon pers"></span>
                        <span>Update bio</span>
                    </div>
                    
                    <div class="input-wrap">
                        <textarea type="text" class="fields" id="bio" name="bio" required onkeydown="autosize('bio')" maxlength="350"></textarea>
                        <span class="label">Bio</span>
                    </div>
                    

                    <div class="button-wrap">
                       <input type="hidden" name="submitted" value="oiuygf">
                        <button class="continue" name="submitted" onclick="document.getElementById('form').submit();">Save</button>
                    </div>
                    <br>
                </div>
               
            </form>
        </div>
    </div>
    <div class="hide load_anything"></div>
    <script>
    function autosize(getEleId) {
    setTimeout(function () {
        el = document.getElementById(getEleId);
        el.style.cssText = 'height:auto; padding:.75em 1em';
        el.style.cssText = 'height:calc(' + (el.scrollHeight) + 'px +  2px);';
    }, 100);
}
autosize();
    </script>
</body>
</html>