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
   <?php
     include '../php/desktop_header.php';
    ?>
    
    
    
    
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
                                <a href="../chatall/" class="back inner_div">
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
                                <div class="actions inner_div ">
                                    <img src="../SVG/ellipsis-regular.svg" class="send_icon more_options">
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