<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){include '../login/check_coockie.php';}

if(isset($_GET['delete'])){
$delete = mysqli_real_escape_string($connection,$_GET['delete']);
$query = "DELETE FROM yaarme.about WHERE (`about`.`id` = {$delete} and `about`.`user` = {$_SESSION['id']})";
// echo $query;
if(mysqli_query($connection,$query)){
header('Location: ../account?edit=1');
exit(0);
}
}


$saved_opinion = '';
$saved_id = '';
$saved_name = '';
$saved_degree = '';
$saved_branch = '';
$saved_joining_date = 0;
$saved_joining_month = 0;
$saved_joining_year = 0;
$saved_leaving_date = 0;
$saved_leaving_month = 0;
$saved_leaving_year = 0;

if(isset($_GET['edit'])){
$edit = mysqli_real_escape_string($connection,$_GET['edit']);
    
$query_show = "SELECT * FROM yaarme.about left join yaarme.users on users.id = about.add_profile WHERE (`about`.`id` = {$edit} and `about`.`user` = {$_SESSION['id']})" ;
$result_show = mysqli_query($connection,$query_show);
while($row_show = mysqli_fetch_assoc($result_show)){
$saved_opinion = $row_show['my_opinion'];
$saved_id = $row_show['add_profile'];
    if($row_show['first_name']){
$saved_name = $row_show['first_name'].' '.$row_show['last_name'];
    }else{
$saved_name = $row_show['add_profile_name'];
    }
    $saved_degree = $row_show['position'];
$saved_branch = $row_show['branch'];
    $saved_relationship_status = $row_show['position'];
if($row_show['start_date']>0){$saved_joining_date = $row_show['start_date'];}
if($row_show['start_month']>0){$saved_joining_month = $row_show['start_month'];}
if($row_show['start_month']>0){$saved_joining_year = $row_show['start_month'];}
if($row_show['end_date']>0){$saved_leaving_date = $row_show['end_date'];}
if($row_show['end_month']>0){$saved_leaving_month = $row_show['end_month'];}
if($row_show['end_year']>0){$saved_leaving_year = $row_show['end_year'];}
}   
}







