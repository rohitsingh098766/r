<?php
session_start();
include '../connection.php';
  if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


if(isset($_GET['delete'])){
$delete = mysqli_real_escape_string($connection,$_GET['delete']);
$query = "DELETE FROM yaarme.about WHERE (`about`.`id` = {$delete} and `about`.`user` = {$_SESSION['id']})";
// echo $query;
if(mysqli_query($connection,$query)){
header('Location: ../account?edit=1');
exit(0);
}
}

 $saved_opinion = '';
      $saved_degree = '';
if(isset($_GET['edit'])){
$edit = mysqli_real_escape_string($connection,$_GET['edit']);

    $query_show = "SELECT * FROM yaarme.about WHERE (`about`.`id` = {$edit} and `about`.`user` = {$_SESSION['id']})" ;
$result_show = mysqli_query($connection,$query_show);
while($row_show = mysqli_fetch_assoc($result_show)){
    $saved_opinion = $row_show['my_opinion'];
      $saved_degree = $row_show['position'];
}
    
}


if(isset($_POST['submitted'])){
    
    
   $date = mysqli_real_escape_string($connection,$_POST['date']);
$year = mysqli_real_escape_string($connection,$_POST['year']);
    
if(isset($_GET['edit'])){
$edit = mysqli_real_escape_string($connection,$_GET['edit']);
 $query = "UPDATE `about` SET 
    `position` = {$date},
    `my_opinion` =   '{$year}'
    WHERE (`about`.`id` = {$edit} and user = {$_SESSION['id']});";
}else{
    
    $query = "INSERT INTO yaarme.about (`user`, `about_code`,  `position`, `my_opinion`) VALUES ( {$_SESSION['id']}, 9,  '{$date}','{$year}');";
}

// echo $query;
//    exit;
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
    <title>Contact details </title>
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
                <img src="../icons/logo/logo_transparent.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">YAARIII</b><b></b>
                </div>

            </div>
          
            <form class="multi-stage" autocomplete="off" id="form" method="post" >
               

              
                
                <div class="forms">
                    <div class="form-heading">
<!--                        <span class="svg-icon pers"></span>-->
                        <span>Contact details</span>
                    </div>
                    
                    <div class="input-wrap">
                        <input type="text" class="fields" id="first_name" name="date" required="" value="<?php echo $saved_degree;?>">
                        <span class="label">E-mail / contact no.</span>
                        
                    </div>
                    <div class="input-wrap">
                        <textarea type="text" class="fields" id="summary" name="year" required="" onkeydown="autosize('summary')" maxlength="350" style="height: calc(69px);"  placeholder="Add a note..."><?php echo $saved_opinion;?></textarea>
                        <span class="label"></span>
                    </div>


                    <div class="button-wrap">
                       <input type="hidden" name="submitted" value="oiuygf">
                        <button class="continue" name="submitted" onclick="document.getElementById('form').submit();">Add</button>
                    </div>
                    <br>
                </div>
               
            </form>
             <?php 
            if(isset($_GET['edit'])){
echo '<a href="?delete='.$_GET['edit'].'" id="skipall" >Delete this contact detail</a>';
            }
            ?>
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