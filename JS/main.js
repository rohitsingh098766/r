// sidebar mobile
const sidebar = document.querySelector(".sidebar");
const blurBackground = function () {
          sidebar.style.boxShadow ="0px 0px 20px 5000px #00000094";
    document.querySelector(".container").style.pointerEvents = "none";
    document.querySelector(".mobile-header").style.pointerEvents = "none";
    if(document.querySelector(".mobile-nav-bar")){
    document.querySelector(".mobile-nav-bar").style.pointerEvents = "none";
    }
  
};
const removeBlurBackground = function () {
    sidebar.style.boxShadow = "none";
    document.querySelector(".container").style.pointerEvents = "auto";
    document.querySelector(".mobile-header").style.pointerEvents = "auto";
     if(document.querySelector(".mobile-nav-bar")){
    document.querySelector(".mobile-nav-bar").style.pointerEvents = "auto";
     }
};


// sidebar open
document.querySelector(".mobile-header .me-icon").addEventListener("click", function () {
    sidebar.style.left = 0;
    sidebar.style.top = 0;
    // blur background
    blurBackground();
});

//sidebar close
document.querySelector(".container-wrap").addEventListener("click", function () {
    sidebar.style.left = "";
    sidebar.style.top = "";
    // unblur background
    removeBlurBackground();
});


document.querySelector(".sidebar .down").addEventListener("click", function () {
    this.classList.toggle("rotate-arrow");
});

document.querySelector(".expand-add-acc").addEventListener("click", function () {
    document.querySelector(".all-uls").classList.toggle("show-add-acc");
});

function hide_mob_nb() {
    document.querySelector(".mobile-nav-bar").style.bottom = "-55px";
}





//Scroll Suggestions
const next_btn = document.querySelector(".next");
const previous_btn = document.querySelector(".previous");

const wrapper = document.querySelector(".suggestions-list");

let scrollMovePoint = 0;
const max_scroll = wrapper.scrollWidth;

function test(event) {
    let operand = 300;

    // Calculate the number to move.
    if (event.target.classList.contains("next")) {
        if (scrollMovePoint < max_scroll) {
            scrollMovePoint = scrollMovePoint + operand;
        }
    } else if (event.target.classList.contains("previous")) {
        if (0 < scrollMovePoint) {
            scrollMovePoint = scrollMovePoint - operand;
        }
    }

    // Move the scroll bar to the value.
    wrapper.scroll(scrollMovePoint, 0);
}
next_btn.addEventListener("click", test);
previous_btn.addEventListener("click", test);

//Scroll Story
const nxt_btn = document.querySelector(".nxt");
const prev_btn = document.querySelector(".prev");

const wrapperStory = document.querySelector(".scroll-stories");

let scrollStoryMovePoint = 0;
const maxStory_scroll = wrapperStory.scrollWidth;

function testStory(event) {
    let operandStory = 300;

    // Calculate the number to move.
    if (event.target.classList.contains("nxt")) {
        if (scrollStoryMovePoint < maxStory_scroll) {
            scrollStoryMovePoint = scrollStoryMovePoint + operandStory;
        }
    } else if (event.target.classList.contains("prev")) {
        if (0 < scrollStoryMovePoint) {
            scrollStoryMovePoint = scrollStoryMovePoint - operandStory;
        }
    }

    // Move the scroll bar to the value.
    wrapperStory.scroll(scrollStoryMovePoint, 0);
}
nxt_btn.addEventListener("click", testStory);
prev_btn.addEventListener("click", testStory);




//    switch to best friends post
var stop_bg = function () {
    document.querySelector('body').style.overflowY = "hidden";
}
var auto_bg = function () {
    document.querySelector('body').style.overflowY = "auto";
}

