<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}
$pic_url_ar = array("");



function image_fix_orientation($path,$image_name) {
    $exif = exif_read_data($path.$image_name);
    if (!empty($exif['Orientation'])) {
        $image_3 = imagecreatefromjpeg('./upload/360/'.$image_name);
        $image_4 = imagecreatefromjpeg('./upload/480/'.$image_name);
        $image_5 = imagecreatefromjpeg('./upload/720/'.$image_name);
        $image_6 = imagecreatefromjpeg('./upload/1080/'.$image_name);
        $image_7 = imagecreatefromjpeg('./upload/1440/'.$image_name);
        $image_8 = imagecreatefromjpeg('./upload/2160/'.$image_name);
        switch ($exif['Orientation']) {
            case 3:
                $image_3 = imagerotate($image_3, 180, 0);
                $image_4 = imagerotate($image_4, 180, 0);
                $image_5 = imagerotate($image_5, 180, 0);
                $image_6 = imagerotate($image_6, 180, 0);
                 $image_7 = imagerotate($image_7, 180, 0);
                $image_8 = imagerotate($image_8, 180, 0);
                // echo 180;
                break;

            case 6:
                $image_3 = imagerotate($image_3, -90, 0);
                $image_4 = imagerotate($image_4, -90, 0);
                $image_5 = imagerotate($image_5, -90, 0);
                $image_6 = imagerotate($image_6, -90, 0);
                 $image_7 = imagerotate($image_7, -90, 0);
                $image_8 = imagerotate($image_8, -90, 0);
                // echo -90;
                break;

            case 8:
                $image_3 = imagerotate($image_3, 90, 0);
                $image_4 = imagerotate($image_4, 90, 0);
                $image_5 = imagerotate($image_5, 90, 0);
                $image_6 = imagerotate($image_6, 90, 0);
                 $image_7 = imagerotate($image_7, 90, 0);
                $image_8 = imagerotate($image_8, 90, 0);
                
                // echo 90;
                break;
        }
        imagejpeg($image_3, './upload/360/'.$image_name , 90);
        imagejpeg($image_4, './upload/480/'.$image_name , 90);
        imagejpeg($image_5, './upload/720/'.$image_name, 90);
        imagejpeg($image_6, './upload/1080/'.$image_name, 90);
         imagejpeg($image_7, './upload/1440/'.$image_name , 90);
        imagejpeg($image_8, './upload/2160/'.$image_name , 90);
        // echo "999999";
    }
    // echo "77777777777";
}



if(isset($_POST["submit"])) {
    
    if(uploadImg('a')){
//     echo "good<br>";
    }

   $text = mysqli_real_escape_string($connection, $_POST['text']);
   $pic_url = mysqli_real_escape_string($connection, $pic_url_ar[0]);
    
    $query = "INSERT INTO yaarme_post.story (`owner_id`, `content`,`img`) VALUES ('{$_SESSION['id']}', '{$text}', '{$pic_url}')";
    echo "<br>".$query."<br>";
    
     if(mysqli_query($connection,$query)){
     echo "inserted"; 
     }else{
     echo"something went wrong";
     }
    echo $query;
    echo $pic_url_ar[0]."<br>";
    echo $_POST['text'];
     header('Location: ../');
    exit(0);
        }




        function uploadImg($inputName){
        global $pic_url_ar;
        if(is_array($_FILES)) {
        $name_img = $inputName;
        $id_s = base_convert($_SESSION['id'], 10, 36);
        $file = $_FILES[$name_img]['tmp_name'];
        if($file){$sourceProperties = getimagesize($file);
        $fileNewName = $id_s.'.'.base_convert((time()-1603170711), 10, 36).'.'.$inputName;
        $folderPath = "upload/";
        $ext = pathinfo($_FILES[$name_img]['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
        switch ($imageType) {
        case IMAGETYPE_PNG:
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
             $pic_url_ar[0]=    $fileNewName. ".". $ext;
//        array_push($pic_url_ar,$fileNewName. ".". $ext);
                    image_fix_orientation('./upload/original/',$fileNewName. ".". $ext);
        return $folderPath."original/".$fileNewName. ".". $ext;
        }
        }
        }

function imageResize($imageResourceId,$width,$height,$target) {  
    if($width <= $target){ $percent=1; }else{ $percent=$target/$width; } $targetWidth=$width * $percent; $targetHeight=$height * $percent; $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight); imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height); return $targetLayer;
}

?>




































<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Story</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../CSS/spin_loader.css">

    <!--icons-->
    <link rel="apple-touch-icon" sizes="57x57" href="../icons/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../icons/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../icons/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../icons/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../icons/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../icons/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../icons/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../icons/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../icons/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../icons/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../icons/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../icons/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../icons/icons/favicon-16x16.png">
    <link rel="manifest" href="../icons/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#0073b1">
    <meta name="msapplication-TileImage" content="../icons/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#0073b1">
</head>

<body>
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
    
    
    <div id="create">
    <div id="head">
        <a href="../" class="span"><img src='./image/arrow-left-regular.svg' alt="Exit" class="img arrow"></a href="../">
        <span class="span"><img src='<?php if($_SESSION['img']){ echo '../profile/i/240/'.$_SESSION['img'];}else{ echo "../profile/i/none.svg"; } ?>' alt="User Profile" class="img profile"></span>
        <span class="span"></span>
        <span class="span"><img src='./image/ellipsis-v-solid.svg' alt="Exit" class="img arrow ellipse"></span>
        </div>
        <form id="other" method="post" enctype="multipart/form-data">
        
        <div id="story_img">
          <label for="image_file" id="image_file_label">
              <img src=""  id="story_pic">
              <p id="tap_para"> Tap to add image</p>
              <img src='./image/image-solid.svg' alt="Exit" id="story_pic_add" title="Tap to add Image / Photo" >
              
            </label>  
            </div>
            <input  type="file" title="image_file" value="image_file" name="a" id="image_file" onchange="loadFile(event)">
        <div  id="story_description">
            
            <textarea id="textarea" onkeydown="autosize()" placeholder="Add a caption..." name="text" maxlength="2000"></textarea>
            <input  type="submit" title="submit" value="submit" name="submit" id="submit">
            <div id="submit_label"><label id="submit_label_img" for="submit"><img src="./image/send-button.svg" id="img_send" alt="post"></label></div>
            </div>
        </form>
    
    </div>
    
    <script src="app.js"></script>
    </body>
</html>