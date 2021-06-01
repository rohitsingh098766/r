 <?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}



if(isset($_POST['active_label']) && isset($_POST['privacy_level']) && isset($_POST['action']) && isset($_POST['label'])){
    $active_label = mysqli_real_escape_string($connection,$_POST['active_label']);
    $privacy_level = mysqli_real_escape_string($connection,$_POST['privacy_level']);
    $action = mysqli_real_escape_string($connection,$_POST['action']);
    $label = mysqli_real_escape_string($connection,$_POST['label']);
    
  
    
    $query_get_owner = "SELECT * from yaarme_follow.category where (id = {$active_label} and owner_id = {$_SESSION['id']})" ;
  $result_get_owner = mysqli_query($connection,$query_get_owner);
  while($row_get_owner = mysqli_fetch_assoc($result_get_owner)){
      
        if($row_get_owner['share_with'] == 4 && $privacy_level < 4){
          $query_delete = "DELETE FROM yaarme_follow.category_privacy WHERE category_id = {$active_label} " ;
      mysqli_query($connection,$query_delete);
    }
      
      if($label>0){
      if($action==='add'){
            $query_insert_label = "INSERT INTO  yaarme_follow.category_privacy (`id`, `category_id`, `category_allow`) VALUES (NULL, {$active_label} , {$label});" ;
      mysqli_query($connection,$query_insert_label);
          
      }else if($action==='delete'){
            $query_delete_label = "DELETE FROM yaarme_follow.category_privacy WHERE (category_id = {$active_label} and category_allow = {$label})" ;
      mysqli_query($connection,$query_delete_label);
          
      }
      }
      
      
      $query_change = "UPDATE yaarme_follow.category SET `share_with` = {$privacy_level} WHERE `category`.`id` = {$row_get_owner['id']};" ;
      mysqli_query($connection,$query_change);
  }
    
}
else{
echo "Something Went Wrong";
}






?> 