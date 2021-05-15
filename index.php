<?php
     session_start();
     include './connection.php';
   if(!isset($_SESSION['id'])){include './login/check_coockie.php';}
//echo   $_SESSION['name'].$_SESSION['img'];
?>
<?php
                                    
                                    $list_show = 1;
                                        if(isset($_GET['t'])){
                                            $post_type = $_GET['t'];
                                             setcookie("t", $_GET['t'], time() + (86400 * 364),'/');
                                            if($post_type==5){
                                               setcookie("list", $_GET['l'], time() + (86400 * 364)); 
                                                $list_show = $_GET['l'];
                                            }
                                            
                                        }else if(isset($_COOKIE['t'])){
                                            $post_type = $_COOKIE['t'];
                                            
                                             if($post_type==5){
                                               if(isset($_COOKIE['list'])){
                                                   $list_show = $_COOKIE['list'];
                                               }else{
                                                  $post_type = 1;
                                               }
                                                
                                            }
                                            
                                        }else{
                                             $post_type = 1;
                                           
                                        }
                                    if($post_type==1){
                                        $show_list =  "all followings";
                                    }else if($post_type==2){
                                        $show_list =  "selected lists";
                                    }else if($post_type==3){
                                        $show_list =  "unlisted followings";
                                    }else if($post_type==4){
                                        $show_list =  "muted followings";
                                    }
                                    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feed | YaarMe</title>
    <link rel="stylesheet" href="CSS/style.css?v=3" />
    <link rel="stylesheet" href="CSS/spin_loader.css" />
    <link rel="stylesheet" href="./search/CSS/style.css" />
    <link rel="stylesheet" href="CSS/slider.css" />
    <link rel="stylesheet" href="CSS/mobile_header.css" />
    <link rel="stylesheet" href="CSS/mobile_header.css" />
    <link rel="stylesheet" href="page/css/like.css">
    <script src="JS/app.js"> </script>
    <script src="JS/slider.js"> </script>

    <script src="JS/constructor.js"> </script>
    <!--icons-->
    <link rel="apple-touch-icon" sizes="57x57" href="./icons/icons/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="./icons/icons/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="./icons/icons/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="./icons/icons/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="./icons/icons/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="./icons/icons/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="./icons/icons/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="./icons/icons/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="./icons/icons/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="./icons/icons/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./icons/icons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="./icons/icons/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./icons/icons/favicon-16x16.png" />
    <link rel="manifest" href="./icons/icons/manifest.json" />
    <meta name="msapplication-TileColor" content="#0073b1" />
    <meta name="msapplication-TileImage" content="./icons/icons/ms-icon-144x144.png" />
    <meta name="theme-color" content="#0073b1" />
    <meta name="description" content="Sign up for free and start building your network.">
  <meta name="keywords" content="Yaarme, YaarMe, Yaar me, Social media, Build and organize your network">
</head>


<body id="body" oncontextmenu="">
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

    <div class="my_options">
        <div class="my_options" id="my_options"></div>
        <div class="items">
            <p class="select_category">Select lists to watch posts and stories only from them. </p>
            <form>
                <ul id="s_lists">

                    <?php
                    
                    $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']}";
               $query = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($query)){
      if($row['description']){
          $description = '<span>'.$row['description'].'</span>';
      }else{
          $description = '';
      }
      if($row['pin']){
          $pin1 = "select_me_selected";
          $pin2 = "display_flex";
      }else{
            $pin1 = "";
          $pin2 = "";
      }
      echo '      <li>
                        <div class="follow-conn select_tl" cd="'.$row['id'].'">
                            <img src="./emogi/128/'.$row['emoji'].'" class="follow-icon">
                                    <span class="conn-name">
                                        <span><b>'.$row['group_name'].'</b></span>
                                             '.$description.'
                                         </span>
                                    <span class="select_me '.$pin1.'">
                                <div class="inner_checked '.$pin2.'">&#10004;</div>
                            </span>
                        </div>
                    </li>';
  }
                    
                    
                    ?>
                    <div class="follow-conn ">

                        <a href="./manage_category" class="hint_crt">Click to manage labels.</a>

                    </div>


                    <li>
                        <a href="?t=2" class="follow-conn">

                            <button type="button" id="alter_button">APPLY</button>


                        </a>
                    </li>


                    <!--<li>
                        <a href="?t=1" class="follow-conn ">
                            <img src="./emogi/128/symbols/heart-suit.png" class="follow-icon">
                            <span class="conn-name cn">
                                <span><b>All</b></span>
                                <span>Watch posts from all following.</span>
                            </span>

                        </a>
                    </li>

                    <li>
                        <a href="?t=4" class="follow-conn ">
                            <img src="./emogi/128/symbols/muted-speaker.png" class="follow-icon">
                            <span class="conn-name cn">
                                <span><b>Muted</b></span>
                                <span>Watch posts from Muted Following</span>
                            </span>

                        </a>
                    </li>
                    <li>
                        <a href="?t=3" class="follow-conn ">
                            <img src="./emogi/128/human/man-astronaut-medium-dark-skin-tone.png" class="follow-icon">
                            <span class="conn-name cn">
                                <span><b>Unlisted</b></span>
                                <span>Everyone who are not listed yet.</span>
                            </span>

                        </a>
                    </li>-->
                    <!--
                    <li>
                        <a href="#" class="follow-conn ">
                            <img src="./emogi/128/nature/fire.png" class="follow-icon">
                            <span class="conn-name cn">
                                <span><b>Trending posts</b></span>
                                <span>Among Your following / in India.</span>
                            </span>

                        </a>
                    </li>