var select_list = document.getElementById('s_lists').querySelectorAll('.select_tl');
for (var i = select_list.length - 1; i >= 0; --i) {
    select_list[i].addEventListener("click", function () {
        var id = this.getAttribute('cd');
        if (this.querySelector('.select_me').classList.contains('select_me_selected')) {
            my_ajax("./php/choose_category.php", "ct=" + id + "&action=delete");
        } else {
            my_ajax("./php/choose_category.php", "ct=" + id + "&action=add");
        }
        this.querySelector('.select_me').classList.toggle('select_me_selected');
        this.querySelector('.select_me').querySelector('div').classList.toggle('display_flex');
    })
}


document.querySelector("#my_options").addEventListener("click", function () {
    document.querySelector(".my_options").style.display = "none";
    auto_bg();
})

document.querySelector("#alter_posts").addEventListener("click", function () {
    document.querySelector(".my_options").style.display = "flex";
    //        document.querySelector(".items").style.animation = "show_alter_timeline";
    //        document.querySelector(".items").style.animationDuration = ".3s";
    stop_bg();
});








//});

//open post options
var ftp = document.getElementById('post_option_fst');
var user_name = 0;
var active_post = 0;

function open_post_options(owner_id, owner_name, post_id, privacy) {
    document.getElementById('post_option_fst').classList.add('active');
    
    user_at = owner_id;
    user_name = owner_name;
    active_post = post_id;
    active_privacy = privacy;
    var chk_follow = document.querySelector('.fllw_' + owner_id).innerHTML;
    var oper_at = document.getElementById('unflww').querySelector('b');
    var img_flw = document.getElementById('unflww').querySelector('img');
    if (chk_follow === ' • Follow ') {
        oper_at.innerHTML = "Follow";
        img_flw.setAttribute('src','./SVG/heart-solid.svg')
    } else if (chk_follow === ' • Requested ') {
        oper_at.innerHTML = "Cancel follow request";
        img_flw.setAttribute('src','./SVG/heart-broken-solid.svg')
    } else {
        oper_at.innerHTML = "Unfollow";
        img_flw.setAttribute('src','./SVG/heart-broken-solid.svg')
    }
     var chk_mute = document.querySelector('.unmt_' + owner_id).innerHTML;
var oper_at_mute = document.getElementById('mutww').querySelector('b');
var img_mute = document.getElementById('mutww').querySelector('img');
    if(chk_mute===' • Unmute '){
        oper_at_mute.innerHTML = 'Unmute posts'
        img_mute.setAttribute('src','./SVG/volume-up-solid.svg')
    }else{
        oper_at_mute.innerHTML = 'Mute posts'
        img_mute.setAttribute('src','./SVG/volume-mute-solid.svg')
    }
    stop_bg();
}
  
//close post options 
function close_options(post_id) {
    document.querySelector("#post_option" + post_id).classList.remove('active')
    auto_bg();
}



 var links = document.getElementsByTagName('a');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener("click", function (e) {
            if (this.getAttribute('href') != "#" && this.getAttribute('href') ) {
                
                e.preventDefault();
                location.assign(this.getAttribute('href'));
                document.querySelector(".loader").style.display = "flex";
                document.querySelector(".container-wrap").style.display = "none";
            }
        })
    }


/*
// hyperlink animation
var href_click_animation = function () {
    var links = document.getElementsByTagName('a');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener("click", function (e) {
            if (this.getAttribute('href') != "#") {
                document.querySelector(".loader").style.display = "flex";
            }
        })
    }
}

var isChromium = window.chrome;
var winNav = window.navigator;
var vendorName = winNav.vendor;
var isOpera = typeof window.opr !== "undefined";
var isIEedge = winNav.userAgent.indexOf("Edge") > -1;
var isIOSChrome = winNav.userAgent.match("CriOS");

if (isIOSChrome) {
    //  href_click_animation();
    //   window.alert("chrome ");
} else if (
    isChromium !== null &&
    typeof isChromium !== "undefined" &&
    vendorName === "Google Inc." &&
    isOpera === false &&
    isIEedge === false
) {
    href_click_animation();
    //   window.alert("chrome ");
} else {
    //   window.alert("chrome not found");
}
if (navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
    navigator.userAgent &&
    navigator.userAgent.indexOf('CriOS') == -1 &&
    navigator.userAgent.indexOf('FxiOS') == -1
) {
    //  href_click_animation();
    // window.alert("safari ");
} else {
    //   window.alert("safari not found");
}

if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
    // href_click_animation();
    // window.alert("firefox ");
} else {
    //   window.alert("firefox not found");
}
*/





