<?php
session_start();
     include './connection.php';
   if(!isset($_SESSION['id'])){include './login/check_coockie.php';}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed | YaarMe</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./request/style.css">
    <link rel="stylesheet" href="./page/css/like.css">

    <!--icons-->
    <link rel="apple-touch-icon" sizes="57x57" href="./icons/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./icons/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./icons/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./icons/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./icons/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./icons/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./icons/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./icons/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./icons/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="./icons/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./icons/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./icons/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./icons/icons/favicon-16x16.png">
    <link rel="manifest" href="./icons/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#0073b1">
    <meta name="msapplication-TileImage" content="./icons/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#0073b1">
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

    
    <!--desktop header-->
   <div class="main-navbar-wrap">
        <div class="main-navbar">
            <a href="./" class="icon company-logo"></a>
 <a href="./" class="input-wrap" autocomplete="off">
                <span class="icon search-icon autocomplete"></span>
                <input type="search" placeholder="Search" class="search-bar" name="s" id="search_des" />
                <span class="icon qrcode-icon"></span>
            </a>
            <ul class="nav-icons">
                <a href="./" class="icon home-icon " title="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px" height="30px">
                        <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 15 L 14 15 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z"></path>
                    </svg>
                </a>
                <a href="request/" class="icon home-icon-active" title="My Network">
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
                    <svg aria-hidden="true" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-7x" width="28px" height="26px">
                        <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                    </svg>

                </a>
                <a href="noti" class="icon" title="Notifications">
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
                                            <img src="SVG/list-alt-solid.svg" alt="" />
                                            <span>Manage List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page/activity">
                                            <img src="SVG/clock-solid.svg" alt="" />
                                            <span>My activity</span>
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

                   <div id="al_lst">
                       <?php
                            
                             $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']} order by `category`.`id` ASC";
               $query = mysqli_query($connection,$query);
           $list_p = '';            
  while($row = mysqli_fetch_assoc($query)){
      $list_p .= '
      <div class=" d flx_2 step_3 list_o_'.$row['id'].'" l="'.$row['id'].'"><img src="./emogi/64/'.$row['emoji'].'" class="list_img"><div class="lt_m">'.str_replace(' ', '&nbsp;', $row['group_name']).'</div></div>        
    ';
  }
                    
                            ?>
                    </div>

                    <div id="all_list">

                        
                            <div id="result">
                                
                               
                                
                                
                                <?php
                                
                                $query = "select * from yaarme_follow.follow join yaarme.users on yaarme.users.id = yaarme_follow.follow.user left join yaarme.location on yaarme.location.id = yaarme.users.location where (opponent = {$_SESSION['id']} and approve = 9)" ;
                                $result = mysqli_query($connection,$query);
                                $rws = mysqli_num_rows($result);
                                if($rws>0){
                                    if($rws>1){$jj='s';}else{$jj='';}
                                      echo '<p id="my_list"> Respond to '.$rws.' follow request'.$jj.'</p>';
                                }else{
//                                      echo '<p id="my_list"> No follow requests yet</p>';
                                }
                              
                                while($row = mysqli_fetch_assoc($result)){
                                    if($row['img']){
                                        $img = './profile/i/240/'.$row['img'];
                                    }else{
                                        $img = './profile/i/none.svg';
                                    }
                                echo '
                                
                                  <div class="posts g1 act_'.$row['user'].'" u="'.$row['user'].'">
                                    <div class="k1"><img src="'.$img.'" class="avatar"></div>
                                    <div class="k1 mid">
                                        <div class="mid_head">'.$row['first_name'].' '.$row['last_name'].'<small class="tag tag_'.$row['user'].'"></small></div>
                                        <div class="mid_con">'.$row['status_mini_bio'].'</div>
                                    </div>
                                   
                                    <div></div>
                                    <div class=" k1 mid reqest_btn">
                                          <div class="location "><img src="./SVG/location.svg" class="location_img"> '.$row['location'].'</div>
                                        <div class="select_one select_one_'.$row['user'].' step1" o="'.$row['user'].'">
                                           <div class="d active step_1" l="following"  onclick="yd('.$row['user'].')">Deny</div>
                                            <div class=" d step_1" l="follower" onclick="yt('.$row['user'].')">Allow</div>
                                            <div class=" d step_2" l="follower" onclick="yp('.$row['user'].')">Follow&nbsp;back</div>
                                            <div class=" d step_4" l="follower" onclick="yb('.$row['user'].')">Block</div>
                                            <div class=" d step_4" l="follower" onclick="yb('.$row['user'].')">Report&nbsp;&&nbsp;block</div>
                                            '.$list_p.'
                                            </div>
                                    </div>
                                   
                                </div>
                                <script>
                                var y = document.querySelector(".select_one_'.$row['user'].'").querySelectorAll(".step_3");
                                for(var i = 0;i<y.length;i++){
                                var y_fix = y[i].getAttribute("l")
                                y[i].setAttribute("onclick","yk('.$row['user'].',"+y_fix+")")
                                }
                                
                                </script>
                                
                                ';
                                }
                                
                                ?>
                                
                            </div>

