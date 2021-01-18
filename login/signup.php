
 <?php

session_start();
include '../connection.php';

// echo "uname:".$_POST['uname']."<br>";
// echo "pass:".$_POST['pass']."<br>";
// echo "contact_mail:".$_POST['contact_mail']."<br>";
// echo "contact_num:".$_POST['contact_num']."<br>";
// echo "country:".$_POST['country']."<br>";
// echo "state:".$_POST['state']."<br>";
// echo "city:".$_POST['city']."<br>";
// echo "date:".$_POST['date']."<br>";
// echo "month:".$_POST['month']."<br>";
// echo "year:".$_POST['year']."<br>";
// echo "first_name:".$_POST['first_name']."<br>";
// echo "last_name:".$_POST['last_name']."<br>";
$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$query = "SELECT * FROM `users` where user_name='{$_POST['uname']}'";
$query_get = mysqli_query($connection,$query);
    if(!mysqli_num_rows($query_get)){
$query_insert = "INSERT INTO `users` (`user_name`, `key_`, `first_name`, `last_name`) VALUES('{$_POST['uname']}','{$password}','{$_POST['first_name']}', '{$_POST['last_name']}')";

if(mysqli_query($connection,$query_insert)){
               
               $query_get_id = "SELECT * FROM `users` where user_name='{$_POST['uname']}'"; 
               $result_get_id = mysqli_query($connection,$query_get_id);
  while($row = mysqli_fetch_assoc($result_get_id)){
          $id = $row['id'];
            $password = $row['key_'];
            $_SESSION['id'] = $id;
                $_SESSION['name'] = $row['first_name'].' '.$row['last_name'];
                $_SESSION['img'] = $row['img'];
      
      
//      follow youself
      $follow = "INSERT INTO `yaarme_follow`.`follow` (`user`, `opponent`, `approve`) VALUES ({$id}, '{$id}', '1');"; 
               if(mysqli_query($connection,$follow));
      //    favorite
      $i = mysqli_real_escape_string($connection, 'symbols/heart-with-ribbon.png');
      $favorite = "INSERT INTO `yaarme_follow`.`category` (`owner_id`, `group_name`,`emoji`) VALUES ({$id}, 'favorite','{$i}');"; 
 if(mysqli_query($connection,$favorite));
      
      
      
        
            setcookie("active_user", $id, time() + (86400 * 364),'/');
            setcookie("user_id[$id]", $password, time() + (86400 * 364),'/');
            echo '1';
  }
            }else{
            
                 echo 'no';
            }
}

          
?>
