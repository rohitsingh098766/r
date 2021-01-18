<?php
     session_start();
     include '../connection.php';
     if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}

function delete_file($filePath, $image_name) {
 if (file_exists($filePath.$image_name)){
                 unlink('../create_post/upload/360/'.$image_name);
                 unlink('../create_post/upload/480/'.$image_name);
                 unlink('../create_post/upload/720/'.$image_name);
                 unlink('../create_post/upload/1080/'.$image_name);
                 unlink('../create_post/upload/1440/'.$image_name);
                 unlink('../create_post/upload/2160/'.$image_name);
                 unlink('../create_post/upload/original/'.$image_name);
              }else{}}



     if(isset($_POST['post'])){
     $post_id = mysqli_real_escape_string($connection, $_POST['post']);

   $query_get_pics = "select * from yaarme_post.posts WHERE id = '{$post_id}' and owner_id = '{$_SESSION['id']}'" ;
$result_get_pics = mysqli_query($connection,$query_get_pics);
    
while($row_get_pics = mysqli_fetch_assoc($result_get_pics)){
     if($row_get_pics['p1']){delete_file('../create_post/upload/original/',$row_get_pics['p1']);}
     if($row_get_pics['p2']){delete_file('../create_post/upload/original/',$row_get_pics['p2']);}
     if($row_get_pics['p3']){delete_file('../create_post/upload/original/',$row_get_pics['p3']);}
     if($row_get_pics['p4']){delete_file('../create_post/upload/original/',$row_get_pics['p4']);}
     if($row_get_pics['p5']){delete_file('../create_post/upload/original/',$row_get_pics['p5']);}
     if($row_get_pics['p6']){delete_file('../create_post/upload/original/',$row_get_pics['p6']);}
     if($row_get_pics['p7']){delete_file('../create_post/upload/original/',$row_get_pics['p7']);}
     if($row_get_pics['p8']){delete_file('../create_post/upload/original/',$row_get_pics['p8']);}
     if($row_get_pics['p9']){delete_file('../create_post/upload/original/',$row_get_pics['p9']);}
     if($row_get_pics['p10']){delete_file('../create_post/upload/original/',$row_get_pics['p10']);}
    
}


     $query = "DELETE FROM yaarme_post.posts WHERE id = '{$post_id}' and owner_id = '{$_SESSION['id']}'";

     // echo $query;
     if(mysqli_query($connection,$query)){
     echo "inserted";

     $query = "DELETE FROM yaarme_like.post_like WHERE post_id = '{$post_id}'";

     // echo $query;
     if(mysqli_query($connection,$query)){
     echo "inserted";
     }
         
//         delete pics


     }else{
     echo"something went wrong";
     }
     }else{
     echo "some post values are not set";
     }
     ?>