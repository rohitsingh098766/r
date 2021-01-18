<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





     if(isset($_POST['post_id']) && isset($_POST['text'])){
        
     $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
     $text = mysqli_real_escape_string($connection, $_POST['text']);
         
    $query = "INSERT INTO yaarme_post.post_comment (`post_id`, `user`,`text`) VALUES('{$post_id}','{$_SESSION['id']}','{$text}')";

     if(mysqli_query($connection,$query)){
     echo "inserted";
     }else{
     echo"something went wrong";
     }
     }else{
echo"post values are not set";
     }

     ?>