<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}





if(isset($_POST['submitted'])){
    
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
if(mysqli_query($connection,$query)){}
    }
    
    
$gender = 0;
$date = 0;
$month = 0;
$year = 0;
$location = 1;
$bio = "";
$summary = "";
if(isset($_POST['gender'])){
$gender = mysqli_real_escape_string($connection,$_POST['gender']);
}if(isset($_POST['date'])){
$date = mysqli_real_escape_string($connection,$_POST['date']);
}if(isset($_POST['month'])){
$month = mysqli_real_escape_string($connection,$_POST['month']);
}if(isset($_POST['year'])){
$year = mysqli_real_escape_string($connection,$_POST['year']);
}if($_POST['location']){
$location = mysqli_real_escape_string($connection,$_POST['location']);
}if($_POST['bio']){
$bio = mysqli_real_escape_string($connection,$_POST['bio']);
}if($_POST['summary']){
$summary = mysqli_real_escape_string($connection,$_POST['summary']);
}
    

//insert location
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
`DOB_date` = '{$date}',
`DOB_month` = '{$month}',
`DOB_year` = '{$year}',
`gender` = '{$gender}',
`location` = '{$location_id}',
`status_mini_bio` = '{$bio}'
WHERE `users`.`id` = {$_SESSION['id']};";
// echo $query;
if(mysqli_query($connection,$query)){
// echo "inserted";
}else{
// echo"something went wrong ";
}


//insert summary
$query = "INSERT INTO `summary` (`user_id`, `summary`) VALUES ( {$_SESSION['id']}, '{$summary}');";
// echo $query;
if(mysqli_query($connection,$query)){
// echo "inserted_summary";
}else{
// echo"something went wrong_summary ";
$query = "UPDATE summary SET
`summary` = '{$summary}'
WHERE user_id = {$_SESSION['id']};";
// echo $query;
if(mysqli_query($connection,$query)){
// echo "inserted__sum";
}else{
// echo"something went wrong__sum ";
}
}
    
    
    
//   start session
$query = "Select * from yaarme.users where id =  {$_SESSION['id']}";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result)){
$_SESSION['name'] = $row['first_name'].' '.$row['last_name'];
$_SESSION['img'] = $row['img'];
}
    
//redired at shared page
    if(isset($_COOKIE['shared'])){
        if($_COOKIE['shared']==1){
//            direct at profile
            header('Location: ../account?user='.$_COOKIE['shared_id']);
        }else if($_COOKIE['shared']==2){
//            direct at post
            header('Location: ../posts?p='.$_COOKIE['shared_id']);
        }
    }else{
      header('Location: ../');
exit(0);
  
    }
    
    


}else{
// echo 'no';
}