-->



                </ul>

            </form>
        </div>

    </div>

    <div class="sidebar">
        <div  class="profile-img-sidebar">
            <a  href="profile/"><img class="avatar" src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>" alt="" /></a>
            <a  href="profile/"><img class="moon" src="SVG/moon-solid.svg" alt="" /></a>
            <p>
                <a class="white"  href="profile/">  <?php echo $_SESSION['name'];?> <br /></a>
            </p>
            <img class="down expand-add-acc " src="SVG/chevron-down-solid.svg" alt="" />
            <!-- <i class="fas fa-chevron-down arrow expand-add-acc"></i> -->
        </div>
        <div class="all-uls">
            <ul class="add-account">
                 <li>
                    <a href="login/">
                        <img src="SVG/plus-solid.svg" alt="" /> <span>Add account</span>
                    </a>
                </li>
                 <?php
                
if (isset($_COOKIE['active_user'])){
    foreach ($_COOKIE['user_id'] as $user_id => $value) {
        if($user_id != $_COOKIE['active_user']){
                $query_verify = "SELECT * FROM `users` where id='{$user_id}'";
//        echo $query_verify;
               $result_verify = mysqli_query($connection,$query_verify);
//               echo"gor each9";
  while($row = mysqli_fetch_assoc($result_verify)){
     $password =  $row['key_'];
//    
     if ($password === $value && $value) {
//echo $row['first_name'].' '.$row['last_name'];
//                echo $row['img'];
         if($row['img']){
             $sidebar_other_profile = "./profile/i/120/".$row['img'];
         }else{
              $sidebar_other_profile = "./profile/i/none.svg";
         }
                echo ' <li>
                    <a href="login/switch.php?to='.$user_id.'">
                        <img src="'.$sidebar_other_profile.'" alt="" class="profile_sidebar"/>
                        <span>Switch to '.$row['first_name'].' '.$row['last_name'].'</span>
                    </a>
                </li>';
         
  }
                }
}
    }
}
                
                ?>
               
               
            </ul>
            
            <hr /> 
            <ul>
                <li>
                    <a href="profile/">
                        <img src="SVG/user-edit-solid.svg" alt="" />
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li>
                    <a href="manage_category/">
                        <img src="./SVG/tags-solid-black.svg" alt="" />
                        <span>Manage Labels</span>
                    </a>
                </li>
                <li>
                    <a href="page/activity">
                        <img src="SVG/clock-solid.svg" alt="" />
                        <span>My activities</span>
                    </a>
                </li>
                <li>
                    <a href="page/saved_posts">
                        <img src="SVG/save-black.svg" alt="" /> <span>Saved posts</span>
                    </a>

            </ul>
            <hr />
            
            <ul>
                <li>
                    <a href="page/settings">
                        <img src="SVG/cog-solid.svg" alt="" />
                        <span class="work-cont">Settings</span>

                    </a>
                </li>
                <li>
                    <a href="page/settings">
                        <img src="SVG/shield-alt-solid.svg" alt="" />
                        <span>Privacy</span>
                    </a>
                </li>
                <li>
                    <a href="page/settings">
                        <img src="SVG/lock-solid.svg" alt="" />
                        <span>Password</span>
                    </a>
                </li>
<!--
                <li>
                    <a href="#">
                        <img src="SVG/stumbleupon-circle-brands.svg" alt="" />
                        <span>Statics</span>
                    </a>
                </li>
