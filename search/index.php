<?php
if(isset($_GET['s'])){
session_start();
include '../connection.php';
    $search = mysqli_real_escape_string($connection, $_GET['s']);
$query_get_id = "SELECT *,follower as followers, users.id as num FROM `users` left join yaarme.location on yaarme.location.id = users.location where first_name like '{$search}%'   ORDER BY follower DESC limit 100  ";
//$query_get_id = "SELECT * FROM `users` where first_name like '{$search}%' limit 10";
//    echo $query_get_id;
$result_get_id = mysqli_query($connection,$query_get_id);
$total_rows = mysqli_num_rows($result_get_id);
// echo $total_rows;

echo '{
"post" :
[';
$x=1;
while($row = mysqli_fetch_assoc($result_get_id)){
//check if i am already following
    $follow= " select * from yaarme_follow.follow where user={$_SESSION['id']}  and opponent = {$row['num']}" ;
$result_f = mysqli_query($connection,$follow);
    $following = "0";
    $requested = "0";
while($row_f = mysqli_fetch_assoc($result_f)){
    if($row_f['approve']==1){
//        he is following
        $following = 1;
    }else{
//        he just requested
        $following = "0";
        $requested = "1";
    }
}
echo '
{
"user_id":'.$row['num'].',
"name":"'.$row['first_name']." ".$row['last_name'].'",
"profile_img":"'.$row['img'].'",
"followers":"'.$row['followers'].'",
"intro":"'.$row['status_mini_bio'].'",
"account_type":"'.$row['account_type'].'",
"location":"'.$row['location'].'",
"following":"'.$following.'", 
"requested": "'.$requested.'"
}


' ;
if($x!= $total_rows){echo ",";}
$x++;

}
echo ']} ';


//echo $_GET['s'];
exit(0);
}
?>


       