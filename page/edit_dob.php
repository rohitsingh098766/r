<?php
session_start();
include '../connection.php';
  if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


if(isset($_POST['submitted'])){
    
   $date = mysqli_real_escape_string($connection,$_POST['date']);
$month = mysqli_real_escape_string($connection,$_POST['month']);
$year = mysqli_real_escape_string($connection,$_POST['year']);
    
    $query = "UPDATE yaarme.users SET
`DOB_date` = '{$date}',
`DOB_month` = '{$month}',
`DOB_year` = '{$year}'
WHERE `users`.`id` = {$_SESSION['id']};";
// echo $query;
if(mysqli_query($connection,$query)){
 header('Location: ../account');
exit;
}else{
// echo"something went wrong ";
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
                <img src="../edit_profile/CSS/Images/Yaarme-logo.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">Yaar</b><b>Me</b>
                </div>

            </div>
          
            <form class="multi-stage" autocomplete="off" id="form" method="post" >
               

              
                
                <div class="forms">
                    <div class="form-heading">
                        <span class="svg-icon pers"></span>
                        <span>Update date of birth</span>
                    </div>
                    
                    <div class="date-wrap">
                        <div class="input-wrap">
                            <select class="fields" name="date" id="date" required>
                                <option value="" selected disabled></option>
                            </select>
                            <span class="label select">Date</span>
                        </div>
                        <div class="input-wrap month">
                            <select class="fields" name="month" id="month" required>
                                <option value="" selected disabled></option>
                            </select>
                            <span class="label select">Month</span>
                        </div>
                        <div class="input-wrap">
                            <select class="fields" name="year" id="year" required>
                                <option value="" selected disabled></option>
                            </select>
                            <span class="label select">Year</span>
                        </div>
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
// Filling in Date
for(var i = 1; i <= 31; i++){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    date.appendChild(option);
}

// Filling in Month
var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
for(var i = 0; i < 12; i++){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = months[i];
    month.appendChild(option);
}

// Filling in Year
for(var i = 2020; i >= 1940; i--){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    year.appendChild(option);
}
        
    </script>
</body>
</html>