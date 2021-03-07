
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
    echo "Something went wrong";
     }
     ?>