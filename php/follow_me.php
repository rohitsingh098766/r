
<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}


     if(isset($_POST['user_id']) && isset($_POST['privacy']) && isset($_POST['action'])){
     $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
     $action = mysqli_real_escape_string($connection, $_POST['action']);


     if($action==1){
     $query = "select * from yaarme.users where id = {$user_id} " ;
     $result = mysqli_query($connection,$query);
     while($row_p = mysqli_fetch_assoc($result)){
     $privacy = $row_p['account_type'];
     }
     if($privacy==1){$insert_value = 9;}else{$insert_value = 1;}


     $query = "INSERT INTO yaarme_follow.follow (`opponent`, `user`,`approve`) VALUES('{$user_id}','{$_SESSION['id']}','{$insert_value}')";

     }else if($action==0){
     $query = "DELETE FROM yaarme_follow.follow WHERE `opponent` = {$user_id} and `user` = {$_SESSION['id']}";
     }

     if(mysqli_query($connection,$query)){
     echo "inserted";
     }else{
     echo "something went wrong";
     }
     }else{
     echo "post values are not set";
     }
     ?>