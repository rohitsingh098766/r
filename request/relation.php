<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}


if(isset($_POST['accept']) && isset($_POST['user'])){
   $user = mysqli_real_escape_string($connection, $_POST['user']);
    
$query = "UPDATE yaarme_follow.follow SET `approve` = '1' WHERE `follow`.`opponent` = {$_SESSION['id']} and `follow`.`user` = {$user}" ;
mysqli_query($connection,$query);

    
    
    
    
}else if(isset($_POST['deny']) && isset($_POST['user'])){
   $user = mysqli_real_escape_string($connection, $_POST['user']); 
    
 $query = "UPDATE yaarme_follow.follow SET `approve` = '8' WHERE `follow`.`opponent` = {$_SESSION['id']} and `follow`.`user` = {$user}" ;
mysqli_query($connection,$query);
    
    
}else if(isset($_POST['Follow_back']) && isset($_POST['user'])){
   
   $user = mysqli_real_escape_string($connection, $_POST['user']); 
$query = "select * from yaarme.users where id = {$user} " ;
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
  if($row['account_type']==1){
     $insert = 9; 
  }else{
      $insert = 1; 
  }
}
 
 $query = "INSERT INTO yaarme_follow.follow (`user`, `opponent`, `approve`) VALUES ({$_SESSION['id']}, {$user}, {$insert});" ;
mysqli_query($connection,$query);      
    
    
}else if(isset($_POST['user']) && isset($_POST['list'])){
  $user = mysqli_real_escape_string($connection, $_POST['user']); 
  $list = mysqli_real_escape_string($connection, $_POST['list']); 
    
     $query = "UPDATE yaarme_follow.follow SET `category` = {$list} WHERE `follow`.`user` = {$_SESSION['id']} and `follow`.`opponent` = {$user}" ;
mysqli_query($connection,$query);
//    echo $query;
    
    
}else if(isset($_POST['block']) && isset($_POST['user'])){
    $query = "UPDATE yaarme_follow.follow SET `approve` = '11' WHERE `follow`.`opponent` = {$_SESSION['id']} and `follow`.`user` = {$user}" ;
mysqli_query($connection,$query);
    $query = "UPDATE yaarme_follow.follow SET `approve` = '10' WHERE `follow`.`user` = {$_SESSION['id']} and `follow`.`opponent` = {$user}" ;
mysqli_query($connection,$query);
    
}






?>