if(isset($_POST['submitted'])){

$collage = mysqli_real_escape_string($connection,$_POST['collage']);
$collage_profile_id = mysqli_real_escape_string($connection,$_POST['collage_profile_id']);
$date = mysqli_real_escape_string($connection,$_POST['date']);
$month = mysqli_real_escape_string($connection,$_POST['month']);
$year = mysqli_real_escape_string($connection,$_POST['year']);
$date_2 = mysqli_real_escape_string($connection,$_POST['date_2']);
$month_2 = mysqli_real_escape_string($connection,$_POST['month_2']);
$year_2 = mysqli_real_escape_string($connection,$_POST['year_2']);
$experience = mysqli_real_escape_string($connection,$_POST['experience']);
$branch = mysqli_real_escape_string($connection,$_POST['branch']);

if($_POST['collage'] && !$_POST['collage_profile_id']){
$collage = "'".mysqli_real_escape_string($connection,$_POST['collage'])."'";
}else{
$collage = "NULL";
}
if($_POST['collage_profile_id']){
$collage_profile_id = "'".mysqli_real_escape_string($connection,$_POST['collage_profile_id'])."'";
}else{
$collage_profile_id = "NULL";
}
if($_POST['date']){
$date = "'".mysqli_real_escape_string($connection,$_POST['date'])."'";
}else{
$date = "NULL";
}
if($_POST['month']){
$month = "'".mysqli_real_escape_string($connection,$_POST['month'])."'";
}else{
$month = "NULL";
}
if($_POST['year']){
$year = "'".mysqli_real_escape_string($connection,$_POST['year'])."'";
}else{
$year = "NULL";
}
if($_POST['date_2']){
$date_2 = "'".mysqli_real_escape_string($connection,$_POST['date_2'])."'";
}else{
$date_2 = "NULL";
}
if($_POST['month_2']){
$month_2 = "'".mysqli_real_escape_string($connection,$_POST['month_2'])."'";
}else{
$month_2 = "NULL";
}
if($_POST['year_2']){
$year_2 = "'".mysqli_real_escape_string($connection,$_POST['year_2'])."'";
}else{
$year_2 = "NULL";
}
if($_POST['experience']){
$experience = "'".mysqli_real_escape_string($connection,$_POST['experience'])."'";
}else{
$experience = "NULL";
}
if($_POST['degree']){
$degree = "'".mysqli_real_escape_string($connection,$_POST['degree'])."'";
}else{
$degree = "NULL";
}
if($_POST['branch']){
$branch = "'".mysqli_real_escape_string($connection,$_POST['branch'])."'";
}else{
$branch = "NULL";
}

if(isset($_GET['edit'])){
$edit = mysqli_real_escape_string($connection,$_GET['edit']);

    $query = "UPDATE `about` SET 
    `position` = {$degree},
    `branch` =   {$branch},
    `add_profile` =   {$collage_profile_id},
    `add_profile_name` =   {$collage},
    `my_opinion` =   {$experience}, 
    `start_date` =   {$date},
    `start_month` =   {$month},
    `start_year` =   {$year},
    `end_date` =   {$date_2},
    `end_month` =  {$month_2} ,
    `end_year` = {$year_2}
    WHERE (`about`.`id` = {$edit} and user = {$_SESSION['id']});";
}else{
  $query = "INSERT INTO `about`
(`id`, `user`, `about_code`, `share_with`, `connect_privacy`, `position`, `branch`, `add_profile`, `add_profile_name`, `my_opinion`, `start_date`, `start_month`, `start_year`, `end_date`, `end_month`, `end_year`)
VALUES (NULL, '{$_SESSION['id']}', '5', '1', NULL, {$degree}, {$branch}, {$collage_profile_id}, {$collage}, {$experience}, {$date}, {$month}, {$year}, {$date_2}, {$month_2}, {$year_2});";  
}

// echo $query;
if(mysqli_query($connection,$query)){
  $query_inspect = "select * from yaarme.about where (user = {$_SESSION['id']} and about_code = 5) order by id asc limit 1";
    $result_inspect = mysqli_query($connection,$query_inspect);
  while($row_inspect = mysqli_fetch_assoc($result_inspect)){
    $query_set = "UPDATE `about` SET `share_with` = {$row_inspect['share_with']}, `connect_privacy` = {$row_inspect['connect_privacy']} WHERE (user = {$_SESSION['id']} and about_code = 5)";
      if(mysqli_query($connection,$query_set)){
      }
}
}
// echo $query;
//exit;




header('Location: ../account?edit=1');
exit(0);

}

          ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education</title>
    <link rel="icon" type="image/x-icon" href="CSS/Images/Yaarme-logo.png">

    <link rel="stylesheet" href="../CSS/spin_loader.css">
    <link rel="stylesheet" href="../login/CSS/style.css">
    <link rel="stylesheet" href="../edit_profile/CSS/style.css">
    <link rel="stylesheet" href="./css/education.css">

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
    <style>

    </style>
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
        <div class="main-login hide" id="login-form"></div>
       
        <div class="main-signup " id="signup-form">
            <div class="header">
                <img src="../login/CSS/Images/Yaarme-logo.png" class="main-img head-img">
                <div class="title">
                    <b style="color: #196fb6;">Yaar</b><b>Me</b>
                </div>

            </div>
            <h2 class="heading" style="font-size: 1.25em;">Sign Up</h2>
            <div class="progress-bar">
                <span class="number finished" id="n-1">1</span>
                <span class="line" id="l-1"></span>
                <span class="number" id="n-2">2</span>
                <span class="line" id="l-2"></span>
                <span class="number" id="n-3">3</span>
                <span class="line" id="l-3"></span>
                <span class="number" id="n-4">4</span>

            </div>
            <form class="multi-stage" autocomplete="off" id="form" method="post" enctype="multipart/form-data">
                <div class="forms" autocomplete="off" spellcheck="false">
                    <div class="form-heading">
                        <span>Education</span>
                    </div>
                    <span class="note note-plus">Where did you study?</span>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="location" name="collage" required placeholder='School / Collage / University / Institute name' value="<?php echo $saved_name;?>">
                    </div>
                    <input type="hidden" id="collage_profile_id" name="collage_profile_id" value="<?php echo $saved_id;?>">

                    <div class="button-wrap">
                        <div data-id="1" class="continue">Continue</div>
                    </div>
                </div>

                <div class="forms" autocomplete="off" spellcheck="false">
                    <div class="form-heading">

                        <span>&nbsp;</span>
                    </div>
                    <span class="note note-plus">Please mention your degree and branch. (Optional)</span>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="degree" name="degree" value="<?php echo $saved_degree;?>" required>
                        <span class="label">Degree</span>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="fields " id="branch" name="branch" value="<?php echo $saved_branch;?>" required>
                        <span class="label">Branch</span>
                    </div>

                    <div class="button-wrap">
                        <div data-id="1" class="previous">Previous</div>
                        <div data-id="2" class="continue">Continue</div>
                    </div>
                </div>

                <div class="forms" autocomplete="off" spellcheck="false" id="signup_username">
                    <div class="form-heading">

                        <span>&nbsp;</span>
                    </div>
                    <span class="note note-plus">When did you join your collage?</span>
                    <div class="date-wrap">
                        <div class="input-wrap">
                            <select class="fields" name="date" id="date" required>
                                <option value="" selected></option>
                            </select>
                            <span class="label select">Date</span>
                        </div>
                        <div class="input-wrap month">
                            <select class="fields" name="month" id="month" required>
                                <option value="" selected></option>
                            </select>
                            <span class="label select">Month</span>
                        </div>
                        <div class="input-wrap">
                            <select class="fields" name="year" id="year" required>
                                <option value="" selected></option>
                            </select>
                            <span class="label select">Year</span>
                        </div>
                    </div>
