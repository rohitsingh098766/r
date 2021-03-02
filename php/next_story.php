  <?php
        

$filter=  $post_type;



if($filter==1){
 
 $query = "
 SELECT *,  max(story.id) as post_num, story.owner_id as owner,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.story
join yaarme.users on yaarme.users.id = yaarme_post.story.owner_id 
join yaarme_follow.follow A on yaarme_post.story.owner_id = A.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = A.category
left join yaarme_post.share_with_story on share_with_story.story_detail = story.id
 left join  yaarme_follow.follow B on B.category = share_with_story.category_id
WHERE 
(
    A.user = {$_SESSION['id']} and
    A.approve = 1 and
    A.mute_post = 0 
     and
   (
   yaarme_post.story.shared_with is null
   or B.opponent ={$_SESSION['id']} 
   )
   
)
group by story.owner_id 
limit 500
";

}else if($filter==2){
  $query = "
SELECT *,  max(story.id) as post_num, story.owner_id as owner  ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.story
join yaarme.users on yaarme.users.id = yaarme_post.story.owner_id 
join yaarme_follow.follow A on yaarme_post.story.owner_id = A.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = A.category
 left join yaarme_post.share_with_story on share_with_story.story_detail = story.id
 left join  yaarme_follow.follow B on B.category = share_with_story.category_id
WHERE 
(
    A.user = {$_SESSION['id']} and
    (
        A.approve = 1 OR
        (A.approve = 2 and yaarme.users.account_type=0)
    ) and
    A.mute_post = 0 and
     
    (
        yaarme_follow.category.pin = 1
    )
     and
   (
   yaarme_post.story.shared_with is null
   or B.opponent ={$_SESSION['id']} 
   )
)
group by story.owner_id 
limit 500
";  
 
}else if($filter == 3){
    $query = "
SELECT *,  max(story.id) as post_num, story.owner_id as owner ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.story
join yaarme.users on yaarme.users.id = yaarme_post.story.owner_id 
join yaarme_follow.follow A on yaarme_post.story.owner_id = A.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = A.category
left join yaarme_post.share_with_story on share_with_story.story_detail = story.id
 left join  yaarme_follow.follow B on B.category = share_with_story.category_id
WHERE 
(
    A.user = {$_SESSION['id']} and
    A.approve = 1 and
    A.mute_post = 0 and
     
    (
        A.category is null
    )
      and
   (
   yaarme_post.story.shared_with is null
   or B.opponent ={$_SESSION['id']} 
   )
)
group by story.owner_id 
limit 500
";  
}else if($filter==4){
     $query = "
SELECT *,  max(story.id) as post_num, story.owner_id as owner  ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.story
join yaarme.users on yaarme.users.id = yaarme_post.story.owner_id 
join yaarme_follow.follow A on yaarme_post.story.owner_id = A.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = A.category
left join yaarme_post.share_with_story on share_with_story.story_detail = story.id
 left join  yaarme_follow.follow B on B.category = share_with_story.category_id
WHERE 
(
    A.user = {$_SESSION['id']} and
    A.approve = 1 and
     (
    A.mute_post = 1 
   )
     and
   (
   yaarme_post.story.shared_with is null
   or B.opponent ={$_SESSION['id']} 
   )
)
group by story.owner_id 
limit 500
";   
}else if($filter==5){
  $query = "
SELECT *,  max(story.id) as post_num, story.owner_id as owner  ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.story
join yaarme.users on yaarme.users.id = yaarme_post.story.owner_id 
join yaarme_follow.follow A on yaarme_post.story.owner_id = A.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = A.category
 left join yaarme_post.share_with_story on share_with_story.story_detail = story.id
 left join  yaarme_follow.follow B on B.category = share_with_story.category_id
WHERE 
(
    A.user = {$_SESSION['id']} and
    (
        A.approve = 1 OR
        (A.approve = 2 and yaarme.users.account_type=0)
    ) and
    A.mute_post = 0 and
     
    (
        yaarme_follow.category.id = {$list_show} and 
         yaarme_follow.category.owner_id = {$_SESSION['id']}
    )
     and
   (
   yaarme_post.story.shared_with is null
   or B.opponent ={$_SESSION['id']} 
   )
)
group by story.owner_id 
limit 500
";  
 
}


$query_check_seen = "select * from yaarme_post.story where (owner_id = {$_SESSION['id']})";
    $query_check_seen = mysqli_query($connection,$query_check_seen);
    if(mysqli_num_rows($query_check_seen)){
        
        if($_SESSION['img']){ $my_profile = 'profile/i/240/'.$_SESSION['img'];}else{ $my_profile = "profile/i/none.svg"; }
        
         echo  '<a class="storie " href="story/?u='.$_SESSION['id'].'">
    <span class="photo my">
        <img src="'.$my_profile.'" alt="profile-pic" />
    </span>
    <span class="name">You</span>
</a>';
    }



$unseen_story = '';
$seen_story = '';

$query = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($query)){
    if($row['owner'] != $_SESSION['id']){
    if($row['img']){
$owner_profile = 'profile/i/240/'.$row['img'];
}else{
$owner_profile = "profile/i/none.svg";
}
    
    
    $query_check_seen = "select * from yaarme_post.story_watched where (story_id = {$row['post_num']} and watched_by = {$_SESSION['id']})";
    $query_check_seen = mysqli_query($connection,$query_check_seen);
    if(mysqli_num_rows($query_check_seen)){
       $seen_story .=  '<a class="storie " href="story/?u='.$row['owner'].'">
    <span class="photo inactive">
        <img src="'.$owner_profile.'" alt="profile-pic" />
    </span>
    <span class="name">'.$row['first_name'].'&nbsp;'.$row['last_name'].'</span>
</a>';
    }else{
       $unseen_story .=  '<a class="storie " href="story/?f='.$filter.'&o='.$row['owner'].'">
    <span class="photo">
        <img src="'.$owner_profile.'" alt="profile-pic" />
    </span>
    <span class="name">'.$row['first_name'].'&nbsp;'.$row['last_name'].'</span>
</a>';
    }
    

    
    }
}
echo $unseen_story.$seen_story;

?>