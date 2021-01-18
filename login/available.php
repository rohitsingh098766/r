<?php

session_start();
include '../connection.php';




$query_verify = "SELECT * FROM `users` where user_name='{$_GET['u']}'"; 
               $result_verify = mysqli_query($connection,$query_verify);
               
               if ($result=mysqli_query($connection,$query_verify)){
if(mysqli_num_rows($result)){
    echo $_GET['u']." is unavailable";
}else{
    echo $_GET['u']." is available";
}
               
  }
?>