<span class="note note-plus  "><input type="checkbox" id="i_work_here" onchange="show_ending_date()" checked> I currently study here here. </span>
<!--                    <span class="note note-plus">Date (or Expected) of completion. </span>-->
                      <div class="hide hide_a"><span class="note note-plus  ">When did you leave collage? </span></div>
                    <div class="date-wrap hidden hide hide_b">
                        <div class="input-wrap">
                            <select class="fields" name="date_2" id="date_2" required>
                                <option value="" selected></option>
                            </select>
                            <span class="label select">Date</span>
                        </div>
                        <div class="input-wrap month">
                            <select class="fields" name="month_2" id="month_2" required>
                                <option value="" selected></option>
                            </select>
                            <span class="label select">Month</span>
                        </div>
                        <div class="input-wrap">
                            <select class="fields" name="year_2" id="year_2" required>
                                <option value="" selected></option>
                            </select>
                            <span class="label select">Year</span>
                        </div>
                    </div>


                    <div class="button-wrap">
                        <div data-id="2" class="previous">Previous</div>
                        <div data-id="3" class="continue">Continue</div>
                    </div>
                    <br>
                </div>

                <div class="forms" autocomplete="off" spellcheck="false">
                    <div class="form-heading">

                        <span>&nbsp;</span>
                    </div>
                    <span class="note note-plus">How was your experience at this collage? (Optional)</span>
                    <div class="input-wrap">
                        <textarea type="text" class="fields" id="summary" name="experience" required="" onkeydown="autosize('summary')" maxlength="1000"><?php
                            echo $saved_opinion;
                            ?></textarea>
                        <span class="label">Experience</span>
                    </div>
                    <div class="button-wrap">
                        <div data-id="3" class="previous">Previous</div>
                         <div  class="signup-button  "  id="submit">Save</div>
                    </div>
                </div>




 <input type="hidden" name="submitted" value="1">

            </form>
             <?php 
            if(isset($_GET['edit'])){
echo '<a href="?delete='.$_GET['edit'].'" id="skipall" >Delete education</a>';
            }
            ?>
        </div>
    </div>




    <div class="hide load_anything"></div>
    <script src="js/about.js"></script>

 <script>
        var edit = false;
        var correct_day = 0;
        var correct_month = 0;
        var correct_year = 0;
        var correct_day_end = 0;
        var correct_month_end = 0;
        var correct_year_end = 0;
        <?php
        if(isset($_GET['edit'])){
            echo 'var edit = true;';
            echo 'var correct_day = '.$saved_joining_date.';';
            echo 'var correct_month = '.$saved_joining_month.';';
            echo 'var correct_year = '.$saved_joining_year.';';
            echo 'var correct_day_end = '.$saved_leaving_date.';';
            echo 'var correct_month_end = '.$saved_leaving_month.';';
            echo 'var correct_year_end = '.$saved_leaving_year.';';
            
        }
        ?>
    </script>
    <script src="js/joining_and_ending_dates.js"></script>

    <!--    select school-->
    <script src="js/about_add_profile.js"></script>

</body>

</html>