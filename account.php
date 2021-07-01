<?php
session_start();
     include './connection.php';

if(isset($_GET['user'])){
     $user = mysqli_real_escape_string($connection, $_GET['user']);
setcookie("shared", 1, time() + (86400 * 364),'/');
setcookie("shared_id", $user, time() + (86400 * 364),'/');
}

   if(!isset($_SESSION['id'])){include './login/check_coockie.php';}

//echo   $_SESSION['name'].$_SESSION['img'];
$user = $_SESSION['id'];
if(isset($_GET['user'])){
    $user = mysqli_real_escape_string($connection, $_GET['user']);
}

$query_ckr = "select * from yaarme_follow.follow
left join yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category
where (
yaarme_follow.follow.user = {$_SESSION['id']} and yaarme_follow.follow.opponent = {$user}
)";
$follow_status_out = "Follow";
$group_name = '';
$mute = 0;
$approve = 2;
$group_name ="";
$show_every = false;

$result_ckr = mysqli_query($connection,$query_ckr);
while($row_ckr = mysqli_fetch_assoc($result_ckr)){
$group_name = htmlentities($row_ckr['group_name']);
$mute = $row_ckr['mute_post'];
$approve = $row_ckr['approve'];
if($approve==1){
   $follow_status_out = "Following";
    $show_every = true;
}else if($approve==9){
   $follow_status_out = "Requested"; 
}
if($approve==10 || $approve==11){
exit(0);
}
}

$query_details = "select *,yaarme.users.id as selected_user from yaarme.users
left join yaarme.location on yaarme.location.id = yaarme.users.location
left join yaarme.summary on yaarme.summary.user_id = yaarme.users.id
where (
yaarme.users.id = {$user}
)";
$result_details = mysqli_query($connection,$query_details);
while($row_details = mysqli_fetch_assoc($result_details)){
$name_user =  htmlentities($row_details['first_name'].' '.$row_details['last_name']);
 $privacy_user =    $row_details['account_type'];
$bio_user =  htmlentities($row_details['status_mini_bio']);
$location_user =  htmlentities($row_details['location']);
$dob_user =  $row_details['DOB_date'].'-'.$row_details['DOB_month'].'-'.$row_details['DOB_year'];
$summary_user =  htmlentities($row_details['summary']);
    if($row_details['img']){
        $img_user = "./profile/i/1080/".$row_details['img'];
    }else{
        $img_user = "./profile/i/none.svg";
    }
    if($group_name){
    $group_name = ' <small class="u_c u_c_'.$row_details['selected_user'].'" onclick="change_tag('.$user.')"> • '.$group_name.'</small>';
    }else{
        $group_name ='';
}
    if($show_every===false && $privacy_user!=1){
        $show_every = true;
    }
}



$query_post = "select count(*) as total_sum_post from yaarme_post.posts
where (
owner_id = {$user}
)
group by yaarme_post.posts.owner_id
";
$result_post = mysqli_query($connection,$query_post);
$post_user = 0;
$follower_user = 0;
while($row_post = mysqli_fetch_assoc($result_post)){
$post_user = $row_post['total_sum_post'];
}

$query_following = "select count(*) as total_sum_following from yaarme_follow.follow
where (
opponent = {$user} and approve = 1
)
group by yaarme_follow.follow.opponent
";
$result_following = mysqli_query($connection,$query_following);
while($row_following = mysqli_fetch_assoc($result_following)){
$follower_user = $row_following['total_sum_following'];
}






?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name_user;?></title>
    <link rel="stylesheet" href="./CSS/style.css?v=17">
    <link rel="stylesheet" href="./CSS/profile.css?v=16">
    <link rel="stylesheet" href="./page/css/like.css?v=16">

    <link rel="stylesheet" href="CSS/spin_loader.css" />
    <link rel="stylesheet" href="./search/CSS/style.css" />
    <link rel="stylesheet" href="CSS/slider.css" />

    <script src="JS/app.js"> </script>
    <script src="JS/slider.js"> </script>
    <script src="JS/constructor.js"> </script>
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
    <?php
    if($user==$_SESSION['id']){
    echo "<style>.edit_allowed{
    display:inline;
    }.c1{display:none;}</style>";
}else{
       echo "<style>.cn_mine{display:none;}</style>";  
    }
    ?>
</head>

