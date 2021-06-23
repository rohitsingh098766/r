<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}

$privacy = 'public';
$query="select * from yaarme.users where id = {$_SESSION['id']} and account_type = 1";
$result=mysqli_query($connection,$query);
if (mysqli_num_rows($result)){
$privacy = 'private';
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="css/settings.css">
    <!--icons-->
    <link rel="apple-touch-icon" sizes="57x57" href="../icons/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../icons/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../icons/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../icons/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../icons/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../icons/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../icons/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../icons/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../icons/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../icons/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/icons/favicon-16x16.png">
    <link rel="manifest" href="../icons/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#0073b1">
    <meta name="msapplication-TileImage" content="../icons/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#0073b1">
</head>

<body id="body" oncontextmenu="">
    
<!--desktop header-->
   <?php
     include '../php/desktop_header.php';
    ?>
    
    
    
    <div class="container-wrap">
        <div class="container">
            <div class="left-bar"></div>
            <div class="main-content">
                <div class="homepage-main-content">

                    <div class="settings_cart" onclick="open_id('change_privacy')">
                        <div class="settings_header">Privacy </div>
                        <div class="settings_subject">Your account is <span id="current_status"><?php echo $privacy;?></span></div>
                      <!--  <form >
                        
                            <input type="radio" id="male" name="gender" value="male">
<label for="male">Male</label><br>
<input type="radio" id="female" name="gender" value="female">
<label for="female">Female</label><br>
<input type="radio" id="other" name="gender" value="other">
<label for="other">Other</label>
                        </form>-->
                    </div>

                    <div class="settings_cart"  onclick="open_id('change_login')">
                        <div class="settings_header">Login Details </div>
                        <div class="settings_subject">Change your username or password</div>
                    </div>

                </div>
            </div>
            <div class="right-bar"></div>
        </div>
    </div>
               <div class="my_options " id="change_privacy">
                   <div class="my_options my_options_block" onclick="close_id('change_privacy')">
                   </div>
                   <div class="items item_post" style="">
                       <div class="choose" id="make_public">
                           <div class="settings_header">Public</div>
                           <div class="settings_subject">Anyone can follow you, however you can remove them anytime.<br>Anyone can watch your post, story, followers-followings.</div>
                       </div>
                       <div class="choose" id="make_private">
                           <div class="settings_header">Private</div>
                           <div class="settings_subject">People can follow you only after your approval.<br>Only your followings can watch your post, story, followers-followings. </div>
                       </div>
                   </div>
               </div>
    <div class="my_options " id="change_login">
                   <div class="my_options my_options_block" onclick="close_id('change_login')">
                   </div>
                   <div class="items item_post" style="">
                       <a href="./edit_username">
                       <div class="choose" onclick="close_id('change_login')">
                           <div class="settings_header">Change Username</div>
                       </div>
                           </a>
                       <a href="./edit_password">
                       <div class="choose" onclick="close_id('change_login')">
                           <div class="settings_header">Change Password</div>
                       </div>
                       </a>
                   </div>
               </div>
                    
                    

    
<!--    mobile header-->
    <div class="mobile-header">
        <a href="../" class="icon me-icon">
           <svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" data-supported-dps="24x24" fill="black" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"></path></svg>
        </a>
        <span class="">
            <label class="white" for="button_post_desk">Settings</label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>
    
    <script>
        function open_id(id) {
            document.getElementById(id).classList.add('active')
        }

        function close_id(id) {
            document.getElementById(id).classList.remove('active')
        }

        //ajax
        function my_ajax(url, post_data) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(post_data);
        }

        document.getElementById('make_public').addEventListener('click', function() {
            document.getElementById('current_status').innerHTML = "public";
            close_id('change_privacy');
            my_ajax("../php/change_privacy.php", "change=0");
        })
        document.getElementById('make_private').addEventListener('click', function() {
            document.getElementById('current_status').innerHTML = "private";
            close_id('change_privacy');
            my_ajax("../php/change_privacy.php", "change=1");
        })
    </script>
</body>
<script src="js/like.js"></script>
</html>