<?php
session_start();
include '../connection.php';
if(!isset($_SESSION['id'])){
exit(0);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed | YaarMe</title>
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
            <span class="icon company-logo"></span>
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
                <a href="../create_post/" class="icon " title="Add Post">
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
                            <div class="profile-img-sidebar">
                                <img class="avatar" src="<?php if($_SESSION['img']){ echo '../profile/i/240/'.$_SESSION['img'];}else{ echo "../profile/i/none.svg"; } ?>" alt="">
                                <span class="moon"></span>
                                <p>
                                     <?php echo $_SESSION['name'];?>  <br>
                                </p>
                                <img class="down expand-add-acc" src="../SVG/chevron-down-solid.svg" alt="">
                            </div>
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
                                        <a href="../page/share_profile">
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
<p id="my_list"> My labels</p>

                    <div id="all_list">
                        <?php
                    
                    $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']} order by `category`.`id` ASC";
               $query = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($query)){
      if($row['description']){
          $description = '<div class="mid_con">'.$row['description'].'</div>';
      }else{
          $description = '';
      }

        echo ' <div class="posts g1" id="pt_'.$row['id'].'">
                            <a href="../manage_people?c='.$row['id'].'" class="k1"><img src="../emogi/128/'.$row['emoji'].'" class="avatar"></a>
                            <a href="../manage_people?c='.$row['id'].'" class="k1 mid">
                                <div class="mid_head">'.$row['group_name'].'</div>
                                '.$description.'
                            </a>
                            <div href="#" class="k1 hovrr1" id="'.$row['id'].'" name="'.$row['group_name'].'"  des="'.$row['description'].'"   url="'.$row['emoji'].'">
                                <div class="svg_a"> <img src="image/trash.svg"></div>
                            </div>
                            <div href="#" class="k1 hovrr2" id="'.$row['id'].'" name="'.$row['group_name'].'"  des="'.$row['description'].'"   url="'.$row['emoji'].'">
                                <div class="svg_a"> <img src="image/edit.svg"></div>
                            </div>
                        </div>';
  }
                    ?>
                    </div>



                    <div class="posts g1 g1_create">
                        Create new label
                    </div>



                    <div id="all_emogi">
                        <!--                        <img src="./image/times-solid.svg" class="cross">-->
                        <div id="all_emogi_hide"></div>
                        <div class="effect">

                            <!--      <p class="avtar_para"> Select a avatar for your list</p>-->
                            <div class="show_emogi">

                                <div class="emogi_cot">
                                    <div t="1" class="active"> <img src="../emogi/32/symbols/heart-decoration.png"></div>
                                    <div t="2"> <img src="../emogi/32/flags/flag-united-states.png"></div>
                                    <div t="3"> <img src="../emogi/32/food/bagel.png"></div>
                                    <div t="4"> <img src="../emogi/32/human/bearded-person-light-skin-tone.png"></div>
                                    <div t="5"> <img src="../emogi/32/nature/dog-face.png"></div>
                                    <div t="6"> <img src="../emogi/32/travel/helicopter.png"></div>
                                </div>

                                <div class="show_1_cd emg_1">

                                    <div class="emg emg1">
                                        <img src="../emogi/32/symbols/heart-decoration.png">
                                        <img src="../emogi/32/symbols/heart-exclamation.png">
                                        <img src="../emogi/32/symbols/heart-suit.png">
                                        <img src="../emogi/32/symbols/heart-with-arrow.png">
                                        <img src="../emogi/32/symbols/black-heart.png">
                                        <img src="../emogi/32/symbols/blue-heart.png">
                                        <img src="../emogi/32/symbols/brown-heart.png">
                                        <img src="../emogi/32/symbols/heart-with-ribbon.png">
                                        <img src="../emogi/32/symbols/beating-heart.png">
                                        <img src="../emogi/32/symbols/green-heart.png">
                                        <img src="../emogi/32/symbols/revolving-hearts.png">
                                        <img src="../emogi/32/symbols/sparkling-heart.png">
                                        <img src="../emogi/32/symbols/two-hearts.png">
                                        <img src="../emogi/32/activity/american-football.png">
                                        <img src="../emogi/32/activity/volleyball.png">
                                        <img src="../emogi/32/activity/badminton.png">
                                        <img src="../emogi/32/activity/baseball.png">
                                        <img src="../emogi/32/activity/bowling.png">
                                        <img src="../emogi/32/activity/chess-pawn.png">
                                        <img src="../emogi/32/activity/cricket-game.png">
                                        <img src="../emogi/32/activity/direct-hit.png">
                                        <img src="../emogi/32/activity/field-hockey.png">
                                        <img src="../emogi/32/activity/kite.png">
                                        <img src="../emogi/32/activity/headphone.png">
                                        <img src="../emogi/32/activity/microphone.png">
                                        <img src="../emogi/32/activity/musical-score.png">
                                        <img src="../emogi/32/activity/trumpet.png">
                                        <img src="../emogi/32/activity/violin.png">
                                        <img src="../emogi/32/activity/drum.png">
                                        <img src="../emogi/32/activity/guitar.png">
                                        <img src="../emogi/32/activity/performing-arts.png">
                                        <img src="../emogi/32/symbols/heavy-dollar-sign.png">
                                        <img src="../emogi/32/symbols/hundred-points.png">
                                        <img src="../emogi/32/symbols/atm-sign.png">
                                        <img src="../emogi/32/symbols/check-mark-button.png">
                                        <img src="../emogi/32/symbols/free-button.png">
                                        <img src="../emogi/32/symbols/cyclone.png">
                                        <img src="../emogi/32/symbols/exclamation-mark.png">
                                        <img src="../emogi/32/symbols/warning.png">
                                        <img src="../emogi/32/symbols/hot-springs.png">
                                        <img src="../emogi/32/activity/1st-place-medal.png">
                                        <img src="../emogi/32/activity/military-medal.png">
                                        <img src="../emogi/32/activity/trophy.png">
                                        <img src="../emogi/32/activity/artist-palette.png">
                                    </div>

                                    <div class="emg emg2">
                                        <img src="../emogi/32/flags/flag-united-states.png">
                                        <img src="../emogi/32/flags/flag-india.png">
                                        <img src="../emogi/32/flags/flag-united-kingdom.png">
                                        <img src="../emogi/32/flags/flag-canada.png">
                                        <img src="../emogi/32/flags/flag-china.png">
                                        <img src="../emogi/32/flags/flag-australia.png">
                                        <img src="../emogi/32/flags/flag-france.png">
                                        <img src="../emogi/32/flags/flag-brazil.png">
                                        <img src="../emogi/32/flags/flag-italy.png">
                                        <img src="../emogi/32/flags/flag-russia.png">
                                        <img src="../emogi/32/flags/flag-japan.png">
                                        <img src="../emogi/32/flags/flag-indonesia.png">
                                        <img src="../emogi/32/flags/flag-italy.png">
                                        <img src="../emogi/32/flags/flag-pakistan.png">
                                        <img src="../emogi/32/flags/flag-saudi-arabia.png">
                                        <img src="../emogi/32/flags/flag-united-arab-emirates.png">
                                        <img src="../emogi/32/flags/flag-colombia.png">
                                        <img src="../emogi/32/flags/flag-germany.png">
                                        <img src="../emogi/32/flags/flag-chile.png">
                                        <img src="../emogi/32/flags/flag-kuwait.png">
                                        <img src="../emogi/32/flags/flag-monaco.png">
                                        <img src="../emogi/32/flags/pirate-flag.png">
                                        <img src="../emogi/32/flags/rainbow-flag.png">
                                        <img src="../emogi/32/flags/triangular-flag.png">
                                        <img src="../emogi/32/flags/white-flag.png">
                                        <img src="../emogi/32/flags/black-flag.png">
                                        <img src="../emogi/32/flags/chequered-flag.png">
                                        <img src="../emogi/32/flags/crossed-flags.png">
                                    </div>

                                    <div class="emg emg3">
                                        <img src="../emogi/32/food/bagel.png">
                                        <img src="../emogi/32/food/banana.png">
                                        <img src="../emogi/32/food/beer-mug.png">
                                        <img src="../emogi/32/food/bell-pepper.png">
                                        <img src="../emogi/32/food/birthday-cake.png">
                                        <img src="../emogi/32/food/bottle-with-popping-cork.png">
                                        <img src="../emogi/32/food/bowl-with-spoon.png">
                                        <img src="../emogi/32/food/bread.png">
                                        <img src="../emogi/32/food/broccoli.png">
                                        <img src="../emogi/32/food/candy.png">
                                        <img src="../emogi/32/food/carrot.png">
                                        <img src="../emogi/32/food/cherries.png">
                                        <img src="../emogi/32/food/chocolate-bar.png">
                                        <img src="../emogi/32/food/clinking-beer-mugs.png">
                                        <img src="../emogi/32/food/clinking-glasses.png">
                                        <img src="../emogi/32/food/coconut.png">
                                        <img src="../emogi/32/food/cupcake.png">
                                        <img src="../emogi/32/food/curry-rice.png">
                                        <img src="../emogi/32/food/cut-of-meat.png">
                                        <img src="../emogi/32/food/doughnut.png">
                                        <img src="../emogi/32/food/ear-of-corn.png">
                                        <img src="../emogi/32/food/eggplant.png">
                                        <img src="../emogi/32/food/french-fries.png">
                                        <img src="../emogi/32/food/garlic.png">
                                        <img src="../emogi/32/food/glass-of-milk.png">
                                        <img src="../emogi/32/food/grapes.png">
                                        <img src="../emogi/32/food/green-apple.png">
                                        <img src="../emogi/32/food/green-salad.png">
                                        <img src="../emogi/32/food/hamburger.png">
                                        <img src="../emogi/32/food/honey-pot.png">
                                        <img src="../emogi/32/food/hot-beverage.png">
                                        <img src="../emogi/32/food/hot-dog.png">
                                        <img src="../emogi/32/food/hot-pepper.png">
                                        <img src="../emogi/32/food/ice-cream.png">
                                        <img src="../emogi/32/food/ice-cube.png">
                                        <img src="../emogi/32/food/kiwi-fruit.png">
                                        <img src="../emogi/32/food/leafy-green.png">
                                        <img src="../emogi/32/food/lemon.png">
                                        <img src="../emogi/32/food/lollipop.png">
                                        <img src="../emogi/32/food/mango.png">
                                        <img src="../emogi/32/food/pancakes.png">
                                        <img src="../emogi/32/food/peach.png">
                                        <img src="../emogi/32/food/peanuts.png">
                                        <img src="../emogi/32/food/pineapple.png">
                                        <img src="../emogi/32/food/pizza.png">
                                        <img src="../emogi/32/food/popcorn.png">
                                        <img src="../emogi/32/food/pot-of-food.png">
                                        <img src="../emogi/32/food/poultry-leg.png">
                                        <img src="../emogi/32/food/red-apple.png">
                                        <img src="../emogi/32/food/salt.png">
                                        <img src="../emogi/32/food/sandwich.png">
                                        <img src="../emogi/32/food/shortcake.png">
                                        <img src="../emogi/32/food/spaghetti.png">
                                        <img src="../emogi/32/food/strawberry.png">
                                        <img src="../emogi/32/food/taco.png">
                                        <img src="../emogi/32/food/teacup-without-handle.png">
                                        <img src="../emogi/32/food/teapot.png">
                                        <img src="../emogi/32/food/tumbler-glass.png">
                                        <img src="../emogi/32/food/watermelon.png">
                                        <img src="../emogi/32/food/wine-glass.png">
                                    </div>

                                    <div class="emg emg4">
                                        <img src="../emogi/32/human/artist-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/astronaut-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/baby-angel-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/backhand-index-pointing-up-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/bearded-person-light-skin-tone.png">
                                        <img src="../emogi/32/human/blond-haired-man-light-skin-tone.png">
                                        <img src="../emogi/32/human/breast-feeding-light-skin-tone.png">
                                        <img src="../emogi/32/human/call-me-hand-light-skin-tone.png">
                                        <img src="../emogi/32/human/child-medium-dark-skin-tone.png">
                                        <img src="../emogi/32/human/clapping-hands-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/construction-worker-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/cook-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/crossed-fingers-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/detective-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/firefighter-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/flexed-biceps-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/folded-hands-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/girl-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/guard-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/hand-with-fingers-splayed-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/health-worker-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/index-pointing-up-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/left-facing-fist-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/love-you-gesture-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/mage-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/man-artist-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/ok-hand-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/old-man-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/old-woman-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/oncoming-fist-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/palms-up-together-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/person-wearing-turban-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/sign-of-the-horns-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/superhero-medium-skin-tone.png">
                                        <img src="../emogi/32/human/supervillain-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/thumbs-down-medium-skin-tone.png">
                                        <img src="../emogi/32/human/thumbs-up-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/vampire-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/victory-hand-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/vulcan-salute-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/waving-hand-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-and-man-holding-hands-medium-light-skin-tone-medium-skin-tone.png">
                                        <img src="../emogi/32/human/woman-astronaut-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-artist-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-dancing-medium-skin-tone.png">
                                        <img src="../emogi/32/human/woman-feeding-baby-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-health-worker-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-in-manual-wheelchair-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-kneeling-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-superhero-medium-skin-tone.png">
                                        <img src="../emogi/32/human/woman-supervillain-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-vampire-dark-skin-tone.png">
                                        <img src="../emogi/32/human/woman-walking-medium-light-skin-tone.png">
                                        <img src="../emogi/32/human/woman-with-headscarf-medium-skin-tone.png">
                                        <img src="../emogi/32/human/writing-hand-medium-light-skin-tone.png">
                                        <img src="../emogi/32/activity/man-biking.png">
                                        <img src="../emogi/32/activity/man-bouncing-ball.png">
                                        <img src="../emogi/32/activity/man-cartwheeling.png">
                                        <img src="../emogi/32/activity/man-climbing.png">
                                        <img src="../emogi/32/activity/man-golfing.png">
                                        <img src="../emogi/32/activity/man-in-lotus-position.png">
                                        <img src="../emogi/32/activity/man-juggling.png">
                                        <img src="../emogi/32/activity/man-lifting-weights.png">
                                        <img src="../emogi/32/activity/man-mountain-biking.png">
                                        <img src="../emogi/32/activity/man-playing-handball.png">
                                        <img src="../emogi/32/activity/man-playing-water-polo.png">
                                        <img src="../emogi/32/activity/men-wrestling.png">
                                        <img src="../emogi/32/activity/person-biking.png">
                                        <img src="../emogi/32/activity/woman-biking.png">
                                        <img src="../emogi/32/activity/woman-bouncing-ball.png">
                                        <img src="../emogi/32/activity/woman-climbing.png">
                                        <img src="../emogi/32/activity/woman-golfing.png">
                                        <img src="../emogi/32/activity/woman-lifting-weights.png">
                                        <img src="../emogi/32/activity/woman-playing-handball.png">
                                        <img src="../emogi/32/activity/women-wrestling.png">
                                    </div>

                                    <div class="emg emg5">
                                        <img src="../emogi/32/nature/ant.png">
                                        <img src="../emogi/32/nature/baby-chick.png">
                                        <img src="../emogi/32/nature/bat.png">
                                        <img src="../emogi/32/nature/bear.png">
                                        <img src="../emogi/32/nature/black-cat.png">
                                        <img src="../emogi/32/nature/boar.png">
                                        <img src="../emogi/32/nature/bouquet.png">
                                        <img src="../emogi/32/nature/butterfly.png">
                                        <img src="../emogi/32/nature/cactus.png">
                                        <img src="../emogi/32/nature/camel.png">
                                        <img src="../emogi/32/nature/cat-face.png">
                                        <img src="../emogi/32/nature/cat.png">
                                        <img src="../emogi/32/nature/chicken.png">
                                        <img src="../emogi/32/nature/chipmunk.png">
                                        <img src="../emogi/32/nature/cow-face.png">
                                        <img src="../emogi/32/nature/cow.png">
                                        <img src="../emogi/32/nature/crab.png">
                                        <img src="../emogi/32/nature/cricket.png">
                                        <img src="../emogi/32/nature/crocodile.png">
                                        <img src="../emogi/32/nature/deer.png">
                                        <img src="../emogi/32/nature/dog.png">
                                        <img src="../emogi/32/nature/dog-face.png">
                                        <img src="../emogi/32/nature/dolphin.png">
                                        <img src="../emogi/32/nature/dove.png">
                                        <img src="../emogi/32/nature/dragon-face.png">
                                        <img src="../emogi/32/nature/dragon-face.png">
                                        <img src="../emogi/32/nature/duck.png">
                                        <img src="../emogi/32/nature/eagle.png">
                                        <img src="../emogi/32/nature/elephant.png">
                                        <img src="../emogi/32/nature/fish.png">
                                        <img src="../emogi/32/nature/fly.png">
                                        <img src="../emogi/32/nature/flamingo.png">
                                        <img src="../emogi/32/nature/fox.png">
                                        <img src="../emogi/32/nature/frog.png">
                                        <img src="../emogi/32/nature/giraffe.png">
                                        <img src="../emogi/32/nature/gorilla.png">
                                        <img src="../emogi/32/nature/hatching-chick.png">
                                        <img src="../emogi/32/nature/hear-no-evil-monkey.png">
                                        <img src="../emogi/32/nature/hedgehog.png">
                                        <img src="../emogi/32/nature/honeybee.png">
                                        <img src="../emogi/32/nature/horse-face.png">
                                        <img src="../emogi/32/nature/horse.png">
                                        <img src="../emogi/32/nature/kangaroo.png">
                                        <img src="../emogi/32/nature/koala.png">
                                        <img src="../emogi/32/nature/lady-beetle.png">
                                        <img src="../emogi/32/nature/leopard.png">
                                        <img src="../emogi/32/nature/lion.png">
                                        <img src="../emogi/32/nature/lizard.png">
                                        <img src="../emogi/32/nature/llama.png">
                                        <img src="../emogi/32/nature/lobster.png">
                                        <img src="../emogi/32/nature/mammoth.png">
                                        <img src="../emogi/32/nature/monkey.png">
                                        <img src="../emogi/32/nature/monkey-face.png">
                                        <img src="../emogi/32/nature/mosquito.png">
                                        <img src="../emogi/32/nature/mouse-face.png">
                                        <img src="../emogi/32/nature/mouse.png">
                                        <img src="../emogi/32/nature/orangutan.png">
                                        <img src="../emogi/32/nature/owl.png">
                                        <img src="../emogi/32/nature/ox.png">
                                        <img src="../emogi/32/nature/panda.png">
                                        <img src="../emogi/32/nature/parrot.png">
                                        <img src="../emogi/32/nature/peacock.png">
                                        <img src="../emogi/32/nature/penguin.png">
                                        <img src="../emogi/32/nature/pig.png">
                                        <img src="../emogi/32/nature/pig-face.png">
                                        <img src="../emogi/32/nature/polar-bear.png">
                                        <img src="../emogi/32/nature/rabbit-face.png">
                                        <img src="../emogi/32/nature/rabbit.png">
                                        <img src="../emogi/32/nature/raccoon.png">
                                        <img src="../emogi/32/nature/rat.png">
                                        <img src="../emogi/32/nature/rhinoceros.png">
                                        <img src="../emogi/32/nature/rooster.png">
                                        <img src="../emogi/32/nature/rose.png">
                                        <img src="../emogi/32/nature/rooster.png">
                                        <img src="../emogi/32/nature/rock.png">
                                        <img src="../emogi/32/nature/sauropod.png">
                                        <img src="../emogi/32/nature/scorpion.png">
                                        <img src="../emogi/32/nature/service-dog.png">
                                        <img src="../emogi/32/nature/shark.png">
                                        <img src="../emogi/32/nature/snowman.png">
                                        <img src="../emogi/32/nature/tiger-face.png">
                                        <img src="../emogi/32/nature/tiger.png">
                                        <img src="../emogi/32/nature/t-rex.png">
                                        <img src="../emogi/32/nature/tropical-fish.png">
                                        <img src="../emogi/32/nature/turkey.png">
                                        <img src="../emogi/32/nature/turtle.png">
                                        <img src="../emogi/32/nature/water-buffalo.png">
                                        <img src="../emogi/32/nature/whale.png">
                                        <img src="../emogi/32/nature/wolf.png">
                                        <img src="../emogi/32/nature/worm.png">
                                        <img src="../emogi/32/nature/zebra.png">
                                    </div>

                                    <div class="emg emg6">
                                        <img src="../emogi/32/travel/automobile.png">
                                        <img src="../emogi/32/travel/auto-rickshaw.png">
                                        <img src="../emogi/32/travel/bicycle.png">
                                        <img src="../emogi/32/travel/bullet-train.png">
                                        <img src="../emogi/32/travel/bus.png">
                                        <img src="../emogi/32/travel/helicopter.png">
                                        <img src="../emogi/32/travel/high-speed-train.png">
                                        <img src="../emogi/32/travel/motorcycle.png">
                                        <img src="../emogi/32/travel/police-car.png">
                                        <img src="../emogi/32/travel/racing-car.png">
                                        <img src="../emogi/32/travel/rocket.png">
                                        <img src="../emogi/32/travel/tractor.png">
                                        <img src="../emogi/32/travel/speedboat.png">
                                        <img src="../emogi/32/travel/small-airplane.png">
                                        <img src="../emogi/32/travel/ship.png">
                                    </div>





                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="create_list">
                        <div id="create_click_hd">
                        </div>
                        <div id="create_list_b">
                            <div class="cr_img_div">
                                <div class="z1">

                                    <img class="z3" src="../emogi/128/nature/rat.png">
                                </div>
                                <span class="z2" src="image/edit.svg"> Change&nbsp;avatar</span>
                            </div>
                            <div><textarea class="textarea textarea1" placeholder="Name of label"></textarea></div>
                            <div><textarea class="textarea textarea2" placeholder="Description (optional)"></textarea></div>
                            <div><button type="submit" value="SAVE" id="save">SAVE</button></div>
                        </div>
                    </div>

                    <div id="warn" class="">
                        <div id="warn_in">
                        </div>
                          <div id="warn_j">
                            <div class="cr_img_div">
                                <div class="z1">

                                    <img class="z7" src="">
                                </div>
                                <span class="z8" src="image/edit.svg"> </span>
                            </div>
                            <div><textarea class="textarea warnhead" readonly>RAT</textarea></div>
                            <div><div class="textarea warntext " >Warning!<br><br> If you delete this label then member of this label will be also deleted from this label and this action can not be reverse back. </div></div>
                            <div class="btn_ct"><button type="submit" value="SAVE" class="warn_btn" id="back" >BACK</button>
                              <button type="submit" value="SAVE" class="warn_btn warn_red" id="delete">DELETE</button>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="right-bar"></div>
        </div>
    </div>
    <div class="mobile-header">
        <a href="../" class="icon me-icon">
            <svg aria-hidden="true" data-prefix="far" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-left fa-w-14 fa-7x">
                <path fill="black" d="M229.9 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L94.569 282H436c6.627 0 12-5.373 12-12v-28c0-6.627-5.373-12-12-12H94.569l155.13-155.13c4.686-4.686 4.686-12.284 0-16.971L229.9 38.101c-4.686-4.686-12.284-4.686-16.971 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971L212.929 473.9c4.686 4.686 12.284 4.686 16.971-.001z" class=""></path>
            </svg>
        </a>
        <span class="">
            <label id="button_post" for="button_post_desk">Manage label</label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>
    <script src="app.js"></script>
</body>

</html>