-->
                <li>
                    <a href="page/settings">
                        <img src="" alt="" />
                        <span>More...</span>
                    </a>
                </li>
            </ul>
            <hr />
            <ul>
                <li >
                    <a href="#" onclick="share(' <?php echo $_SESSION['name'];?>','Follow <?php echo $_SESSION['name'];?> on YaarMe','https://yaarme.com/account?user=<?php echo $_SESSION['id'];?>')">
                        <img src="SVG/share-black.svg" alt="" />
                        <span>Share Your Profile</span>
                    </a>
                </li>
               
                <li>
                    <a href="page/faq">
                        <img src="SVG/question-circle-solid.svg" alt="" />
                        <span>YaarMe FAQ</span>
                    </a>
                </li>
                
                 <li >
                    <a href="page/logout" >
                        <img src="SVG/power-off-solid.svg" alt="" />
                        <span>Logout <?php echo $_SESSION['name'];?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php
    
     $query = "select *,COUNT(*) as num from yaarme.notification where user_id = {$_SESSION['id']} GROUP by category";
               $query = mysqli_query($connection,$query);
    $foll_alt = "";
    $msg_alt = "";
    $noti_alt = "";
  while($row = mysqli_fetch_assoc($query)){
     if($row['category']==1){
       $foll_alt = '<span class="badge"> '.$row['num'].' </span>'  ;
     }else if($row['category']==2){
       $msg_alt = '<span class="badge"> '.$row['num'].' </span>'  ;
     }else if($row['category']==3){
       $noti_alt = '<span class="badge"> '.$row['num'].' </span>'  ;
     }
  }
    $query = "DELETE FROM yaarme.notification WHERE user_id = {$_SESSION['id']}";
               $query = mysqli_query($connection,$query);
    
    ?>



    <div class="main-navbar-wrap">
        <div class="main-navbar">
            <a href="./" class="icon company-logo"></a>
            <form class="input-wrap" autocomplete="off">
                <span class="icon search-icon autocomplete"></span>
                <input type="search" placeholder="Search" class="search-bar" name="s" id="search_des" />
                <span class="icon qrcode-icon"></span>
            </form>
            <ul class="nav-icons">
                <a href="#" class="icon home-icon home-icon-active" title="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px" height="30px">
                        <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 15 L 14 15 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z"></path>
                    </svg>
                </a>
                <a href="request/" class="icon" title="My Network">
                    <?php echo $foll_alt;?>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends" class="svg-inline--fa fa-user-friends fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="31px" height="31px">
                        <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"></path>
                    </svg>
                </a>
                <a href="create_post/" class="icon" title="Add Post">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="28px">
                        <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                    </svg>
                </a>
                <a href="chatall" class="icon" title="Message">
                    <?php echo $msg_alt;?>
                    <svg aria-hidden="true" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-7x" width="28px" height="26px">
                        <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                    </svg>

                </a>
                <a href="noti" class="icon" title="Notifications">
                    <?php echo $noti_alt;?>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="26px">
                        <path d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                    </svg>
                </a>
                <span href="#" class="icon profile-icon work-cont">
                    <img src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>">
                    <div class="desk-menu">
                        <div class="sidebar desktop-menu">
                            <a href="./account" class="profile-img-sidebar">
                                <img class="avatar" src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>" alt="" />
                                <span class="moon"></span>
                                <p>
                                    <?php echo $_SESSION['name'];?> <br />
                                </p>
                                <img class="down expand-add-acc  opacaity0" src="SVG/chevron-down-solid.svg" alt="" />
                                <!-- <i class="fas fa-chevron-down arrow expand-add-acc"></i> -->
                            </a>
                            <div class="all-uls">
                                <!--<ul class="add-account">-->
                                <!--	<li >-->
                                <!--		<a href="#">-->
                                <!--			<img src="SVG/plus-solid.svg" alt="" /> <span>Add Account</span>-->
                                <!--		</a>-->
                                <!--	</li>-->

                                <!--</ul>-->
                                <ul>
                                    <li>
                                        <a href="profile/">
                                            <img src="SVG/user-edit-solid.svg" alt="" />
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="manage_category/">
                                            <img src="./SVG/tags-solid-black.svg" alt="" />
                                            <span>Manage Labels</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page/activity">
                                            <img src="SVG/clock-solid.svg" alt="" />
                                            <span>My activities</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page/saved_posts">
                                            <img src="SVG/save-black.svg" alt="" /> <span>Saved posts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page/settings">
                                            <img src="SVG/cog-solid.svg" alt="" />
                                            <span>Settings</span>

                                        </a>
                                    </li>



                                    <li>
                                        <a href="#" onclick="share(' <?php echo $_SESSION['name'];?>','Follow <?php echo $_SESSION['name'];?> on YaarMe','https://yaarme.com/account?user=<?php echo $_SESSION['id'];?>')">
                                            <img src="SVG/share-black.svg" alt="" />
                                            <span>Share Your Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page/logout">
                                            <img src="SVG/power-off-solid.svg" alt="" />
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
                    <div class="select_one_cont">
                         <div class="options">
                        <ul class="select_one" id="select_one_home">
                             <li>
                                 <a href="./?t=4"  class="select_element <?php if($post_type==4){echo  "active";}?>">Muted</a>

                            </li>
                              <li>
                                 <a href="./?t=3"  class="select_element <?php if($post_type==3){echo  "active";}?>">Unlabelled</a>

                            </li>
                           
                            <li>
                                <a href="./?t=1" class="select_element <?php if($post_type==1){echo  "active";}?>">Following</a>

                            </li>
                            
                            
                            <?php
                              $query = "SELECT * FROM `yaarme_follow`.`category` where (owner_id = {$_SESSION['id']}) " ;
    $result = mysqli_query($connection,$query);
                            
                           $colors = array("#ff8197",  "var(--blue)", "darkorange",  "#71bd21", "#cc00ff", "#067206");
//                            $total = count($colors);
                            $y = 0;
                            
                            
                            
                            if(mysqli_num_rows($result)>1){
                                
                                if($post_type==2){$echo_active =   "active";}else{$echo_active= '';}
                                echo '
                                <li>
                                <a href="./?t=2" class="select_element '.$echo_active.'">Favorite&nbsp;labels
                                </a>
                            </li>
                                ';
    }
                            
                             while($row = mysqli_fetch_assoc($result)){
                                 if($y==count($colors)){
                                    $y=0; 
                                 }
                                 
                                 if(($list_show == $row['id']) && ($post_type == 5)){
                                     $make_it_active = 'active';
                                 }else{
                                    $make_it_active = ''; 
                                 }
                                 
                                 echo '
                                    <li>
                                <a href="./?t=5&l='.$row['id'].'" class="select_element '.$make_it_active. '" style="color:'.$colors[$y].'">
                                    <img src="./emogi/128/'.$row['emoji'].'" class="tag_icon">'.str_replace(' ','&nbsp;', str_replace('  ',' ', htmlentities( preg_replace('/\r|\n/',' ', htmlentities($row['group_name']))))).'</a>
                            </li>   
                                 ';
                                  $y++;
                             }
                           
                            ?>
                            <li>
                                <a href="./manage_category/" class="select_element " style="color:#cc00ff">
                                    <img src="SVG/cog-solid.svg" class="tag_icon" style="opacity:.6">&nbsp;</a>
                            </li>
                          
                        </ul>
                        </div>
                        <?php if($post_type==2){
    $query = "SELECT * FROM `yaarme_follow`.`category` where (owner_id = {$_SESSION['id']} and pin = 1) " ;
    $result = mysqli_query($connection,$query);
    $selected_tags = '';
    $row_s = 0;
    $x = 1;
    if(mysqli_num_rows($result)){
    $selected_tags = 'You are watching updates only from ';
    $row_s = mysqli_num_rows($result);
    }

    while($row = mysqli_fetch_assoc($result)){
    if($x==($row_s-1)){
    $end = ' and ';
    }else if($x==$row_s){
    $end = '. ';
    }else{
    $end = ', ';
    }
    $selected_tags .= '<a href="./manage_people/?c='.$row['id'].'" class="blue">'.$row['group_name'].'</a>'.$end;
    $x++;
    }
    if(!$selected_tags){
    $selected_tags .= 'Ooops! you have not selected any tags.';
    }

    echo '<div class="card-header">

        <div>
            '.$selected_tags.'
        </div>
        <span class="icon more-icon" id="alter_posts"></span>
    </div>';
    }
                        ?>