// pwa
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('JS/sw.js').then(reg => {
        console.log("Service Worker registered successfully");
    }).catch(err => {
        console.log("Service Worker error", err);
    })
}




//search result

//   hide mobile nav bar at the time of search
//document.querySelector("#search_mob").addEventListener("click", function () {
//    hide_mob_nb();
//});

var search = function (click_elm, search_word) {
    click_elm.addEventListener("click", function () {
        if (window.location.hash !== "#searching") {
            history.pushState("", "", window.location.href + '#searching');
            window.location.hash = "#searching";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector(".homepage-main-content").style.display = "none";
                    document.querySelector("#search_content").style.display = "block";
                    document.querySelector(".loader").style.display = "none";

                    document.getElementById("search_rs").innerHTML += this.responseText;
                } else {
                    document.querySelector(".loader").style.display = "flex";
                }
            };
            xhttp.open("GET", "./search", true);
            xhttp.send();
        }
        // scroll top
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    })
    document.body.scrollTop = 0;
}
search(document.getElementById("search_des"), "countries");
search(document.getElementById("search_mob"), "countries");

function searching(a) {
    a.addEventListener("input", function () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                var profiles = "";
                //            window.alert(this.responseText);
                var output = JSON.parse(this.responseText);

                for (var i = 0; i < output.post.length; i++) {
                    if (output.post[i].requested == 1) {
                        var following = "hide";
                        var not_following = "";

                    } else {
                        var not_following = "hide";
                        var following = "";
                    }
                    if (output.post[i].account_type == 1) {
                        var follow = "REQUESTED";
                    } else {
                        var follow = "FOLLOWING";
                    }
                    if (output.post[i].following == 1) {
                        var followers = "following";
                        var follow_button = '<a href="./account?user='+output.post[i].user_id+'" target="_blank"><button class="connect-btn green_bg">VIEW PROFILE</button></a>';
                        var follow_mob = '<a href="./account?user='+output.post[i].user_id+'" target="_blank"><img  src="./SVG/arrow-right-solid.svg" alt="" </a>';

                    } else {
                        var followers = output.post[i].followers + " followers";
                        var hide = "";
                        var follow_button = '<button class="connect-btn user_send_' + output.post[i].user_id + ' ' + following + ' ' + hide + '" onclick="follow_me(' + output.post[i].user_id + ',' + output.post[i].account_type + ',1)">FOLLOW</button><button class="connect-btn connect-btn-af user_sending_' + output.post[i].user_id + ' ' + not_following + ' ' + hide + '" onclick="follow_me(' + output.post[i].user_id + ',1,0)">' + follow + '</button>';
                        var follow_mob = '<img class="user_s_' + output.post[i].user_id + ' ' + following + '" src="./SVG/user-plus-solid.svg" alt="" onclick="follow_me(' + output.post[i].user_id + ',' + output.post[i].account_type + ',1)"><img class="user_sing_' + output.post[i].user_id + ' ' + not_following + '" src="./SVG/user-plus-solid-blue.svg" alt="" onclick="follow_me(' + output.post[i].user_id + ',1,0)">';
                    }
                    if(output.post[i].profile_img){
                        var profile_img = 'profile/i/120/'+output.post[i].profile_img;
                    }else{
                        var profile_img = 'profile/i/none.svg';
                    }
if(output.post[i].location){
   var location_search = '<img class="loc-icon" src="./SVG/location.svg" alt=""><span class="location"> ' + output.post[i].location + ' </span>';
   }else{
   var location_search ="";
   }

                    profiles += '<div class="card-main res"><a href="./account?user='+output.post[i].user_id+'" target="_blank" class="img-wrap "><img class="circle" src="'+ profile_img + '" alt=""></a><div class="info"><h1><a href="./account?user='+output.post[i].user_id+'" target="_blank">' + output.post[i].name + '</a><span> • ' + followers + ' </span></h1><p>' + output.post[i].intro + '</p>'+location_search+'<br></div><div class="last">' + follow_button + '<button class="connect-icon ">' + follow_mob + ' </button></div></div>';
                }
                document.getElementById("search_rs").innerHTML = profiles;

            } else {
                //                  show page loading animation
            }
        };
        var value = a.value;
        xhttp.open("GET", "./search/index.php?s=" + value, true);
        xhttp.send();
    })
}

