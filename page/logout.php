<?php
session_start();

if(isset($_COOKIE['active_user'])){
    $id  = $_COOKIE['active_user'];
setcookie("active_user", '', time() - 60,'/');
//     setcookie("user_id[$id]", ' ja', time() - 60,'/');
     setcookie("user_id[$id]", '',  time() - 60,'/');
    echo $id."delete me";
    echo "user_id[$id]";
    session_destroy();
}
//echo '<br>'.$_SESSION['id'];
//exit(0);

//login another account
//session_start();

echo "<br><br><br>".$_SESSION['name'];



header('Location: ../login/active_another_account.php');
exit(0);
?>
