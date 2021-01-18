<?php
session_start();
session_destroy();
setcookie("active_user", '', time() - 60,'/');
// setcookie("user_id[$id]", ' ja', time() - 60,'/');
header('Location: ../login');
exit(0);
?>
