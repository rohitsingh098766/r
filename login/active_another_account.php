<?php

session_start();


     include '../connection.php';
echo 'oo';
if (isset($_COOKIE['user_id'])){
    foreach ($_COOKIE['user_id'] as $user_id => $value) {
                $query_verify = "SELECT * FROM `users` where id='{$user_id}'"; 
               $result_verify = mysqli_query($connection,$query_verify);
               echo $query_verify;
        echo 'oo';
  while($row = mysqli_fetch_assoc($result_verify)){
     $password =  $row['key_'];
    echo $password;
    echo '<br>hey'.$value;
     if ($password === $value && $value) {
//        //  exit(0);
         echo 'entry';
                $id_after = $row['id'];
                $password = $row['key_'];
                $_SESSION['id'] = $id_after;
                $_SESSION['name'] = htmlentities($row['first_name'].' '.$row['last_name']);
                $_SESSION['img'] = $row['img'];
                setcookie("active_user", $id_after, time() + (86400 * 364),'/');
                setcookie("user_id[$id_after]", $password, time() + (86400 * 364),'/');
         header("Location: ../");exit(0);
  }
                }
}
}else{
     header("Location: ../login");exit(0);
}

?>