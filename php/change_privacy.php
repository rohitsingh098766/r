<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





     if(isset($_POST['action'])){


     $action = mysqli_real_escape_string($connection, $_POST['action']);
     $about_id = mysqli_real_escape_string($connection, $_POST['about_id']);
     $privacy_level = mysqli_real_escape_string($connection, $_POST['privacy_level']);
     $about_section = mysqli_real_escape_string($connection, $_POST['about_section']);
     $label = mysqli_real_escape_string($connection, $_POST['label']);
     if($action === 'add'){
     if($privacy_level < 4){
     $query = "UPDATE yaarme.about SET `share_with` = {$privacy_level} WHERE ( user = {$_SESSION['id']} and `about_code` = {$about_section}) ";
     if(mysqli_query($connection,$query)){
     echo "inserted";
     }
     }else{
     $query = "Select * from yaarme.about where  ( user = {$_SESSION['id']} and `about_code` = {$about_section}) order by id asc limit 1";

     $result = mysqli_query($connection,$query);
     while($row = mysqli_fetch_assoc($result)){

         $query = "UPDATE yaarme.about SET `share_with` = {$privacy_level}, connect_privacy = {$row['id']}  WHERE ( user = {$_SESSION['id']} and `about_code` = {$about_section}) ";
     if(mysqli_query($connection,$query)){
     echo "inserted";
     }
         $query = "INSERT INTO `yaarme`.`about_privacy` (`id`, `about_id`, `category_id`) VALUES (NULL, {$row['id']}, {$label}); ";
     if(mysqli_query($connection,$query)){
     echo "inserted";
     }
       echo $query;  
     }
     }

     }else if($action === 'delete'){

     $query = "Select * from yaarme.about where  ( user = {$_SESSION['id']} and `about_code` = {$about_section}) order by id asc limit 1";

     $result = mysqli_query($connection,$query);
     while($row = mysqli_fetch_assoc($result)){

         $query = "DELETE FROM `yaarme`.`about_privacy` WHERE (about_id = {$row['id']} and category_id =  {$label}) ";
     if(mysqli_query($connection,$query)){
     echo "inserted";
     }
        
       echo $query;  
     }
//     echo $query;
     echo $label;

     }
     }else{
     echo"action is not set";
     }
     ?>