<body id="body" oncontextmenu="">


    <div class="my_options">
        <div class="my_options" id="my_options"></div>
        <div class="items">
            <p class="select_category">Who can see this? </p>
            <form>
                <ul id="s_lists_about">
                    <li>
                        <div class="follow-conn select_tl" cd="0" c="1">
                            <img src="SVG/lock-solid-about.svg" class="follow-icon  about_lock">
                            <span class="conn-name">
                                <span><b>Only you</b></span>

                            </span>
                            <span class="select_me only_one">
                                <div class="inner_checked ">&#10004;</div>
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="follow-conn select_tl" cd="0" c="2">
                            <img src="SVG/lock-solid-green.svg" class="follow-icon about_lock">
                            <span class="conn-name">
                                <span><b>Only followers</b></span>

                            </span>
                            <span class="select_me only_one ">
                                <div class="inner_checked ">&#10004;</div>
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="follow-conn select_tl" cd="0" c="3">
                            <img src="SVG/lock-open-red.svg" class="follow-icon about_lock">
                            <span class="conn-name">
                                <span><b>Everyone</b></span>

                            </span>
                            <span class="select_me only_one">
                                <div class="inner_checked ">&#10004;</div>
                            </span>
                        </div>
                    </li>
                    <p class="select_category"></p>
                    <span class="or-marker">&nbsp;Or only&nbsp;</span>
                    <?php
                    
                    $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']}";
               $query = mysqli_query($connection,$query);
                    $users_label = '';
                    $add_me_too = '';
                    $labels_name = '';
  while($row = mysqli_fetch_assoc($query)){
      if($row['description']){
          $description = '<span>'.htmlentities($row['description']).'</span>';
      }else{
          $description = '';
      }
      if($row['pin']){
          $pin1 = "select_me_selected";
          $pin2 = "display_flex";
      }else{
           
      }
        $pin1 = "";
        $pin2 = "";
     
        $labels_name =  str_replace(" ","&nbsp;",htmlentities( preg_replace('/\r|\n/',' ', htmlentities($row['group_name']))));
      
      echo '      <li>
                        <div class="follow-conn select_tl" cd="'.$row['id'].'"  c="4">
                            <img src="./emogi/128/'.$row['emoji'].'" class="follow-icon">
                                    <span class="conn-name">
                                        <span><b>'.$labels_name.'</b></span>
                                             '.$description.'
                                         </span>
                                    <span class="select_me '.$pin1.' " name="'.$row['group_name'].'">
                                <div class="inner_checked '.$pin2.'">&#10004;</div>
                            </span>
                        </div>
                    </li>';
      
      $users_label .= ' <div class="f11 label_list" id="people_label_'.$row['id'].'" onclick="show_member('.$row['id'].')">
                                     <img src="./emogi/128/'.$row['emoji'].'" class="label_list_logo">
                                    <div class="  following_button">'.$labels_name.'</div>
                                </div>';
      $add_me_too .= ' <div class="f11 label_list" id="people_adds_'.$row['id'].'" onclick="add_me_to('.$row['id'].')">
                                     <img src="./emogi/128/'.$row['emoji'].'" class="label_list_logo">
                                    <div class="  following_button">'.$labels_name.'</div>
                                </div>';
      
  }
                     if($user!=$_SESSION['id']){
                           if($approve == 1){
       $if_follow = 'or A.share_with = 2' ; 
     }else{
       $if_follow = '' ; 
     }
                         $query = "select *,A.id as label_id, A.emoji as emoji_out,A.group_name as group_name_out from yaarme_follow.category A 
                         left join yaarme_follow.category_privacy on A.id = category_privacy.category_id 
                         left join yaarme_follow.category B on  category_privacy.category_allow = B.id 
                         left join yaarme_follow.follow on follow.category = category_privacy.category_allow
                         where (A.owner_id = {$user} and (A.share_with = 3 ".$if_follow." or follow.opponent = {$_SESSION['id']}))";
                         echo $query;
                         $query = mysqli_query($connection,$query);
                         $users_label = '';
                         while($row = mysqli_fetch_assoc($query)){
                               $labels_name =  str_replace(" ","&nbsp;",htmlentities( preg_replace('/\r|\n/',' ', htmlentities($row['group_name_out']))));

                               $users_label .= ' <div class="f11 label_list" id="people_label_'.$row['label_id'].'" onclick="show_member('.$row['label_id'].')">
                                     <img src="./emogi/128/'.$row['emoji_out'].'" class="label_list_logo">
                                    <div class="  following_button">'.$labels_name.'</div>
                                </div>';
                         }
                     }
                    
                    ?>




                    <div class="follow-conn ">

                        <a href="./manage_category" class="hint_crt">Click to manage labels.</a>

                    </div>


                </ul>

            </form>
        </div>

    </div>


    <!--desktop header-->
    <?php
     include './php/desktop_header.php';
    ?>

    <div class="container-wrap">
        <div class="container">
            <div class="left-bar"></div>
            <div class="main-content">
                <div class="homepage-main-content">


                    <div class="a1">
                        <div class="a12 a12_change">
                            <div style="background-image:url('<?php echo $img_user;?>')" class="post_profile a121  <?php if($show_every===true){echo "allow";} ?>" id="profile_image"></div>

                        </div>
                        <a href="#about" class="a12" onclick="show_now('post')">
                            <div>
                                <p class="a122 a122_b"><?php echo $post_user;?></p>
                                <p class="a122 a122_l">Posts</p>
                            </div>
                        </a>
                        <a href="#about" class="a12" onclick="show_now('people');show_member('follower')">
                            <div>
                                <p class="a122 a122_b"><?php echo $follower_user-1;?></p>
                                <p class="a122 a122_l">Followers</p>
                            </div>
                        </a>
                    </div>

                    <img src="<?php echo $img_user;?>" id="full_image">

                    <div class="b1">
                        <div class="b11 b11_name"><?php echo $name_user.$group_name;?></div>
                        <div class="b11 b11_bio"><?php echo $bio_user;?> </div>
                        <div class="b11 b11_location"><?php if(strlen($location_user)>2){echo '<img class="loc-icon" src="./SVG/location.svg" alt="">'.$location_user;} ?></div>
                    </div>

                    <div class="c1">
                        <div class="c12">
                            <div class="c121 c121_follow" id="following_status" onclick="profile_follow(<?php echo $user.','.$privacy_user;?>)"><?php echo $follow_status_out; ?></div>
                        </div>
                        <div class="c12">
                            <a href="./php/create_room.php?for=<?php echo $user; ?>" class="c121 c121_message">Message</a>
                        </div>
                        <div class="c12">
                            <div class="c121 c121_more" onclick="profile_options();open_post_options(<?php echo $user.','. "'".$name_user."'";?>,24,0);">More</div>
                        </div>
                    </div>

                    <div class="cn_mine">
                        <div class="c12  c12_mine">
                            <a class="c121 c121_follow" href="./page/edit_public_profile">Edit profile</a>
                        </div>
                        <div class="c12 c12_mine">
                            <a class="c121 c121_more" href="./page/settings.php">Settings</a>
                        </div>
                    </div>

                    <div class="click_location">
                        <div id="about"></div>
                        <div id="posts"></div>
                        <div id="people"></div>
                    </div>
                    <div class="d1">
                        <a href="#about" class="d12 <?php if($show_every===false){echo "active";} ?>" id="about_add_active" onclick="show_now('about')">About</a>
                        <a href="#about" class="d12 <?php if($show_every===true){echo "active";} ?>" id="post_add_active" onclick="show_now('post')">Posts</a>
                        <a href="#about" class="d12" id="people_add_active" onclick="show_now('people');show_member('following')">People</a>
                    </div>
                    <script>
                        var list_html = [
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            []
                        ];
                    </script>
                    <div class="e1">
                        <!--                        about-->
                        <div class="e11 <?php if($show_every===false){echo "active";} ?>" id="about_show">
                            <!-- <div class="e111 e111_dob">Date of birth :<small class="edit_allowed"><a href="page/edit_dob.php" class="edit"><img src="SVG/pencil.svg" class="pencil">Edit</a></small></div>
                            <div class="e111 e111_date"><?php echo $dob_user;?></div>
                            <div class="e111 e111_Sum">Summary and Overview :<small class="edit_allowed"><a href="page/edit_summary.php" class="edit"><img src="SVG/pencil.svg" class="pencil">Edit</a></small></div>
                            <div class="e111 e111_detail"><?php echo $summary_user;?></div>-->






                            <?php
                            $all_echo  = array();
                            $dateName = '';
                            $monthName = '';
                            $yearName = '';
                            $add_relationship = '';
                            $edit_option = '';
                            $privacy_option = '';
                            $social_links = '';
                            $contact = '';
                            $education_body ='';
                            $work_body ='';
                            $echo_date_work = '';
                            $echo_date_education = '';
                            $edit_option_inner = '';
                            $relationship_body = '';
                            $echo_list_id = '';
                            $privacy_change = '';
                            $contact_edit = '';
                            $contact_eye = '';
                            $group_name = '';
                            
