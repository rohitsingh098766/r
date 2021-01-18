    <?php
    session_start();
if (isset($_COOKIE['active_user'])){
    foreach ($_COOKIE['user_id'] as $user_id => $value) {

        echo "user_id:".$user_id."<br>value".$value."<br>";
        echo "coo:".$_COOKIE['active_user']."<br>";
              
}
}

    
    
    ?>