<!--
                            <div class="card-header">
                               
                                <div>
                                    You are watching stories and posts from <b> <?php echo $show_list; ?></b>
                                </div>
                                <span class="icon more-icon" id="alter_posts"></span>
                            </div>
-->
                        </div>
                    <div class="scroll">
                        <section class="stories">
                            <div class="scroll-stories">
                                <a href="create_story/" class="storie">
                                    <span class="photo user">
                                        <img src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>" alt="profile-pic" />
                                        <span class="add-story">
                                            <div class="add-story-text">+</div>
                                        </span>
                                    </span>
                                    <span class="name">Your Story</span>
                                </a>
                                
                                <?php
                               include 'php/next_story.php';
                                ?>
                                
                              <!--  <div class="storie live">
                                    <span class="photo">
                                        <img src="./Images/profile-pic2.jpg" alt="profile-pic" />
                                        <span class="live-text">LIVE</span>
                                    </span>
                                    <span class="name">static Meghana</span>
                                </div>
                                <div class="storie">
                                    <span class="photo">
                                        <img src="./Images/profile-pic3.png" alt="profile-pic" />
                                    </span>
                                    <span class="name">Shirley</span>
                                </div>
                                <div class="storie">
                                    <span class="photo">
                                        <img src="./Images/profile-pic5.jpg" alt="profile-pic" />
                                    </span>
                                    <span class="name">Mahathi</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic4.jpg" alt="profile-pic" />
                                    </span>
                                    <span class="name">Rahul</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic6.jpg" alt="profile-pic" />
                                    </span>
                                    <span class="name">Sandeep</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic7.jpg" alt="profile-pic" />
                                    </span>
                                    <span class="name">Shreyan</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic3.png" alt="profile-pic" />
                                    </span>
                                    <span class="name">Priya</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic4.jpg" alt="profile-pic" />
                                    </span>
                                    <span class="name">Rahul</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic6.jpg" alt="profile-pic" />
                                    </span>
                                    <span class="name">Sandeep</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic7.jpg" alt="profile-pic" />
                                    </span>
                                    <span class="name">Shreyan</span>
                                </div>
                                <div class="storie">
                                    <span class="photo inactive">
                                        <img src="./Images/profile-pic3.png" alt="profile-pic" />
                                    </span>
                                    <span class="name">Priya</span>
                                </div>-->
                                <img class="arr prev" src="./Images/left-arrow.png" />
                                <img class="arr nxt" src="./Images/right-arrow.png" />
                            </div>
                        </section>
                    </div>

                    <div class="posts" >
                        
                        <div  id="first_post"></div>

                        
                         <?php 
                        if($post_type==1){
                           echo ' <div class="suggestion-box">
                            <div class="suggestion-title">
                                <span>Suggested for You</span>
                                <a href="./request/" class="see-all">See All</a>
                            </div>
                            <div class="suggestions-list">' ;
                        
                        
                       
                                $query_select = "SELECT * FROM yaarme_follow.follow where (user = {$_SESSION['id']} and approve = 1) ORDER BY `follow`.`id` DESC limit 5";
                                $query_select = mysqli_query($connection,$query_select);
                                $g=1;
                                $selected_user = '';
                                while($row_select = mysqli_fetch_assoc($query_select)){
                                // if($row_select['opponent']!=$_SESSION['id']){
                                if($row_select['opponent']!=$_SESSION['id']){
                                if($g==1){
                                $selected_user .= ' ';
                                $g=0;
                                }else{
                                $selected_user .= ' or ';
                                }
                                //
                                $selected_user .= 'user = '.$row_select['opponent'].' ';
                                }
                                // }
                                }
                                if($selected_user==''){
                                $selected_user = 'user = 1';
                                }
                                // echo $selected_user;
                                $query = "SELECT *,COUNT(*) FROM yaarme_follow.follow join yaarme.users on yaarme.users.id = yaarme_follow.follow.opponent WHERE ({$selected_user}) GROUP by opponent ORDER BY COUNT(*) DESC limit 100";
                                $query = mysqli_query($connection,$query);
                                $x=1;
                                while($row = mysqli_fetch_assoc($query)){
                                $query_user = "select * from yaarme_follow.follow where (user = {$_SESSION['id']} and opponent = {$row['opponent']} )";
                                $query_user = mysqli_query($connection,$query_user);
                                $relation = 1;
                                while($row_user = mysqli_fetch_assoc($query_user)){
                                $relation = 0;
                                }
                                if($relation == 1){
                                    if($row['img']){
                                    $img_out = './profile/i/240/'.$row['img'];
                                    }else{
                                    $img_out = "./profile/i/none.svg";
                                    }
                                echo '<div class="suggestion suggest_'.$row['opponent'].'">
                                    <a href="./account?user='.$row['opponent'].'" style="background-image: url('.$img_out.');" class="suggest-img" ></a>
                                    <span class="suggest-close" onclick="ignore('.$row['opponent'].')">&#x2715;</span>
                                    <span class="suggest-name">'.$row['first_name'].' '.$row['last_name'].'</span>
                                    <p class="suggest-info">'.$row['status_mini_bio'].'</p>
                                    <button class="follow-button flw_btn_'.$row['opponent'].'" onclick="follow_ya('.$row['opponent'].','.$row['account_type'].')">Follow</button>
                                </div>';
                                if($x==10){
                                break;
                                }
                                $x++;
                                }else{
                                }
                                }
                       

                             echo '   <img class="arrow previous" src="./Images/left-arrow.png" />
                                <img class="arrow next" src="./Images/right-arrow.png" />
                            </div>
                        </div>';
                        }

 ?>

                        <div id="new_posts"> </div>