if($user==$_SESSION['id']){
$all_echo[1] = '<a href="page/edit_summary" class=" about_edit_show hidden_about"> <div  class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> A BRIEF NOTE ABOUT YOURSELF</div></div></div></a>'; 
$all_echo[2] = ' <a href="page/edit_dob" class=" about_edit_show hidden_about"> <div class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> DATE OF BIRTH</div></div></div></a>';  
$all_echo[4] = ' <a href="page/relationship" class=" about_edit_show hidden_about"> <div class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> RELATIONSHIP</div></div></div></a>';  
$all_echo[5] = ' <a href="page/education" class=" about_edit_show hidden_about"> <div class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> EDUCATION</div></div></div></a>'; 
$all_echo[6] = ' <a href="page/work" class=" about_edit_show hidden_about"> <div class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> WORK</div></div></div></a>';  
//$all_echo[7] = ' <a href="page/edit_summary"> <div class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> a bried note about yourself</div></div></div></a>'; 
$all_echo[8] = ' <a href="page/add_social_media" class=" about_edit_show hidden_about"> <div class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> OTHER SOCIAL MEDIA</div></div></div></a>';  
$all_echo[9] = ' <a href="page/contact_details" class=" about_edit_show hidden_about"> <div class="about_section"> <div class="section_header"><div class="header_main"><span class="add_user">Add &nbsp;</span> CONTACT DETAILS</div></div></div></a>';  
}
                       
 if($user==$_SESSION['id']){
$query_about = "select *,users.id as  profile_id, about.id as real_id from yaarme.about left join yaarme.users on users.id = about.add_profile
where (
yaarme.about.user = {$user}
)
order by about_code, yaarme.about.id desc
";
}else{
     if($approve == 1){
       $following = 'or share_with = 2' ; 
     }else{
       $following = '' ; 
     }
     
 $query_about = "select *,users.id as  profile_id, about.id as real_id from yaarme.about left join yaarme.users on users.id = about.add_profile left join yaarme.about_privacy on about.connect_privacy  = about_privacy.about_id left join yaarme_follow.follow on follow.category = about_privacy.category_id
where (
yaarme.about.user = {$user} and (share_with = 3 ".$following." or (share_with = 4 and follow.opponent = {$_SESSION['id']}))
)
order by about_code, yaarme.about.id desc
";
 }  
//                            echo $query_about;
                            

$result_about = mysqli_query($connection,$query_about);
while($row_about = mysqli_fetch_assoc($result_about)){
    $joining_date = '';
    $leaving_date = '';
    $echo_privacy = '';
if($row_about['about_code']==1){
if($user==$_SESSION['id']){
$edit_option = '<a href="page/edit_summary" class=""><img src="SVG/pencil.svg" class="pencil about"></a>';
}
if($user==$_SESSION['id']){
    
     if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
//         echo $query_echo_lebels;
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
            $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= htmlentities($row_echo_lebels['group_name']).', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
         $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);
    }
    
    
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
$privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
    
$all_echo[1] = ' <div class="about_section">
    <div class="section_header">
        <div class="header_main">ABOUT </div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
        <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.' id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'"> '.$privacy_option.'</div>
    </div>
    <div class="section_body">'.htmlentities($row_about['my_opinion']).'</div>
</div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';

}else if($row_about['about_code']==2 || $row_about['about_code']==3){
    
    if($user==$_SESSION['id']){
$edit_option = '<a href="page/edit_dob" class=""><img src="SVG/pencil.svg" class="pencil about"></a>';
}
if($user==$_SESSION['id']){
    if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
             $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= $row_echo_lebels['group_name'].', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
     $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);   
    }
    
    
    
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}

    $widget_up = ' <div class="about_section">
     <div class="section_header">
        <div class="header_main">DATE OF BIRTH</div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
        <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.'  id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'">'.$privacy_option.'</div>
    </div>
    <div class="section_body">';
    $widget_down = '</div>
</div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';
    

    if($row_about['start_date']){
    $dateName = $row_about['start_date'];
    }
    
    if($row_about['start_month']){
        $monthNum  = $row_about['start_month'];
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
         $monthName = substr($monthName,0,3);  
    }
    
    if($row_about['start_year']){
    $yearName = $row_about['start_year'];
    }
    if($dateName && $yearName){
        $comma = ', ';
    }else{
       $comma = ''; 
    }
    