<div>
                        
                        <p id="my_list_suggestion"> Suggested for you</p>
                        
                        <?php
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
                    
//                    echo $_GET['post'];
                    
                    
//                        $post  = mysqli_real_escape_string($connection, $_GET['post']);
                        $post  = 16;
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
                        $query = "SELECT *,COUNT(*) FROM yaarme_follow.follow 
                        join yaarme.users on yaarme.users.id = yaarme_follow.follow.opponent 
                        join yaarme.location on yaarme.location.id = yaarme.users.location
                        WHERE ({$selected_user}) GROUP by opponent ORDER BY COUNT(*) DESC limit 150";
//    echo $query;
                        $result = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            if($row['img']){
                                $img = './profile/i/240/'.$row['img'];
                            }else{
                                $img = './profile/i/none.svg';
                            }
                            
//                            check relation
                            $query_relation = "select * from yaarme_follow.follow left join yaarme_follow.category on category.id = follow.category where ( user = {$_SESSION['id']} and opponent = {$row['opponent']})";
//                            echo $query_relation;
                        $result_relation = mysqli_query($connection,$query_relation);
                            $following = ' • Follow ';
                            $mute = '';
                            $category ='';
                            $proceed = true;
                            
                        while($row_relation = mysqli_fetch_assoc($result_relation)){
//                       
                            $proceed = false;
//                            $following = ' • Following ';
                        }
                            
                         if($proceed===true){  
                        echo '
                        <div class="grid">
                    
                    <a href="./account?user='.$row['opponent'].'" class="flex_s"><img class="profile_img" src="'.$img.'"></a>
                    <div class="grid_mid">
                        <div class="name">'.$row['first_name'].' '.$row['last_name'].'
                            <small class="u_c_'.$row['opponent'].'">'.$category.'</small>
                            <small class="fllw_'.$row['opponent'].'" onclick="unfollow_ys('.$row['opponent'].','.$row['account_type'].')">'.$following.'</small>
                            <small class="unmt_'.$row['opponent'].'" onclick="mute_ys('.$row['opponent'].')">'.$mute.'</small>
                        </div>
                        <a href="./account?user='.$row['opponent'].'" class="description">'.$row['status_mini_bio'].'</a>
                        <a href="./account?user='.$row['opponent'].'" class="location"><img class="loc-icon" src="./SVG/location.svg" alt="">'.$row['location'].'</a>
                        </div>
                    <div class="flex_s" onclick="open_post_options('.$row['opponent'].', 88,16,0)"><span class="icon more-icon" ></span></div>
                    </div>
                        ';
                         }
                        }
                   
                    
                    
                    
                    ?>
                        </div>

        <!--                    activate on click triple dot-->
                     <div class="my_options " id="post_option_fst">
                            <div class="my_options my_options_block" onclick="close_options('_fst')">
                            </div>
                            <div class="items item_post" style="">
                                <p class="select_category hide">Select what to do with post or post owner.</p>
                                <ul class="post_options">
