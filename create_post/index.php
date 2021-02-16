<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}

ini_set('memory_limit', '128M');


$pic_url_ar = array();



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
     echo "good<br>";
    }

    if(uploadImg('b')){
     echo "good<br>";
    }

    if(uploadImg('c')){
     echo "good<br>";
    }

    if(uploadImg('d')){
     echo "good<br>";
    }

    if(uploadImg('e')){
     echo "good<br>";
    }

    if(uploadImg('f')){
     echo "good<br>";
    }

    if(uploadImg('g')){
     echo "good<br>";
    }

    if(uploadImg('h')){
     echo "good<br>";
    }

    if(uploadImg('i')){
     echo "good<br>";
    }

    if(uploadImg('j')){
    echo "good<br>";
    }
     echo $_POST['text'];
    echo $_POST['location'];
    $url = "";
    for($x=0;$x<10;$x++){
        if(count($pic_url_ar)>$x){
            $url .= '"'.$pic_url_ar[$x].'",';
        }else{
            $url .= "NULL, ";
        }
                         
        }
    $text = mysqli_real_escape_string($connection, $_POST['text']);
     $location = mysqli_real_escape_string($connection, $_POST['location']);
    
    $query = "INSERT INTO yaarme_post.posts (`id`, `owner_id`, `content`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `status_temporary`, `location`, `shared_with`, `permission_like`, `permission_comment`, `permission_share`, `private_comment`, `private_like`, `private_comment_num`, `private_like_num`, `total_comment`, `total_share`, `archive`, `pined`) VALUES (NULL, '{$_SESSION['id']}', '{$text}', {$url} '', '{$location}', NULL, '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', NULL);";
    echo "<br>".$query."<br>";
    
     if(mysqli_query($connection,$query)){
     echo "inserted";
         
         if(isset($_POST['all_list'])){
             if($_POST['all_list']==1){
                 
             $query = "select * from yaarme_post.posts where owner_id = {$_SESSION['id']} order by id desc limit 1" ;
                                              $result = mysqli_query($connection,$query);
                                              while($row = mysqli_fetch_assoc($result)){
                                                  $query_1 = "UPDATE yaarme_post.posts SET `shared_with` = {$row['id']} WHERE `posts`.`id` = {$row['id']};";
                                                  if(mysqli_query($connection,$query_1)){
                                                      
                                                  } 
                                                  
                                                  $name = $_POST['list'];
                                                  $insert ='';
                                                  foreach ($name as $list){
                                                      echo $list."<br />";
                                                  $insert .= '('.$row['id'].','.$list.'),';
                                                  }
                                                    $insert = substr( $insert,0,-1);
                                                  
                                                  $query_2 = "INSERT INTO yaarme_post.share_with_post (`post_detail`, `category_id`) VALUES {$insert}";
                                                  if(mysqli_query($connection,$query_2)){
                                                      
                                                  }
                                                  
                                              }
             
               }
             
             
         }
         
         header('Location: ../');
//         header
     }else{
     echo"something went wrong";
     }
    echo $url;
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
        array_push($pic_url_ar,$fileNewName. ".". $ext);
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
    <title>Create post</title>
    <link rel="stylesheet" href="../CSS/spin_loader.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="./style.css">

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


