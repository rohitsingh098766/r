 <?php

session_start();
include '../connection.php';


$name =  mysqli_real_escape_string($connection, $_POST['name']);
$fb_id =  mysqli_real_escape_string($connection, $_POST['fb_id']);
$password = password_hash(mt_rand(1,99999).mt_rand(1,99999).mt_rand(1,99999).mt_rand(1,99999), PASSWORD_DEFAULT);

$query_insert = "INSERT INTO `users` (`first_name`,`facebook_id`, `key_`) VALUES('{$name}','{$fb_id}','{$password}')";

if(mysqli_query($connection,$query_insert)){
                   // do sign up
                   
               $query_get_id = "SELECT * FROM `users` where facebook_id='{$fb_id}'"; 
               $result_get_id = mysqli_query($connection,$query_get_id);
  while($row = mysqli_fetch_assoc($result_get_id)){
          $id = $row['id'];
            $password = $row['key_'];
            $_SESSION['id'] = $id;
                $_SESSION['name'] = htmlentities($row['first_name'].' '.$row['last_name']);
                $_SESSION['img'] = $row['img'];
      
      
//      follow youself
      $follow = "INSERT INTO `yaarme_follow`.`follow` (`user`, `opponent`, `approve`) VALUES ({$id}, '{$id}', '1');"; 
               if(mysqli_query($connection,$follow));
      //    favorite
       $i = mysqli_real_escape_string($connection, 'symbols/heart-with-ribbon.png');
      $j = mysqli_real_escape_string($connection, 'activity/volleyball.png');
      $favorite = "INSERT INTO `yaarme_follow`.`category` (`owner_id`, `group_name`,`emoji`,`pin`) VALUES ({$id}, 'Friends','{$i}','1'),({$id}, 'Family','{$j}','1');"; 
 if(mysqli_query($connection,$favorite));
      
      
      
        
            setcookie("active_user", $id, time() + (86400 * 364),'/');
            setcookie("user_id[$id]", $password, time() + (86400 * 364),'/');
      setcookie("t", 6, time() + (86400 * 364),'/');
            echo '1';
  }
            }else{
            // do sign in
            // echo(" do sign in");
            
            
            
            $query_verify = "SELECT * FROM `users` where facebook_id = '{$fb_id}'"; 
               $result_verify = mysqli_query($connection,$query_verify);
  while($row = mysqli_fetch_assoc($result_verify)){
      
   $id = $row['id'];
                $password = $row['key_'];
                $_SESSION['id'] = $id;
                $_SESSION['name'] = htmlentities($row['first_name'].' '.$row['last_name']);
                $_SESSION['img'] = $row['img'];
                setcookie("active_user", $id, time() + (86400 * 364),'/');
                setcookie("user_id[$id]", $password, time() + (86400 * 364),'/');
                echo '2';
   
   
   
   
          
  }
            
            
            
            
            
            
            
            
            
            
            
            }


          
?>