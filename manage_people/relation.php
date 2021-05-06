<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}


if(isset($_POST['i']) && isset($_POST['user'])){
//    follow user
$privacy = 0;  
    $approve = 0;
    $insert = 0;
    $privacy = 0;
$i = mysqli_real_escape_string($connection, $_POST['i']);
$user = mysqli_real_escape_string($connection, $_POST['user']);
$query = "select * from yaarme.users where id = {$user} " ;
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
  $privacy = $row['account_type'];
}
 
     $query = "select * from yaarme_follow.follow where (user = {$_SESSION['id']} and opponent = {$user})" ;
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
$approve = $row['approve'];
    if($approve==11){
        exit(0);
    }
}
    
    if($i=="follow"){
        if($privacy == 1){
           if($approve == 2 || $approve == 1) {
               $final = 9;
           }else if($approve ==  8 || $approve == 7){
                $final = 8;
           }else{
               $final = 9;
               $insert = 1;
           }
            $query_noti = "INSERT INTO `yaarme`.`notification` (`id`, `user_id`, `category`) VALUES (NULL, {$user}, '1');";
            
        }else{
            if($approve == 2 || $approve == 1) {
               $final = 1;
           }else if($approve ==  8 || $approve == 7){
                $final = 8;
           }else{
                $final = 1;
                $insert = 1;
            }
            
//            insert in noti page
            $text_insert = $_SESSION['name'].' started following you.';
           $query_noti_page = "INSERT INTO `yaarme`.`notifications_all` (`for_user`, `from_user`, `text`, `link`) VALUES ({$user},{$_SESSION['id']}, '{$text_insert}','');";
             mysqli_query($connection,$query_noti_page); 
            $query_noti = "INSERT INTO `yaarme`.`notification` (`id`, `user_id`, `category`) VALUES (NULL, {$user}, '3');";
        }
        
//        notify for following
        mysqli_query($connection,$query_noti); 
        
        
        
        
    }else if($i=="unfollow"){
      if($approve == 2 || $approve == 1 || $approve == 9) {
               $final = 2;
           }else if($approve ==  8 || $approve == 7){
                $final = 7;
           }else{
           $final = 2;
      }
    }
    
    if($insert == 1){
         $query = "INSERT INTO yaarme_follow.follow (`user`, `opponent`, `approve`) VALUES ({$_SESSION['id']}, {$user}, {$final} );";
    }else{
        
        $query = "UPDATE yaarme_follow.follow SET `approve` = {$final} WHERE (user = {$_SESSION['id']} and opponent = {$user})";
    }
    
    