<body id="body" oncontextmenu="">
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
    
    
<!--desktop header-->
    <div class="main-navbar-wrap">
        <div class="main-navbar">
            <a href="../" class="icon company-logo"></a>
            <a href="../" class="input-wrap" autocomplete="off">
                <span class="icon search-icon autocomplete"></span>
                <input type="search" placeholder="Search" class="search-bar" name="s" id="search_des">
                <span class="icon qrcode-icon"></span>
            </a>
            <ul class="nav-icons">
                <a href="../" class="icon home-icon " title="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px" height="30px">
                        <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 15 L 14 15 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z"></path>
                    </svg>
                </a>
                <a href="../request/" class="icon" title="My Network">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends" class="svg-inline--fa fa-user-friends fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="31px" height="31px">
                        <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"></path>
                    </svg>
                </a>
                <a href="../create_post/" class="icon home-icon-active" title="Add Post">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="28px">
                        <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                    </svg>
                </a>
                <a href="../chatall" class="icon" title="Message">
                    <svg aria-hidden="true" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-7x" width="28px" height="26px">
                        <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                    </svg>

                </a>
                <a href="../noti" class="icon" title="Notifications">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="26px">
                        <path d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                    </svg>
                </a>
                <span href="#" class="icon profile-icon work-cont">
                    <img src="<?php if($_SESSION['img']){ echo '../profile/i/240/'.$_SESSION['img'];}else{ echo "../profile/i/none.svg"; } ?>">
                    <div class="desk-menu">
                        <div class="sidebar desktop-menu">
                            <a href="../profile/" class="profile-img-sidebar">
                                <img class="avatar" src="<?php if($_SESSION['img']){ echo '../profile/i/240/'.$_SESSION['img'];}else{ echo "../profile/i/none.svg"; } ?>" alt="">
                                <span class="moon"></span>
                                <p>
                                     <?php echo $_SESSION['name'];?>  <br>
                                </p>
                                <img class="down expand-add-acc" src="../SVG/chevron-down-solid.svg" alt="">
                            </a>
                            <div class="all-uls">
                                <ul>
                                    <li>
                                        <a href="../profile/">
                                            <img src="../SVG/user-edit-solid.svg" alt="" />
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../manage_category/">
                                            <img src="../SVG/list-alt-solid.svg" alt="" />
                                            <span>Manage List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/activity">
                                            <img src="../SVG/clock-solid.svg" alt="" />
                                            <span>My activity</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/saved_posts">
                                            <img src="../SVG/save-black.svg" alt="" /> <span>Saved posts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/settings">
                                            <img src="../SVG/cog-solid.svg" alt="" />
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                         <a href="#" onclick="share(' <?php echo $_SESSION['name'];?>','Follow <?php echo $_SESSION['name'];?> on YaarMe','https://yaarme.com/account?user=<?php echo $_SESSION['id'];?>')">
                                            <img src="../SVG/share-black.svg" alt="" />
                                            <span>Share Your Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../page/logout">
                                            <img src="../SVG/power-off-solid.svg" alt="" />
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </span>
            </ul>
        </div>
    </div>
    
    
    <div class="container-wrap">
        <div class="container">
            <div class="left-bar"></div>
            <div class="main-content">
                <div class="homepage-main-content">

                    <div class="posts">
                        <div class="card">
                            <form action="./" class="card-main" id="form" method="post" enctype="multipart/form-data">
                                <div class="follow-conn">
                                    <img src="<?php if($_SESSION['img']){ echo '../profile/i/240/'.$_SESSION['img'];}else{ echo "../profile/i/none.svg"; } ?>" class="follow-icon">
                                    <a href="profile/" class="conn-name">
                                        <span><b><?php echo $_SESSION['name'];?>    </b></span>
                                        <span>
                                        
                                        <?php 
                                                $query_show = "SELECT * FROM yaarme.users where id = {$_SESSION['id']}" ;
                                                $result_show = mysqli_query($connection,$query_show);
                                                while($row = mysqli_fetch_assoc($result_show)){
echo $row['status_mini_bio'];
                                                }
