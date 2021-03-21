{"location":[






<?php
include '../connection.php';
$s = mysqli_real_escape_string($connection, $_GET['s']);
$query_show = "SELECT * FROM yaarme.users where first_name LIKE '{$s}%' order by follower DESC limit 20";
  $result_show = mysqli_query($connection,$query_show);
  while($row = mysqli_fetch_assoc($result_show)){
      
      
      echo '["'.$row['id'].'","'.$row['first_name'].' '.$row['last_name'].'","'.$row['follower'].'","'.$row['img'].'","'.$row['status_mini_bio'].'"],';
      
      
  }
?>
0
]}
