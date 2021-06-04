<?php
session_start();
include '../connection.php';

function delete_file($filePath, $image_name) {
 if (file_exists($filePath.$image_name) && (strlen($image_name)>3)){
                 unlink('../profile/i/120/'.$image_name);
                 unlink('../profile/i/240/'.$image_name);
                 unlink('../profile/i/360/'.$image_name);
                 unlink('../profile/i/480/'.$image_name);
                 unlink('../profile/i/720/'.$image_name);
                 unlink('../profile/i/1080/'.$image_name);
                 unlink('../profile/i/1440/'.$image_name);
                 unlink('../profile/i/2160/'.$image_name);
                 unlink('../profile/i/original/'.$image_name);
              }else{}}


function image_fix_orientation($path,$image_name) {
    $exif = exif_read_data($path.$image_name);
    if (!empty($exif['Orientation'])) {
        $image_1 = imagecreatefromjpeg('../profile/i/120/'.$image_name);
        $image_2 = imagecreatefromjpeg('../profile/i/240/'.$image_name);
        $image_3 = imagecreatefromjpeg('../profile/i/360/'.$image_name);
        $image_4 = imagecreatefromjpeg('../profile/i/480/'.$image_name);
        $image_5 = imagecreatefromjpeg('../profile/i/720/'.$image_name);
        $image_6 = imagecreatefromjpeg('../profile/i/1080/'.$image_name);
        $image_7 = imagecreatefromjpeg('../profile/i/1440/'.$image_name);
        $image_8 = imagecreatefromjpeg('../profile/i/2160/'.$image_name);
        switch ($exif['Orientation']) {
            case 3:
                $image_1 = imagerotate($image_1, 180, 0);
                $image_2 = imagerotate($image_2, 180, 0);
                $image_3 = imagerotate($image_3, 180, 0);
                $image_4 = imagerotate($image_4, 180, 0);
                $image_5 = imagerotate($image_5, 180, 0);
                $image_6 = imagerotate($image_6, 180, 0);
                 $image_7 = imagerotate($image_7, 180, 0);
                $image_8 = imagerotate($image_8, 180, 0);
                // echo 180;
                break;

            case 6:
                $image_1 = imagerotate($image_1, -90, 0);
                $image_2 = imagerotate($image_2, -90, 0);
                $image_3 = imagerotate($image_3, -90, 0);
                $image_4 = imagerotate($image_4, -90, 0);
                $image_5 = imagerotate($image_5, -90, 0);
                $image_6 = imagerotate($image_6, -90, 0);
                 $image_7 = imagerotate($image_7, -90, 0);
                $image_8 = imagerotate($image_8, -90, 0);
                // echo -90;
                break;

            case 8:
                $image_1 = imagerotate($image_1, 90, 0);
                $image_2 = imagerotate($image_2, 90, 0);
                $image_3 = imagerotate($image_3, 90, 0);
                $image_4 = imagerotate($image_4, 90, 0);
                $image_5 = imagerotate($image_5, 90, 0);
                $image_6 = imagerotate($image_6, 90, 0);
                 $image_7 = imagerotate($image_7, 90, 0);
                $image_8 = imagerotate($image_8, 90, 0);
                
                // echo 90;
                break;
        }
        imagejpeg($image_1, '../profile/i/120/'.$image_name , 90);
        imagejpeg($image_2, '../profile/i/240/'.$image_name , 90);
        imagejpeg($image_3, '../profile/i/360/'.$image_name , 90);
        imagejpeg($image_4, '../profile/i/480/'.$image_name , 90);
        imagejpeg($image_5, '../profile/i/720/'.$image_name, 90);
        imagejpeg($image_6, '../profile/i/1080/'.$image_name, 90);
         imagejpeg($image_7, '../profile/i/1440/'.$image_name , 90);
        imagejpeg($image_8, '../profile/i/2160/'.$image_name , 90);
        // echo "999999";
    }
    // echo "77777777777";
}


