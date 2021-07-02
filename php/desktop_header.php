<?php
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
//    echo $url;  
 //Path of the file stored under pathinfo
    $myFile = pathinfo($url);
  
    //Show the file name
//    echo $myFile['basename'], "\n";
//echo '&'.basename($url).'&';
//echo  $_SERVER['HTTP_HOST']; 
if($_SERVER['HTTP_HOST']==='localhost'){
    
$current_domain = 'http://localhost/r/a/';
}else{
$current_domain = 'https://yaariii.com/';

}
?>
    

<div class="main-navbar-wrap">
        <div class="main-navbar">
            <a href="<?php echo $current_domain;?>" class="icon company-logo"></a>
          <a href="<?php echo $current_domain;?>" class="input-wrap" autocomplete="off">
                <span class="icon search-icon autocomplete"></span>
                <input type="search" placeholder="Search" class="search-bar" name="s" id="search_des" />
                <span class="icon qrcode-icon"></span>
            </a>
            <ul class="nav-icons">
                <a href="<?php echo $current_domain;?>" class="icon home-icon " title="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px" height="30px">
                        <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 15 L 14 15 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z"></path>
                    </svg>
                </a>
                <a href="<?php echo $current_domain;?>request/" class="icon <?php if(basename($url)==='request.php')echo 'home-icon-active';?>" title="My Network">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends" class="svg-inline--fa fa-user-friends fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="31px" height="31px">
                        <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"></path>
                    </svg>
                </a>
                <a href="<?php echo $current_domain;?>create_post/" class="icon <?php if(basename($url)==='create_post')echo 'home-icon-active';?>" title="Add Post">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="28px">
                        <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                    </svg>
                </a>
                <a href="<?php echo $current_domain;?>chatall " class="icon <?php if(basename($url)==='chatall')echo 'home-icon-active';?>" title="Message">
                    <svg aria-hidden="true" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16 fa-7x" width="28px" height="26px">
                        <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                    </svg>

                </a>
                <a href="<?php echo $current_domain;?>noti" class="icon  <?php if(basename($url)==='noti')echo 'home-icon-active';?>" title="Notifications">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28px" height="26px">
                        <path d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                    </svg>
                </a>
                <span href="#" class="icon profile-icon work-cont">
                      <div  style="background-image:url('<?php if($_SESSION['img']){ echo $current_domain.'profile/i/240/'.$_SESSION['img'];}else{ echo $current_domain."profile/i/none.svg"; } ?>');" alt="profile-pic" class="bg_image profile_img_desk_header"></div>
                    <div class="desk-menu">
                        <div class="sidebar desktop-menu">
                            <a href="<?php echo $current_domain;?>account" class="profile-img-sidebar">
                                  <div  style="background-image:url('<?php if($_SESSION['img']){ echo $current_domain.'profile/i/240/'.$_SESSION['img'];}else{ echo $current_domain."profile/i/none.svg"; } ?>')" alt="profile-pic" class="bg_image avatar "></div>
                                <span class="moon"></span>
                                <p>
                                    <?php echo $_SESSION['name'];?> <br />
                                </p>
                                <img class="down expand-add-acc  opacaity0" src="SVG/chevron-down-solid.svg" alt="" />
                                <!-- <i class="fas fa-chevron-down arrow expand-add-acc"></i> -->
                            </a>
                            <div class="all-uls">
                                <!--<ul class="add-account">-->
                                <!--	<li >-->
                                <!--		<a href="#">-->
                                <!--			<img src="SVG/plus-solid.svg" alt="" /> <span>Add Account</span>-->
                                <!--		</a>-->
                                <!--	</li>-->

                                <!--</ul>-->
                                <ul>
                                    <li>
                                        <a href="<?php echo $current_domain;?>profile/">
                                            <img src="<?php echo $current_domain;?>SVG/user-edit-solid.svg" alt="" />
                                            <span>Visit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $current_domain;?>manage_category/">
                                            <img src="<?php echo $current_domain;?>SVG/tags-solid-black.svg" alt="" />
                                            <span>Manage Labels</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $current_domain;?>page/activity">
                                            <img src="<?php echo $current_domain;?>SVG/clock-solid.svg" alt="" />
                                            <span>My activities</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $current_domain;?>page/saved_posts">
                                            <img src="<?php echo $current_domain;?>SVG/save-black.svg" alt="" />
                                            <span>Saved posts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $current_domain;?>page/settings">
                                            <img src="<?php echo $current_domain;?>SVG/cog-solid.svg" alt="" />
                                            <span>Settings</span>

                                        </a>
                                    </li>



                                    <li>
                                        <a href="#" onclick="share(' <?php echo $_SESSION['name'];?>','Follow <?php echo $_SESSION['name'];?> on Yaariii','https://Yaariii.com/account?user=<?php echo $_SESSION['id'];?>')">
                                            <img src="<?php echo $current_domain;?>SVG/share-black.svg" alt="" />
                                            <span>Share Your Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $current_domain;?>page/logout">
                                            <img src="<?php echo $current_domain;?>SVG/power-off-solid.svg" alt="" />
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
    