$all_echo[2] =  $widget_up.$monthName.' '.$dateName.$comma.$yearName.$widget_down;

}else if($row_about['about_code']==4){
         if($user==$_SESSION['id']){
$edit_option = '<a href="page/relationship" class=""><img src="SVG/plus-regular.svg" class="plus_about about"></a>';
$edit_option_inner = '<a href="page/relationship?edit='.$row_about['real_id'].'" class="about_inner_edit"><img src="SVG/pencil.svg" class="pencil about"></a>';
}
if($user==$_SESSION['id']){
     
     if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
//         echo $query_echo_lebels;
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
          $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= $row_echo_lebels['group_name'].', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
         $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);
        
    }
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
    if($row_about['add_profile']){
        echo '<style>.about_image_relationship{height: 3em;width: 3em;margin-right: 1em;}.about_image_dimension_relationship{height: 3em;width: 3em;background-color: white;</style>';
    }
    
       $widget_up = ' <div class="about_section">
    <div class="section_header">  <div class="header_main">RELATIONSHIP</div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
        <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.'  id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'">'.$privacy_option.'</div></div>
    ';
    $widget_down = '</div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';
    
    $branch = '';
    $company = '';
    $dateName = '';
    $profile_link = '';
    $echo_date_work = '';
    if($row_about['branch'] && $row_about['add_profile']){
        $branch = ', '.$row_about['branch'];
    }
    if($row_about['add_profile']){
        $company = ' with <b>'.htmlentities($row_about['first_name'].' '.$row_about['last_name']).'</b>';
    }else if($row_about['add_profile_name']){
         $company = ' with '.$row_about['add_profile_name'].' ';
    }else{
$company = '  ';
    }
    
     if($row_about['start_year']){
         if($row_about['start_month'] ){
             $monthNum  = $row_about['start_month'];
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
           $monthName = substr($monthName,0,3);  
         }else{$monthName='';}
         if($row_about['start_date'] && $row_about['end_date']){
             $dateName = $row_about['start_date'].', ';
}
         
        $joining_date = $monthName.' '.$dateName.' '.$row_about['start_year'];
         
           if($row_about['end_year']){
         if($row_about['end_month']){
             $monthNum  = $row_about['end_month'];
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
              $monthName = substr($monthName,0,3);  
         }else{$monthName='';}
         if($row_about['end_date'] && $row_about['end_month']){
             $dateName = $row_about['end_date'].', ';
}
         
        $leaving_date = ' - '.$monthName.' '.$dateName.' '.$row_about['end_year'];
    }else{
        $leaving_date = ' - Present';
    }
      $echo_date_work = '<div class="about_date"> '.$joining_date.$leaving_date .'</div> ';  
    }
  if($row_about['profile_id']){
  if($row_about['img']){
$profile_img = './profile/i/120/'.$row_about['img'];   
  }else{
      $profile_img = './profile/i/none.svg';
}
  } else{
      $profile_img = '';
  } 
    if($row_about['profile_id']){
         $profile_link = 'href="./account?user='.$row_about['profile_id'].'"';
    }

    $relationship_body .= ' <div class="section_body"><div class="section_body_grid">
                                        <a '.$profile_link.' class="  about_image_relationship"><div class="post_profile about_image_dimension_relationship round" style="background-image:url('."'".$profile_img."'".')"></div></a>
                                        <div class="  about_other">
                                           <a '.$profile_link.' class="black"> '.htmlentities($row_about['position']).$company.$branch.'</a>                                 
                                           '.$echo_date_work.'
                                           <div class="about_description"> '.htmlentities($row_about['my_opinion']).' </div>  
                                        </div>
                                       '.$edit_option_inner.'
                                    </div></div>';
$all_echo[4] =  $widget_up.$relationship_body.$widget_down;

    
    
    
}else if($row_about['about_code']==5){
         if($user==$_SESSION['id']){
$edit_option = '<a href="page/education" class=""><img src="SVG/plus-regular.svg" class="plus_about about"></a>';
             $edit_option_inner = '<a href="page/education?edit='.$row_about['real_id'].'" class="about_inner_edit"><img src="SVG/pencil.svg" class="pencil about"></a>';
}
if($user==$_SESSION['id']){
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
    if($user==$_SESSION['id']){
    if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
             $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= $row_echo_lebels['group_name'].', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
        $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);
    }
    
    
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
    
    
    if($row_about['add_profile']){
        echo '<style>.about_image_education{height: 3em;width: 3em;margin-right: 1em;}.about_image_dimension_education{height: 3em;width: 3em;background-color: white;</style>';
    }
    
       $widget_up = ' <div class="about_section">
    <div class="section_header">  <div class="header_main">EDUCATION</div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
        <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.'  id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'">'.$privacy_option.'</div></div>
    ';
    $widget_down = '</div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';
    
    $branch = '';
    $company = '';
    $dateName = '';
    $profile_link = '';
    $echo_date_education = '';
   
    
     if($row_about['start_year']){
         if($row_about['start_month'] ){
             $monthNum  = $row_about['start_month'];
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
           $monthName = substr($monthName,0,3);  
         }else{$monthName='';}
         if($row_about['start_date'] && $row_about['end_date']){
             $dateName = $row_about['start_date'].', ';
}
         
        $joining_date = $monthName.' '.$dateName.' '.$row_about['start_year'];
         
           if($row_about['end_year']){
         if($row_about['end_month']){
             $monthNum  = $row_about['end_month'];
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
              $monthName = substr($monthName,0,3);  
         }else{$monthName='';}
         if($row_about['end_date'] && $row_about['end_month']){
             $dateName = $row_about['end_date'].', ';
}
         
        $leaving_date = ' - '.$monthName.' '.$dateName.' '.$row_about['end_year'];
    }else{
        $leaving_date = ' - Present';
    }
      $echo_date_education = '<div class="about_date"> '.$joining_date.$leaving_date .'</div> ';  
    }
    
 $profile_img = '';
    if($row_about['profile_id']){
         $profile_link = 'href="./account?user='.$row_about['profile_id'].'"';
         if($row_about['img']){
$profile_img = './profile/i/120/'.$row_about['img'];
     
  }else{
      $profile_img = './profile/i/none.svg';
}
    }
    
    
    if($row_about['add_profile']){
        $company = '<b>'.htmlentities($row_about['first_name'].' '.$row_about['last_name']).'</b>';
    }else{
       $company =  $row_about['add_profile_name'];
    }
    if($row_about['branch'] || $row_about['branch']){
        $comma_edu = '';
        if($row_about['branch'] && $row_about['branch']){
            $comma_edu = ', ';
}
$branch = '<div class="about_edu_degre">'.htmlentities($row_about['position']).$comma_edu.$row_about['branch'].'</div> ';
    }else{
        $branch = '';
    }

    $education_body .= ' <div class="section_body"><div class="section_body_grid">
                                        <a '.$profile_link.' class="  about_image_education"><div class="post_profile about_image_dimension_education round" style="background-image:url('."'".$profile_img."'".')"></div></a>
                                        <div class="  about_other">
                                           <a '.$profile_link.' class="black"> '.$company.'</a>
                                           '.$branch.'     
                                           '.$echo_date_education.'
                                           <div class="about_description"> '.htmlentities($row_about['my_opinion']).' </div>  
                                        </div>
                                        '.$edit_option_inner.'
                                    </div></div>';
$all_echo[5] =  $widget_up.$education_body.$widget_down;

}else if($row_about['about_code']==6){
    if($user==$_SESSION['id']){
    if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
             $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= $row_echo_lebels['group_name'].', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
        $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);
        
    }
    
    
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
    
      if($user==$_SESSION['id']){
$edit_option = '<a href="page/work" class=""><img src="SVG/plus-regular.svg" class="plus_about about"></a>';
$edit_option_inner = '<a href="page/work?edit='.$row_about['real_id'].'" class="about_inner_edit"><img src="SVG/pencil.svg" class="pencil about"></a>';
}
if($user==$_SESSION['id']){
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
    if($row_about['add_profile']){
        echo '<style>.about_image_work{height: 3em;width: 3em;margin-right: 1em;}.about_image_dimension_work{height: 3em;width: 3em;background-color: white;</style>';
    }
    
       $widget_up = ' <div class="about_section">
    <div class="section_header">  <div class="header_main">WORK</div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
        <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.'  id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'">'.$privacy_option.'</div></div>
    ';
    $widget_down = '</div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';
    
    $branch = '';
    $company = '';
    $dateName = '';
    $profile_link = '';
    $echo_date_work = '';
    if($row_about['branch'] && $row_about['add_profile']){
        $branch = ', '.$row_about['branch'];
    }
    if($row_about['add_profile']){
        $company = ' at <b>'.htmlentities($row_about['first_name'].' '.$row_about['last_name']).'</b>';
    }
    
     if($row_about['start_year']){
         if($row_about['start_month'] ){
             $monthNum  = $row_about['start_month'];
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
           $monthName = substr($monthName,0,3);  
         }else{$monthName='';}
         if($row_about['start_date'] && $row_about['end_date']){
             $dateName = $row_about['start_date'].', ';
}
         
        $joining_date = $monthName.' '.$dateName.' '.$row_about['start_year'];
         
           if($row_about['end_year']){
         if($row_about['end_month']){
             $monthNum  = $row_about['end_month'];
$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
              $monthName = substr($monthName,0,3);  
         }else{$monthName='';}
         if($row_about['end_date'] && $row_about['end_month']){
             $dateName = $row_about['end_date'].', ';
}
         
        $leaving_date = ' - '.$monthName.' '.$dateName.' '.$row_about['end_year'];
    }else{
        $leaving_date = ' - Present';
    }
      $echo_date_work = '<div class="about_date"> '.$joining_date.$leaving_date .'</div> ';  
    }
  if($row_about['profile_id']){
  if($row_about['img']){
$profile_img = './profile/i/120/'.$row_about['img'];   
  }else{
      $profile_img = './profile/i/none.svg';
}
  } else{
      $profile_img = '';
  } 
    if($row_about['profile_id']){
         $profile_link = 'href="./account?user='.$row_about['profile_id'].'"';
    }

    $work_body .= ' <div class="section_body"><div class="section_body_grid">
                                        <a '.$profile_link.' class="  about_image_work"><div class="post_profile about_image_dimension_work round" style="background-image:url('."'".$profile_img."'".')"></div></a>
                                        <div class="  about_other">
                                           <a '.$profile_link.' class="black"> '.htmlentities($row_about['position']).$company.$branch.'</a>                                 
                                           '.$echo_date_work.'
                                           <div class="about_description"> '.htmlentities($row_about['my_opinion']).' </div>  
                                        </div>
                                       '.$edit_option_inner.'
                                    </div></div>';
$all_echo[6] =  $widget_up.$work_body.$widget_down;

}else if($row_about['about_code']==7){
    
    if($user==$_SESSION['id']){
    if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
             $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= $row_echo_lebels['group_name'].', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
        $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);
        
    }
    
    
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
      if($user==$_SESSION['id']){
$edit_option = '<a href="page/edit_dob" class=""><img src="SVG/pencil.svg" class="pencil about"></a>';
}
if($user==$_SESSION['id']){
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>Everyone</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}

