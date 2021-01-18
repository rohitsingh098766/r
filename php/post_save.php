<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


     if(isset($_POST['post_id']) && isset($_POST['action']) && isset($_POST['save'])){
     $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
     $action = mysqli_real_escape_string($connection, $_POST['action']);
     $save = mysqli_real_escape_string($connection, $_POST['save']);
         
     if($_POST['action']=="delete"){
     // save post
     $query = "DELETE FROM yaarme_like.post_like WHERE post_like.post_id = '{$post_id}' and post_like.user = '{$_SESSION['id']}'";
     }else if($_POST['action']=="insert"){
     // delete from saved post
     $query = "INSERT INTO yaarme_like.post_like (`post_id`, `user`, `emogi`, `save`) VALUES ('{$post_id}', '{$_SESSION['id']}', '0', '1')";
    }else if($_POST['action']=="update"){
     if($_POST['save']==1){
        $query = "UPDATE yaarme_like.post_like SET `save` = '1' WHERE post_like.post_id = '{$post_id}' and post_like.user = '{$_SESSION['id']}'"; 
     }else{
        $query = "UPDATE yaarme_like.post_like SET `save` = '0' WHERE post_like.post_id = '{$post_id}' and post_like.user = '{$_SESSION['id']}'"; 
     }
     }
      echo $query;
     if(mysqli_query($connection,$query)){
     echo "inserted";
     }else{
     echo"something went wrong";
     }
     }else{
     echo "some post values are not set";
     }
     ?>