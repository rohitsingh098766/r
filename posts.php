<?php
     session_start();
     include './connection.php';


//check in user is allowed to watch this post
$post_id =  mysqli_real_escape_string($connection, $_GET['p']);

// add coockies if shared
setcookie("shared", 2, time() + (86400 * 364),'/');
setcookie("shared_id", $post_id, time() + (86400 * 364),'/');

   if(!isset($_SESSION['id'])){include './login/check_coockie.php';}
//echo   $_SESSION['name'].$_SESSION['img'];

function time_convert($time) {
   if($time <60){ $time_show=$time."s"; }else if($time < 3600){ $time_show=$time / 60; $time_show=intval($time_show); $time_show=$time_show."m"; }else if($time < 86400){ $time_show=$time / 3600; $time_show=intval($time_show); $time_show=$time_show."h"; }else if($time < (86400*30)){ $time_show=$time / 86400; $time_show=intval($time_show); $time_show=$time_show."d"; }else if($time < (86400*365)){ $time_show=$time / (86400*30); $time_show=intval($time_show); $time_show=$time_show."M"; }else{ $time_show=$time / (86400*365); $time_show=intval($time_show); $time_show=$time_show."y"; } return $time_show; }



$query = "select * from yaarme_post.posts join yaarme.users on users.id = posts.owner_id  where posts.id = {$post_id}";
//echo $query;
 $result = mysqli_query($connection,$query);
if(!mysqli_num_rows($result)){
    header('Location: ./');
}

     while($row_p = mysqli_fetch_assoc($result)){
         $owner = $row_p['owner_id'];
         $relation = false;
//         echo $row_p['p1'];
         $query_check_relation = "select * from yaarme_follow.follow where user = {$_SESSION['id']} and opponent = {$row_p['owner_id']}";
         $result_check_relation = mysqli_query($connection,$query_check_relation);
     while($row_check_relation = mysqli_fetch_assoc($result_check_relation)){
         if($row_check_relation['approve']==1){
             $relation = true;
         }else if($row_check_relation['approve']==11){
            exit(0);   
         }
        
     }
          if($row_p['account_type']==1 && $relation === false){
             header('Location: ./account?user='.$owner);
              exit(0);  
         }else if($row_p['account_type']!=1){
//                echo "show post"; 
          }
     }
//exit(0);    

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feed | YaarMe</title>
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="stylesheet" href="CSS/spin_loader.css" />
    <link rel="stylesheet" href="./search/CSS/style.css" />
    <link rel="stylesheet" href="CSS/slider.css" />
    <link rel="stylesheet" href="CSS/mobile_header.css" />
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
    
    <style>
    
    .load_comments {
    padding: .25em 0;
    border-top: 0;
}
    </style>
    
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

    <!--desktop header-->
 <?php
     include './php/desktop_header.php';
    ?>
    
    
    <div class="container-wrap">
        <div class="container">
            <div class="left-bar"></div>
            <div class="main-content">
                <div class="homepage-main-content">
                  

                    <div class="posts" >
                        
                        <div  id="first_post"></div>



                        <div id="new_posts"> </div>