<!--                   add posts   -->
                         <script>
                            <?php
                            
                             if($post_type==1){
                                        echo "var po_st_type = 1;";
                                    }else if($post_type==2){
                                        echo "var po_st_type = 2;";
                                    }else if($post_type==3){
                                        echo "var po_st_type = 3;";
                                    }else if($post_type==4){
                                        echo "var po_st_type = 4;";
                                    }else if($post_type==5){
                                        echo "var po_st_type = '5&l=".$list_show."';";
                                    }
                            
                             if($_SESSION['img']){
                             echo "var active_profile_url = 'profile/i/240/".$_SESSION['img']."';";
                             }else{
                             echo "var active_profile_url = 'profile/i/none.svg';";
                             }
                              echo "var user_id = ".$_SESSION['id'].";";
                            ?>
  
//hide mobile navs 1
let scroll = 1;
let scrolldown = 1;
var load_m = 1;
var t = 1;
var max_id = 100000000000;
var num_fnt = 1;
                             
window.onscroll = function (ev) {
if ((window.innerHeight + window.scrollY + 3000) >= document.body.offsetHeight && window.location.hash !== "#searching") {
creat_post();
}
    //hide mobile navs 2
    if (this.oldScroll > this.scrollY) {
        scroll++;
        scrolldown = 1;
        if (scroll > 20 || window.pageYOffset < 60) {
//               scrolling show
            document.querySelector(".mobile-header").style.top = "0";
            document.querySelector(".mobile-nav-bar").style.bottom = "0";
            scroll = 1;
        }
    } else {
        //   scrolling hide
        scrolldown++;
        scroll = 1;
        if (scrolldown > 20 && window.pageYOffset > 60) {
            document.querySelector(".mobile-header").style.top = "-52px";
            document.querySelector(".mobile-nav-bar").style.bottom = "-55px";
            scrolldown = 1;
        }
    }
    this.oldScroll = this.scrollY;
};
                             
                             
creat_post();
                             
  function creat_post(){
         if (load_m) {
            load_m = 0;
             
            console.log('bottom');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {

                    var my_adds = "";

                    var output = JSON.parse(this.responseText);
                    
                    
                       if(output.post.length<1 && !document.getElementById("first_post").innerHTML){
                       document.getElementById("first_post").innerHTML='<div class="card " ><div class="follow-conn promote_following_p"> <a href="#"  class="follow-icon users post_profile promote_following" ></a><div class="conn-name"> <span> <b class="promote_following_para"><?php if($post_type==1){echo 'follow accounts to watch their posts';}else{echo 'Ooops! there are no posts, try to change filter.';}?> </b> </span>  </div> <span></span> </div></div>'; 
                       }
                    
                    for (var i = 0; i < output.post.length+1; i++) {
                        var slidrr = "";
                        var sa = '<div id="slider_' + output.post[i].id + '" class="slider loaded" post_id="' + output.post[i].id + '" > <div class="wrapper"> <span id="prev_' + output.post[i].id + '" class="control prev"></span> <span id="next_' + output.post[i].id + '" class="control next"></span> <div id="items_' + output.post[i].id + '" class="items_slider"> ';
                        var sb = '</div></div> </div>';
                        for (var im = 0; im < output.post[i].body_img_urls.length; im++) {
                            slidrr += '<img src="create_post/upload/1080/' + output.post[i].body_img_urls[im] + '" class="slide" id="img' + output.post[i].id + "img" + im + '" oncontextmenu="this.requestFullscreen();return false;"> ';
                        }
                        if (output.post[i].body_img_urls.length <= 1) {
                            sa = "";
                            sb = "";
                        }
                        if(output.post[i].following!=1){
                           follow_integ = " • Follow ";
                           }else{
                               follow_integ='';
                           } 
                        if(output.post[i].mute==1){
                           mute_integ = " • Unmute ";
                           }else{
                               mute_integ='';
                           }
                        if(output.post[i].tag){
                           tagshow = "• "+output.post[i].tag;
                           }else{
                               tagshow='';
                           }
                        var react_types = '';
                        for (var m = 0; m < output.post[i].reaction_type.length; m++) {
                            if (m < 3) {
                                if (output.post[i].reaction_type[m] == 1) {
                                    react_types += '<a href="like?post='+output.post[i].id+'"  class="icon like-icon"></a>';
                                } else if (output.post[i].reaction_type[m] == 2) {
                                    react_types += '<a href="like?post='+output.post[i].id+'"  class="icon love-icon"></a>';
                                } else if (output.post[i].reaction_type[m] == 3) {
                                    react_types += '<a href="like?post='+output.post[i].id+'"  class="icon support-icon"></a>';
                                } else if (output.post[i].reaction_type[m] == 4) {
                                    react_types += '<a href="like?post='+output.post[i].id+'"  class="icon celebrate-icon"></a>';
                                } else if (output.post[i].reaction_type[m] == 5) {
                                    react_types += '<a href="like?post='+output.post[i].id+'"  class="icon fire-icon"></a>';
                                } else if (output.post[i].reaction_type[m] == 6) {
                                    react_types += '<a href="like?post='+output.post[i].id+'"  class="icon haha-icon"></a>';
                                } else if (output.post[i].reaction_type[m] == 7) {
                                    react_types += '<a href="like?post='+output.post[i].id+'"  class="icon sad-icon"></a>';
                                }
                            }
                        }
                        if(output.post[i].profile_url){
                            var post_own_pic = "profile/i/120/"+output.post[i].profile_url;
                        }else{
                            var post_own_pic = "profile/i/none.svg";
                        }
//                        onclick="openlist('_report')"
                        if(user_id==output.post[i].owner_id){
                           var check_if_owner = '<span class="icon more-icon top-corner" id="more_post_click" onclick="open_ask_delete('+ output.post[i].id + ');openlist('+"'"+'_warning_delete'+"'"+','+ output.post[i].id + ');"></span>'; 
                        }else{
                            var check_if_owner = '<span class="icon more-icon top-corner" id="more_post_click" onclick="open_post_options(' + output.post[i].owner_id + ', ' + "'" + output.post[i].name + "'" + ',' + output.post[i].id + ',' + output.post[i].account_type + ')"></span>'; 
                        }
                        if(output.post[i].location){
                            var location_in_post = ' • ' +  output.post[i].location ;
                        }else{
                             var location_in_post ='';
                        }
                        var total_comments = '';
                        if(output.post[i].comment==1){
                             total_comments = '1 comment';
                        }else if(output.post[i].comment>1){
                             total_comments = output.post[i].comment+' comments';
                        }
                       
                        
                        console.log(react_types)
                        max_id = output.post[i].id;
                        my_adds = '<div class="card card_own_' + output.post[i].owner_id + '" post_id="' + output.post[i].id + '"> <div class="follow-conn"> <a href="./account?user='+output.post[i].owner_id+'" style="background-image:url('+post_own_pic+')" class="follow-icon users post_profile" target="_blank"></a> <div class="conn-name"> <span> <b>' + output.post[i].name + ' <small class="u_c_' + output.post[i].owner_id + '">' + tagshow + '</small> <small class="fllw_' + output.post[i].owner_id + '" onclick="unfollow_ys(' + output.post[i].owner_id + ',' + output.post[i].account_type + ')">'+follow_integ+'</small><small class="unmt_' + output.post[i].owner_id + '" onclick="mute_ys(' + output.post[i].owner_id + ')">'+mute_integ+'</small> </b> </span> <a href="./account?user='+output.post[i].owner_id+'" target="_blank">' + output.post[i].introduction + '</a> <a href="./account?user='+output.post[i].owner_id+'" target="_blank"> <span>' + output.post[i].time + location_in_post + ' </span>  </a> </div> '+check_if_owner+' </div><div class="post_raw_body" ondblclick="double_click_love(' + output.post[i].id + ')"> <p class="content select_text"> ' + output.post[i].body_text.replace("<br>","<br>") + ' </p> ' +
                            sa + slidrr + sb +
                            '</div> <div class="vote-section" > '+react_types+' <a href="like?post='+output.post[i].id+'" target="_blank" class="votes">' + output.post[i].like + '</a> <span class=" post-slider-dots post-slider-dots_' + output.post[i].id + '"></span> <a href="posts?p='+output.post[i].id+'" target="_blank" > ' +  total_comments+' </a> </div> <div class="share-section"  > <div class="icon-wrap open_reactions ' + output.post[i].reaction + '" id="like_' + output.post[i].id + '"> <div class="like_option"> <div class="set_it"> <img src="./emogi/other/compressed/thumbs_up.gif" title="Like" class="like_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/sparkling_heart.gif" title="Love" class="love_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/handshake.gif" title="Support" class="support_inner " oncontextmenu="return false"/> <img src="./emogi/other/compressed/party_popper.gif" title="Celebrate" class="cele_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/fire.gif" title="Hot" class="hot_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" title="Laugh" class="smile_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/crying_face.gif" title="Sad" class="sad_inner" oncontextmenu="return false"/> </div> </div> <div class="flex"> <img src="./emogi/128/human/thumbs-up-medium-light-skin-tone.png" class="icon like-i default"> <span class="default">Like&nbsp;</span> <img src="./emogi/other/compressed/thumbs_up.gif" class="icon like-i liked" oncontextmenu="return false"> <span class="liked">Liked</span> <img src="./emogi/other/compressed/sparkling_heart.gif" class="icon loved" oncontextmenu="return false"> <span class="loved">Loved</span> <img src="./emogi/other/compressed/handshake.gif" class="icon supported" oncontextmenu="return false"> <span class="supported">Supported</span> <img src="./emogi/other/compressed/party_popper.gif" class="icon celebrated" oncontextmenu="return false"> <span class="celebrated">celebrated</span> <img src="./emogi/other/compressed/fire.gif" class="icon fired" oncontextmenu="return false"> <span class="fired">Hot</span> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" class="icon haha" oncontextmenu="return false"> <span class="haha">HaHa</span> <img src="./emogi/other/compressed/crying_face.gif" class="icon sad" oncontextmenu="return false"> <span class="sad">Sad</span> </div> </div> <div class="icon-wrap" onclick="show_comment(' + output.post[i].id + ')"> <img src="./SVG/comment.svg" class="icon comment-icon" /> <span>Comment</span> </div> <div class="icon-wrap ' + output.post[i].save + '" id="save_' + output.post[i].id + '" onclick="save_me(' + output.post[i].id + ')"> <img src="./SVG/save.svg" class="icon send-icon" /><span>Save&nbsp;</span> <img src="./SVG/saved.svg" class="icon send-icon saved_done" /> <span class="saved_done ">Saved</span> </div> </div> <div id="load_comments_' + output.post[i].id + '"></div> <form class="follow-conn comment_attempt " id="comment_' + output.post[i].id + '" onsubmit="submit_comment(event,' + output.post[i].id + ')"><img src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>" class="follow-icon comment_profile" /><span href="profile/" class="comment_form"><textarea type="text" rows="1" class="comment_input" id="comment_input_' + output.post[i].id + '" value="o" placeholder="Leave your comment..." onkeydown="autosize(' + output.post[i].id + ')"></textarea></span><button class="follow post_comment">Post</button></form> </div> ';
                        load_m = 1;
                        if(num_fnt==1){
                            document.getElementById("first_post").insertAdjacentHTML("beforeend", my_adds);
                            num_fnt = 2;
                        }else{
                            document.getElementById("new_posts").insertAdjacentHTML("beforeend", my_adds);
                        }
                        if (document.getElementById('slider_' + output.post[i].id)) {
                            slide(output.post[i].id, document.getElementById('slider_' + output.post[i].id), document.getElementById('items_' + output.post[i].id), document.getElementById('prev_' + output.post[i].id), document.getElementById('next_' + output.post[i].id));
                        }
                        reaction(output.post[i].id);
                    }
                    
//                    prevent emoji download
                    var images = document.querySelectorAll('img');
for(var i = 0; i < images.length; i++){
     images[i].oncontextmenu = function () {
        return false;
    };
}
                    
                }
            };
            xhttp.open("GET", "./php/next.php?f="+po_st_type+"&s=" + max_id, true);
            console.log("./php/next.php?f="+po_st_type+"&s=" + max_id)
            xhttp.send();
            t++;
        }
    }
       
                        </script>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        


                    </div>
                </div>
                <div id="search_content" style="display:none">
                    <div class="main-content-searching">
                        <div class="filters-wrapper card2 visible">
                            <div class="filters">
                                <span class="selected">People</span>
                                <!--
            <span>More</span>
            <span>Content</span>
            <span>Companies</span>
            <span>Schools</span>
            <span>Groups</span>
            <span>Events</span>