searching(document.getElementById("search_des"));
searching(document.getElementById("search_mob"));



function hashHandler() {
    if (window.location.hash !== "#searching") {
        document.querySelector(".homepage-main-content").style.display = "block";
        document.querySelector("#search_content").style.display = "none";
    } else if (window.location.hash === "#searching") {
        document.querySelector(".homepage-main-content").style.display = "none";
        document.querySelector("#search_content").style.display = "block";
    }
}
window.addEventListener('hashchange', hashHandler, false);
if (window.location.hash === "#searching") removeHash();

function removeHash() {
    history.pushState("", document.title, window.location.pathname + window.location.search);
}

function follow_me(user_id, privacy, action) {
    document.querySelector(".user_send_" + user_id).classList.toggle("hide");
    document.querySelector(".user_sending_" + user_id).classList.toggle("hide");
    document.querySelector(".user_s_" + user_id).classList.toggle("hide");
    document.querySelector(".user_sing_" + user_id).classList.toggle("hide");
    my_ajax("./php/follow_me.php", "user_id=" + user_id + "&privacy=" + privacy + "&action=" + action);
}



//save the post

function save_me(post_id) {
    var check_reaction_s = document.querySelector("#like_" + post_id);
    if (document.querySelector("#save_" + post_id).classList.contains("saved")) {

        if (
            check_reaction_s.classList.contains("liked_done") ||
            check_reaction_s.classList.contains("loved_done") ||
            check_reaction_s.classList.contains("supported_done") ||
            check_reaction_s.classList.contains("celebrated_done") ||
            check_reaction_s.classList.contains("fired_done") ||
            check_reaction_s.classList.contains("haha_done") ||
            check_reaction_s.classList.contains("sad_done")
        ) {
            console.log("update kro unsave krne ke liye");
            my_ajax("./php/post_save.php", "post_id=" + post_id + "&action=update&save=0");
        } else {
            console.log("delete kro whole line");
            my_ajax("./php/post_save.php", "post_id=" + post_id + "&action=delete&save=1");
        }
        //        console.log('call event to unsave ' + post_id);
        //        my_ajax("./php/post_save.php", "post_id=" + post_id + "&action=delete");
    } else {
        if (
            check_reaction_s.classList.contains("liked_done") ||
            check_reaction_s.classList.contains("loved_done") ||
            check_reaction_s.classList.contains("supported_done") ||
            check_reaction_s.classList.contains("celebrated_done") ||
            check_reaction_s.classList.contains("fired_done") ||
            check_reaction_s.classList.contains("haha_done") ||
            check_reaction_s.classList.contains("sad_done")
        ) {
            console.log("upadate kr na to save post");
            my_ajax("./php/post_save.php", "post_id=" + post_id + "&action=update&save=1");
        } else {
            console.log("insert kr na save to save post");
            my_ajax("./php/post_save.php", "post_id=" + post_id + "&action=insert&save=1");
        }


        //        console.log('call event to save' + post_id);
        //        my_ajax("./php/post_save.php", "post_id=" + post_id + "&action=save")
    }
    document.querySelector("#save_" + post_id).classList.toggle('saved');
}