if(isset($_POST['submitted_form'])){
    

    
     function imageResize($imageResourceId,$width,$height,$target) {
     if($width <= $target){ $percent=1; }else{ $percent=$target/$width; } $targetWidth=$width * $percent; $targetHeight=$height * $percent; $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight); imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height); return $targetLayer; }
    
    $pic_url_ar = array();
     function uploadImg($inputName){
        global $pic_url_ar;
        if(is_array($_FILES) && $_FILES[$inputName]['tmp_name']) {
        echo "hooooooey";
        $name_img = $inputName;
        $id_s = base_convert($_SESSION['id'], 10, 36);
        $file = $_FILES[$name_img]['tmp_name'];
        $sourceProperties = getimagesize($file);
        $fileNewName = $id_s.'.'.base_convert((time()-1603170711), 10, 36);
        $folderPath = "../profile/i/";
        $ext = pathinfo($_FILES[$name_img]['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
        switch ($imageType) {
        case IMAGETYPE_PNG:
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],360),$folderPath."120/".$fileNewName. ".". $ext);
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],360),$folderPath."240/".$fileNewName. ".". $ext);
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],360),$folderPath."360/".$fileNewName. ".". $ext);
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],480),$folderPath."480/".$fileNewName. ".". $ext);
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],720),$folderPath."720/".$fileNewName. ".". $ext);
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],1080),$folderPath."1080/". $fileNewName. ".". $ext);
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],1440),$folderPath."1440/".$fileNewName. ".". $ext);
        imagepng(imageResize(imagecreatefrompng($file),$sourceProperties[0],$sourceProperties[1],2160),$folderPath."2160/".$fileNewName. ".". $ext);
        break;
        case IMAGETYPE_GIF:
        // imagegif(imageResize(imagecreatefromgif($file),$sourceProperties[0],$sourceProperties[1],360),$folderPath."360/".$fileNewName. ".". $ext);
        // imagegif(imageResize(imagecreatefromgif($file),$sourceProperties[0],$sourceProperties[1],480),$folderPath."480/".$fileNewName. ".". $ext);
        // imagegif(imageResize(imagecreatefromgif($file),$sourceProperties[0],$sourceProperties[1],720),$folderPath."720/".$fileNewName. ".". $ext);
        // imagegif(imageResize(imagecreatefromgif($file),$sourceProperties[0],$sourceProperties[1],1080),$folderPath."1080/". $fileNewName. ".". $ext);
        // imagegif(imageResize(imagecreatefromgif($file),$sourceProperties[0],$sourceProperties[1],1440),$folderPath."1440/".$fileNewName. ".". $ext);
        // imagegif(imageResize(imagecreatefromgif($file),$sourceProperties[0],$sourceProperties[1],2160),$folderPath."2160/".$fileNewName. ".". $ext);
        break;
        case IMAGETYPE_JPEG:
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],360),$folderPath."120/".$fileNewName. ".". $ext);
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],360),$folderPath."240/".$fileNewName. ".". $ext);
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],360),$folderPath."360/".$fileNewName. ".". $ext);
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],480),$folderPath."480/".$fileNewName. ".". $ext);
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],720),$folderPath."720/".$fileNewName. ".". $ext);
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],1080),$folderPath."1080/". $fileNewName. ".". $ext);
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],1440),$folderPath."1440/".$fileNewName. ".". $ext);
        imagejpeg(imageResize(imagecreatefromjpeg($file),$sourceProperties[0],$sourceProperties[1],2160),$folderPath."2160/".$fileNewName. ".". $ext);
        break;
        default:
        return false; exit; break;
        }
        move_uploaded_file($file, $folderPath."original/".$fileNewName. ".". $ext);
        array_push($pic_url_ar,$fileNewName. ".". $ext);
            image_fix_orientation('../profile/i/original/',$fileNewName. ".". $ext);
        return $folderPath."original/".$fileNewName. ".". $ext;
            
        }
        }

   if(uploadImg('a')){
         $query = "UPDATE yaarme.users SET `img` = '{$pic_url_ar[0]}' WHERE `users`.`id` = {$_SESSION['id']};";
 // echo $query;
if(mysqli_query($connection,$query)){
    delete_file('../profile/i/original/',$_SESSION['img']);
    $_SESSION['img'] = $pic_url_ar[0];
}
    }
    
    if(isset($_POST['first_name'])){
        $first_name   =  mysqli_real_escape_string($connection,$_POST['first_name']);
        if($first_name){
            
        }else{

            header('Location: ../account');
exit(0); 
        }
    }else{
        exit(0); 
    }
    
     
    if(isset($_POST['bio'])){
        $bio   =  mysqli_real_escape_string($connection,$_POST['bio']);
        if($bio){
            
        $insert = ",`status_mini_bio` = '{$bio}'";
        }else{
         $insert = ",`status_mini_bio` = null"; 

        }
    }
    
     $query = "UPDATE yaarme.users SET `first_name` = '{$first_name}' ".$insert." WHERE `users`.`id` = {$_SESSION['id']};";
