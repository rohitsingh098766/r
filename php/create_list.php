<?php
  session_start();
  include '../connection.php';
  if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}



  if(isset($_POST['action'])){
  if($_POST['action']=="create"){



  $t1 = mysqli_real_escape_string($connection, $_POST['t1']);
  $t2 = mysqli_real_escape_string($connection, $_POST['t2']);
  $t3 = mysqli_real_escape_string($connection, $_POST['t3']);
  $query = "INSERT INTO `yaarme_follow`.`category` (`owner_id`, `group_name`, `description` ,`emoji`) VALUES ({$_SESSION['id']}, '{$t1}', '{$t2}', '{$t3}');";
  if(mysqli_query($connection,$query)){

  $query_show = "SELECT * FROM `yaarme_follow`.`category` where owner_id = {$_SESSION['id']} ORDER BY `yaarme_follow`.`category`.`id` DESC LIMIT 1" ;
  $result_show = mysqli_query($connection,$query_show);
  while($row = mysqli_fetch_assoc($result_show)){
  echo '<a href="../manage_people?c='.$row['id'].'" class="k1"><img src="../emogi/128/'.$row['emoji'].'" class="avatar"></a>
  <a href="../manage_people?c='.$row['id'].'" class="k1 mid">
      <div class="mid_head">'.$row['group_name'].'</div>
<div class="mid_con">'.$row['description'].'</div>
  </a>
  <div href="#" class="k1 hovrr1" id="'.$row['id'].'" name="'.$row['group_name'].'"  des="'.$row['description'].'" url="'.$row['emoji'].'">
      <div class="svg_a"> <img src="image/trash.svg"></div>
  </div>
  <div href="#" class="k1 hovrr2" id="'.$row['id'].'" name="'.$row['group_name'].'"  des="'.$row['description'].'" url="'.$row['emoji'].'">
      <div class="svg_a"> <img src="image/edit.svg"></div>
  </div>';

  }






  }else{
  echo "something went wrong";
  }



  }
      else if($_POST['action']=="edit"){
      $t1 = mysqli_real_escape_string($connection, $_POST['t1']);
  $t2 = mysqli_real_escape_string($connection, $_POST['t2']);
  $t3 = mysqli_real_escape_string($connection, $_POST['t3']);
      $id = mysqli_real_escape_string($connection, $_POST['id']);
      $query = "UPDATE `yaarme_follow`.`category` SET `description` = '{$t2}' , group_name =  '{$t1}' , emoji =  '{$t3}' WHERE `category`.`id` = {$id};";
//      echo $query;
//      exit(0);
  if(mysqli_query($connection,$query)){

  $query_show = "SELECT * FROM `yaarme_follow`.`category` where (owner_id = {$_SESSION['id']} and `id` = {$id}) ";
  $result_show = mysqli_query($connection,$query_show);
  while($row = mysqli_fetch_assoc($result_show)){
  echo '<div class="k1"><img src="../emogi/128/'.$row['emoji'].'" class="avatar"></div>
  <div class="k1 mid">
      <div class="mid_head">'.$row['group_name'].'</div>
<div class="mid_con">'.$row['description'].'</div>
  </div>
   <div href="#" class="k1 hovrr1" id="'.$row['id'].'" name="'.$row['group_name'].'"  des="'.$row['description'].'" url="'.$row['emoji'].'">
      <div class="svg_a"> <img src="image/trash.svg"></div>
  </div>
  <div href="#" class="k1 hovrr2" id="'.$row['id'].'" name="'.$row['group_name'].'"  des="'.$row['description'].'" url="'.$row['emoji'].'">
      <div class="svg_a"> <img src="image/edit.svg"></div>
  </div>';

  }
  }
  }
      else if($_POST['action']=="delete"){
          
      $id = mysqli_real_escape_string($connection, $_POST['id']);
          echo id;
       $query = "DELETE FROM `yaarme_follow`.`category` WHERE( `category`.`id` = {$id} and owner_id = {$_SESSION['id']});";
  if(mysqli_query($connection,$query)){
      
  }else{
      
  }
      
  }
  }

?>


