//double click love react
function double_click_love(post_id) {
    if (document.querySelector("#like_" + post_id).classList.contains("loved_done")) {
        removereaction(post_id);
        my_ajax("./php/post_like.php", "post_id=" + post_id + "&action=delete");
        console.log('call event to remove love at' + post_id);
        document.querySelector("#like_" + post_id).classList.remove('loved_done');
    } else {
        other_reactions(post_id, 2);
        removereaction(post_id);
        console.log('call event to love at' + post_id);
        document.querySelector("#like_" + post_id).classList.add('loved_done');
    }
    //   window.alert("love reaction at post :  "+post_id);
}

//prevent image right click
var img_all = document.querySelectorAll('img');
for (var i = 0; i < document.querySelectorAll('img').length; i++) {
    document.querySelectorAll('img')[i].oncontextmenu = function () {
        return false;
    };
}
// example <img src="a.png" oncontextmenu="return false;">




//ajax
function my_ajax(url, post_data, container) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (container) {
                document.querySelector(container).innerHTML += this.responseText;
            }
            console.log(this.responseText);
            load_more = true;
        }
    };
    if (post_data) {
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(post_data);
    } else {
        xhttp.open("GET", url, true);
        xhttp.send();
    }
}
// call ajax
//my_ajax("./php/post_like.php","post_id=100&action=delete","body");




//show comment option
function show_comment(post_id) {
    document.querySelector("#comment_" + post_id).classList.toggle("comment_show");
    hide_mob_nb();
}

//submit comment
function submit_comment(event, post_id) {
    event.preventDefault();
    var text = document.querySelector("#comment_input_" + post_id).value;
    if (text.length > 0) {
        if (document.querySelector("#load_comments_" + post_id).querySelector('.load_comments')) {
            var already_exist = document.querySelector("#load_comments_" + post_id).querySelector('.load_comments').innerHTML;
        } else var already_exist = "";
        my_ajax("./php/comment.php", "post_id=" + post_id + "&text=" + text + "");
        document.querySelector("#load_comments_" + post_id).innerHTML = '<div class="load_comments">' + already_exist + '<div class="follow-conn"><img src="'+active_profile_url+'" class="follow-icon comment_profile" /><span href="profile/" class="comment_form commented"><div class="comment_input commented_input"> ' + text + '</div></span></div></div>';
        document.querySelector("#comment_input_" + post_id).value = "";
        document.querySelector("#comment_input_" + post_id).style.height = "auto";
    }
    //    show_comment(post_id);show_comment(post_id);
}



//auto expandable textarea
//var textarea = document.querySelector('textarea');
//textarea.addEventListener('keydown', autosize);           
function autosize(id) {
    setTimeout(function () {
        el = document.getElementById('comment_input_' + id)
        el.style.cssText = 'height:auto; padding:.75em 1em';
        el.style.cssText = 'height:calc(' + (el.scrollHeight) + 'px +  2px);';
    }, 100);
}





//open lists
function openlist(click_point,post_id) {
      active_post = post_id;
    document.querySelector('.active_name').innerHTML = user_name;
    document.getElementById('post_option'+click_point).classList.add('active');
    close_options('_fst');
    stop_bg();
}


//change list
var user_at = 0;

function changelist(id, id_nme, delete_) {
    my_ajax("./manage_people/relation.php", 'change_list=1&user=' + user_at + '&list=' + id);
    if (delete_) {
        my_ajax("./manage_people/relation.php", 'change_list=1&user=' + user_at + '&list=delete');
    }
    var a_name_spn = document.querySelectorAll('.u_c_' + user_at);
    for (var i = 0; i < a_name_spn.length; i++) {
        if (id_nme) {
            a_name_spn[i].innerHTML = "• " + id_nme;
        } else {
            a_name_spn[i].innerHTML = '';
        }
    }
    close_options('yy');
}