if(isset($_GET['skip'])){
     if($_COOKIE['shared']==1){
//            direct at profile
            header('Location: ../account?user='.$_COOKIE['shared_id']);
        }else if($_COOKIE['shared']==2){
//            direct at post
            header('Location: ../posts?p='.$_COOKIE['shared_id']);
        }else{
         header('Location: ../');
     }
}



          ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | YaarMe</title>
    <link rel="icon" type="image/x-icon" href="CSS/Images/Yaarme-logo.png">

    <link rel="stylesheet" href="../CSS/spin_loader.css">
    <link rel="stylesheet" href="../login/CSS/style.css">
    <link rel="stylesheet" href="./CSS/style.css">

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
                <img src="CSS/Images/Yaarme-logo.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">Yaar</b><b>Me</b>
                </div>

            </div>
            <h2 class="heading" style="font-size: 1.25em;">Profile details</h2>
            <div class="progress-bar">
                <span class="number finished" id="n-1">1</span>
                <span class="line" id="l-1"></span>
                <span class="number" id="n-2">2</span>
                <span class="line" id="l-2"></span>
                <span class="number" id="n-3">3</span>
                <span class="line" id="l-3"></span>
                <span class="number" id="n-4">4</span>
                <span class="line" id="l-4"></span>
                <span class="number" id="n-5">5</span>

            </div>
            <form class="multi-stage" autocomplete="off" id="form" method="post" enctype="multipart/form-data">
                <div class="forms">
                    <div class="form-heading">
                        <span class="svg-icon pers"></span>
                        <span>Profile picture</span>
                    </div>

                    <label for="f1" class="profile_img">
                        <img src="../profile/i/none.svg" class="change_img" id="o1">
                    </label>
                    <input accept="image/*" type="file" id="f1" onchange="loadFile(event)" class="hide" value="image_file" name="a" id="image_file">
                    <label for="f1" class="profile_img">
                        <span>Select image</span>
                    </label>
                    <div class="button-wrap">
                        <div data-id="1" class="continue" id="st_1">Next</div>
                    </div>
                </div>

                <div class="forms">
                    <div class="form-heading">
                        <span class="svg-icon account"></span>
                        <span>Gender</span>
                    </div>
                    <span class="note note-plus">Please add your location so people can recongnise you easily.</span>
                    <div class="input-wrap">
                        <select class="fields" id="gender" name="gender"  required>
                            <option  value="" selected disabled></option>
                            <option  value="1">Male</option>
                            <option   value="2">Female</option>
                            <option   value="3">Prefer not to say</option>
                        </select>
                        <span class="label select">Gender</span>
                    </div>
                    <div class="button-wrap">
                        <div data-id="1" class="previous">Previous</div>
                        <div data-id="2" class="continue" id="st_1">Next</div>
                    </div>
                    <br>
                </div>
                <div class="forms">
                    <div class="form-heading">
                        <span class="svg-icon pers"></span>
                        <span>Date Of Birth</span>
                    </div>
                    <span class="note note-plus">Please add your date of birth.</span>
                    <div class="date-wrap">
                        <div class="input-wrap">
                            <select class="fields" name="date" id="date" required>
                                <option value="" selected disabled></option>
                            </select>
                            <span class="label select">Date</span>
                        </div>
                        <div class="input-wrap month">
                            <select class="fields" name="month" id="month" required>
                                <option value="" selected disabled></option>
                            </select>
                            <span class="label select">Month</span>
                        </div>
                        <div class="input-wrap">
                            <select class="fields" name="year" id="year" required>
                                <option value="" selected disabled></option>
                            </select>
                            <span class="label select">Year</span>
                        </div>
                    </div>



                    <div class="button-wrap">
                        <div data-id="2" class="previous">Previous</div>
                        <div data-id="3" class="continue" id="st_1">Next</div>
                    </div>
                    <br>
                </div>
                <div class="forms">
                    <div class="form-heading">
                        <span class="svg-icon account"></span>
                        <span>Location</span>
                    </div>
                    <span class="note note-plus">Please fill your location so people can recongnise you easily.</span>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="location" name="location" required>
                        <span class="label">Location</span>
                        
                    </div>

                    <div class="button-wrap">
                        <div data-id="3" class="previous">Previous</div>
                        <div data-id="4" class="continue" id="st_1">Next</div>
                    </div>
                    <br>
                </div>
                <div class="forms">
                    <div class="form-heading">
                        <span class="svg-icon account"></span>
                        <span>Bio & summary </span>
                    </div>
                    <span class="note note-plus">You can add a short bio in your profile.</span>
                    <div class="input-wrap">
                        <textarea type="text" class="fields" id="bio" name="bio" required onkeydown="autosize('Bio')"></textarea>
                        <span class="label">Bio</span>
                    </div>
                    <div class="input-wrap">
                        <textarea type="text" class="fields " id="summary" name="summary" required placeholder="In additional, you can also add a brief note about yourself." onkeydown="autosize('summary')"></textarea>
                    </div>

                    <div class="button-wrap">
                        <div data-id="4" class="previous">Previous</div>
                        <input type="hidden" name="submitted" value="1">
                        <div  class="signup-button  "  onclick="document.getElementById('form').submit(); document.querySelector('.loader').style.display='flex';">Save</div>
                    </div>
                    <br>
                </div>
             
            </form>
               <div >
                    
                    <a href="./?skip=1" id="skipall">Skip all</a>
                </div>
        </div>
    </div>
    <div class="hide load_anything"></div>
    <script src="JS/main.js"></script>
</body>
</html>