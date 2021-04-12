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
     $query_inspect = "select * from yaarme.about where (user = {$_SESSION['id']} and about_code = 8) order by id asc limit 1";
    $result_inspect = mysqli_query($connection,$query_inspect);
  while($row_inspect = mysqli_fetch_assoc($result_inspect)){
    $query_set = "UPDATE `about` SET `share_with` = {$row_inspect['share_with']}, `connect_privacy` = {$row_inspect['connect_privacy']} WHERE (user = {$_SESSION['id']} and about_code = 8)";
      if(mysqli_query($connection,$query_set)){
      }
}
}  


    

header('Location: ../account?edit=1');
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
    <style>
    .date-wrap .input-wrap:last-of-type {
    flex: 3;
}
    </style>
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
<!--                        <span class="svg-icon pers"></span>-->
                        <span>Add other social media profiles</span>
                    </div>
                    
                    <div class="date-wrap">
                        <div class="input-wrap">
                            <select class="fields" name="date" id="date" required>
                                <option value="" selected ></option>
                            </select>
                            <span class="label select">Profile</span>
                        </div>
                        <div class="input-wrap month">
                            <input type="text" class="fields" id="summary" name="year" required="" onkeydown="autosize('summary')" maxlength="350"></input>
                            <span class="label select">Profile link</span>
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

        
var social_media = ["Facebook","Instagram","Twitter","LinkedIn","Youtube","Whatsapp","Snapchat","Telegram","Github","Website"];
for(var i = 0; i < 10; i++){
    var option = document.createElement('option');
    option.value = social_media[i];
    option.innerHTML = social_media[i];
    date.appendChild(option);
}

        
    </script>
</body>
</html>