//ignone user
function ignore(id){
    document.querySelector('.suggest_'+id).classList.add('reject');
    my_ajax("./manage_people/relation.php", 'ignore=1&user=' + id );
}

//folow user from suggestion box
function follow_ya(id,  privacy){
    if(document.querySelector('.flw_btn_'+id).innerHTML === "Follow"){
        if(privacy){
        document.querySelector('.flw_btn_'+id).innerHTML = "Requested";
        }else{
        document.querySelector('.flw_btn_'+id).innerHTML = "Following";
        }
           my_ajax("./manage_people/relation.php", 'i=follow&user=' + id );
    }else{
        document.querySelector('.flw_btn_'+id).innerHTML = "Follow";
         my_ajax("./manage_people/relation.php", 'i=unfollow&user=' + id );
    }
    
    document.querySelector('.flw_btn_'+id).classList.toggle('follow-button-alt');
    my_ajax("./manage_people/relation.php", 'ignore=1&user=' + id );
}

//unfollow user from posts
function unfollow_ys(id,privacy){
    var select_owner = document.querySelectorAll('.fllw_'+id)
    if(select_owner[0].innerHTML===" • Follow "){
          my_ajax("./manage_people/relation.php", 'i=follow&user=' + id );
        for(var i = 0 ; i < select_owner.length;i++){
            if(privacy==1){
                select_owner[i].innerHTML = " • Requested ";
            }else{
                select_owner[i].innerHTML = " • Following ";
            }
        
    }
    }else if(select_owner[0].innerHTML===" • Following "||select_owner[0].innerHTML===" • Requested "){
             my_ajax("./manage_people/relation.php", 'i=unfollow&user=' + id );
        for(var i = 0 ; i < select_owner.length;i++){
        select_owner[i].innerHTML = " • Follow ";
    }
             }
}
//mute user from posts
function mute_ys(id){
    var select_owner = document.querySelectorAll('.unmt_'+id)
    if(select_owner[0].innerHTML===" • Unmute "){
        my_ajax("./manage_people/relation.php", 'mute_post=1&value=0&user=' + id );
            for(var i = 0 ; i < select_owner.length;i++){
        select_owner[i].innerHTML = " • Mute ";
    }
    }else if(select_owner[0].innerHTML===" • Mute "){
        my_ajax("./manage_people/relation.php", 'mute_post=1&value=1&user=' + id );
         for(var i = 0 ; i < select_owner.length;i++){
        select_owner[i].innerHTML = " • Unmute ";
    }
    }
}
//report post from posts
function report_post(){
     my_ajax("./manage_people/relation.php", 'report_post=1&post_id=' + active_post );
   close_options('_report')
}




//unfollow user from posts
function unfollow_yes() {
    var select_owner = document.querySelectorAll('.fllw_' + user_at);
    var getinner = document.getElementById('unflww').querySelector('b').innerHTML;
    var show_outpt = '';
    if (getinner === 'Unfollow') {
       
        if(active_privacy == 1){
            openlist('_unfollow');
        }else{
            my_ajax("./manage_people/relation.php", 'i=unfollow&user=' + user_at);
        show_outpt = ' • Follow '; 
        }
    } else if (getinner === 'Follow') {
        my_ajax("./manage_people/relation.php", 'i=follow&user=' + user_at);
        if (active_privacy == 1) {
            show_outpt = ' • Requested ';
        } else {
            show_outpt = ' • Following ';
        }
    } else if (getinner === 'Cancel follow request') {
        my_ajax("./manage_people/relation.php", 'i=unfollow&user=' + user_at);
        show_outpt = ' • Follow ';
    }
    for (var i = 0; i < select_owner.length; i++) {
        select_owner[i].innerHTML = show_outpt;
    }

    close_options('_fst');
}

