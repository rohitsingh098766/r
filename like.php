<?php
session_start();
     include './connection.php';
   if(!isset($_SESSION['id'])){include './login/check_coockie.php';}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YaarMe</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="page/css/like.css">
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
    
    <!--desktop header-->
   <?php
     include './php/desktop_header.php';
    ?>
    
    
    
    <div class="container-wrap">
        <div class="container">
            <div class="left-bar"></div>
            <div class="main-content">
                <div class="homepage-main-content">


<?php
                    
//                    echo $_GET['post'];
                    
                    if(isset($_GET['post'])){
                        $post  = mysqli_real_escape_string($connection, $_GET['post']);
                        $query = "select * from yaarme_like.post_like join yaarme.users on users.id = post_like.user left join yaarme.location on location.id = users.location where post_id = {$post} limit 500";
                        $result = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            if($row['img']){
                                $img = './profile/i/240/'.$row['img'];
                            }else{
                                $img = './profile/i/none.svg';
                            }
                            
//                            check relation
                            $query_relation = "select * from yaarme_follow.follow left join yaarme_follow.category on category.id = follow.category where ( user = {$_SESSION['id']} and opponent = {$row['user']})";
                        $result_relation = mysqli_query($connection,$query_relation);
                            $following = ' • Follow ';
                            $mute = '';
                            $category ='';
                            $proceed = true;
                        while($row_relation = mysqli_fetch_assoc($result_relation)){
//                            $following = '';
                            $proceed = true;
                            if($row_relation['approve']==9){
                              $following = ' • Requested ';
                            }else if($row_relation['approve']==1){
                              $following = '';  
                            }
                            
                            if($row_relation['mute_post']){
                              $mute = " • Unmute "  ;
                            }
                             if($row_relation['group_name']){
                             $category = '• '.$row_relation['group_name'];
                            }
                            $proceed = true;
                             if($row_relation['approve']==10 || $row_relation['approve']==11 || $row_relation['approve']==8 ){
                             $proceed = false;
                            }
                            
                        }
                            if($row['location']){
                                $location_show = '
                         <a   href="./account?user='.$row['user'].'" target="_blank" class="location"><img class="loc-icon" src="./SVG/location.svg" alt="">'.$row['location'].'</a>';
                            }else{
                                $location_show = '';
                            }
                            
                         if($proceed===true){  
                        echo '
                        <div class="grid">
                    
                    <a   href="./account?user='.$row['user'].'" target="_blank" class="flex_s"><img class="profile_img" src="'.$img.'"></a>
                    <div class="grid_mid">
                        <div class="name"><a href="./account?user='.$row['user'].'" target="_blank" class="name_link">'.$row['first_name'].' '.$row['last_name'].'</a>
                            <small class="u_c_'.$row['user'].'" onclick="change_tag('.$row['user'].')">'.$category.'</small>
                            <small class="fllw_'.$row['user'].'" onclick="unfollow_ys('.$row['user'].','.$row['account_type'].')">'.$following.'</small>
                            <small class="unmt_'.$row['user'].'" onclick="mute_ys('.$row['user'].')">'.$mute.'</small>
                        </div>
                         <a   href="./account?user='.$row['user'].'" target="_blank" class="description">'.$row['status_mini_bio'].'</a>'.$location_show.'
                        </div>
                    <div class="flex_s" onclick="open_post_options('.$row['user'].', 88,16,0)"><span class="icon more-icon" ></span></div>
                    </div>
                        ';
                         }
                        }
                    }else{
                        echo "It seems like link is broken";
                    }
                    
                    
                    
                    ?>
                   
                    
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
                                        <div class="follow-conn "> <img src="./SVG/tags-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Label</b></span> </span> </div>
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
                                <p class="select_category">Add a label on <span class="active_name">name</span>.<span class="remove_label" onclick=" changelist(id,'',1)">Remove Label</span></p>
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


<!--
                                        <li onclick=" changelist(id,'',1)">
                                            <div class="follow-conn select_tl">
                                                <img src="./emogi/128/human/man-astronaut-medium-dark-skin-tone.png" class="follow-icon">
                                                <span class="conn-name cn">
                                                    <span><b>Unlabel</b></span>
                                                    <span>Everyone who doesn't have any label.</span>
                                                </span>

                                            </div>
                                        </li>
-->


<div class="follow-conn ">

                        <a href="./manage_category" class="hint_crt">Click to manage labels.</a>

                    </div>
                                    </ul>

                                </form>
                            </div>
                        </div>


                </div>
            </div>
            <div class="right-bar"></div>
        </div>
    </div>
    
<!--    mobile header-->
    <div class="mobile-header">
        <a href="./" class="icon me-icon">
           <svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" data-supported-dps="24x24" fill="black" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"></path></svg>
        </a>
        <span class="">
            <label class="white" for="button_post_desk">Likes</label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>
    <script src="./JS/main.js"></script>
</body>

</html>