-->
                            </div>


                        </div>


                        <div class="touch-swipe">
                            <div class="card" id="search_rs"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-bar"></div>
        </div>

    </div>

    
                           
                        <!--                        open post option on triple click-->
                        <div class="my_options " id="post_option_fst">
                            <div class="my_options my_options_block" onclick="close_options('_fst')">
                            </div>
                            <div class="items item_post" style="">
                                <p class="select_category" id="select_owner">Select what to do with post or post owner.</p>
                                <ul class="post_options">
                                    <li onclick="openlist('_report')" id="report_post">
                                        <div class="follow-conn "> <img src="./SVG/exclamation-triangle-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Report post...</b></span> </span> </div>
                                    </li>
                                     <li id="block_options" onclick="openlist('_block');close_options('_warning_delete');">
                                        <div class="follow-conn "> <img src="./SVG/lock-solid-red.svg" class="follow-icon"> <span class="conn-name"> <span><b>block</b></span> </span> </div>
                                    </li>
                                  
                                    <li id="mutww" onclick="mute_yes()">
                                        <!--                                     <li  onclick="openlist('_mute')">-->
                                        <div class="follow-conn ">
                                            <!-- <img src="./SVG/volume-mute-solid.svg" class="follow-icon">--> <img src="./SVG/volume-up-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Mute posts</b></span> </span>
                                        </div>
                                    </li>
                                    <!--                                     <li onclick="openlist('_unfollow')">-->
                                    <li id="unflww" onclick="unfollow_yes()">
                                        <div class="follow-conn "> <img src="./SVG/heart-broken-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Unfollow</b></span> </span> </div>
                                    </li>
                                      <li onclick="openlist('yy')">
                                        <div class="follow-conn "> <img src="./SVG/tags-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Label</b></span> </span> </div>
                                    </li>
                                    <li onclick="share_post();close_options('_fst')" id="share_post">
                                        <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Post</b></span> </span> </div>
                                    </li>
                                    <li>
                                        <div class="follow-conn"> </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- mute conform-->
                        <!--
                          <div class="my_options" id="post_option_mute">
                             <div class="my_options my_options_block" onclick="close_options('_mute')">
                             </div>
                             <div class="items item_post" style="">
                                 <ul class="post_options">
                                     <li>
                                         <div class="follow-conn ">You will stay connected but would not get his/her posts in your news feed.</div>
                                     </li>
                                 </ul>
                                 <div class="btn_box"><div></div>
                                     <button class="follow-button follow-button-alt "  onclick="close_options('_mute')">Cancel</button><div></div>
                                     <button class="follow-button " onclick="mute_yes()" >Confirm</button><div></div>
                                 </div>
                             </div>
                         </div>
