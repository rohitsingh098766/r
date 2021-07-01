<?php
session_start();
     include '../connection.php';
   if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}

if(isset($_GET['type']) && isset($_GET['user'])){
    
    
    
    
    
    
    
    
    
    
    
    
    






$type  = mysqli_real_escape_string($connection, $_GET['type']);
$user  = mysqli_real_escape_string($connection, $_GET['user']);
$post  = mysqli_real_escape_string($connection, 16);
if($type==='follower'){
    $query = "select *, yaarme_follow.follow.user as target from yaarme_follow.follow
join yaarme.users on users.id = yaarme_follow.follow.user 
 left join yaarme.location on location.id  = users.location 
where (yaarme_follow.follow.opponent = {$user} and approve = 1)
limit 500
    
";
}else if($type==='following'){
   $query = "select *, yaarme_follow.follow.opponent as target from yaarme_follow.follow
join yaarme.users on users.id = yaarme_follow.follow.opponent 
left join yaarme.location on location.id  = users.location 
where (yaarme_follow.follow.user = {$user} and approve = 1)
limit 500 
";
}else if($type>=1){
   $query = "select *, yaarme_follow.follow.opponent as target from yaarme_follow.follow
join yaarme.users on users.id = yaarme_follow.follow.opponent 
left join yaarme.location on location.id  = users.location 
join yaarme_follow.category on category.id = yaarme_follow.follow.category
where (yaarme_follow.follow.user = {$user} and yaarme_follow.follow.category = {$type})
limit 500 
";
}
   
//    echo $query;
    
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
if($row['img']){
$img = './profile/i/240/'.$row['img'];
}else{
$img = './profile/i/none.svg';
}

//  check relation
$query_relation = "select * from yaarme_follow.follow left join yaarme_follow.category on category.id = follow.category where ( user = {$_SESSION['id']} and opponent = {$row['target']})";
$result_relation = mysqli_query($connection,$query_relation);
$following = ' • Follow ';
$mute = '';
$category ='';
$proceed = true;
while($row_relation = mysqli_fetch_assoc($result_relation)){
//                            $following = '';
if($row_relation['approve']==9){
$following = ' • Requested ';
}else if($row_relation['approve']==1){
$following = '';  
}

if($row_relation['mute_post']){
$mute = " • Unmute "  ;
}
if($row_relation['group_name']){
$category = '• '.htmlentities($row_relation['group_name']);
}
$proceed = true;
if($row_relation['approve']==10 || $row_relation['approve']==11 || $row_relation['approve']==8 ){
$proceed = false;
}

}

if($proceed===true  && $row['target']!=$user){  
    if($row['location']){
     $location_out = '<img class="loc-icon" src="./SVG/location.svg" alt="">'.htmlentities($row['location']);  
    }else{
        $location_out = "";
}
echo '
<div class="grid user_profile_'.$row['target'].'">
<a class="flex_s" href="./account?user='.$row['target'].'" target="_blank"><div class="post_profile profile_img" style="background-image:url('."'".$img."'".')"></div></a>
<div class="grid_mid">
<div class="name"><a href="./account?user='.$row['target'].'" target="_blank" class="name_link">'.htmlentities($row['first_name'].' '.$row['last_name']).'</a>
<small class="u_c_'.$row['target'].'" onclick="change_tag('.$row['target'].')">'.$category.'</small>
<small class="fllw_'.$row['target'].'" onclick="unfollow_ys('.$row['target'].','.$row['account_type'].')">'.$following.'</small>
<small class="unmt_'.$row['target'].'" onclick="mute_ys('.$row['target'].')">'.$mute.'</small>
</div>
<a class="description" href="./account?user='.$row['target'].'" target="_blank">'.htmlentities($row['status_mini_bio']).'</a>
<a class="location" href="./account?user='.$row['target'].'" target="_blank">'.$location_out.'</a>
</div>
<div class="flex_s" onclick="open_post_options('.$row['target'].', 88,16,0)"><span class="icon more-icon" ></span></div>
</div>
';
}
}
                  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}else{
    echo "something is not set";
    exit(0);
}
 exit(0);
?> 


