<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


//check if  post values are set
     if(isset($_POST['comment_id'])){

     $comment_id = mysqli_real_escape_string($connection, $_POST['comment_id']);
         echo $comment_id;
//         exit(0);

          $query_get_owner = "SELECT *,yaarme_post.posts.id as post_vvv FROM yaarme_post.post_comment 
join yaarme_post.posts on yaarme_post.post_comment.post_id = yaarme_post.posts.id
where yaarme_post.post_comment.id = {$comment_id}" ;
  $result_get_owner = mysqli_query($connection,$query_get_owner);
  while($row_get_owner = mysqli_fetch_assoc($result_get_owner)){
     
      if(($row_get_owner['owner_id'] == $_SESSION['id']) || ($row_get_owner['user'] == $_SESSION['id']))   
      $query_delete_it = "DELETE FROM yaarme_post.post_comment WHERE yaarme_post.post_comment.id ={$comment_id}" ;
      if( mysqli_query($connection,$query_delete_it)){
          echo "deleted";
          
          
//          update total comment
            $query_get = "SELECT COUNT(*) as set_na FROM yaarme_post.post_comment where post_id = '{$row_get_owner['post_vvv']}'" ;
  $result_get = mysqli_query($connection,$query_get);
     while($row_get = mysqli_fetch_assoc($result_get)){
         $query_make_update = "UPDATE yaarme_post.posts SET `total_comment` = {$row_get['set_na']} where id = '{$row_get_owner['post_vvv']}'" ;
    if(mysqli_query($connection,$query_make_update)){
  } 
         
     }    
          
      }
     }
     }
?>