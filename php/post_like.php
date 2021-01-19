<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


//check if  post values are set
     if(isset($_POST['post_id']) && isset($_POST['action'])){

     $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);

     if($_POST['action']=="add"){
     if(isset($_POST['emogi'])){
     $emogi_type = mysqli_real_escape_string($connection, $_POST['emogi']);
//insert reaction + emogi 
     $query = "INSERT INTO yaarme_like.post_like (`post_id`, `user`,`emogi`) VALUES({$post_id}, {$_SESSION['id']},{$emogi_type})";
     }else{
         if(isset($_POST['save'])){
               $query = "UPDATE yaarme_like.post_like SET emogi = '1' WHERE `post_id` = '{$post_id}' and user = '{$_SESSION['id']}'";
         }else{
              $query = "INSERT INTO yaarme_like.post_like (`post_id`, `user`) VALUES({$post_id}, {$_SESSION['id']})";
         }
//insert reaction only like
    
     }
       
         
         
//         notify
   $query_show = "SELECT * FROM yaarme_post.posts where id = '{$post_id}'" ;
  $result_show = mysqli_query($connection,$query_show);
  while($row_show = mysqli_fetch_assoc($result_show)){
      $query_notify = "INSERT INTO yaarme.notification  (`user_id`, `category`) VALUES ('{$row_show['owner_id']}', '3')" ;
  if(mysqli_query($connection,$query_notify)){
  }    
      $insert_text = $_SESSION['name']. ' liked  your post';
      $insert_link = '../posts?p='.$post_id;
      $query_notify_at_page = "INSERT INTO yaarme.notifications_all  (`for_user`, `from_user`,`text`,`link`) VALUES ('{$row_show['owner_id']}', '{$_SESSION['id']}','{$insert_text}','{$insert_link}')" ;
  if(mysqli_query($connection,$query_notify_at_page)){
  }    
  }    
         
         
     }


// delete reaction
     else if($_POST['action']=="delete"){
         if(isset($_POST['save'])){
              $query = "UPDATE yaarme_like.post_like SET emogi = '0' WHERE `post_id` = '{$post_id}' and user = '{$_SESSION['id']}'";
         }else{
              $query = "DELETE FROM yaarme_like.post_like WHERE post_id = '{$post_id}' and user = '{$_SESSION['id']}'";
         }
    
     }

// update reaction
     else if($_POST['action']=="update"){
     if(isset($_POST['emogi'])){
     $emogi_type = mysqli_real_escape_string($connection, $_POST['emogi']);}
     $query = "UPDATE yaarme_like.post_like SET emogi = {$emogi_type} WHERE `post_id` = '{$post_id}' and user = '{$_SESSION['id']}'";
         
         //         notify
   $query_show = "SELECT * FROM yaarme_post.posts where id = '{$post_id}'" ;
  $result_show = mysqli_query($connection,$query_show);
  while($row_show = mysqli_fetch_assoc($result_show)){
      $query_notify = "INSERT INTO yaarme.notification  (`user_id`, `category`) VALUES ('{$row_show['owner_id']}', '3')" ;
  if(mysqli_query($connection,$query_notify)){
  }    
      $insert_text = $_SESSION['name']. ' liked  your post';
      $insert_link = '../posts?p='.$post_id;
      $query_notify_at_page = "INSERT INTO yaarme.notifications_all  (`for_user`, `from_user`,`text`,`link`) VALUES ('{$row_show['owner_id']}', '{$_SESSION['id']}','{$insert_text}','{$insert_link}')" ;
  if(mysqli_query($connection,$query_notify_at_page)){
  }    
  }   
         
     }

     else{
     echo "wrong action";
     exit(0);
     }

     if(mysqli_query($connection,$query)){
     echo "inserted";
     }else{
     echo"something_wrong";
     }
     }
     echo $query;
?>