-->

                        <!-- unfollow conform-->
                        <div class="my_options" id="post_option_unfollow">
                            <div class="my_options my_options_block" onclick="close_options('_unfollow')">
                            </div>
                            <div class="items item_post" style="">
                                <ul class="post_options">
                                    <li>
                                        <div class="follow-conn ">If you ever got interested back, you will have to send a follow request again since this account is a private account.</div>
                                    </li>
                                </ul>
                                <div class="btn_box">
                                    <div></div>
                                    <button class="follow-button follow-button-alt " onclick="close_options('_unfollow')">Cancel</button>
                                    <div></div>
                                    <button class="follow-button " onclick="confirm_unfollow()">Confirm</button>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        
                        
                          <!-- block confirm-->
                        <div class="my_options" id="post_option_block">
                            <div class="my_options my_options_block" onclick="close_options('_block')">
                            </div>
                            <div class="items item_post" style="">
                                <ul class="post_options">
                                    <li>
                                        <div class="follow-conn ">Are you sure to block.</div>
                                    </li>
                                </ul>
                                <div class="btn_box">
                                    <div></div>
                                    <button class="follow-button follow-button-alt block" onclick="close_options('_block')">No</button>
                                    <div></div>
                                    <button class="follow-button block" onclick="block_user_confirm();">Yes</button>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- report conform-->
                        <div class="my_options" id="post_option_report">
                            <div class="my_options my_options_block" onclick="close_options('_report')">
                            </div>
                            <div class="items item_post" style="">
                                <ul class="post_options">
                                    <li>
                                        <div class="follow-conn ">Are you sure to report this post.</div>
                                    </li>
                                </ul>
                                <div class="btn_box">
                                    <div></div>
                                    <button class="follow-button follow-button-alt " onclick="close_options('_report')">No</button>
                                    <div></div>
                                    <button class="follow-button " onclick="report_post()">Yes</button>
                                    <div></div>
                                </div>
                            </div>
                        </div>

                        <!-- delete post warning-->
                        <div class="my_options" id="post_option_warning_delete">
                            <div class="my_options my_options_block" onclick="close_options('_warning_delete')">
                            </div>
                            <div class="items item_post" style="">
                                <p class="select_category">Select what to do with this post.</p>
                                <ul class="post_options">
                                    <li onclick="close_options('_warning_delete');edit_post_confirm();">
                                        <div class="follow-conn "> <img src="./SVG/pen-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Edit Post</b></span> </span> </div>
                                    </li>
                                    <li onclick="close_options('_warning_delete');openlist('_delete')">
                                        <div class="follow-conn "> <img src="./SVG/trash-alt-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Delete post...</b></span> </span> </div>
                                    </li>
                                   
                                    <li onclick="share_post();close_options('_warning_delete')">
                                        <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Post</b></span> </span> </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- delete post conform-->
                        <div class="my_options" id="post_option_delete">
                            <div class="my_options my_options_block" onclick="close_options('_delete')">
                            </div>
                            <div class="items item_post" style="">
                                <ul class="post_options">
                                    <li>
                                        <div class="follow-conn ">Are you sure to delete this post.</div>
                                    </li>
                                </ul>
                                <div class="btn_box">
                                    <div></div>
                                    <button class="follow-button follow-button-alt " onclick="close_options('_delete')">No</button>
                                    <div></div>
                                    <button class="follow-button " onclick="delete_post_confirm();">Yes</button>
                                    <div></div>
                                </div>
                            </div>
                        </div>




                        <!--                        chnage list-->
                        <div class="my_options " id="post_optionyy">
                            <div class="my_options my_options_block" onclick="close_options('yy')"></div>
                            <div class="items item_post" style="">
                                <p class="select_category">Add a label for <span class="active_name">name</span>.</p>
                                <form>
                                    <ul>


                                        <?php
                    
                    $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']}";
               $query = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($query)){
      if($row['description']){
          $description = '<span>'.preg_replace('/\r|\n/','',trim(htmlentities($row['description']))).'</span>';
      }else{
          $description = '';
      }
      if($row['pin']){
          $pin1 = "select_me_selected";
          $pin2 = "display_flex";
      }else{
            $pin1 = "";
          $pin2 = "";
      }
      echo '
       <li>
     <div class="follow-conn select_tl" onclick="changelist('.$row['id'].','."'".preg_replace('/\r|\n/','',trim(htmlentities($row['group_name'])))."'".')">
         <img src="./emogi/128/'.$row['emoji'].'" class="follow-icon">
         <span class="conn-name">
             <span><b>'.preg_replace('/\r|\n/','',trim(htmlentities($row['group_name']))).'</b></span>
             '.$description.'
         </span>
         </span>
         <span>

         </span>
     </div>
 </li>
           ';
  }
                    
                    
                    ?>


                                        <li onclick=" changelist(id,'',1)">
                                            <div class="follow-conn select_tl">
                                                <img src="./emogi/128/human/man-astronaut-medium-dark-skin-tone.png" class="follow-icon">
                                                <span class="conn-name cn">
                                                    <span><b>Unlabel</b></span>
                                                    <span>Everyone who doesn't have any label.</span>
                                                </span>

                                            </div>
                                        </li>



                                    </ul>

                                </form>
                            </div>
                        </div>


    <div class="mobile-header" style="top: 0px">
        <span class="icon me-icon">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars" class="svg-inline--fa fa-bars fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
            </svg>
        </span>
        <form id="header-form" class="input-wrap blue-background-header" autocomplete="off" onclick="invisible()">
            <span class="search-icon autocomplete"></span>
            <span id="company-title" class="title white"><span>YAAR</span><span>ME</span></span>
            <input type="search" placeholder="Search" class="search-bar invisible" id="search_mob" name="s">

            <img id="search-icon-img" src="SVG/search.png">

            <span class="icon qrcode-icon"></span>
        </form>
        <a href="https://yaarme.com/profile" class="icon profile-icon">
            <!--            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-circle" class="svg-inline--fa fa-user-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="white" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path></svg>-->
            <img src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>">
        </a>
    </div>



    <div class="mobile-nav-bar">
        <ul class="nav-icons">
            <a href="./" class="icon home-icon home-icon-active" title="Home">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px" height="30px">
                    <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 15 L 14 15 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z"></path>
                </svg>
            </a>
            <a href="request/" class="icon user-icon" title="My Network">
                <?php echo $foll_alt;?>
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends" class="svg-inline--fa fa-user-friends fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="31px" height="31px">
                    <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"></path>
                </svg>
            </a>
            <a href="create_post/" class="icon add-icon" title="Add Post">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="28px">
                    <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                </svg>
            </a>
            <a href="chatall" class="icon message-icon" title="Message">
                <?php echo $msg_alt;?>
                <svg aria-hidden="true" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-7x" width="28px" height="26px">
                    <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                </svg>

            </a>
            <a href="noti" class="icon notify-icon" title="Notifications">
                <?php echo $noti_alt;?>
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="26px" fill="#000000">
                    <path d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                </svg>
            </a>
        </ul>
    </div>
    <script src="JS/main.js?v=4"></script>





</body>

</html>