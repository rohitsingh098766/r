<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat | YaarMe</title>
    <link rel="icon" href="logo.png" type="image/icon type">

    <link rel="stylesheet" href="style.css">


    <!--icons-->
    <link rel="apple-touch-icon" sizes="57x57" href="../icons/icons/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="../icons/icons/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="../icons/icons/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../icons/icons/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="../icons/icons/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../icons/icons/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="../icons/icons/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../icons/icons/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/icons/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="../icons/icons/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/icons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="../icons/icons/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/icons/favicon-16x16.png" />
    <link rel="manifest" href="../icons/icons/manifest.json" />
    <meta name="msapplication-TileColor" content="#0073b1" />
    <meta name="msapplication-TileImage" content="../icons/icons/ms-icon-144x144.png" />
    <meta name="theme-color" content="#0073b1" />
</head>

<body onload="scrollToBottom()">

    <header>
        <a href="../chatall/">
            <img class="lnk" src="SVG/arrow-left-solid.svg" alt="" title="Back">
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
    echo '  <a href="../account?user='.$row_room['opponent_member'].'">
                <img class="lnk avatar" src="'.$profile.'" alt="" title="Visit Profile">
            </a>
            <a href="../account?user='.$row_room['opponent_member'].'" class="chat-title" title="Visit Profile">
                <p class="username">'.$row_room['first_name']." ".$row_room['last_name'].'</p>
                <p class="last-seen">'.$row_room['status_mini_bio'].'</p>
            </a>';
    $proceed = true;
}
                                
                                ?>

        <!--
            <a href="#">
                <img class="lnk2" src="SVG/video-camera.svg" title="Start a video call">
            </a>
            <a href="#">
                <img class="lnk2" src="SVG/info-outline.svg" alt="" title="Information">
            </a>
-->
    </header>
    <main>
        <section style="height: 60px;"></section>
        <!-- <p class="day">
                    26 Jun 8:08 am
                </p>-->
        <ul id="last">
            <?php
if($proceed===true){
$query_room = "select * from yaarme_message.message
where (room_id = {$room}) order by id desc limit 100";
// echo $query_room;
$result_room = mysqli_query($connection,$query_room);
    $final_result ='';
while($row_room = mysqli_fetch_assoc($result_room)){
if($row_room['sender']==$_SESSION['id']){
    $side = 'right';
}else{
    $side = 'left';
}
$final_result = ' 
<li class="'.$side.' messaged" id="message_id_'.$row_room['id'].'"  message="'.$row_room['id'].'">
                        <ul>
                            <li>
                                <p>
                                    '.preg_replace('/\r|\n/','\n',trim(htmlentities($row_room['text']))).'
                                </p>
                            </li>
                            
                        </ul>
                    </li>
'.$final_result;
}
    echo $final_result;
}else{
    exit(0);
}
?>
           
            <!--<li class="left">
                        <ul>
                            <li>
                                <p>
                                    Hello! Do you have some free time right now?
                                </p>
                            </li>
                            <li>
                                <p>
                                    I wanted to talk to you urgently...
                                </p>
                            </li>
                        </ul>
                    </li>

                    <li class="right">
                        <ul>
                            <li>
                                <p>
                                    Heyyy... What exactly happened?
                                </p>
                            </li>
                            <li>
                                <p>
                                    Go ahead.
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li class="left">
                        <ul>
                            <li>
                                <p>
                                    Today I woke up and realized that I have not completed the Mechanics assignment
                                    which was supposed to be submitted yesterday!
                                </p>
                            </li>
                            <li>
                                <p>
                                    I started solving the sums, but got stuck on this Question.
                                    Can you help me with this?
                                </p>
                            </li>
                            <li>
                                <img class="sent-img" src="mech.jpg" alt="">
                            </li>
                        </ul>
                    </li>


                    <p class="day">
                        Yesterday
                    </p>

                    <li class="left">
                        <ul>
                            <li>
                                <p>
                                    I asked for your help like a week ago...
                                </p>
                            </li>
                            <li>
                                <p>
                                    Why are you not replying back????
                                </p>
                            </li>
                            <li>
                                <p>
                                    Are you mad at me ? :(
                                </p>
                            </li>
                        </ul>
                    </li>

                    <li class="right">
                        <ul class="right-ul">
                            <li>
                                <p>
                                    Heyy! I am really sorry... I totally forgot...
                                </p>
                            </li>
                            <li>
                                <img class="sent-img" src="mech.jpg" alt="">
                            </li>
                            <li>
                                <p>
                                    Here is the solution to the problem...
                                </p>
                            </li>
                            <li>
                                <p>
                                    Hope it helps... :)
                                </p>
                            </li>
                        </ul>
                    </li>-->


        </ul>
        <!--<p class="seen">
                    Seen
                </p>-->
<!--
 <div id="sending">
            
            </div>
-->
        <section style="height: 90px;"></section>

    </main>
    <footer>
        <form class="input-bar msg-form" method="POST" action="#">
            <!-- <form class="msg-form" action="#" method="POST"> -->
            <a href="#">
                <img id="camera-btn" class="lnk3 camera" src="SVG/camera-solid.svg" alt="" title="Camera">
            </a>
            <input type="text" placeholder="Message...">
            <!--
                        <a href="#" class="other-btns">
                            <img class="lnk3 mic" src="SVG/microphone-outline.svg" alt="" title="Voice Message">
                        </a>
                        <a href="#" class="other-btns">
                            <img class="lnk3 img" src="SVG/image-regular.svg" alt="" title="Gallery">
                        </a>
                        <a href="#" class="other-btns">
                            <img class="lnk3 stk" src="SVG/sticky-note-regular.svg" alt="" title="Stickers">
                        </a>
-->

            <button class="send-btn">
                SEND
            </button>


            <!-- </form> -->
        </form>
    </footer>



    <script>
        <?php echo "var room = ".$room.";\n";?>
//        scroll
     
    </script>
    <script src="script.js?v=3"></script>
</body>
</html>

























