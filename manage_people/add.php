<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}



if(isset($_POST['l'])){
$e = mysqli_real_escape_string($connection, $_POST['e']);
if($_POST['l']=="follower"){
$query = "SELECT * FROM yaarme_follow.follow JOIN yaarme.users on yaarme.users.id = yaarme_follow.follow.user left join yaarme.location on yaarme.location.id = users.location  where (yaarme_follow.follow.opponent ={$_SESSION['id']} and yaarme_follow.follow.approve = 1) ORDER BY `follow`.`id` DESC";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){

$query_check = "select * from yaarme_follow.follow left join yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category where (yaarme_follow.follow.user ={$_SESSION['id']} and yaarme_follow.follow.opponent = {$row['user']}) ";
$result_check = mysqli_query($connection,$query_check);
$relation = '';
$mute = 0;
$follow_offer='<span class="tag2" onclick="change('.$row['user'].','.$row['account_type'].',100)" id="s_'.$row['user'].'">Follow</span>';
    $btn = '<div class="add add_'.$row['user'].'"  u="'.$row['user'].'" ><div class="active d red">Add</div></div>';
while($row_check = mysqli_fetch_assoc($result_check)){
    if($row_check['group_name']){
$relation = ' • '.$row_check['group_name'];}
    $x = $row_check['approve'];
    
if($x==1){
    $follow_offer=''; 
}else if($x==2 || $x==7){
     $follow_offer='<span class="tag2" onclick="change('.$row['user'].','.$row['account_type'].','.$x.')" id="s_'.$row['user'].'">Follow</span>'; 
}else if($x==8 || $x==9){
     $follow_offer='<span class="tag2" onclick="change('.$row['user'].','.$row['account_type'].','.$x.')" id="s_'.$row['user'].'">Requested</span>'; 
}
    $mute = $row_check['mute'];
    
    if($e==$row_check['category']){
          $btn = '<div class="add add_'.$row['user'].'"  u="'.$row['user'].'" ><div class="active d red blue">Remove</div></div>';
     }else{
         $btn = '<div class="add add_'.$row['user'].'"  u="'.$row['user'].'" ><div class="active d red">Add</div></div>';
     }
    
}
    
$img_out = "../profile/i/none.svg";
    if($row['img']){
       $img_out =  '../profile/i/240/'.$row['img'];
    }else{
       $img_out = "../profile/i/none.svg";
    }
    
echo ' <div class="posts g1 act_'.$row['user'].'" u="'.$row['user'].'">
    <div class="k1"><img src="'.$img_out.'" class="avatar"></div>
    <div class="k1 mid">
        <div class="mid_head">'.$row['first_name'].' '.$row['last_name'].' '.$follow_offer.'</div>
        <div class="mid_con"> '.$row['status_mini_bio'].'</div>
    </div>'.$btn.'<div></div>
    <div class=" k1 mid ">
        <div class="location "><img src="./image/location.svg" class="location_img"> '.$row['location'].'</div>
    </div>
    <div></div>
</div>';

}


//echo "follower";
}else if($_POST['l']=="following"){
    
$query = "SELECT *, yaarme.users.id as get_id FROM yaarme_follow.follow JOIN yaarme.users on yaarme.users.id = yaarme_follow.follow.opponent left JOIN yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category left join yaarme.location on yaarme.location.id = users.location  where (yaarme_follow.follow.user ={$_SESSION['id']} and yaarme_follow.follow.approve = 1  ) ORDER BY `follow`.`id` DESC";
//    echo $query;
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
    if($row['group_name']){
        $grp = ' • '.$row['group_name'];
    }else{
        $grp = '';
    }
    if($e==$row['category']){
          $btn = '<div class="add add_'.$row['opponent'].'"  u="'.$row['opponent'].'" ><div class="active d red blue">Remove</div></div>';
     }else{
         $btn = '<div class="add add_'.$row['opponent'].'"  u="'.$row['opponent'].'" ><div class="active d red">Add</div></div>';
     }
    $img_out = "../profile/i/none.svg";
    if($row['img']){
       $img_out =  '../profile/i/240/'.$row['img'];
    }else{
       $img_out = "../profile/i/none.svg";
    }
echo ' <div class="posts g1 act_'.$row['get_id'].'" u="'.$row['get_id'].'">
    <div class="k1"><img src="'.$img_out.'" class="avatar"></div>
    <div class="k1 mid">
        <div class="mid_head">'.$row['first_name'].' '.$row['last_name'].'</div>
        <div class="mid_con">'.$row['status_mini_bio'].'</div>
    </div>
    '.$btn.'
    <div></div>
    <div class=" k1 mid ">
        <div class="location "><img src="./image/location.svg" class="location_img"> '.$row['location'].'</div>
    </div>
    <div></div>
</div>';

}

//echo "following";
}else if($_POST['l']=="muted"){
echo "muted";
}else if($_POST['l']=="unlisted"){
echo "unlisted";
}else{
//echo $_POST['l'];

$l = mysqli_real_escape_string($connection, $_POST['l']);
   
$query = "SELECT * FROM yaarme_follow.follow JOIN yaarme.users on yaarme.users.id = yaarme_follow.follow.opponent left JOIN yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category left join yaarme.location on yaarme.location.id = users.location  where (yaarme_follow.follow.user ={$_SESSION['id']} and yaarme_follow.category.id ={$l} and yaarme_follow.category.owner_id ={$_SESSION['id']} and yaarme_follow.follow.approve != 11) ORDER BY `follow`.`id` DESC";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
    $follow_offer = '';
    
      $x = $row['approve'];
    if( $x==7 || $x==8){
        $y = 1;
    }else{
      $y =  $row['account_type'];
    }
if($x==1){
    $follow_offer=''; 
}else if($x==2 || $x==7){
     $follow_offer='<span class="tag2" onclick="change('.$row['opponent'].','.$y.','.$x.')" id="s_'.$row['opponent'].'">Follow</span>'; 
}else if($x==8 || $x==9){
     $follow_offer='<span class="tag2" onclick="change('.$row['opponent'].','.$y.','.$x.')" id="s_'.$row['opponent'].'">Requested</span>'; 
}
 if($row['group_name']){
        $grp = ' • '.$row['group_name'];
    }else{
        $grp = '';
    }
     if($e==$l){
          $btn = '<div class="add add_'.$row['opponent'].'"  u="'.$row['opponent'].'" ><div class="active d red blue">Remove</div></div>';
     }else{
         $btn = '<div class="add add_'.$row['opponent'].'"  u="'.$row['opponent'].'" ><div class="active d red">Add</div></div>';
     }
$img_out = "../profile/i/none.svg";
    if($row['img']){
       $img_out =  '../profile/i/240/'.$row['img'];
    }else{
       $img_out = "../profile/i/none.svg";
    }
echo '<div class="posts g1 act_'.$row['opponent'].'" u="'.$row['opponent'].'">
    <div class="k1"><img src="'.$img_out.'" class="avatar"></div>
    <div class="k1 mid">
        <div class="mid_head">'.$row['first_name'].' '.$row['last_name'].' '.$follow_offer.' </div>
        <div class="mid_con"> '.$row['status_mini_bio'].'</div>

    </div>
    <div href="#" class="k1 user_i_'.$row['opponent'].'">
        '.$btn.'
    </div>
    <div></div>
    <div class=" k1 mid ">
        <div class="location "><img src="./image/location.svg" class="location_img"> '.$row['location'].'</div>
    </div>
    <div></div>
</div>';

}



}



}
else{
echo "Something Went Wrong";
}






?>