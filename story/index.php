<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YaarMe Stories</title>

    <link rel="stylesheet" href="style.css">

    <!--icons-->
    <link rel="apple-touch-icon" sizes="57x57" href="../icons/icons/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="../icons/icons/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="../icons/icons/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../icons/icons/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="../icons/icons/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../icons/icons/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="../icons/icons/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../icons/icons/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/icons/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="../icons/icons/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/icons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="../icons/icons/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/icons/favicon-16x16.png" />
    <link rel="manifest" href="../icons/icons/manifest.json" />
    <meta name="msapplication-TileColor" content="#0073b1" />
    <meta name="msapplication-TileImage" content="../icons/icons/ms-icon-144x144.png" />
    <meta name="theme-color" content="#0073b1" />
</head>

<body>
    <div id="css"></div>
    <div class="left-part">
    </div>
    <main>

        
        
        
        
        <?php
   session_start();
   include '../connection.php';

   if(isset($_GET['f'])){
   $filter= $_GET['f'];
   $skip_owner = $_GET['o'];


   if($filter==1){
   $query = "
   SELECT *, max(story.id) as post_num, story.owner_id as owner,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
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
   SELECT *, max(story.id) as post_num, story.owner_id as owner ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
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
   SELECT *, max(story.id) as post_num, story.owner_id as owner ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
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
   SELECT *, max(story.id) as post_num, story.owner_id as owner ,TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as time_ago
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
   }$query = mysqli_query($connection,$query);



   $first_slide=1;
   $continue=false;
   while($row=mysqli_fetch_assoc($query)){
   if($skip_owner==$row['owner']){
   $continue=true;
   } if($continue===true){
   $query_check_seen="select * from yaarme_post.story_watched where (story_id = {$row['post_num']} and watched_by = {$_SESSION['id']})" ;
   $query_check_seen=mysqli_query($connection,$query_check_seen);
   if(!mysqli_num_rows($query_check_seen)){
   $line='' ;
   $content='' ;
   $query_x="SELECT *, TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as sec FROM yaarme_post.story where owner_id = {$row['owner']} ORDER BY `story`.`id` DESC" ;
   $result_x=mysqli_query($connection,$query_x);
   while($row_x=mysqli_fetch_assoc($result_x)){
   $line .='<div class="bar">
       <div>&nbsp</div>
   </div>' ;
   $content .='
   <div class="status" s="'.$row_x['id'].'">
       <img class="content-img" src="../create_story/upload/1080/' .$row_x['img'].'" alt="">
       <div class="bottom">
           <p>'.$row_x['content'].'</p>
           <!--<img class="reply-icon" src="SVG/chevron-up-solid.svg" alt=""><span>Reply</span> -->
       </div>
   </div>
   ' ;
   $time_out = time_convert($row_x['sec']);
   }

   if($first_slide = 1){
   $first = 'firsqqst';
   $first_slide = 0;
   }else{
   $first = '';
   }
   if($row['img']){
   $image = '../profile/i/240/'.$row['img'];
   }else{
   $image = '../profile/i/none.svg';
   }

   echo '
   <section class="'.$first.' story">
       <div class="top-section">
           <div class="loader">
               '.$line.'
           </div>
           <div class="top">
               <img class="back" src="SVG/arrow-left-solid.svg" alt="" onclick="  window.location.assign('."'".'../'."'".')">
               <a href="../account?user='.$row['owner'].'" class="profile-pic" style="background-image: url('.$image.');"></a>
               <a href="../account?user='.$row['owner'].'" class="info">
                   <div class="name">'.$row['first_name']."&nbsp;".$row['last_name'].'</div>
                   <div class="time">'.$time_out.'</div>
               </a>
               <img class="menu" src="SVG/ellipsis-h-solid.svg" alt="">
           </div>
       </div>
       '.$content.'
   </section>
   ';
   }
   }
   }
   }else if(isset($_GET['u'])){
   $u = mysqli_real_escape_string($connection, $_GET['u']);
   $next = false;
   $query = "select * from yaarme_follow.follow join yaarme.users on follow.opponent = users.id where (user = {$_SESSION['id']} and opponent = {$u})";
   $result=mysqli_query($connection,$query);
   while($row=mysqli_fetch_assoc($result)){
   if(($row['approve']==1)||($row['approve']==2 && $row['account_type']!=1)){
   $next = true;
   }
   if($row['approve']==10 || $row['approve']==11 ||($row['approve']==2 && $row['account_type']==1)){
   exit(0);
   }
   echo "yes";
   }
   $query_u= "SELECT *, TIMESTAMPDIFF(SECOND, story.time,CURRENT_TIMESTAMP ) as sec, story.img as image FROM yaarme_post.story join yaarme.users on users.id = story.owner_id where (owner_id = {$u}) ORDER BY `story`.`id` DESC" ;
   $result_u=mysqli_query($connection,$query_u);
   $content = '';
   $line = '';
   while($row_u=mysqli_fetch_assoc($result_u)){
   if($next === false){
   if($row_u['account_type']==1)exit(0);
   }

   $name = $row_u['first_name']."&nbsp;".$row_u['last_name'];
   if($row_u['img']){
   $image = '../profile/i/240/'.$row_u['img'];
   }else{
   $image = '../profile/i/none.svg';
   }
   $time = time_convert($row_u['sec']);
   $line .='<div class="bar">
       <div>&nbsp</div>
   </div>';
   $content .='<div class="status">
       <img class="content-img" src="../create_story/upload/1080/' .$row_u['image'].'" alt="">
       <div class="bottom">
           <p>'.$row_u['content'].'</p>
           <!--<img class="reply-icon" src="SVG/chevron-up-solid.svg" alt=""><span>Reply</span> -->
       </div>
   </div>
   ' ;
   }
   echo '
   <section class="firsqqst story">
       <div class="top-section">
           <div class="loader">
               '.$line.'
           </div>
           <div class="top">
               <img class="back" src="SVG/arrow-left-solid.svg" alt="" onclick="  window.location.assign('."'".'../'."'".')">
               <a href="../account?user='.$u.'" class="profile-pic" style="background-image: url('.$image.');"></a>
               <a href="../account?user='.$u.'" class="info">
                   <div class="name">'.$name.'</div>
                   <div class="time">'.$time.'</div>
               </a>
               <img class="menu" src="SVG/ellipsis-h-solid.svg" alt="">
           </div>
       </div>
       '.$content.'
   </section>
   ';
   }
   function time_convert($time) {
   if($time <60){ $time_show=$time."s"; }else if($time < 3600){ $time_show=$time / 60; $time_show=intval($time_show); $time_show=$time_show."m"; }else if($time < 86400){ $time_show=$time / 3600; $time_show=intval($time_show); $time_show=$time_show."h"; }else if($time < (86400*30)){ $time_show=$time / 86400; $time_show=intval($time_show); $time_show=$time_show."d"; }else if($time < (86400*365)){ $time_show=$time / (86400*30); $time_show=intval($time_show); $time_show=$time_show."M"; }else{ $time_show=$time / (86400*365); $time_show=intval($time_show); $time_show=$time_show."y"; } return $time_show; }
?>



    </main>
    <div class="right-part"></div>
</body>
<script src="script.js"></script>
</html>