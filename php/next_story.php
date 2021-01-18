  <?php
        

$filter=  $post_type;



if($filter==1){
 
 $query = "
 SELECT *,  max(story.id) as post_num, story.owner_id as owner,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.story
join yaarme.users on yaarme.users.id = yaarme_post.story.owner_id 
join yaarme_follow.follow on yaarme_post.story.owner_id = yaarme_follow.follow.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category
WHERE 
(
    yaarme_follow.follow.user = {$_SESSION['id']} and
    yaarme_follow.follow.approve = 1 and
    yaarme_follow.follow.mute_post = 0 
    
   
)
group by story.owner_id 
limit 500
";

}else if($filter==2){
  $query = "
SELECT *,  max(story.id) as post_num, story.owner_id as owner  ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
from yaarme_post.story
join yaarme.users on yaarme.users.id = yaarme_post.story.owner_id 
join yaarme_follow.follow on yaarme_post.story.owner_id = yaarme_follow.follow.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category
WHERE 
(
    yaarme_follow.follow.user = {$_SESSION['id']} and
    (
        yaarme_follow.follow.approve = 1 OR
        (yaarme_follow.follow.approve = 2 and yaarme.users.account_type=0)
    ) and
    yaarme_follow.follow.mute_post = 0 and
     
    (
        yaarme_follow.category.pin = 1
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
join yaarme_follow.follow on yaarme_post.story.owner_id = yaarme_follow.follow.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category
WHERE 
(
    yaarme_follow.follow.user = {$_SESSION['id']} and
    yaarme_follow.follow.approve = 1 and
    yaarme_follow.follow.mute_post = 0 and
     
    (
        yaarme_follow.follow.category is null
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
join yaarme_follow.follow on yaarme_post.story.owner_id = yaarme_follow.follow.opponent 
left join yaarme_follow.category on yaarme_follow.category.id = yaarme_follow.follow.category
WHERE 
(
    yaarme_follow.follow.user = {$_SESSION['id']} and
    yaarme_follow.follow.approve = 1 and
     (
    yaarme_follow.follow.mute_post = 1 
   )
)
group by story.owner_id 
limit 500
";   
}






$unseen_story = '';
$seen_story = '';

$query = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($query)){
    
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
echo $unseen_story.$seen_story;

?>