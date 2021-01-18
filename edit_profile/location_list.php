{"location":[






<?php
include '../connection.php';
$s = mysqli_real_escape_string($connection, $_GET['s']);
$query_show = "SELECT * FROM yaarme.location where location LIKE '{$s}%' order by capacity DESC limit 100";
  $result_show = mysqli_query($connection,$query_show);
  while($row = mysqli_fetch_assoc($result_show)){
      
      
      echo '"'.$row['location'].'",';
      
      
  }
?>
0
]}