mysqli_query($connection,$query); 
//echo $i." fuck ".$query."privary: ".$privacy." approve: ".$approve;
    
    

    
    
}else if(isset($_POST['change_list']) && isset($_POST['user'])  && isset($_POST['list'])){
//    change list
    $user = mysqli_real_escape_string($connection, $_POST['user']);
$list = mysqli_real_escape_string($connection, $_POST['list']);
    if($list=="delete"){
        $query = "UPDATE yaarme_follow.follow SET `category` =  NULL WHERE (user = {$_SESSION['id']} and opponent = {$user})";
        mysqli_query($connection,$query);
        echo $query."delete requestefh";
        
    }else{
     $query = "UPDATE yaarme_follow.follow SET `category` = {$list} WHERE (user = {$_SESSION['id']} and opponent = {$user})";
    if(mysqli_query($connection,$query))
         $query = "INSERT INTO yaarme_follow.follow (`user`, `opponent`, `approve`,`category` ) VALUES ({$_SESSION['id']}, {$user}, 2, {$list});";
        mysqli_query($connection,$query);
      
    }
    echo $_POST['change_list'].' : '.$_POST['user'].' : '.$_POST['list'];
}else if(isset($_POST['block']) && isset($_POST['user'])){
    
     $user = mysqli_real_escape_string($connection, $_POST['user']);
    
         $query = "INSERT INTO yaarme_follow.follow (`user`, `opponent`, `approve` ) VALUES ({$_SESSION['id']}, {$user}, 10);";
    if(mysqli_query($connection,$query)){}else{
     $query = "UPDATE yaarme_follow.follow SET `approve` = 10 WHERE (user = {$_SESSION['id']} and opponent = {$user})";
        mysqli_query($connection,$query);
    }
         $query = "INSERT INTO yaarme_follow.follow (`user`, `opponent`, `approve` ) VALUES ({$user}, {$_SESSION['id']}, 11);";
    if(mysqli_query($connection,$query)){}else{
     $query = "UPDATE yaarme_follow.follow SET `approve` = 11 WHERE (opponent = {$_SESSION['id']} and user = {$user})";
        mysqli_query($connection,$query);
    }
    
    //block message
//    $query = "UPDATE yaarme_message.my_room SET `chat_status` = 10 WHERE (room_member = {$_SESSION['id']} and opponent_member = {$user})";
//        mysqli_query($connection,$query);
    
    $query_get = "select * from  yaarme_message.my_room WHERE (room_member = {$_SESSION['id']} and opponent_member = {$user})";
      $result_get = mysqli_query($connection,$query_get);
     while($row_get = mysqli_fetch_assoc($result_get)){
         
         $query_delete = "DELETE FROM yaarme_message.my_room WHERE `room_id` = {$row_get['room_id']}";
         mysqli_query($connection,$query_delete);
         $query_delete = "DELETE FROM yaarme_message.message WHERE `room_id` = {$row_get['room_id']}";
         mysqli_query($connection,$query_delete);
         
     }
    
    
    
}else if(isset($_POST['mute']) && isset($_POST['user'])&& isset($_POST['value'])){
//    mute user
    $user = mysqli_real_escape_string($connection, $_POST['user']);
    $value = mysqli_real_escape_string($connection, $_POST['value']);
    if($value!=1){
        $value = '0';
    }
     $query = "UPDATE yaarme_follow.follow SET `mute` = {$value} WHERE (user = {$_SESSION['id']} and opponent = {$user})";
    if(mysqli_query($connection,$query)){
        
    }else{
         $query = "INSERT INTO yaarme_follow.follow (`user`, `opponent`, `mute`, `approve` ) VALUES ({$_SESSION['id']}, {$user}, {$value},2);";
        mysqli_query($connection,$query);
    } 
}else if(isset($_POST['mute_post']) && isset($_POST['user']) && isset($_POST['value'])){
//    mute user posts
    $user = mysqli_real_escape_string($connection, $_POST['user']);
    $value = mysqli_real_escape_string($connection, $_POST['value']);
    if($value!=1){
        $value = '0';
    }
     $query = "UPDATE yaarme_follow.follow SET `mute_post` = {$value} WHERE (user = {$_SESSION['id']} and opponent = {$user})";
    if(mysqli_query($connection,$query)){}
        
}else if(isset($_POST['remove_follower']) && isset($_POST['user'])){
//    remove follower
    $user = mysqli_real_escape_string($connection, $_POST['user']);
     $query = "UPDATE yaarme_follow.follow SET `approve` = 2 WHERE (opponent = {$_SESSION['id']} and user = {$user})";
    mysqli_query($connection,$query);
        
}else if(isset($_POST['unfollow']) && isset($_POST['user'])){
//    unfollow follow
    $user = mysqli_real_escape_string($connection, $_POST['user']);
     $query = "UPDATE yaarme_follow.follow SET `approve` = 2 WHERE (user = {$_SESSION['id']} and opponent  = {$user})";
    mysqli_query($connection,$query);
}else if(isset($_POST['ignore']) && isset($_POST['user'])){
//    unfollow follow
    $user = mysqli_real_escape_string($connection, $_POST['user']);
     $query = "INSERT INTO yaarme_follow.follow (`user`, `opponent`,  `approve` ) VALUES ({$_SESSION['id']}, {$user} ,2);";
    mysqli_query($connection,$query);
}else if(isset($_POST['report_post']) && isset($_POST['post_id'])){
//    unfollow follow
    $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
     $query = "INSERT INTO `yaarme_post`.`report_post` (`user_id`, `post_id`) VALUES ({$_SESSION['id']},{$post_id});";
    mysqli_query($connection,$query);
}else if(isset($_POST['accept']) && isset($_POST['user'])){
//    unfollow follow
    $user = mysqli_real_escape_string($connection, $_POST['user']);
     $query = "UPDATE `yaarme_follow`.`follow` SET `approve` = '1' WHERE (user={$user} and opponent={$_SESSION['id']})";
    mysqli_query($connection,$query);
}else if(isset($_POST['deny']) && isset($_POST['user'])){
//    unfollow follow
    $user = mysqli_real_escape_string($connection, $_POST['user']);
     $query = "UPDATE `yaarme_follow`.`follow` SET `approve` = '8' WHERE (user={$user} and opponent={$_SESSION['id']})";
    mysqli_query($connection,$query);
}





else{
    echo "something went wrong";
}































?>