<?php

session_start();
include '../connection.php';


if(!isset($_POST['username']) || !isset($_POST['password'])){
    echo "blank response";
    exit(0);
}

$query_verify = "SELECT * FROM `users` where user_name='{$_POST['username']}'"; 
               $result_verify = mysqli_query($connection,$query_verify);
  while($row = mysqli_fetch_assoc($result_verify)){
      
     $password =  $row['key_'];
     
     
     if (password_verify($_POST['password'], $password)) {
                $id = $row['id'];
                $password = $row['key_'];
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $row['first_name'].' '.$row['last_name'];
                $_SESSION['img'] = $row['img'];
                setcookie("active_user", $id, time() + (86400 * 364),'/');
                setcookie("user_id[$id]", $password, time() + (86400 * 364),'/');
                echo '1';
} else {
    echo 'Invalid password';
}
   
   
   
   
   
          
  }

?>