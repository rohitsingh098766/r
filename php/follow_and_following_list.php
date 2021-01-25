<?php
session_start();
     include '../connection.php';
   if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}

if(isset($_GET['type']) && isset($_GET['user'])){
    
    
    
    
    
    
    
    
    
    
    
    
    






$type  = mysqli_real_escape_string($connection, $_GET['type']);
$user  = mysqli_real_escape_string($connection, $_GET['user']);
$post  = mysqli_real_escape_string($connection, 16);
if($type==1){
    $query = "select *, yaarme_follow.follow.user as target from yaarme_follow.follow
join yaarme.users on users.id = yaarme_follow.follow.user 
 left join yaarme.location on location.id  = users.location 
where yaarme_follow.follow.opponent = {$user}
limit 500
    
";
}else if($type==2){
   $query = "select *, yaarme_follow.follow.opponent as target from yaarme_follow.follow
join yaarme.users on users.id = yaarme_follow.follow.opponent 
left join yaarme.location on location.id  = users.location 
where yaarme_follow.follow.user = {$user}
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
$category = '• '.$row_relation['group_name'];
}
$proceed = true;
if($row_relation['approve']==10 || $row_relation['approve']==11 || $row_relation['approve']==8 ){
$proceed = false;
}

}

if($proceed===true && $row['target']!=$_SESSION['id']){  
    if($row['location']){
     $location_out = '<img class="loc-icon" src="./SVG/location.svg" alt="">'.$row['location'];  
    }else{
        $location_out = "";
}
echo '
<div class="grid">
<a class="flex_s" href="./account?user='.$row['target'].'"><img class="profile_img" src="'.$img.'"></a>
<div class="grid_mid">
<div class="name">'.$row['first_name'].' '.$row['last_name'].'
<small class="u_c_'.$row['target'].'">'.$category.'</small>
<small class="fllw_'.$row['target'].'" onclick="unfollow_ys('.$row['target'].','.$row['account_type'].')">'.$following.'</small>
<small class="unmt_'.$row['target'].'" onclick="mute_ys('.$row['target'].')">'.$mute.'</small>
</div>
<a class="description" href="./account?user='.$row['target'].'">'.$row['status_mini_bio'].'</a>
<a class="location" href="./account?user='.$row['target'].'">'.$location_out.'</a>
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

<div class="grid">
                                    <div class="flex_s"><img class="profile_img" src="./profile/i/240/30.2t0cp.png"></div>
                                    <div class="grid_mid">
                                        <div class="name">YaarMe
                                            <small class="u_c_1">• favorite</small>
                                            <small class="fllw_1" onclick="unfollow_ys(1,0)"></small>
                                            <small class="unmt_1" onclick="mute_ys(1)"></small>
                                        </div>
                                        <div class="description">Official account</div>
                                        <div class="location"><img class="loc-icon" src="./SVG/location.svg" alt="">i</div>
                                    </div>
                                    <div class="flex_s" onclick="open_post_options(1, 88,16,0)"><span class="icon more-icon"></span></div>
                                </div>

   
                                
                                <div class="grid">
                                    <div class="flex_s"><img class="profile_img" src="./profile/i/240/2z.2qjbx.jpg"></div>
                                    <div class="grid_mid">
                                        <div class="name">Akash Modi
                                            <small class="u_c_2"></small>
                                            <small class="fllw_2" onclick="unfollow_ys(2,0)"></small>
                                            <small class="unmt_2" onclick="mute_ys(2)"></small>
                                        </div>
                                        <div class="description"></div>
                                        <div class="location"><img class="loc-icon" src="./SVG/location.svg" alt="">India</div>
                                    </div>
                                    <div class="flex_s" onclick="open_post_options(2, 88,16,0)"><span class="icon more-icon"></span></div>
                                </div>
