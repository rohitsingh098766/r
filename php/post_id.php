<?php
  session_start();
  include '../connection.php';
  if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}

echo '{
"post" :
[';
if(isset($_GET['p'])){
    $post = mysqli_real_escape_string($connection, $_GET['p']);
//    for some time
//    $skip = 100000;
}else{
    echo "GET['p']) is not set";
    exit(0);
}

    $first_post = 1;
function react($fname) {
 if($fname==1){
      return "liked_done";
  }else if($fname==2){
      return "loved_done";
  }else if($fname==3){
      return "supported_done";
  }else if($fname==4){
      return "celebrated_done";
  }else if($fname==5){
      return "fired_done";
  }else if($fname==6){
      return "haha_done";
  }else if($fname==7){
      return "sad_done";
  }else{
      return "";
 }
}

$query = "
SELECT *, posts.id as post_num, posts.owner_id as owner , posts.location as post_location  ,TIMESTAMPDIFF(SECOND, posts.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.posts
join yaarme.users on yaarme.users.id = yaarme_post.posts.owner_id 
join yaarme_follow.follow on yaarme_post.posts.owner_id = yaarme_follow.follow.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category
WHERE 
(
   yaarme_post.posts.id = {$post}
    
   
)
limit 1
";

$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
    
//    check if user liked or saved it
    $query_react = "select * from yaarme_like.post_like where (post_id = {$row['post_num']} and user = {$_SESSION['id']})" ;
$result_react = mysqli_query($connection,$query_react);
    $like_output = '';
    $saved_output = '';
while($row_react = mysqli_fetch_assoc($result_react)){
    if($row_react['emogi']){
        $like_output = react($row_react['emogi']);
    }
    if($row_react['save']==1){
         $saved_output = 'saved';
    }
}
    
//    count likes
//    modify and add symbols
     $query_total_like = "select emogi,COUNT(*) as total_likes from yaarme_like.post_like where (post_id = {$row['post_num']} ) GROUP by emogi ORDER BY `total_likes` DESC" ;
$result_total_like = mysqli_query($connection,$query_total_like);
   $total_like = "";
    $emogi_type = '[';
    
while($row_total_like = mysqli_fetch_assoc($result_total_like)){
       $total_like += $row_total_like['total_likes']; 
    $emogi_type .= $row_total_like['emogi'].',';
}
    $emogi_type .='0]';
    
 
    $p1="";$p2="";$p3="";$p4="";$p5="";$p6="";$p7="";$p8="";$p9="";$p10="";
    if($row['p1']){$p1 ='"'.$row['p1'].'"';}
    if($row['p2']){$p2 =',"'.$row['p2'].'"';}
    if($row['p3']){$p3 =',"'.$row['p3'].'"';}
    if($row['p4']){$p4 =',"'.$row['p4'].'"';}
    if($row['p5']){$p5 =',"'.$row['p5'].'"';}
    if($row['p6']){$p6 =',"'.$row['p6'].'"';}
    if($row['p7']){$p7 =',"'.$row['p7'].'"';}
    if($row['p8']){$p8 =',"'.$row['p8'].'"';}
    if($row['p9']){$p9 =',"'.$row['p9'].'"';}
    if($row['p10']){$p10 =',"'.$row['p10'].'"';}



   
        echo '';
        
//    time farmatting
 $time = $row['time_ago'];
$time_show = '';
if($time <60){
$time_show = $time."s";
}else if($time < 3600){
$time_show = $time / 60;
$time_show = intval($time_show);
$time_show = $time_show."m";
}else if($time < 86400){
$time_show = $time / 3600;
$time_show = intval($time_show);
$time_show = $time_show."h";
}else if($time < (86400*30)){
$time_show = $time / 86400;
$time_show = intval($time_show);
$time_show = $time_show."d";
}else if($time < (86400*365)){
$time_show = $time / (86400*30);
$time_show = intval($time_show);
$time_show = $time_show."M";
}else{
$time_show = $time / (86400*365);
$time_show = intval($time_show);
$time_show = $time_show."y";
}
    if($row['total_comment']){
        $comments_total = $row['total_comment'];
    }else{
        $comments_total = "";
    }
    echo '
    
    {
            "id":"'.$row['post_num'].'",
            "profile_url":"'.$row['img'].'",
            "name":"'.preg_replace('/\r|\n/','\n',trim(htmlentities($row['first_name'].' '.$row['last_name']))).'",
            "owner_id":"'.$row['owner'].'",
            "account_type":"'.$row['account_type'].'",
            "tag":"'.preg_replace('/\r|\n/','\n',trim(htmlentities($row['group_name']))).'",
            "introduction":"'.preg_replace('/\r|\n/','\n',trim(htmlentities($row['status_mini_bio']))).'",
            "time":"'.$time_show.'",
            "location":"'.preg_replace('/\r|\n/','\n',trim(htmlentities($row['post_location']))).'",
            "body_text":"'.str_replace('<br><br>','<br>',preg_replace('/\r|\n/','<br>',trim(htmlentities($row['content'])))).'",
            "body_img_urls":['.$p1.$p2.$p3.$p4.$p5.$p6.$p7.$p8.$p9.$p10.'],
            "like":"'.$total_like.'",
            "reaction_type":'.$emogi_type.',
            "comment":"'.$comments_total.'",
            "reaction":"'.$like_output.'",
            "save":"'.$saved_output.'",
            "mute":"'.$row['mute_post'].'",
            "following":"'.$row['approve'].'"
    }
    
    ';
    
}
 

echo ']}';

exit(0);
?>
