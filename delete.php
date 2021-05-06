<?php
     session_start();
     include './connection.php';
     if(!isset($_SESSION['id'])){include './login/check_coockie.php';}










     if (isset($_COOKIE['active_user'])){
     foreach ($_COOKIE['user_id'] as $user_id => $value) {
     $query_verify = "SELECT * FROM `users` where id='{$user_id}'";
     $result_verify = mysqli_query($connection,$query_verify);
     while($row = mysqli_fetch_assoc($result_verify)){
     $password = $row['key_'];
     if ($password === $value && $value) {
     echo $row['first_name'].' '.$row['last_name'];
     echo $row['img'];
     }
     }
     }
     }

?>


