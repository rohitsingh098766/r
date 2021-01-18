<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





     if(isset($_POST['ct']) && isset($_POST['action'])){
        
     $ct = mysqli_real_escape_string($connection, $_POST['ct']);
     $action = mysqli_real_escape_string($connection, $_POST['action']);
         if($action=="delete"){
//             delete
             $query = "UPDATE yaarme_follow.category SET `pin` = 0 WHERE (`category`.`id` = {$ct} and owner_id = {$_SESSION['id']});";
         }else if($action=="add"){
//             add
             $query = "UPDATE yaarme_follow.category SET `pin` = 1 WHERE (`category`.`id` = {$ct} and owner_id = {$_SESSION['id']});";
         }
         
    

     if(mysqli_query($connection,$query)){
     echo "inserted";
     }else{
     echo"something went wrong";
     }
         
         
     }else{
echo"post values are not set";
     }

     ?>