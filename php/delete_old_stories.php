<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





      $query = "DELETE FROM `yaarme_post`.`story` WHERE time < DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -24 HOUR)";

     if(mysqli_query($connection,$query)){
     echo "inserted";
     }

     ?>