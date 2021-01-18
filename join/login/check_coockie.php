    <?php
if (isset($_COOKIE['active_user'])){
    foreach ($_COOKIE['user_id'] as $user_id => $value) {
                $query_verify = "SELECT * FROM `users` where id='{$_COOKIE['active_user']}'"; 
               $result_verify = mysqli_query($connection,$query_verify);
               echo"gor each9";
  while($row = mysqli_fetch_assoc($result_verify)){
     $password =  $row['key_'];
    
     if ($password === $value && $value) {
        //  exit(0);
                $id = $row['id'];
                $password = $row['key_'];
                $_SESSION['id'] = $id;
                setcookie("active_user", $id, time() + (86400 * 364),'/');
                setcookie("user_id[$id]", $password, time() + (86400 * 364),'/');header('Location: /');exit(0);}
                }
}
}

    echo"active_user not found";header('Location: ./login');exit(0);

    
    
    ?>