<?php
//echo $_POST['t'];
?>

<div class="card" >
    <div class="follow-conn"> <img src="./Images/profile-pic4.jpg" class="follow-icon users">
        <div class="conn-name"> <span> <b>Shubham <small>• collage friend</small></b> </span> <span>student at NIT raipur CSE</span> <span> <span>2d • Mumbai </span> </span> </div> <span class="icon more-icon top-corner" id="more_post_click" onclick="open_post_options(1575)"></span>
    </div>
    <div class="my_options " id="post_option1575">
        <div class="my_options my_options_block" onclick="close_options(1575)"></div>
        <div class="items item_post">
            <p class="select_category">Select what to do with post or post owner.</p>
            <ul class="post_options">
                <li>
                    <div class="follow-conn "> <img src="./SVG/exclamation-triangle-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Report post...</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn "> <img src="./SVG/tags-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Change List</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn ">
                        <!-- <img src="./SVG/volume-mute-solid.svg" class="follow-icon">--> <img src="./SVG/volume-up-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Mute Shubham </b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn "> <img src="./SVG/heart-broken-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Unfollow Shubham</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Post</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn"> </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="post_raw_body" ondblclick="double_click_love(1575)">
        <p class="content select_text"> In 1538, the Flemish cartographer Gerardus Mercator used the name 'America' on his own world map, applying it to the entire Western Hemisphere The first known use of the name 'America' dates back to 1507,In 1538, the Flemish cartographer Gerardus Mercator used the name 'America' on his own world map, applying it to the entire Western Hemisphere when it appeared on a world map created by the German cartographer Martin Waldseemüller. On this map, the name applied to South America in honor of the Italian explorer Amerigo Vespucci.[34] After returning from his expeditions, Vespucci first postulated that the West Indies did not represent Asia eastern limit, as initially thought by Christopher Columbus, but instead were part of an entirely separate landmass thus far unknown to the Europeans.[35] In 1538, the Flemish cartographer Gerardus Mercator used the name 'America' on his own world map, applying it to the entire Western Hemisphere </p>
        <div id="slider_1575" class="slider loaded">
            <div class="wrapper"> <span id="prev_1575" class="control prev"></span> <span id="next_1575" class="control next "></span>
                <div id="items_1575" class="items_slider"> 
                    <img src="./Images/profile-pic5.jpg" class="slide">
                    <img src="./Images/profile-pic2.jpg" class="slide"></div>
            </div>
        </div>
    </div>
    <div class="vote-section"> <span class="icon like-icon"></span> <span class="votes">400</span>
        <div class=" post-slider-dots post-slider-dots_1575"></div> <span> 80 Comments</span>
    </div>
    <div class="share-section" onmouseover="reaction(1575)">
        <div class="icon-wrap open_reactions haha_done" id="like_1575" >
            <div class="like_option">
                <div class="set_it"> <img src="./emogi/other/compressed/thumbs_up.gif" title="Like" class="like_inner"> <img src="./emogi/other/compressed/sparkling_heart.gif" title="Love" class="love_inner"> <img src="./emogi/other/compressed/handshake.gif" title="Support" class="support_inner "> <img src="./emogi/other/compressed/party_popper.gif" title="Celebrate" class="cele_inner"> <img src="./emogi/other/compressed/fire.gif" title="Hot" class="hot_inner"> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" title="Laugh" class="smile_inner"> <img src="./emogi/other/compressed/crying_face.gif" title="Sad" class="sad_inner"> </div>
            </div>
            <div class="flex"> <img src="./emogi/128/human/thumbs-up-medium-light-skin-tone.png" class="icon like-i default"> <span class="default">Like&nbsp;</span> <img src="./emogi/other/compressed/thumbs_up.gif" class="icon like-i liked"> <span class="liked">Liked</span> <img src="./emogi/other/compressed/sparkling_heart.gif" class="icon loved"> <span class="loved">Loved</span> <img src="./emogi/other/compressed/handshake.gif" class="icon supported"> <span class="supported">Supported</span> <img src="./emogi/other/compressed/party_popper.gif" class="icon celebrated"> <span class="celebrated">celebrated</span> <img src="./emogi/other/compressed/fire.gif" class="icon fired"> <span class="fired">Hot</span> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" class="icon haha"> <span class="haha">HaHa</span> <img src="./emogi/other/compressed/crying_face.gif" class="icon sad"> <span class="sad">Sad</span> </div>
        </div>
        <div class="icon-wrap" onclick="show_comment(1575)"> <img src="./SVG/comment.svg" class="icon comment-icon"> <span>Comment</span> </div>
        <div class="icon-wrap saved" id="save_1575" onclick="save_me(1575)"> <img src="./SVG/save.svg" class="icon send-icon"><span>Save&nbsp;</span> <img src="./SVG/saved.svg" class="icon send-icon saved_done"> <span class="saved_done ">Saved</span> </div>
    </div>
    <div id="load_comments_1575"></div>
    <form class="follow-conn comment_attempt " id="comment_1575" onsubmit="submit_comment(event,1575)"><img src="./Images/profile-pic4.jpg" class="follow-icon comment_profile"><span href="profile/" class="comment_form"><textarea type="text" rows="1" class="comment_input" id="comment_input_1575" value="o" placeholder="Leave your comment..." onkeydown="autosize(1575)"></textarea></span><button class="follow post_comment">Post</button></form>
</div>
<script>
    slide(1575, document.getElementById("slider_1575"), document.getElementById("items_1575"), document.getElementById("prev_1575"), document.getElementById("next_1575"));
</script>


