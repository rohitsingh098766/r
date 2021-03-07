
<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


     if(isset($_POST['room'])&&isset($_POST['max_id'])){
     $room = mysqli_real_escape_string($connection, $_POST['room']);
     $max_id = mysqli_real_escape_string($connection, $_POST['max_id']);
     $final_result ='';
    $max_message_id = 0;
         $update_last_seen_message = false;
         
          $query_seen = "select * from yaarme_message.my_room join yaarme.users on yaarme.users.id = yaarme_message.my_room.room_member where (room_id = {$room} and opponent_member = {$_SESSION['id']})";
                            $result_seen= mysqli_query($connection,$query_seen);
                            while($row_seen = mysqli_fetch_assoc($result_seen)){
$opponent_last_seen_message =  $row_seen['last_seen_msg_id'];
$opponent_last_seen_time =  $row_seen['last_login'];
//                                exit(0);
                            }   
         
         

     $query_room = "select *
     from yaarme_message.message 
     where (
     room_id = {$room} and 
     id >{$max_id}
     ) 
     order by id desc limit 100";
     // echo $query_room;
     $result_room = mysqli_query($connection,$query_room);
     while($row_room = mysqli_fetch_assoc($result_room)){
    
          if($max_message_id < $row_room['id']){
        $max_message_id = $row_room['id'];
               $update_last_seen_message = true;
    }
         
         if($row_room['sender']==$_SESSION['id']){
    $side = 'sent';
   if($opponent_last_seen_message >= $row_room['id']){
        
   $revienced_icon =  '<span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#009be0" /></svg></span>';
    }else if($opponent_last_seen_message >= $row_room['id']){
        
   $revienced_icon =  '<span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#9b9b9b" /></svg></span>';
    }else{
   $revienced_icon =  '<span class="tick"><svg aria-hidden="true" data-prefix="fal" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-check fa-w-14 fa-7x" width="12" height="12"><path fill="#9b9b9b" d="M413.505 91.951L133.49 371.966l-98.995-98.995c-4.686-4.686-12.284-4.686-16.971 0L6.211 284.284c-4.686 4.686-4.686 12.284 0 16.971l118.794 118.794c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-11.314-11.314c-4.686-4.686-12.284-4.686-16.97 0z" class=""></path></svg></span>';
        
    }
}else{
    $revienced_icon = '';
    $side = 'received';
}
         
     $final_result = '
      <div class="message messaged '.$side.'" id="message_id_'.$row_room['id'].'" message="'.$row_room['id'].'">
                                         '.preg_replace('/\r|\n/','\n',trim(htmlentities($row_room['text']))).'
                                        <span class="metadata">
                                            <span class="time time_incorrect" time="'.$row_room['time'].'  UTC">9:10 AM</span>'.$revienced_icon.'
                                        </span>
                                    </div>
     '.$final_result;
         
         
     }
     echo $final_result;
if($update_last_seen_message===true){
    
          $query_insert = "UPDATE `yaarme_message`.`my_room` SET `last_seen_msg_id` = '{$max_message_id}' WHERE (room_id = {$room} and room_member = {$_SESSION['id']});";
     if(mysqli_query($connection,$query_insert)){
     }
}
         
     }else{
    echo "Something went wrong";
     }
     ?>