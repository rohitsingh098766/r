<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


     if(isset($_GET['s'])){
     $s = mysqli_real_escape_string($connection, $_GET['s']);
     $query = "INSERT INTO `yaarme_post`.`story_watched` (`id`, `story_id`, `watched_by`, `time`) VALUES (NULL, {$s}, {$_SESSION['id']}, current_timestamp());";
     if(mysqli_query($connection,$query)){
     }else{
     }
     }
     else{
     }
     ?>