//mute user from posts
function mute_yes(){
//    var select_owner = document.querySelectorAll('.card_own_'+user_at)
//    for(var i = 0 ; i < select_owner.length;i++){
////        select_owner[i].classList.add('reject2');
//    }
    
    var getinner = document.getElementById('mutww').querySelector('b').innerHTML;
    var select_owner = document.querySelectorAll('.unmt_'+user_at)
    if(getinner==='Mute posts'){
        my_ajax("./manage_people/relation.php", 'mute_post=1&value=1&user=' + user_at );
        for(var i = 0 ; i < select_owner.length;i++){
        select_owner[i].innerHTML = " • Unmute ";
    }
    }else if(getinner==='Unmute posts'){
        my_ajax("./manage_people/relation.php", 'mute_post=1&value=0&user=' + user_at );
        for(var i = 0 ; i < select_owner.length;i++){
        select_owner[i].innerHTML = " • Mute ";
    }
    }else{
        window.alert(8)
    }
    
//     my_ajax("./manage_people/relation.php", 'mute_post=1&value=1&user=' + user_at );
close_options('_fst');
}


function confirm_unfollow(){
     my_ajax("./manage_people/relation.php", 'i=unfollow&user=' + user_at);
    var select_owner = document.querySelectorAll('.card_own_' + user_at);
    
    for (var i = 0; i < select_owner.length; i++) {
        select_owner[i].setAttribute('class','reject2')
    }
    close_options('_unfollow')
}

function block_user_confirm(refresh) {
    my_ajax("./manage_people/relation.php", 'block=1&user=' + user_at);
    if (refresh == '1') {
        window.location.assign("./");
    }else{
        var select_owner = document.querySelectorAll('.card_own_' + user_at);
        for (var i = 0; i < select_owner.length; i++) {
            select_owner[i].setAttribute('class', 'reject2')
        }
    }
    close_options('_block');
}



//confirm delete
var delete_post=0;
function open_ask_delete(id){
  delete_post = id;
    
}
function delete_post_confirm(){
//    refresh the page
     my_ajax("./php/delete_post.php", 'post=' + delete_post );
    window.location.assign("./")

    close_options('_delete');
}
function edit_post_confirm(){
    window.location.assign("./create_post/edit?post="+delete_post)
    close_options('_delete');
}










//mobile header click
function invisible() {
  document.querySelector("#company-title").classList.add("invisible");
  document.querySelector("#search-icon-img").classList.add("invisible");
  document.querySelector("#search_mob").classList.remove("invisible");
  document.querySelector("#header-form").classList.remove("blue-background-header");
    document.getElementById("search_mob").focus();
    document.querySelector(".homepage-main-content").style.display = "none";
                    document.querySelector("#search_content").style.display = "block";
    hide_mob_nb();
}



// share profile
function share(title,text,link){
    event.preventDefault();
     if (navigator.share) {
    navigator.share({
      title: title,
      text: text,
      url: link
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(err => {
      console.log(`Couldn't share because of`, err.message);
    });
  } else {
      
    // console.log('web share not supported');
     copyTextToClipboard(text+ ' ' +link);
  alert("Link copied to clipboard ");
  }
    
}

// share post
function share_post(){
    event.preventDefault();
     if (navigator.share) {
    navigator.share({
      title: "YaarMe post",
      text: "Hey there, I found something usefull for you on YaarMe",
      url: "https://yaarme.com/posts?p="+active_post
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(err => {
      console.log(`Couldn't share because of`, err.message);
    });
  } else {
      
    // console.log('web share not supported');
     copyTextToClipboard("Hey there, I found something usefull for you on YaarMe. https://yaarme.com/posts?p="+active_post);
  alert("Link copied to clipboard ");
  }
    
}

// copy to clipboard
function copyTextToClipboard(text) {
  if (!navigator.clipboard) {
    fallbackCopyTextToClipboard(text);
    return;
  }
  navigator.clipboard.writeText(text).then(function() {
    console.log('Async: Copying to clipboard was successful!');
  }, function(err) {
    console.error('Async: Could not copy text: ', err);
  });
}



