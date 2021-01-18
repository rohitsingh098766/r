<?php


//$exif = exif_read_data('profile.jpg'); //parameter should be image path
//
//if(isset($exif['Orientation'])) {
//
//    if($exif['Orientation'] === 1) print 'rotated clockwise by 0 deg (nothing)';
//
//    if($exif['Orientation'] === 8) print 'rotated clockwise by 90 deg';
//
//    if($exif['Orientation'] === 3) print 'rotated clockwise by 180 deg';
//
//    if($exif['Orientation'] === 6) print 'rotated clockwise by 270 deg';
//
//    if($exif['Orientation'] === 2) print 'vertical flip, rotated clockwise by 0 deg';
//
//    if($exif['Orientation'] === 7) print 'vertical flip, rotated clockwise by 90 deg';
//
//    if($exif['Orientation'] === 4) print 'vertical flip, rotated clockwise by 180 deg';
//
//    if($exif['Orientation'] === 5) print 'vertical flip, rotated clockwise by 270 deg';
//
//}
//
//Print_r($exif);



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
image_fix_orientation('../profile/i/original/','1.4bohj.jpg');  
?>
<img src="../profile/i/120/1.4bohj.jpg" style="max-height:300px">
<img src="../profile/i/240/1.4bohj.jpg" style="max-height:300px">
<img src="../profile/i/360/1.4bohj.jpg" style="max-height:300px">
<img src="../profile/i/480/1.4bohj.jpg" style="max-height:300px">
<img src="../profile/i/720/1.4bohj.jpg" style="max-height:300px">
<img src="../profile/i/1080/1.4bohj.jpg" style="max-height:300px">
<img src="../profile/i/1440/1.4bohj.jpg" style="max-height:300px">
<img src="../profile/i/2160/1.4bohj.jpg" style="max-height:300px">