$all_echo[7] =  ' <div class="about_section">
    <div class="section_header">  <div class="header_main">LOCATIONS</div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
        <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.'  id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'">'.$privacy_option.'</div></div>
    <div class="section_body">'.htmlentities($row_about['position']).'</div>
</div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';

}else if($row_about['about_code']==8){
    
    if($user==$_SESSION['id']){
    if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
             $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= $row_echo_lebels['group_name'].', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
        $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);
        
    }
    
    
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}
      if($user==$_SESSION['id']){
$edit_option = '<a href="page/add_social_media" class=""><img src="SVG/pencil.svg" class="pencil about"></a>';
}
if($user==$_SESSION['id']){
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}

$upper_grid =  '   <div class="about_section">
                                <div class="section_header">  <div class="header_main">SOCIAL ACCOUNTS</div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
        <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.'  id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'">'.$privacy_option.'</div></div>
                                <div class="section_body">';
    $lower_grid = '</div></div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';
    
    $transform_css = '';
    if($row_about['position'] === 'Youtube' || $row_about['position'] === 'Telegram' ){
        $transform_css = 'style="transform: scale(1.4);margin-right: 1em;"';
    }
    
    $social_links .= '<a href="'.htmlentities($row_about['my_opinion']).'"><img src="./SVG/social-'.htmlentities($row_about['position']).'.svg" class="about_social_media" '.$transform_css.'></a>';
    
                      
 $all_echo[8] = $upper_grid.$social_links.$lower_grid;
    
}else if($row_about['about_code']==9){
    if($user==$_SESSION['id']){
    if($row_about['share_with']==1){
        $echo_privacy = 'Only you';
    }else if($row_about['share_with']==2){
         $echo_privacy = 'Only followers';
    }else if($row_about['share_with']==3){
         $echo_privacy = 'Everyone';
    }else if($row_about['share_with']==4){
         $echo_privacy = '';
        $query_echo_lebels = "select * from yaarme.about_privacy join yaarme_follow.category on yaarme_follow.category.id = yaarme.about_privacy.category_id where about_id = {$row_about['real_id']}";
          $result_echo_lebels = mysqli_query($connection,$query_echo_lebels);
             $echo_privacy = '';
            $echo_list_id = '';
  while($row_echo_lebels = mysqli_fetch_assoc($result_echo_lebels)){
      $echo_privacy .= $row_echo_lebels['group_name'].', ';
      $echo_list_id .= $row_echo_lebels['category_id'].', ';
  }
        $echo_privacy = 'Only '.substr($echo_privacy,0,-2);
         $echo_list_id = substr($echo_list_id,0,-2);
    }
    
    
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
}


      if($user==$_SESSION['id']){
$edit_option = '<a href="page/contact_details" class=""><img src="SVG/plus-regular.svg" class="plus_about about"></a>';
}
if($user==$_SESSION['id']){
$privacy_option = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
    $privacy_change = 'onclick="show_privacy_change('.$row_about['real_id'].','.$row_about['about_code'].')"';
    $contact_edit = '<a href="page/contact_details?edit='.$row_about['real_id'].'" class=""><img src="SVG/pencil.svg" class="pencil about"></a>';
    $contact_eye = '<img src="SVG/eye-regular.svg" class="pencil about eye"> <span>'.$echo_privacy.'</span>';
}

$upper_grid = ' <div class="about_section">
    <div class="section_header">
        <div class="header_main">CONTACT</div>
        <div class=" about_edit_show hidden_about header_edit">'.$edit_option.'</div>
       
    </div>
    ';
    $lower_grid = '</div>';
    $description = '';
    if($row_about['my_opinion']){
        $description = '  <div class="about_description">'.htmlentities($row_about['my_opinion']).'</div>';
    }
    
    $contact .= '<div class="section_body">
        <div class="contact_about">
            <div>
                <div>'.htmlentities($row_about['position']).$contact_edit.'</div>
              '.$description.'
            </div>
            <div></div>
            <div class=" about_edit_show hidden_about header_privacy  header_privacy about_edit_show hidden_about_'.$row_about['about_code'].'" '.$privacy_change.'  id="privacy_func_'.$row_about['real_id'].'_'.$row_about['about_code'].'" privacy_level="'.$row_about['share_with'].'">'.$contact_eye.'</div>
        </div></div><script>list_html['.$row_about['about_code'].']['.$row_about['real_id'].']=[ '.$echo_list_id.' ];</script>';
    
                      
 $all_echo[9] = $upper_grid.$contact.$lower_grid;
    
}
}


