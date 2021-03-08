<?php
session_start();
     include '../connection.php';
   if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}
$version = 9;
?>


<html lang="en">

<head>
    <title>YaarMe chat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo $version;?>" />
    
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo $version;?>">
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
    <script>
    
     var hours = 0;
       var an_or_pm = 'AM';
     
    
     function get_my_time(time){
        var date = new Date( time + '  UTC');
         
         if(date.getHours()==12){
hours = 12;
        an_or_pm = 'PM';   
       }else if(date.getHours()>12){
           hours = date.getHours()%12;
        an_or_pm = 'PM';  
}else{
     hours = date.getHours();
        an_or_pm = 'AM';  
}

        document.write(hours+':'+date.getMinutes()+' '+an_or_pm);
    }
   
    </script>
</head>

<body>


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
                                        <a href="#"  onclick="share(' <?php echo $_SESSION['name'];?>','Follow <?php echo $_SESSION['name'];?> on YaarMe','https://yaarme.com/account?user=<?php echo $_SESSION['id'];?>')">
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
    
    
    
       <div class="page">
        <div class="marvel-device nexus5">
            <div class="top-bar"></div>
            <div class="sleep"></div>
            <div class="volume"></div>
            <div class="camera"></div>
            <div class="screen">
                <div class="screen-container">
                    <div class="status-bar">
                        <div class="time"></div>
                        <div class="battery">
                            <i class="zmdi zmdi-battery"></i>
                        </div>
                        <div class="network">
                            <i class="zmdi zmdi-network"></i>
                        </div>
                        <div class="wifi">
                            <i class="zmdi zmdi-wifi-alt-2"></i>
                        </div>
                        <div class="star">
                            <i class="zmdi zmdi-star"></i>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="chat-container">
                            <div class="user-bar">
                                <a href="../" class="back inner_div">
                                    <img src="./images/back.svg" class="send_icon">
                                </a>
                                
                                  <?php
                                $room =  mysqli_real_escape_string($connection, $_GET['room']);
                                $query_room = "select * from yaarme_message.my_room 
                                join yaarme.users on yaarme.users.id = yaarme_message.my_room.opponent_member
                                where (room_id = {$room} and room_member = {$_SESSION['id']}) limit 1";
//                                echo $query_room;
                                $result_room = mysqli_query($connection,$query_room);
while($row_room = mysqli_fetch_assoc($result_room)){
    $profile = '../profile/i/none.svg';
    if($row_room['img']){
        $profile = '../profile/i/240/'.$row_room['img']; 
    }
    echo "<script>var opponent = ".$row_room['opponent_member'].";</script>";
//    echo ;
    echo '  <a href="../account?user='.$row_room['opponent_member'].'" class="avatar inner_div" style="background-image: url('."'".$profile."'".'">
                                </a>
    <a href="../account?user='.$row_room['opponent_member'].'" class="name inner_div">
                                    <span>'.$row_room['first_name']." ".$row_room['last_name'].'</span>
                                    <span class="status">'.$row_room['status_mini_bio'].'</span>
                                </a>';
    $proceed = true;
    $opponent_member = $row_room['opponent_member'];
}
                                
                                ?>
                                
                                
                                
<!--
                                
                                <a href="../" class="avatar inner_div" style="background-image: url('../profile.jpg')">
                                </a>
                                 <a href="../" class="name inner_div">
                                    <span>Zeno Rocha</span>
                                    <span class="status">online</span>
                                </a>
-->
                                <div class="actions more inner_div">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </div>
                                <div class="actions attachment inner_div">
                                    <i class="zmdi zmdi-attachment-alt"></i>
                                </div>
                                <div class="actions inner_div">
                                    <i class="zmdi zmdi-phone"></i>
                                </div>
                            </div>
                            <div class="conversation">
                                <div class="conversation-container" id="conversation_container">
                                
                                
                                
                                <?php
//    check last seen
                            $query_seen = "select * from yaarme_message.my_room join yaarme.users on yaarme.users.id = yaarme_message.my_room.room_member where (room_id = {$room} and opponent_member = {$_SESSION['id']})";
                            $result_seen= mysqli_query($connection,$query_seen);
                            while($row_seen = mysqli_fetch_assoc($result_seen)){
$opponent_last_seen_message =  $row_seen['last_seen_msg_id'];
$opponent_last_seen_time =  $row_seen['last_login'];
//                                exit(0);
                            }   
                                    
                                    
                                    
                                    $max_message_id = 0;
if($proceed===true){
$query_room = "select * from yaarme_message.message
where (room_id = {$room}) order by id desc limit 100";
// echo $query_room;
$result_room = mysqli_query($connection,$query_room);
    $final_result ='';
while($row_room = mysqli_fetch_assoc($result_room)){
if($row_room['sender']==$_SESSION['id']){
    $side = 'sent';
    if($opponent_last_seen_message >= $row_room['id']){
        
   $revienced_icon =  '<span class="tick" message="'.$row_room['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#009be0" /></svg></span>';
    }else if($opponent_last_seen_message >= $row_room['id']){
        
   $revienced_icon =  '<span class="tick" message="'.$row_room['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#9b9b9b" /></svg></span>';
    }else{
   $revienced_icon =  '<span class="tick unread_messages" message="'.$row_room['id'].'"><svg aria-hidden="true" data-prefix="fal" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-check fa-w-14 fa-7x" width="12" height="12"><path fill="#9b9b9b" d="M413.505 91.951L133.49 371.966l-98.995-98.995c-4.686-4.686-12.284-4.686-16.971 0L6.211 284.284c-4.686 4.686-4.686 12.284 0 16.971l118.794 118.794c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-11.314-11.314c-4.686-4.686-12.284-4.686-16.97 0z" class=""></path></svg></span>';
        
    }
}else{
    $revienced_icon = '';
    $side = 'received';
}
    if($max_message_id < $row_room['id']){
        $max_message_id = $row_room['id'];
    }
$final_result = ' 
  <div class="message messaged '.$side.'" id="message_id_'.$row_room['id'].'" message="'.$row_room['id'].'">
                                         '.preg_replace('/\r|\n/','\n',trim(htmlentities($row_room['text']))).'
                                        <span class="metadata">
                                            <span class="time"><script>get_my_time("'.$row_room['time'].'  UTC")</script></span>'.$revienced_icon.'
                                        </span>
                                    </div>
'.$final_result;
}
    echo $final_result;
    
//    update seen message
     $query_insert = "UPDATE `yaarme_message`.`my_room` SET `last_seen_msg_id` = '{$max_message_id}' WHERE (room_id = {$room} and room_member = {$_SESSION['id']});";
     if(mysqli_query($connection,$query_insert)){
     }
    
    
}else{
    exit(0);
}
?>
                                
                                
                                
                                
                                  <div id="insert_here"></div>  
                                  
                                </div>
                                <form class="conversation-compose" id="send_message_input">
                                    <div class="emoji">
<!--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209">-->
<!--                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489" /></svg>-->
                                    </div>
                                    <input class="input-msg" name="input" id="input_text" placeholder="Type a message" autocomplete="off" autofocus ></input>
                                    <div class="photo">
<!--                                        <i class="zmdi zmdi-camera"></i>-->
                                    </div>
                                    <button class="send">
                                        <div class="circle">
                                            <img src="./images/send_2.svg" class="send_icon">
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
        <?php echo "var room = ".$room.";\n";?>
//        scroll
     
    
   
      
   
    
    </script>
<!--     <script src="./js/app.js"></script>-->
        <script src="./js/script.js?v=<?php echo $version;?>"></script>
</body>

</html>