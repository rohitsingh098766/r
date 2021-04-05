<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





     if(isset($_POST['action'])){


     $action = mysqli_real_escape_string($connection, $_POST['action']);
     $about_id = mysqli_real_escape_string($connection, $_POST['about_id']);
     $privacy_level = mysqli_real_escape_string($connection, $_POST['privacy_level']);
     if($action === 'add'){

     $query = "UPDATE yaarme.about SET `share_with` = {$privacy_level} WHERE (`about`.`id` = {$about_id} and user = {$_SESSION['id']})";
     }else if($action === 'delete'){

     $query = "UPDATE yaarme.about SET `share_with` = 1 WHERE (`about`.`id` = {$about_id} and user = {$_SESSION['id']})";
     }

echo $query;
     if(mysqli_query($connection,$query)){
     echo "inserted";
     }else{
     echo"something went wrong";
     }
     }else{
     echo"action is not set";
     }

     ?>