?>
                                        
                                        
                                        </span> <span>
                                         
                                        </span>
                                    </a>
                                   
                                </div>
                                <div class="post_raw_body" >

                                    <textarea class="textarea" onkeydown="autosize()" name="text"  placeholder="Whats going on in your mind..."></textarea>
                                   <div class="img_div">
                                     
                                       
                                        <input accept="image/*" type="file" id="f1" name="a" onchange="loadFile(event,1)"/>
                                        <input accept="image/*" type="file" id="f2" name="b" onchange="loadFile(event,2)"/>
                                        <input accept="image/*" type="file" id="f3" name="c" onchange="loadFile(event,3)"/>
                                        <input accept="image/*" type="file" id="f4" name="d" onchange="loadFile(event,4)"/>
                                        <input accept="image/*" type="file" id="f5" name="e" onchange="loadFile(event,5)"/>
                                        <input accept="image/*" type="file" id="f6" name="f" onchange="loadFile(event,6)"/>
                                        <input accept="image/*" type="file" id="f7" name="g" onchange="loadFile(event,7)"/>
                                        <input accept="image/*" type="file" id="f8" name="h" onchange="loadFile(event,8)"/>
                                        <input accept="image/*" type="file" id="f9" name="i" onchange="loadFile(event,9)"/>
                                        <input accept="image/*" type="file" id="f10" name="j" onchange="loadFile(event,10)"/>
                                       
                                       <label class="ac1 "><label for=f1><img  class="slide" id="o1"></label><label class="sp_r" data="1"></label></label>
                                       <label  class="ac2 " ><label for=f2><img  class="slide" id="o2"></label><label class="sp_r" data="2"></label></label>
                                       <label  class="ac3 " ><label for=f3><img  class="slide" id="o3"></label><label class="sp_r" data="3"></label></label>
                                       <label  class="ac4 " ><label for=f4><img  class="slide" id="o4"></label><label class="sp_r" data="4"></label></label>
                                       <label  class="ac5 " ><label for=f5><img  class="slide" id="o5"></label><label class="sp_r" data="5"></label> </label>
                                       <label  class="ac6 " ><label for=f6><img  class="slide" id="o6"></label><label class="sp_r" data="6"></label></label>
                                       <label  class="ac7 " ><label for=f7><img  class="slide" id="o7"></label><label class="sp_r" data="7"></label></label>
                                       <label  class="ac8 " ><label for=f8><img  class="slide" id="o8"></label><label class="sp_r" data="8"></label></label>
                                       <label  class="ac9 " ><label for=f9><img  class="slide" id="o9"></label><label class="sp_r" data="9"></label></label>
                                       <label  class="ac10 " ><label for=f10><img  class="slide" id="o10"></label><label class="sp_r" data="10"></label></label>
                                      
                                    </div>
                                </div>


                                <label class="share-section" id="forclick" for="f1">
                                      <div class="icon-wrap" >
                                        <img src="image/image-solid.svg" class="icon  alert_more_img"> <span id="alert_more">Add Photo / Images</span>
                                    </div>
                                </label>
                              <div class="share-section location_open">
                                      <div class="icon-wrap" >
                                        <img src="image/map-marker-alt-solid.svg" class="icon " > <span  class="location" >Add Location</span>
                                    </div>
                                </div>
                             
                              <div class="share-section location_div">
                                      <div class="icon-wrap" >
                                        <input type="text" value="" name="location" id="location" placeholder="Type Location">
                                    </div>
                                </div>
                              <div class="share-section open_more_click">
                                      <div class="icon-wrap" >
                                        <img src="image/cog-solid.svg" class="icon comment-icon" > <span>More Options</span>
                                    </div>
                                </div>
                              <div id="open_more"     >
                                  <div class="setting_option">
                                      <div class="share-section" onclick="open_id('lists')">
                                          <div class="icon-wrap">
                                              <img src="../story/SVG/eye-regular.svg" class="icon comment-icon"> <span>Share with</span>
                                          </div>
                                      </div>
                                      <div id="lists" >
                                      <div class="share_with" id="bottom_border"><input class="options" type="radio" name="all_list" id="all_follow" value="0" checked>Share with all followers</div>
                                          
                                      <div class="share_with"><input class="options" type="radio" name="all_list" id="all_list" value="1">Share only with</div>
                                          
                                          <div>
                                              
                                              <?php
                                              
                                              $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']}" ;
                                              $result = mysqli_query($connection,$query);
                                              while($row = mysqli_fetch_assoc($result)){
                                              $desciption = '';
                                              if($row['description']){
                                              $desciption = '<div class="description">'.$row['description'].'</div>';
                                              }
                                              echo '
                                              <div class="list_fetch">
                                                  <div class="center"><img src="../emogi/128/'.$row['emoji'].'" class="list_image"></div>
                                                  <div class="certer_mid">
                                                      <div class="name">'.$row['group_name'].'</div>
                                                      '.$desciption.'
                                                  </div>
                                                  <label class="center"><input class="checkbox" type="checkbox" name="list[]" value="'.$row['id'].'" oninput="correct_seletion()"></label>
                                              </div>
                                              ';
                                              }
                                              
                                              ?>
                                              
                                          </div>
                                      </div>
                                  </div>
                                  <div class="setting_option">
                                      <div class="share-section">
                                          <div class="icon-wrap">
                                              <img src="image/thumbs-up-regular.svg" class="icon comment-icon"> <span>Allow people to react on your post</span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="setting_option">
                                      <div class="share-section">
                                          <div class="icon-wrap">
                                              <img src="image/comment-regular.svg" class="icon comment-icon"> <span>Allow people to comment on your post</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                <BUTTON  class="share-section"  id="button_post_desk" name="submit" value="submit">
                                     PUBLISH
                                </BUTTON>
                                
                            </form>
                          </div>
                    </div>
                </div>
            </div>
            <div class="right-bar"></div>
        </div>
    </div>

    <div class="mobile-header">
         <a href="../" class="icon me-icon">
            <svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" data-supported-dps="24x24" fill="black" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <path d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"></path>
            </svg>
        </a>
        <form class="input-wrap" autocomplete="off">
        </form>
        <span class="">
            <label id="button_post" for="button_post_desk">POST</label>
        </span>
    </div>



<script src="app.js"></script>
<!--<script src="../JS/main.js"></script>-->
  



</body>

</html>