<!--
                                    <li onclick="openlist('_report')">
                                        <div class="follow-conn "> <img src="./SVG/exclamation-triangle-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Report post...</b></span> </span> </div>
                                    </li>
-->
                                    <li onclick="openlist('yy')">
                                        <div class="follow-conn "> <img src="./SVG/tags-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Change List</b></span> </span> </div>
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
<!--
                                    <li>
                                        <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Post</b></span> </span> </div>
                                    </li>
-->
                                    <li>
                                        <div class="follow-conn"> </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    
                    

                       <!--                        chnage list-->
                        <div class="my_options " id="post_optionyy">
                            <div class="my_options my_options_block" onclick="close_options('yy')"></div>
                            <div class="items item_post" style="">
                                <p class="select_category">Send <span class="active_name">name</span> in list</p>
                                <form>
                                    <ul>


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
      echo '
       <li>
     <div class="follow-conn select_tl" onclick="changelist('.$row['id'].','."'".$row['group_name']."'".')">
         <img src="./emogi/128/'.$row['emoji'].'" class="follow-icon">
         <span class="conn-name">
             <span><b>'.$row['group_name'].'</b></span>
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
                                                    <span><b>Unlisted</b></span>
                                                    <span>keep name unlisted.</span>
                                                </span>

                                            </div>
                                        </li>



                                    </ul>

                                </form>
                            </div>
                        </div>
                                   


                    </div>


                    <div id="r1" class="flx ">
                        <div id="r2"></div>
                        <div id="r3">
                            <div class="r3_1" id="remove_follower">Remove as follower</div>
                            <div class="r3_1">Follow</div>
                            <div class="r3_1" id="mute_na"></div>

                            <div class="r3_1" id="block">Block</div>
                            <div class="r3_1 r3_1_ck">Change List</div>

                            <div id="lists" class="active">
                                <?php
                            
                             $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']} order by `category`.`id` ASC";
               $query = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($query)){
      echo '
      <div class="chs_list" l="'.$row['id'].'">
        <div class="flx"><img src="./emogi/64/'.$row['emoji'].'" class="chs_im"></div>
        <div class=" flxrt">
            <div class="lst_head">'.$row['group_name'].'</div>
            <div class="lst_body">'.$row['description'].'</div>
            </div>
        </div>
      
      
    ';
  }
                            
                            ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="right-bar"></div>
        </div>
    </div>
    <div class="mobile-header">
        <a href="./" class="icon me-icon">
           <svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" data-supported-dps="24x24" fill="black" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <path d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"></path>
            </svg>
        </a>
        <span class="">
            <label id="button_post" for="button_post_desk">People</label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>
       <div class="mobile-nav-bar">
              <ul class="nav-icons">
                  <a href="./" class="icon home-icon " title="Home">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px" height="30px">
                          <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 15 L 14 15 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z"></path>
                      </svg>
                  </a>
                  <a href="./request/" class="icon user-icon home-icon-active" title="My Network">

                      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends" class="svg-inline--fa fa-user-friends fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="31px" height="31px">
                          <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"></path>
                      </svg>
                  </a>
                  <a href="./create_post/" class="icon add-icon" title="Add Post">
                      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="28px">
                          <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                      </svg>
                  </a>
                  <a href="./chatall" class="icon message-icon " title="Message">

                      <svg aria-hidden="true" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-7x" width="28px" height="26px">
                          <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                      </svg>

                  </a>
                  <a href="./noti/" class="icon notify-icon " title="Notifications">

                      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="26px" fill="#000000">
                          <path d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                      </svg>
                  </a>
              </ul>
          </div>
   
    
    
    
    
    <script src="./JS/main.js"></script>
     <script src="./request/app.js"></script>
</body>

</html>