<!--                   add posts   -->
                         <script>
                            <?php
                            
                            
                            
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
                    for (var i = 0; i < output.post.length; i++) {
                        var slidrr = "";
                        var sa = '<div id="slider_' + output.post[i].id + '" class="slider loaded" post_id="' + output.post[i].id + '" > <div class="wrapper"> <span id="prev_' + output.post[i].id + '" class="control prev"></span> <span id="next_' + output.post[i].id + '" class="control next"></span> <div id="items_' + output.post[i].id + '" class="items_slider"> ';
                        var sb = '</div></div> </div>';
                        for (var im = 0; im < output.post[i].body_img_urls.length; im++) {
                            slidrr += '<img src="create_post/upload/1080/' + output.post[i].body_img_urls[im] + '" class="slide" id="img' + output.post[i].id + "img" + im + '" oncontextmenu="this.requestFullscreen()"> ';
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
                        my_adds = '<div class="card card_own_' + output.post[i].owner_id + '" post_id="' + output.post[i].id + '"> <div class="follow-conn"> <a href="./account?user='+output.post[i].owner_id+'" style="background-image:url('+post_own_pic+')" class="follow-icon users post_profile" target="_blank"></a> <div class="conn-name"> <span> <b class="post_header"><a  href="./account?user='+output.post[i].owner_id+'" target="_blank" class="name">' + output.post[i].name + '</a> <small class="u_c_' + output.post[i].owner_id + '" onclick="change_tag(' + output.post[i].owner_id + ')">' + tagshow + '</small> <small class="fllw_' + output.post[i].owner_id + '" onclick="unfollow_ys(' + output.post[i].owner_id + ',' + output.post[i].account_type + ')">'+follow_integ+'</small><small class="unmt_' + output.post[i].owner_id + '" onclick="mute_ys(' + output.post[i].owner_id + ')">'+mute_integ+'</small> </b> </span> <a href="./account?user='+output.post[i].owner_id+'" target="_blank">' + output.post[i].introduction + '</a>  <a href="./account?user='+output.post[i].owner_id+'" target="_blank"> <span>' + output.post[i].time + location_in_post + ' </span>  </a> </div> '+check_if_owner+' </div><div class="post_raw_body" ondblclick="double_click_love(' + output.post[i].id + ')"> <p class="content select_text"> ' + output.post[i].body_text.replace("<br>","<br>") + ' </p> ' +
                            sa + slidrr + sb +
                            '</div> <div class="vote-section" > '+react_types+' <a href="like?post='+output.post[i].id+'" class="votes">' + output.post[i].like + '&nbsp;</a> <a href="like?post='+output.post[i].id+'" class=" post-slider-dots post-slider-dots_' + output.post[i].id + '"></a> <a href=""> ' + total_comments + ' </a> </div> <div class="share-section"  > <div class="icon-wrap open_reactions ' + output.post[i].reaction + '" id="like_' + output.post[i].id + '"> <div class="like_option"> <div class="set_it"> <img src="./emogi/other/compressed/thumbs_up.gif" title="Like" class="like_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/sparkling_heart.gif" title="Love" class="love_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/handshake.gif" title="Support" class="support_inner " oncontextmenu="return false"/> <img src="./emogi/other/compressed/party_popper.gif" title="Celebrate" class="cele_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/fire.gif" title="Hot" class="hot_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" title="Laugh" class="smile_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/crying_face.gif" title="Sad" class="sad_inner" oncontextmenu="return false"/> </div> </div> <div class="flex"> <img src="./SVG/thumbs-up-black.svg" class="icon like-i default"> <span class="default">Like&nbsp;</span> <img src="./emogi/other/compressed/thumbs_up.gif" class="icon like-i liked" oncontextmenu="return false"> <span class="liked">Liked</span> <img src="./emogi/other/compressed/sparkling_heart.gif" class="icon loved" oncontextmenu="return false"> <span class="loved">Loved</span> <img src="./emogi/other/compressed/handshake.gif" class="icon supported" oncontextmenu="return false"> <span class="supported">Supported</span> <img src="./emogi/other/compressed/party_popper.gif" class="icon celebrated" oncontextmenu="return false"> <span class="celebrated">celebrated</span> <img src="./emogi/other/compressed/fire.gif" class="icon fired" oncontextmenu="return false"> <span class="fired">Hot</span> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" class="icon haha" oncontextmenu="return false"> <span class="haha">HaHa</span> <img src="./emogi/other/compressed/crying_face.gif" class="icon sad" oncontextmenu="return false"> <span class="sad">Sad</span> </div> </div> <div class="icon-wrap" onclick="show_comment(' + output.post[i].id + ')"> <img src="./SVG/comment.svg" class="icon comment-icon" /> <span>Comment</span> </div> <div class="icon-wrap ' + output.post[i].save + '" id="save_' + output.post[i].id + '" onclick="save_me(' + output.post[i].id + ')"> <img src="./SVG/save.svg" class="icon send-icon" /><span>Save&nbsp;</span> <img src="./SVG/saved.svg" class="icon send-icon saved_done" /> <span class="saved_done ">Saved</span> </div> </div><form class="follow-conn comment_attempt comment_show" id="comment_' + output.post[i].id + '" onsubmit="submit_comment(event,' + output.post[i].id + ')"><img src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>" class="follow-icon comment_profile" /><span href="profile/" class="comment_form"><textarea type="text" rows="1" class="comment_input" id="comment_input_' + output.post[i].id + '" value="o" placeholder="Leave your comment..." onkeydown="autosize(' + output.post[i].id + ')"></textarea></span><button class="follow post_comment">Post</button></form> <div id="load_comments_' + output.post[i].id + '"></div> <?php
                            
//                        $post_id = 100;
                        $query_comments = "select * , TIMESTAMPDIFF(SECOND, yaarme_post.post_comment.time,CURRENT_TIMESTAMP ) as time_ago,yaarme_post.post_comment.id as comment_id
                        from yaarme_post.post_comment 
                        join yaarme.users on yaarme.users.id = yaarme_post.post_comment.user
                        where post_id = {$post_id} order by yaarme_post.post_comment.id desc limit 200 ";
                        $query_comments = mysqli_query($connection,$query_comments);
    while($row_comments = mysqli_fetch_assoc($query_comments)){
        if($row_comments['img']){
           $img_comment = './profile/i/240/'.$row_comments['img'];
        }else{
           $img_comment = './profile/i/none.svg'; 
        }
        
//        check relation
$add_follow_option = '<small class="blue fllw_'.$row_comments['user'].'" onclick="unfollow_ys('.$row_comments['user'].','.$row_comments['account_type'].')"> • Follow </small>';
        
         $query_relation = "select *  from yaarme_follow.follow where (user = {$_SESSION['id']} and opponent = {$row_comments['user']})";
                        $query_relation = mysqli_query($connection,$query_relation);
    while($row_relation = mysqli_fetch_assoc($query_relation)){
        
        if($row_relation['approve']==1 || $row_relation['approve']==11 || $row_relation['approve']==10 || ($row_comments['user'] == $_SESSION['id'])){  
        $add_follow_option = '';
        }else if($row_relation['approve']==9){  
        $add_follow_option = '<small class="blue fllw_'.$row_comments['user'].'" onclick="unfollow_ys('.$row_comments['user'].',1)"> • Requested </small>';
        }
    }
          $editable = '';
        if(($row_comments['user'] == $_SESSION['id'])|| ($owner == $_SESSION['id'])){
            $editable = '<span class="comnt_click" onclick="delete_comment('.$row_comments['comment_id'].')">more</span>';
        }
        
        
        $comment = preg_replace('/\r|\n/','\n',trim(htmlentities($row_comments['text'])));
        $time_comment = time_convert($row_comments['time_ago']);
//        $img_comment = 
          echo '<div  class="load_comments" id="comment_id_'.$row_comments['comment_id'].'"><div class="follow-conn"><a href="./account?user='.$row_comments['user'].'"><div  style="background-image:url('.$img_comment.')" alt="profile-pic" class="bg_image comment_profile "></div></a><span href="profile/" class="comment_form commented"><div class="comment_input commented_input"> <b>'.htmlentities($row_comments['first_name'].' '.$row_comments['last_name']).'</b>'.$add_follow_option.'<br>'.$comment.'<div class="more_comment">'.$time_comment.$editable.'   </div></div></span></div></div>';} ?>  </div> ';
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
            xhttp.open("GET", "./php/post_id.php?p=<?php echo $post_id?>", true);
            console.log("./php/post_id.php?p=<?php echo $post_id?>");
            xhttp.send();
            t++;
        }
    }
       
                        </script>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        

                       
                        <!--                        open post option on triple click-->
                        <div class="my_options " id="post_option_fst">
                            <div class="my_options my_options_block" onclick="close_options('_fst')">
                            </div>
                            <div class="items item_post" style="">
                                <p class="select_category">Select what to do with post or post owner.</p>
                                <ul class="post_options">
                                    <li id="block_options" onclick="openlist('_block');close_options('_warning_delete');">
                                        <div class="follow-conn "> <img src="./SVG/lock-solid-red.svg" class="follow-icon"> <span class="conn-name"> <span><b>block</b></span> </span> </div>
                                    </li>
                                    <li onclick="openlist('_report')">
                                        <div class="follow-conn "> <img src="./SVG/exclamation-triangle-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Report post...</b></span> </span> </div>
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
                                    <li onclick="share_post()">
                                        <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Post </b></span> </span> </div>
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
                                   
                                     <li onclick="share_post()">
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
                        
                        <!-- Delete comments-->
                        <div class="my_options" id="post_option_delete_comment">
                            <div class="my_options my_options_block" onclick="close_options('_delete_comment')">
                            </div>
                            <div class="items item_post" style="">
                                <p class="select_category">You can delete this comment, no one will be notified.</p>
                                <ul class="post_options">
                                    <li onclick="delete_comment_confirmed();close_options('_delete_comment');">
                                        <div class="follow-conn "> <img src="./SVG/trash-alt-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Delete comment...</b></span> </span> </div>
                                    </li>
                                </ul>
                               
                            </div>
                        </div>


                        <!--                        chnage list-->
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


    <!--    mobile header-->
    <div class="mobile-header">
        <a href="./" class="icon me-icon">
            <svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" data-supported-dps="24x24" fill="black" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <path d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"></path>
            </svg>
        </a>
        <span class="">
            <label class="white" for="button_post_desk">Post</label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>


<script src="JS/main.js"></script>

<script>
    
    var active_comment = 0;
    function delete_comment(id){
        active_comment = id;
//        window.alert(id);
        openlist('_delete_comment');
    }
    
    function delete_comment_confirmed(){
        document.getElementById('comment_id_'+active_comment).classList.add('hide');
 my_ajax("./php/delete_comment.php","comment_id="+active_comment,"body");
    }
    
    
    
    </script>



</body>

</html>