<div class="card">
    <div class="follow-conn"> <img src="./Images/profile-pic4.jpg" class="follow-icon users">
        <div class="conn-name"> <span> <b>Shubham <small>• collage friend</small></b> </span> <span>student at NIT raipur CSE</span> <span> <span>2d • Mumbai </span> </span> </div> <span class="icon more-icon top-corner" id="more_post_click" onclick="open_post_options(1600)"></span>
    </div>
    <div class="my_options " id="post_option1600">
        <div class="my_options my_options_block" onclick="close_options(1600)"></div>
        <div class="items item_post">
            <p class="select_category">Select what to do with post or post owner.</p>
            <ul class="post_options">
                <li>
                    <div class="follow-conn "> <img src="./SVG/exclamation-triangle-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Report post...</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn "> <img src="./SVG/tags-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Change List</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn ">
                        <!-- <img src="./SVG/volume-mute-solid.svg" class="follow-icon">--> <img src="./SVG/volume-up-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Mute Shubham </b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn "> <img src="./SVG/heart-broken-solid.svg" class="follow-icon"> <span class="conn-name"> <span><b>Unfollow Shubham</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn "> <img src="./SVG/share.svg" class="follow-icon"> <span class="conn-name"> <span><b>Share Post</b></span> </span> </div>
                </li>
                <li>
                    <div class="follow-conn"> </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="post_raw_body" ondblclick="double_click_love(1600)">
        <p class="content select_text"> In 1538, the Flemish cartographer Gerardus Mercator used the name 'America' on his own world map, applying it to the entire Western Hemisphere The first known use of the name 'America' dates back to 1507,In 1538, the Flemish cartographer Gerardus Mercator used the name 'America' on his own world map, applying it to the entire Western Hemisphere when it appeared on a world map created by the German cartographer Martin Waldseemüller. On this map, the name applied to South America in honor of the Italian explorer Amerigo Vespucci.[34] After returning from his expeditions, Vespucci first postulated that the West Indies did not represent Asia eastern limit, as initially thought by Christopher Columbus, but instead were part of an entirely separate landmass thus far unknown to the Europeans.[35] In 1538, the Flemish cartographer Gerardus Mercator used the name 'America' on his own world map, applying it to the entire Western Hemisphere </p>
        <div id="slider_1600" class="slider loaded ">
            <div class="wrapper"> <span id="prev_1600" class="control prev"></span> <span id="next_1600" class="control next"></span>
                <div id="items_1600" class="items_slider">
                    <img src="./Images/profile-pic5.jpg" class="slide">
                    <img src="./Images/profile-pic2.jpg" class="slide"></div>
            </div>
        </div>
    </div>
    <div class="vote-section"> <span class="icon like-icon"></span> <span class="votes">400</span>
        <div class=" post-slider-dots post-slider-dots_1600"></div> <span> 80 Comments</span>
    </div>
    <div class="share-section" onmouseover="reaction(1600)">
        <div class="icon-wrap open_reactions haha_done" id="like_1600">
            <div class="like_option">
                <div class="set_it"> <img src="./emogi/other/compressed/thumbs_up.gif" title="Like" class="like_inner"> <img src="./emogi/other/compressed/sparkling_heart.gif" title="Love" class="love_inner"> <img src="./emogi/other/compressed/handshake.gif" title="Support" class="support_inner "> <img src="./emogi/other/compressed/party_popper.gif" title="Celebrate" class="cele_inner"> <img src="./emogi/other/compressed/fire.gif" title="Hot" class="hot_inner"> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" title="Laugh" class="smile_inner"> <img src="./emogi/other/compressed/crying_face.gif" title="Sad" class="sad_inner"> </div>
            </div>
            <div class="flex"> <img src="./emogi/128/human/thumbs-up-medium-light-skin-tone.png" class="icon like-i default"> <span class="default">Like&nbsp;</span> <img src="./emogi/other/compressed/thumbs_up.gif" class="icon like-i liked"> <span class="liked">Liked</span> <img src="./emogi/other/compressed/sparkling_heart.gif" class="icon loved"> <span class="loved">Loved</span> <img src="./emogi/other/compressed/handshake.gif" class="icon supported"> <span class="supported">Supported</span> <img src="./emogi/other/compressed/party_popper.gif" class="icon celebrated"> <span class="celebrated">celebrated</span> <img src="./emogi/other/compressed/fire.gif" class="icon fired"> <span class="fired">Hot</span> <img src="./emogi/other/compressed/beaming_face_with_smiling_eyes.gif" class="icon haha"> <span class="haha">HaHa</span> <img src="./emogi/other/compressed/crying_face.gif" class="icon sad"> <span class="sad">Sad</span> </div>
        </div>
        <div class="icon-wrap" onclick="show_comment(1600)"> <img src="./SVG/comment.svg" class="icon comment-icon"> <span>Comment</span> </div>
        <div class="icon-wrap saved" id="save_1600" onclick="save_me(1600)"> <img src="./SVG/save.svg" class="icon send-icon"><span>Save&nbsp;</span> <img src="./SVG/saved.svg" class="icon send-icon saved_done"> <span class="saved_done ">Saved</span> </div>
    </div>
    <div id="load_comments_1600"></div>
    <form class="follow-conn comment_attempt " id="comment_1600" onsubmit="submit_comment(event,1600)"><img src="./Images/profile-pic4.jpg" class="follow-icon comment_profile"><span href="profile/" class="comment_form"><textarea type="text" rows="1" class="comment_input" id="comment_input_1600" value="o" placeholder="Leave your comment..." onkeydown="autosize(1600)"></textarea></span><button class="follow post_comment">Post</button></form>
</div>
<script>
    
    slide(1600, document.getElementById("slider_1600"), document.getElementById("items_1600"), document.getElementById("prev_1600"), document.getElementById("next_1600"));
</script>