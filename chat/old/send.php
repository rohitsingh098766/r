
<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


     if(isset($_POST['text'])&&isset($_POST['room'])){
     $text = mysqli_real_escape_string($connection, $_POST['text']);
     $room = mysqli_real_escape_string($connection, $_POST['room']);
     $opponent = mysqli_real_escape_string($connection, $_POST['opponent']);


   $query = "INSERT INTO yaarme_message.message (`id`, `sender`, `room_id`, `text`) VALUES (NULL, '{$_SESSION['id']}', '{$room}', '{$text}')";

     if(mysqli_query($connection,$query)){
     echo "inserted";
         
         $query_noti = "INSERT INTO yaarme.notification (`user_id`,`category`) VALUES ({$opponent},2)";

     if(mysqli_query($connection,$query_noti)){
         
     }
         $query_get_last_id = "select * from yaarme_message.message where (`room_id` = {$room}) order by id desc limit 1";
         $result_get_last_id = mysqli_query($connection,$query_get_last_id);
while($row_get_last_id = mysqli_fetch_assoc($result_get_last_id)){
    
    $query_insert = "UPDATE `yaarme_message`.`room` SET `last_message_id` = '{$row_get_last_id['id']}' WHERE `room`.`id` = {$room};";
     if(mysqli_query($connection,$query_insert)){
     }
}
         
     }else{
     echo "something went wrong";
     }
     }else{
     echo "post text values are not set";
     }
     ?>