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
    <title>Feed | Yaariii</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="./style.css?v=4">
    <link rel="stylesheet" href="../CSS/profile.css">

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
   <?php
     include '../php/desktop_header.php';
    ?>
    
    
    
<!--    add label -->
    <div class="my_options" >
        <div class="my_options" id="my_options"></div>
        <div class="items">
            <p class="select_category">Who can see  this label? </p>
            <form>
                <ul id="s_lists_about">
                      <li>
                        <div class="follow-conn select_tl" cd="0" c="1">
                            <img src="../SVG/lock-solid-about.svg" class="follow-icon  about_lock">
                                    <span class="conn-name">
                                        <span><b>Only you</b></span>
                                          
                                         </span>
                                    <span class="select_me only_one">
                                <div class="inner_checked">✔</div>
                            </span>
                        </div>
                    </li>
                      <li>
                        <div class="follow-conn select_tl" cd="0" c="2">
                            <img src="../SVG/lock-solid-green.svg" class="follow-icon about_lock">
                                    <span class="conn-name">
                                        <span><b>Only followers</b></span>
                                            
                                         </span>
                                    <span class="select_me only_one">
                                <div class="inner_checked">✔</div>
                            </span>
                        </div>
                    </li>
                      <li>
                        <div class="follow-conn select_tl" cd="0" c="3">
                            <img src="../SVG/lock-open-red.svg" class="follow-icon about_lock">
                                    <span class="conn-name">
                                        <span><b>Everyone</b></span>
                                            
                                         </span>
                                    <span class="select_me only_one select_me_selected">
                                <div class="inner_checked display_flex">✔</div>
                            </span>
                        </div>
                    </li>
<p class="select_category"></p>
<span class="or-marker">&nbsp;Or only&nbsp;</span>
                      <?php
                    
                    $query = "select * from yaarme_follow.category where owner_id = {$_SESSION['id']}";
                    $query = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($query)){
                    if($row['description']){
                    $description = '<span>'.$row['description'].'</span>';
                    }else{
                    $description = '';
                    }
                    if($row['pin']){
                    $pin1 = "select_me_selected";
                    $pin2 = "display_flex";
                    }else{

                    }
                    $pin1 = "";
                    $pin2 = "";
                    $group_name = htmlentities( preg_replace('/\r|\n/',' ', htmlentities($row['group_name'])));

                    echo ' <li>
                        <div class="follow-conn select_tl" cd="'.$row['id'].'" c="4">
                            <img src="../emogi/128/'.$row['emoji'].'" class="follow-icon">
                            <span class="conn-name">
                                <span><b>'.$group_name.'</b></span>
                                '.$description.'
                            </span>
                            <span class="select_me '.$pin1.' " name="'.$row['group_name'].'">
                                <div class="inner_checked '.$pin2.'">&#10004;</div>
                            </span>
                        </div>
                    </li>';


                    }
                 
                    ?>
                      




                </ul>

            </form>
        </div>

    </div>
    
    
    
    <div class="container-wrap">
        <div class="container">
            <div class="left-bar"></div>
            <div class="main-content">
                <div class="homepage-main-content">
<p id="my_list"> My labels</p>

                    <div id="all_list">
                         <script>
//        rough work
//     var a = [];
//    a[9] = [123,34566,23456];
//        console.log(a[9][2]);
//        a[345678] = [1123456];
//         console.log(a[345678][0]);
                             var privacy_level = [];
                             var selected_labels = [];
    </script>
                        <?php
                    
                    $query = "select *, category.id as label_id from yaarme_follow.category where owner_id = {$_SESSION['id']} order by `category`.`id` ASC";
//                        echo $query;
               $query = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($query)){
      $label = $row['label_id'];
      if($row['description']){
          $description = '<div class="mid_con">'.$row['description'].'</div>';
      }else{
          $description = '';
      }
      $final_labels = '';
     
      if($row['share_with']==1){
          $privacy_out = 'Private';
      }else if($row['share_with']==2){
          $privacy_out = 'Only followers';
      }else if($row['share_with']==3){
          $privacy_out = 'Everyone';
      }else  if($row['share_with']==4){
          $privacy_out = ' ';
          $query_get_lebels = "select * from yaarme_follow.category_privacy join yaarme_follow.category on category.id = category_privacy.category_allow where category_id = {$label}";
          $query_get_lebels = mysqli_query($connection,$query_get_lebels);
          $class_exists = false;

          while($row_label = mysqli_fetch_assoc($query_get_lebels)){
          $privacy_out .= $row_label['group_name'].', ';
              $final_labels .= $row_label['category_allow'].', ';
              $class_exists = true;
          }
          if($class_exists == true){
              $privacy_out = substr($privacy_out,0,-2);
          }
          else{
              $privacy_out = 'Private';
          }
      }else{
          $privacy_out = '';
      }
      
      
      

        echo ' <div class="posts g1" id="pt_'.$label.'">
                            <a href="../account?label='.$label.'#people" class="k1"><img src="../emogi/128/'.$row['emoji'].'" class="avatar"></a>
                            <div  class="k1 mid">
                                <div class="k1_r1"><a href="../account?label='.$label.'#people" class="mid_head">'.$row['group_name'].'</a><img src="../SVG/eye-regular.svg" class="eye_show" onclick="edit_tag_privacy('.$label.')"><span id="privacy_lebal_id_'.$label.'" class="privacy_visble" onclick="edit_tag_privacy('.$label.')">'.$privacy_out.'</span></div>
                                '.$description.'
                            </div>
                            <div href="#" class="k1 hovrr1" id="'.$label.'" name="'.$row['group_name'].'"  des="'.$row['description'].'"   url="'.$row['emoji'].'">
                                <div class="svg_a"> <img src="image/trash.svg"></div>
                            </div>
                            <div href="#" class="k1 hovrr2" id="'.$label.'" name="'.$row['group_name'].'"  des="'.$row['description'].'"   url="'.$row['emoji'].'">
                                <div class="svg_a"> <img src="image/edit.svg"></div>
                            </div>
                        </div>
                        <script>
                        privacy_level['.$label.'] = '.$row['share_with'].';
                        selected_labels['.$label.'] = ['.$final_labels.'];
                        console.log(privacy_level['.$label.']);
                        console.log(selected_labels['.$label.']);
                        </script>
                        ';
  }
                    ?>
                    </div>



                    <div class="posts g1 g1_create">
                        Create new label
                    </div>
                    <div class="safe_message">
                    * Your all labels are private to you, unless you haven't change it's privacy.
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
                            <div><div class="textarea warntext " >Warning!<br><br> If you delete this label then, this label will be removed from all associated members. </div></div>
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
           <svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" data-supported-dps="24x24" fill="black" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <path d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"></path>
            </svg>
        </a>
        <span class="">
            <label id="button_post" for="button_post_desk">Manage label</label>
        </span>
        <form class="input-wrap" autocomplete="off">
        </form>
    </div>
    <script src="app.js?v=8"></script>
    <script>
//        rough work
//     var a = [[]];
//    a[9] = [123,34566,23456];
//        console.log(a[9][2]);
//        a[345678] = [1123456];
//         console.log(a[345678][0]);
    </script>
</body>

</html>