<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





     if(isset($_POST['post_id']) && isset($_POST['text'])){
        
     $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
     $text = mysqli_real_escape_string($connection, $_POST['text']);
         
    $query = "INSERT INTO yaarme_post.post_comment (`post_id`, `user`,`text`) VALUES('{$post_id}','{$_SESSION['id']}','{$text}')";

     if(mysqli_query($connection,$query)){

//notify about comment         
         
     $query_show = "SELECT * FROM yaarme_post.posts where id = '{$post_id}'" ;
  $result_show = mysqli_query($connection,$query_show);
  while($row_show = mysqli_fetch_assoc($result_show)){
      
     
      
      $query_notify = "INSERT INTO yaarme.notification  (`user_id`, `category`) VALUES ('{$row_show['owner_id']}', '3')" ;
  if(mysqli_query($connection,$query_notify)){
  }    
      $insert_text = $_SESSION['name']. 'commented on your post "'.$text.'"';
      $insert_link = '../posts?p='.$post_id;
      $query_notify_at_page = "INSERT INTO yaarme.notifications_all  (`for_user`, `from_user`,`text`,`link`) VALUES ('{$row_show['owner_id']}', '{$_SESSION['id']}','{$insert_text}','{$insert_link}')" ;
  if(mysqli_query($connection,$query_notify_at_page)){
  }    
      
  }    
         
         
         
         
         
         
         
     }else{
     echo"something went wrong";
     }
     }else{
echo"post values are not set";
     }

     ?>