
<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


     if(isset($_POST['room'])&&isset($_POST['max_id'])){
     $room = mysqli_real_escape_string($connection, $_POST['room']);
     $max_id = mysqli_real_escape_string($connection, $_POST['max_id']);
     $final_result ='';


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
     
         if($row_room['sender']==$_SESSION['id']){
    $side = 'sent';
   $revienced_icon =  '<span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#009be0" /></svg></span>';
}else{
    $revienced_icon = '';
    $side = 'received';
}
         
     $final_result = '
      <div class="message messaged '.$side.'" id="message_id_'.$row_room['id'].'" message="'.$row_room['id'].'">
                                         '.preg_replace('/\r|\n/','\n',trim(htmlentities($row_room['text']))).'
                                        <span class="metadata">
                                            <span class="time">1:22 PM</span>'.$revienced_icon.'
                                        </span>
                                    </div>
     '.$final_result;
     }
     echo $final_result;

     }else{
    echo "Something went wrong";
     }
     ?>