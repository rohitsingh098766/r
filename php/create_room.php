<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}
     //echo $_SESSION['name'].$_SESSION['img'];



     if(isset($_GET['for'])){
     $for = mysqli_real_escape_string($connection, $_GET['for']);
     echo 'creating room for '.$for."<br>";

     //check if room aleady exits
     $query = "Select * from yaarme_message.my_room where (room_member = {$_SESSION['id']} and opponent_member = {$for})";
     if($result = mysqli_query($connection,$query)){
     if(mysqli_num_rows($result)){
     //forward
         
         $query_already = "select * from `yaarme_message`.`my_room` where (room_member = {$_SESSION['id']} and opponent_member = {$for})";
     $query_already = mysqli_query($connection,$query_already);
     while($row_already = mysqli_fetch_assoc($query_already)){
         header('Location: ../chat/?room='.$row_already['room_id']);
exit;
     }
         
         
     echo "class already exist<br>";
     }else{
     echo "lets create room<br>";
     // create room
     $query = "INSERT INTO `yaarme_message`.`room` (`id`, `created_by`, `room_type`, `last_message_id`) VALUES (NULL, '{$_SESSION['id']}', '1', NULL);";
     if(mysqli_query($connection,$query)){
     echo "room created<br>";
     $query = "select * from `yaarme_message`.`room` where created_by = {$_SESSION['id']} ORDER BY `room`.`id` DESC limit 1";
     $query = mysqli_query($connection,$query);
     while($row = mysqli_fetch_assoc($query)){
     echo $row['id'];
     $query_add = "INSERT INTO `yaarme_message`.`my_room` (room_id, room_member, opponent_member) VALUES ({$row['id']},{$_SESSION['id']},{$for}),({$row['id']},{$for},{$_SESSION['id']});";
     if(mysqli_query($connection,$query_add)){
         header('Location: ../chat/?room='.$row['id']);
exit;

     echo "member added";
     //forward
     }
     }

     }
     }
     }





     }else{
     echo 'Something went wrong';
     }

?>