//    echo $query;
//    exit(0);
    if(mysqli_query($connection,$query)){
//        exit(0); 
}
    
    if(isset($_POST['location'])){
        //insert location
    $location = mysqli_real_escape_string($connection,$_POST['location']);
$query = "Select * from yaarme.location where location = '{$location}'";
$result = mysqli_query($connection,$query);
if(mysqli_num_rows($result)){
while($row = mysqli_fetch_assoc($result)){
    
$location_id = $row['id'];
    $capacity = $row['capacity']+1;
        
     $query = "UPDATE yaarme.location SET
`capacity` = '{$capacity}'
WHERE `id` = {$location_id};";
if(mysqli_query($connection,$query)){
// echo "number of location updated";
}
    
}
}else{
$query = "INSERT INTO `location` (`location`, `capacity`) VALUES ( '{$location}', 1);";
mysqli_query($connection,$query);
$query = "Select * from yaarme.location where location = '{$location}'";
$result = mysqli_query($connection,$query);
if(mysqli_num_rows($result)){
while($row = mysqli_fetch_assoc($result)){
$location_id = $row['id'];
}
}
}
  //insert all info
$query = "UPDATE yaarme.users SET

`location` = '{$location_id}'
WHERE `users`.`id` = {$_SESSION['id']};";
// echo $query;
if(mysqli_query($connection,$query)){ } 
    }
    
    header('Location: ../account');
exit(0); 
}else{
// echo 'no';
}

//fetch data

$query = "Select *, location.location as space from yaarme.users left join yaarme.location on location.id = users.location where users.id = {$_SESSION['id']}";
$result = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($result)){
    $name = $row['first_name'].' '.$row['last_name'];
    $bio = $row['status_mini_bio'];
    $location = $row['space'];
}



          ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile </title>

    <link rel="stylesheet" href="../CSS/spin_loader.css">
    <link rel="stylesheet" href="../login/CSS/style.css">
    <link rel="stylesheet" href="../edit_profile/CSS/style.css">
    <link rel="stylesheet" href="./css/edit_profile.css?v=3">

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
    <div class="container">
        <div class="loader">
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="main-login hide" id="login-form">

        </div>
        <div class="main-signup " id="signup-form">
            <div class="header">
                <img src="../icons/logo/logo_transparent.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">YAARIII</b><b></b>
                </div>

            </div>
           
            <form class="multi-stage" autocomplete="off" id="form" method="post" enctype="multipart/form-data">
                <div class="forms">
                    <div class="form-heading">
                        <span>Edit public profile</span>
                    </div>

                    <label for="f1" class="profile_img">
                        <div src="../profile/i/none.svg"  class="change_img" id="o1"></div>
                    </label>
                    <input accept="image/*" type="file" id="f1" onchange="loadFile(event)" class="hide" value="image_file" name="a" id="image_file">
                    <label for="f1" class="profile_img">
                        <span class="span_update">Update profile image</span>
                    </label>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="first_name" name="first_name" value="<?php echo $name;?>" required>
                        <span class="label">Name</span>
                        
                    </div> 
                       <div class="input-wrap">
                        <input type="text" class="fields" id="location" name="location" value="<?php echo $location;?>" required>
                        <span class="label">Location</span>
                        
                    </div>
                       <div class="input-wrap">
                        <textarea type="text" class="fields" id="bio" name="bio" required onkeydown="autosize('bio')" maxlength="350"><?php echo $bio;?></textarea>
                        <span class="label">Bio</span>
                    </div>
                    <div class="button-wrap">
                        
                        <input class="continue"  name="submitted_form" type="hidden" value="1">
                        <button class="continue" name="submitted" onclick="submit_fast();">Update</button>
                    </div>
                </div>
</form>
        </div>
    </div>
    <div class="hide load_anything"></div>
    
    <script src="js/edit_profile.js?v=3"></script>
</body>
</html>