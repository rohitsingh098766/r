<?php
session_start();
     include './connection.php';
   if(!isset($_SESSION['id'])){include './login/check_coockie.php';}
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Activities</title>
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
</head>

<body id="body" oncontextmenu="">

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
                <a href="request/" class="icon" title="My Network">
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
                                        <a href="#" onclick="share(' <?php echo $_SESSION['name'];?>','Follow <?php echo $_SESSION['name'];?> on Yaariii','https://Yaariii.com/account?user=<?php echo $_SESSION['id'];?>')">
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


                    
                    
                       <div id="new_posts"> </div>

<!--                   add posts   -->
                         <script>
                            <?php
                            
                         echo "var po_st_type = 1;";
                            
                             if($_SESSION['img']){
                             echo "var active_profile_url = 'profile/i/240/".$_SESSION['img']."';";
                             }else{
                             echo "var active_profile_url = 'profile/i/none.svg';";
                             }
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
                            var post_own_pic =  "profile/i/none.svg";
                        }
                        if(output.post[i].location){
                            var location_in_post = ' • ' +  output.post[i].location ;
                        }else{
                             var location_in_post ='';
                        }
                        
                        
                        console.log(react_types)
                        max_id = output.post[i].id;
                        my_adds = '<div class="card card_own_' + output.post[i].owner_id + '" post_id="' + output.post[i].id + '"> <div class="follow-conn"> <a href="./account?user='+output.post[i].owner_id+'" style="background-image:url('+post_own_pic+')" class="follow-icon users post_profile" target="_blank"></a> <div class="conn-name"> <span> <b>' + output.post[i].name + ' <small class="u_c_' + output.post[i].owner_id + '">' + tagshow + '</small> <small class="fllw_' + output.post[i].owner_id + '" onclick="unfollow_ys(' + output.post[i].owner_id + ',' + output.post[i].account_type + ')">'+follow_integ+'</small><small class="unmt_' + output.post[i].owner_id + '" onclick="mute_ys(' + output.post[i].owner_id + ')">'+mute_integ+'</small> </b> </span> <a href="./account?user='+output.post[i].owner_id+'" target="_blank">' + output.post[i].introduction + '</a> <a href="./account?user='+output.post[i].owner_id+'" target="_blank"> <span>' + output.post[i].time + location_in_post + '  </span>  </a> </div> <span class="icon more-icon top-corner" id="more_post_click" onclick="open_post_options(' + output.post[i].owner_id + ', ' + "'" + output.post[i].name + "'" + ',' + output.post[i].id + ',' + output.post[i].account_type + ')"></span> </div><div class="post_raw_body" ondblclick="double_click_love(' + output.post[i].id + ')"> <p class="content select_text"> ' + output.post[i].body_text.replace("\n\n","<br>") + ' </p> ' +
                            sa + slidrr + sb +
                            '</div> <div class="vote-section" > '+react_types+' <a href="like?post='+output.post[i].id+'" target="_blank" class="votes">' + output.post[i].like + '&nbsp;</a> <span class=" post-slider-dots post-slider-dots_' + output.post[i].id + '"></span> <a href="posts?p='+output.post[i].id+'" target="_blank" > ' + output.post[i].comment + ' Comments</a> </div> <div class="share-section"  > <div class="icon-wrap open_reactions ' + output.post[i].reaction + '" id="like_' + output.post[i].id + '"> <div class="like_option"> <div class="set_it"> <img src="./emogi/other/compressed/thumbs_up.gif" title="Like" class="like_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/sparkling_heart.gif" title="Love" class="love_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/handshake.gif" title="Support" class="support_inner " oncontextmenu="return false"/> <img src="./emogi/other/compressed/party_popper.gif" title="Celebrate" class="cele_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/fire.gif" title="Hot" class="hot_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" title="Laugh" class="smile_inner" oncontextmenu="return false"/> <img src="./emogi/other/compressed/crying_face.gif" title="Sad" class="sad_inner" oncontextmenu="return false"/> </div> </div> <div class="flex"> <img src="./emogi/128/human/thumbs-up-medium-light-skin-tone.png" class="icon like-i default"> <span class="default">Like&nbsp;</span> <img src="./emogi/other/compressed/thumbs_up.gif" class="icon like-i liked" oncontextmenu="return false"> <span class="liked">Liked</span> <img src="./emogi/other/compressed/sparkling_heart.gif" class="icon loved" oncontextmenu="return false"> <span class="loved">Loved</span> <img src="./emogi/other/compressed/handshake.gif" class="icon supported" oncontextmenu="return false"> <span class="supported">Supported</span> <img src="./emogi/other/compressed/party_popper.gif" class="icon celebrated" oncontextmenu="return false"> <span class="celebrated">celebrated</span> <img src="./emogi/other/compressed/fire.gif" class="icon fired" oncontextmenu="return false"> <span class="fired">Hot</span> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" class="icon haha" oncontextmenu="return false"> <span class="haha">HaHa</span> <img src="./emogi/other/compressed/crying_face.gif" class="icon sad" oncontextmenu="return false">  <span class="sad">Sad</span> </div> </div> <div class="icon-wrap" onclick="show_comment(' + output.post[i].id + ')"> <img src="./SVG/comment.svg" class="icon comment-icon" /> <span>Comment</span> </div> <div class="icon-wrap ' + output.post[i].save + '" id="save_' + output.post[i].id + '" onclick="save_me(' + output.post[i].id + ')"> <img src="./SVG/save.svg" class="icon send-icon" /><span>Save&nbsp;</span> <img src="./SVG/saved.svg" class="icon send-icon saved_done" /> <span class="saved_done ">Saved</span> </div> </div> <div id="load_comments_' + output.post[i].id + '"></div> <form class="follow-conn comment_attempt " id="comment_' + output.post[i].id + '" onsubmit="submit_comment(event,' + output.post[i].id + ')"><img src="<?php if($_SESSION['img']){ echo 'profile/i/240/'.$_SESSION['img'];}else{ echo "profile/i/none.svg"; } ?>" class="follow-icon comment_profile" /><span href="profile/" class="comment_form"><textarea type="text" rows="1" class="comment_input" id="comment_input_' + output.post[i].id + '" value="o" placeholder="Leave your comment..." onkeydown="autosize(' + output.post[i].id + ')"></textarea></span><button class="follow post_comment">Post</button></form> </div> ';
                        load_m = 1;
                         document.getElementById("new_posts").insertAdjacentHTML("beforeend", my_adds);
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
            xhttp.open("GET", "./php/activity_post.php?f="+po_st_type+"&s=" + max_id, true);
            xhttp.send();
            t++;
        }
    }
       
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
            <label class="white" for="button_post_desk">Posts at you reacted</label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>
    <script src="./JS/main.js"></script>
</body>

</html>