foreach($all_echo as $value){
    echo $value ;
}
?>
                            <div class="cn_mine cn_mine_holder">
                                <div class="c12 c12_mine cn_about_edit" id="show_advance_setting_about" onclick="setting_about()">
                                    <div class="c121 c121_more cn_about_more">Edit about section</div>
                                </div>
                            </div>


                        </div>

                        <!--                        post-->
                        <div class="e11 <?php if($show_every===true){echo "active";} ?>" id="post_show">
                            <div id="new_posts"></div>
                        </div>

                        <!--                        follower-->
                        <div class="e11 " id="people_show">
                            <div class="f1 f1_scroll">
                                <div class="f11 green" id="people_label_following" onclick="show_member('following')">
                                    <div class="f111  following_button">following</div>
                                </div>
                                <div class="f11 green active" id="people_label_follower" onclick="show_member('follower')">
                                    <div class="f111 follower_button">followers</div>
                                </div>


                                <?php
//                                if($user==$_SESSION['id']){
                                    echo $users_label;
//}
                                  if($user==$_SESSION['id']){
                                    echo '<a href="./manage_category/" class="f11 manage_label_f11" onclick="show_member(2)">
                                    <div class="f111  following_button manage_label">Manage&nbsp;labels</div>
                                </a>
                                    ';
}
                                
                                
                                ?>



                            </div>
                            <div id="follow_following_list">

                                <!--                            take source code from like.php-->

                            </div>


                            <!--                            add people-->
                            <?php
                                            if($user==$_SESSION['id']){
                                            echo ' <div class="add_people" id="g1_create">
                                Add People
                            </div>
                            <div class="all_ado ">
                                <div class="f1 f1_scroll">
                                    <div class="f11 green" id="people_adds_following" onclick="add_me_to('."'".'following'."'".')">
                                        <div class="f111  following_button">following</div>
                                    </div>
                                    <div class="f11 green active" id="people_adds_follower" onclick="add_me_to('."'".'followers'."'".')">
                                        <div class="f111 follower_button">follower</div>
                                    </div>'.$add_me_too.' <div class="f11 green" id="people_adds_unlisted" onclick="add_me_to('."'".'unlisted'."'".')">
                                        <div class="f111  following_button">Unlabelled</div>
                                    </div>
                                </div>
                                <div id="all_list_f_add">
                                    <div id="result_f_add">
                                    </div>
                                </div>
                            </div>';
                                            }
                                            ?>

                            <!-- <div class="add_people" id="g1_create">
                                Add People
                            </div>
                            <div class="all_ado ">
                                <div class="f1 f1_scroll">
                                    <div class="f11 green" id="people_adds_following" onclick="add_me_to('following')">
                                        <div class="f111  following_button">following</div>
                                    </div>
                                    <div class="f11 green active" id="people_adds_follower" onclick="add_me_to('follower')">
                                        <div class="f111 follower_button">follower</div>
                                    </div>
                                            <?php
                                            if($user==$_SESSION['id']){
                                            echo $add_me_too;
                                            }
                                            ?>
                                      <div class="f11 green" id="people_adds_unlisted" onclick="add_me_to('unlisted')">
                                        <div class="f111  following_button">Unlabelled</div>
                                    </div>
                                </div>
                                <div id="all_list_f_add">
                                    <div id="result_f_add">
                                    </div>
                                </div>
                            </div>-->

                        </div>

                    </div>

                    <!--  activate on click triple dot-->
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
                                    <?php
                                            if($user==$_SESSION['id']){
                                            echo '<li id="remover_follower" onclick="close_options('."'"."_fst"."'".');remove_follower();">
                                    <div class="follow-conn ">
                                        <img src="./SVG/lock-solid-red.svg" class="follow-icon">
                                        <span class="conn-name">
                                            <span>
                                                <b>Remove as follower</b></span>
                                        </span>
                                    </div>
                                </li>';
                                            }
                                            ?>
                                
                                
                                <li id="block_options" onclick="openlist('_block');close_options('_warning_delete');">
                                    <div class="follow-conn ">
                                        <img src="./SVG/lock-solid-red.svg" class="follow-icon">
                                        <span class="conn-name">
                                            <span>
                                                <b>block</b></span>
                                        </span>
                                    </div>
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

                                <li id="share_options" onclick="share(' <?php echo $name_user;?>','Follow <?php echo $name_user;?> on Yaariii','https://yaariii.com/account?user=<?php echo $user;?>');close_options('_fst')">
                                    <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Profile</b></span> </span> </div>
                                </li>

                                <li id="post_options" onclick="share_post();close_options('_fst')">
                                    <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Post</b></span> </span> </div>
                                </li>



                                <li>
                                    <div class="follow-conn"> </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- delete post warning-->
                    <div class="my_options" id="post_option_warning_delete">
                        <div class="my_options my_options_block" onclick="close_options('_warning_delete')">
                        </div>
                        <div class="items item_post" style="">
                            <p class="select_category">Select what to do with this post.</p>
                            <ul class="post_options">
                                <li onclick="edit_post_confirm();close_options('_warning_delete');">
                                    <div class="follow-conn "> <img src="./SVG/pen-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Edit Post</b></span> </span> </div>
                                </li>
                                <li onclick="openlist('_delete');close_options('_warning_delete');">
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
                                <button class="follow-button block" onclick="block_user_confirm(1);">Yes</button>
                                <div></div>
                            </div>
                        </div>
                    </div>

                    <?php echo '<script>var user = '.$user.';</script>';?>



                    <!-- chnage list-->
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

                    <!--                   add posts   -->
                    <script>
                        <?php
                            
                             echo "var po_st_type = 1;";
                             
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

                        window.onscroll = function(ev) {
                            if ((window.innerHeight + window.scrollY + 3000) >= document.body.offsetHeight && window.location.hash !== "#searching") {
                                creat_post();
                            }
                            //hide mobile navs 2
                            if (this.oldScroll > this.scrollY) {
                                scroll++;
                                scrolldown = 1;

                            } else {
                                //   scrolling hide
                                scrolldown++;
                                scroll = 1;

                            }
                            this.oldScroll = this.scrollY;
                        };


                        creat_post();

                        function creat_post() {
                            if (load_m) {
                                load_m = 0;

                                console.log('bottom');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {

                                    if (this.readyState == 4 && this.status == 200) {

                                        var my_adds = "";

                                        var output = JSON.parse(this.responseText);
                                        for (var i = 0; i < output.post.length; i++) {
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
                                            if (output.post[i].following != 1) {
                                                follow_integ = " • Follow ";
                                            } else {
                                                follow_integ = '';
                                            }
                                            if (output.post[i].mute == 1) {
                                                mute_integ = " • Unmute ";
                                            } else {
                                                mute_integ = '';
                                            }
                                            if (output.post[i].tag) {
                                                tagshow = "• " + output.post[i].tag;
                                            } else {
                                                tagshow = '';
                                            }
                                            var react_types = '';
                                            for (var m = 0; m < output.post[i].reaction_type.length; m++) {
                                                if (m < 3) {
                                                    if (output.post[i].reaction_type[m] == 1) {
                                                        react_types += '<a href="like?post=' + output.post[i].id + '"  class="icon like-icon"></a>';
                                                    } else if (output.post[i].reaction_type[m] == 2) {
                                                        react_types += '<a href="like?post=' + output.post[i].id + '"  class="icon love-icon"></a>';
                                                    } else if (output.post[i].reaction_type[m] == 3) {
                                                        react_types += '<a href="like?post=' + output.post[i].id + '"  class="icon support-icon"></a>';
                                                    } else if (output.post[i].reaction_type[m] == 4) {
                                                        react_types += '<a href="like?post=' + output.post[i].id + '"  class="icon celebrate-icon"></a>';
                                                    } else if (output.post[i].reaction_type[m] == 5) {
                                                        react_types += '<a href="like?post=' + output.post[i].id + '"  class="icon fire-icon"></a>';
                                                    } else if (output.post[i].reaction_type[m] == 6) {
                                                        react_types += '<a href="like?post=' + output.post[i].id + '"  class="icon haha-icon"></a>';
                                                    } else if (output.post[i].reaction_type[m] == 7) {
                                                        react_types += '<a href="like?post=' + output.post[i].id + '"  class="icon sad-icon"></a>';
                                                    }
                                                }
                                            }
                                            if (output.post[i].profile_url) {
                                                var post_own_pic = "profile/i/1080/" + output.post[i].profile_url;
                                            } else {
                                                var post_own_pic = "profile/i/none.svg";
                                            }
                                            if (user_id == output.post[i].owner_id) {
                                                var check_if_owner = '<span class="icon more-icon top-corner" id="more_post_click" onclick="open_ask_delete(' + output.post[i].id + ');openlist(' + "'" + '_warning_delete' + "'" + ',' + output.post[i].id + ');"></span>';
                                            } else {
                                                var check_if_owner = '<span class="icon more-icon top-corner" id="more_post_click" onclick="post_options();open_post_options(' + output.post[i].owner_id + ', ' + "'" + output.post[i].name + "'" + ',' + output.post[i].id + ',' + output.post[i].account_type + ')"></span>';
                                            }
                                            if (output.post[i].shared_with) {
                                                var shared_with = "<p class='shared_with'>" + output.post[i].shared_with + "</p>";
                                            } else {
                                                var shared_with = "";
                                            }
                                            if (output.post[i].location) {
                                                var location_in_post = ' • ' + output.post[i].location;
                                            } else {
                                                var location_in_post = '';
                                            }
                                            var total_comments = '';
                                            if (output.post[i].comment == 1) {
                                                total_comments = '1 comment';
                                            } else if (output.post[i].comment > 1) {
                                                total_comments = output.post[i].comment + ' comments';
                                            }


                                            console.log(react_types)
                                            max_id = output.post[i].id;
                                            my_adds = '<div class="card card_own_' + output.post[i].owner_id + '" post_id="' + output.post[i].id + '">' + shared_with + ' <div class="follow-conn"> <img src="' + post_own_pic + '" class="follow-icon users" oncontextmenu="this.requestFullscreen();this.setAttribute(' + "'" + 'src' + "'" + ',' + 'this.getAttribute(' + "'" + 'src' + "'" + ').replace(' + "'" + 'profile/i/120/' + "'" + ', ' + "'" + 'profile/i/1080/' + "'" + ')' + ');return false;"/> <div class="conn-name"> <span> <b class="post_header"><a  href="./account?user=' + output.post[i].owner_id + '" target="_blank" class="name">' + output.post[i].name + '&nbsp;</a> <small class="u_c_' + output.post[i].owner_id + '" onclick="change_tag(' + output.post[i].owner_id + ')">' + tagshow + '</small> <small class="fllw_' + output.post[i].owner_id + '" onclick="unfollow_ys(' + output.post[i].owner_id + ',' + output.post[i].account_type + ')">' + follow_integ + '</small><small class="unmt_' + output.post[i].owner_id + '" onclick="mute_ys(' + output.post[i].owner_id + ')">' + mute_integ + '</small> </b> </span> <a href="./account?user=' + output.post[i].owner_id + '" target="_blank">' + output.post[i].introduction + '</a>  <a href="./account?user=' + output.post[i].owner_id + '" target="_blank"> <span>' + output.post[i].time + location_in_post + ' </span>  </a> </div> ' + check_if_owner + ' </div><div class="post_raw_body" ondblclick="double_click_love(' + output.post[i].id + ')"> <p class="content select_text"> ' + output.post[i].body_text.replace("<br>", "<br>") + ' </p> ' +
                                                sa + slidrr + sb +
                                                '</div> <div class="vote-section" > ' + react_types + ' <a href="like?post=' + output.post[i].id + '" target="_blank" class="votes">' + output.post[i].like + '&nbsp;</a> <span class=" post-slider-dots post-slider-dots_' + output.post[i].id + '"></span> <a href="posts?p=' + output.post[i].id + '" target="_blank" > ' + total_comments + ' </a> </div> <div class="share-section"  > <div class="icon-wrap open_reactions ' + output.post[i].reaction + '" id="like_' + output.post[i].id + '"> <div class="like_option"> <div class="set_it"> <img src="./emogi/other/compressed/thumbs_up.gif" title="Like" class="like_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/sparkling_heart.gif" title="Love" class="love_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/handshake.gif" title="Support" class="support_inner " oncontextmenu="return false"/> <img src="./emogi/other/compressed/party_popper.gif" title="Celebrate" class="cele_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/fire.gif" title="Hot" class="hot_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" title="Laugh" class="smile_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/crying_face.gif" title="Sad" class="sad_inner" oncontextmenu="return false"/> </div> </div> <div class="flex"> <img src="./emogi/128/human/thumbs-up-medium-light-skin-tone.png" class="icon like-i default"> <span class="default">Like&nbsp;</span> <img src="./emogi/other/compressed/thumbs_up.gif" class="icon like-i liked" oncontextmenu="return false"> <span class="liked">Liked</span> <img src="./emogi/other/compressed/sparkling_heart.gif" class="icon loved" oncontextmenu="return false"> <span class="loved">Loved</span> <img src="./emogi/other/compressed/handshake.gif" class="icon supported" oncontextmenu="return false"> <span class="supported">Supported</span> <img src="./emogi/other/compressed/party_popper.gif" class="icon celebrated" oncontextmenu="return false"> <span class="celebrated">celebrated</span> <img src="./emogi/other/compressed/fire.gif" class="icon fired" oncontextmenu="return false"> <span class="fired">Hot</span> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" class="icon haha" oncontextmenu="return false"> <span class="haha">HaHa</span> <img src="./emogi/other/compressed/crying_face.gif" class="icon sad" oncontextmenu="return false"> <span class="sad">Sad</span> </div> </div> <div class="icon-wrap" onclick="show_comment(' + output.post[i].id + ')"> <img src="./SVG/comment.svg" class="icon comment-icon" /> <span>Comment</span> </div> <div class="icon-wrap ' + output.post[i].save + '" id="save_' + output.post[i].id + '" onclick="save_me(' + output.post[i].id + ')"> <img src="./SVG/save.svg" class="icon send-icon" /><span>Save&nbsp;</span> <img src="./SVG/saved.svg" class="icon send-icon saved_done" /> <span class="saved_done ">Saved</span> </div> </div> <div id="load_comments_' + output.post[i].id + '"></div> <form class="follow-conn comment_attempt " id="comment_' + output.post[i].id + '" onsubmit="submit_comment(event,' + output.post[i].id + ')"><img src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>" class="follow-icon comment_profile" /><span href="profile/" class="comment_form"><textarea type="text" rows="1" class="comment_input" id="comment_input_' + output.post[i].id + '" value="o" placeholder="Leave your comment..." onkeydown="autosize(' + output.post[i].id + ')"></textarea></span><button class="follow post_comment">Post</button></form> </div> ';
                                            load_m = 1;
                                            document.getElementById("new_posts").insertAdjacentHTML("beforeend", my_adds);
                                            if (document.getElementById('slider_' + output.post[i].id)) {
                                                slide(output.post[i].id, document.getElementById('slider_' + output.post[i].id), document.getElementById('items_' + output.post[i].id), document.getElementById('prev_' + output.post[i].id), document.getElementById('next_' + output.post[i].id));
                                            }
                                            reaction(output.post[i].id);
                                        }

                                        //                    prevent emoji download
                                        var images = document.querySelectorAll('img');
                                        for (var i = 0; i < images.length; i++) {
                                            images[i].oncontextmenu = function() {
                                                return false;
                                            };
                                        }
                                    }
                                };
                                xhttp.open("GET", "./php/profile_posts.php?u=<?php if($show_every!=false){echo $user;} ?>&f=" + max_id, true);
                                console.log("./php/profile_posts.php?u=<?php if($show_every!=false){echo $user;} ?>&f=" + max_id, true)
                                xhttp.send();
                                t++;
                            }
                        }
                        //       profile_posts.php?u=1
                    </script>



                </div>
            </div>
            <div class="right-bar"></div>
        </div>
    </div>

    <!--    mobile header-->
    <div class="mobile-header">
        <a href="./" class="icon me-icon">
            <svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" data-supported-dps="24x24" fill="black" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <path d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"></path>
            </svg>
        </a>
        <span class="">
            <label class="white" for="button_post_desk"><?php echo $name_user;?></label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>
    <script src="./JS/main.js?v=17"></script>
    <script src="./JS/profile.js?v=17"></script>

    <?php
    if($show_every===false){
        echo "<script>function show_now(id){window.alert('this is private account.')}</script>";
    }
    if(isset($_GET['edit'])){
        echo "<script>show_now('about');setting_about();</script>";
        
    }
     if($user==$_SESSION['id']){
           echo "<script>if(location.hash==='#about'){show_now('about');}else if(location.hash==='#people'){show_now('people');}else if(location.hash==='#post'){show_now('post');}</script>";
         if(isset($_GET['label'])){
              echo "<script>show_member(".$_GET['label'].")</script>";
         }
     }
    
    ?>
    <script>
        console.log(list_html[1][5]);
    </script>
</body>

</html>