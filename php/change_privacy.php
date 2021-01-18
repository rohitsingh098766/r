<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





     if(isset($_POST['change'])){
        
     $change = mysqli_real_escape_string($connection, $_POST['change']);
         
    $query = "UPDATE `users` SET `account_type` = '{$change}' WHERE `users`.`id` = {$_SESSION['id']};";

     if(mysqli_query($connection,$query)){
     echo "inserted";
     }else{
     echo"something went wrong";
     }
     }else{
echo"post values are not set";
     }

     ?>