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
    <div class="main-navbar-wrap">
        <div class="main-navbar">
            <a href="../" class="icon company-logo"></a>
            <a href="../" class="input-wrap" autocomplete="off">
                <span class="icon search-icon autocomplete"></span>
                <input type="search" placeholder="Search" class="search-bar" name="s" id="search_des">
                <span class="icon qrcode-icon"></span>
            </a>
            <ul class="nav-icons">
                <a href="../" class="icon home-icon " title="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px" height="30px">
                        <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 15 L 14 15 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z"></path>
                    </svg>
                </a>
                <a href="../request/" class="icon" title="My Network">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends" class="svg-inline--fa fa-user-friends fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="31px" height="31px">
                        <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"></path>
                    </svg>
                </a>
                <a href="../create_post/" class="icon " title="Add Post">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="28px">
                        <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                    </svg>
                </a>
                <a href="../chatall" class="icon" title="Message">
                    <svg aria-hidden="true" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-7x" width="28px" height="26px">
                        <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                    </svg>

                </a>
                <a href="../noti" class="icon" title="Notifications">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="26px">
                        <path d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                    </svg>
                </a>
                <span href="#" class="icon profile-icon work-cont">
                    <img src="<?php if($_SESSION['img']){ echo '../profile/i/240/'.$_SESSION['img'];}else{ echo "../profile/i/none.svg"; } ?>">
                    <div class="desk-menu">
                        <div class="sidebar desktop-menu">
                            <a href="../account" class="profile-img-sidebar">
                                <img class="avatar" src="<?php if($_SESSION['img']){ echo '../profile/i/240/'.$_SESSION['img'];}else{ echo "../profile/i/none.svg"; } ?>" alt="">
                                <span class="moon"></span>
                                <p>
                                     <?php echo $_SESSION['name'];?>  <br>
                                </p>
                                <img class="down expand-add-acc" src="../SVG/chevron-down-solid.svg" alt="">
                            </a>
                            <div class="all-uls">
                                <ul>
                                    <li>
                                        <a href="../account">
                                            <img src="../SVG/user-edit-solid.svg" alt="" />
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../manage_category/">
                                            <img src="../SVG/list-alt-solid.svg" alt="" />
                                            <span>Manage List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/activity">
                                            <img src="../SVG/clock-solid.svg" alt="" />
                                            <span>My activity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/saved_posts">
                                            <img src="../SVG/save-black.svg" alt="" /> <span>Saved posts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/settings">
                                            <img src="../SVG/cog-solid.svg" alt="" />
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  onclick="share(' <?php echo $_SESSION['name'];?>','Follow <?php echo $_SESSION['name'];?> on Yaariii','https://Yaariii.com/account?user=<?php echo $_SESSION['id'];?>')">
                                            <img src="../SVG/share-black.svg" alt="" />
                                            <span>Share Your Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/logout">
                                            <img src="../SVG/power-off-solid.svg" alt="" />
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </span>
            </ul>
        </div>
    </div>
    
    
    
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