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
                $_SESSION['name'] = htmlentities($row['first_name'].' '.$row['last_name']);
                $_SESSION['img'] = $row['img'];
                setcookie("active_user", $id, time() + (86400 * 364),'/');
                setcookie("user_id[$id]", $password, time() + (86400 * 364),'/');header("Location: https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");exit(0);}
                }
}
}

    echo"active_user not found";header('Location: ./login');exit(0);

    
    
    ?>