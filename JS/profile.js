function show_now(id) {
    document.querySelector('.e11.active').classList.remove('active');
    document.querySelector('.d12.active').classList.remove('active');
    document.getElementById(id + '_show').classList.add('active');
    document.getElementById(id + '_add_active').classList.add('active');

}

var except_list = '';

function show_member(type) {
    
    except_list = type;
    document.querySelector('.f11.active').classList.remove('active')
    document.getElementById('people_label_' + type).classList.add('active')
    document.getElementById('follow_following_list').innerHTML = "<p class='middle'><br><br><br> Loading...<br><br><br><br> please wait </p>";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('follow_following_list').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "php/follow_and_following_list.php?user=" + user + "&type=" + type, true);
    console.log("php/follow_and_following_list.php?user=" + user + "&type=" + type)
    xhttp.send();
    if(document.querySelector('.add_people')){
         if(type>0){
        document.querySelector('.add_people').classList.add('active')
    }else{
         document.querySelector('.add_people').classList.remove('active')
    }
     document.querySelector('.all_ado').classList.remove('active')
    }
    
   if(document.getElementById('remover_follower')){
      if(type==='follower'){
        document.getElementById('remover_follower').style.display="block";
    }else{
        document.getElementById('remover_follower').style.display="none";
        
    }   
   }
  
    
}

//add people list
function add_me_to(type_2) {
    if( document.querySelector('.all_ado').querySelector('.f11.active')){       
        document.querySelector('.all_ado').querySelector('.f11.active').classList.remove('active')
    }
        document.getElementById('people_adds_' + type_2).classList.add('active')
        document.getElementById('result_f_add').innerHTML = "<p class='middle'><br><br><br> Loading...<br><br><br><br> please wait </p>";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //            document.getElementById('result_f_add').innerHTML = this.responseText;
            document.getElementById('result_f_add').innerHTML = this.responseText;
            var total_add = document.getElementById('result_f_add').querySelectorAll('.add');
            for (var i = 0; i < total_add.length; i++) {
                total_add[i].addEventListener("click", function () {
                    var user_add = this.getAttribute("u");
                    var list_add = except_list;
                    if (this.querySelector(".d").innerHTML == "Add") {
                        my_ajx('change_list=1&user=' + user_add + '&list=' + list_add);
                        this.innerHTML = '<div class="active d red blue">Remove</div>';
                    } else if (this.querySelector(".d").innerHTML == "Remove") {
                        my_ajx('change_list=1&user=' + user_add + '&list=delete');
                        this.innerHTML = '<div class="active d red">Add</div>';
                    }
                    //              window.alert('change_list=1&user=' + user_add + '&list='+list_add)
                })

            }
        }
    };
    //          my_ajax_f_add("manage_people/add_profile.php", "e="+except_list+"&l="+type_2);
    xhttp.open("POST", "manage_people/add_profile.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("e=" + except_list + "&l=" + type_2);
    //    console.log("manage_people/add_profile.php?e=" + except_list + "&l=" + type_2, )
    //    xhttp.send();
}

if(document.getElementById('g1_create')){
    document.getElementById('g1_create').addEventListener("click", function () {

    document.querySelector('.all_ado').classList.toggle('active');
    //     if(document.querySelector('.all_ado').classList.contains('active')){
    //         if(document.getElementById('add_m_d1').querySelector('.select_one').querySelector('.active')){
    //         document.getElementById('add_m_d1').querySelector('.select_one').querySelector('.active').classList.remove('active');}
    //         document.getElementById('add_m_d1').querySelector('.select_one').querySelector('.d').classList.add('active');
    //         var except_list = document.querySelector('.select_one').querySelector('.active').getAttribute("l");
    //        my_ajax_f_add("add_profile.php", "e="+except_list+"&l=following");
    //     }
//    my_ajax_f_add("add_profile.php", "e=" + except_list + "&l=following");
    add_me_to('following');
})
}

//ajax 2
function my_ajx(post_data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //                       window.alert(this.responseText);
        }
    };
    xhttp.open("POST", "./manage_people/relation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(post_data);
}





function profile_follow(id, privacy) {
    var status = document.getElementById('following_status');
    if (status.innerHTML === 'Following' || status.innerHTML === 'Requested') {
        status.innerHTML = 'Follow';
        my_ajax("./manage_people/relation.php", 'i=unfollow&user=' + id);
    } else if (status.innerHTML === 'Follow') {
        my_ajax("./manage_people/relation.php", 'i=follow&user=' + id);
        if (privacy) {
            status.innerHTML = 'Requested';
        } else {
            status.innerHTML = 'Following';
        }
    }
}

function profile_options() {
    document.getElementById('post_options').style.display = "none"
    document.getElementById('share_options').style.display = "block"
    document.getElementById('block_options').style.display = "block"
    document.getElementById('mutww').style.display = "block"
}

function post_options() {
    document.getElementById('post_options').style.display = "block"
    document.getElementById('share_options').style.display = "none"
    document.getElementById('block_options').style.display = "none"
    document.getElementById('mutww').style.display = "block"
}

document.getElementById('follow_following_list').addEventListener('click', function () {
    document.getElementById('post_options').style.display = "none"
    document.getElementById('share_options').style.display = "none"
    document.getElementById('block_options').style.display = "none"
    document.getElementById('mutww').style.display = "none"
    document.getElementById('block_options').style.display = "none"
})

//full profile image
document.getElementById('profile_image').addEventListener('click', function () {
    if (this.classList.contains('allow')) {
        document.getElementById('full_image').requestFullscreen();
    }
    return false;
})

//show privacy ontions
var active_about_id = 0;
var active_about_section = 0;
var list_id_privacy = 0;
var get_it_by_id = 0;
var privacy_level = 0;
var active_lists = 0;

//correct this function
function show_privacy_change(id_about, section) {
    active_about_id = id_about;
    active_about_section = section;

    document.querySelector(".my_options").style.display = "flex";
    get_it_by_id = document.getElementById('privacy_func_' + active_about_id + '_' + active_about_section);
    privacy_level = get_it_by_id.getAttribute('privacy_level');
    var already_checked = document.getElementById('s_lists_about').querySelectorAll('.select_tl');
    active_lists = get_it_by_id.getAttribute('lists');
    for (var i = already_checked.length - 1; i >= 0; --i) {
        select_list[i].querySelector('.select_me').classList.remove('select_me_selected');
        select_list[i].querySelector('.select_me').querySelector('div').classList.remove('display_flex');

        if ((privacy_level < 4) && (privacy_level == already_checked[i].getAttribute('c'))) {

            already_checked[i].querySelector('.select_me').classList.add('select_me_selected');
            already_checked[i].querySelector('.select_me').querySelector('div').classList.add('display_flex');

        } else if (privacy_level == 4) {
            console.log(typeof (already_checked[i].getAttribute('cd') * 1));
            var list_loop = already_checked[i].getAttribute('cd') * 1;

            if (list_html[active_about_section][active_about_id].includes(list_loop) && list_loop > 0) {
                already_checked[i].querySelector('.select_me').classList.add('select_me_selected');
                already_checked[i].querySelector('.select_me').querySelector('div').classList.add('display_flex');

            }
            console.log(list_html[active_about_section][active_about_id].includes(already_checked[i].getAttribute('cd')));
            console.log('lists_ids = ' + already_checked[i].getAttribute('cd'))
            console.log(list_html[active_about_section][active_about_id])
        }
    }
}



//change privacy
var select_list = document.getElementById('s_lists_about').querySelectorAll('.select_tl');
for (var i = select_list.length - 1; i >= 0; --i) {
    select_list[i].addEventListener("click", function () {

        if (this.querySelector('.follow-icon').classList.contains('about_lock')) {
            for (var i = select_list.length - 1; i >= 0; --i) {
                select_list[i].querySelector('.select_me').classList.remove('select_me_selected');
                select_list[i].querySelector('.select_me').querySelector('div').classList.remove('display_flex');
            }
            //            auto close on selecting single choice 
            document.querySelector(".my_options").style.display = "none";
        } else {
            //            only_one
            var only_one = document.querySelectorAll('.only_one');
            for (var i = only_one.length - 1; i >= 0; --i) {
                only_one[i].classList.remove('select_me_selected');
                only_one[i].querySelector('div').classList.remove('display_flex');
            }

        }




        this.querySelector('.select_me').classList.toggle('select_me_selected');
        this.querySelector('.select_me').querySelector('div').classList.toggle('display_flex');


        var label_id = this.getAttribute('cd') * 1;
        var text_show_up = '';

        //        update function call on privacy
        var privacy_level = this.getAttribute('c');
        get_it_by_id.setAttribute('privacy_level', privacy_level);
        if (label_id == 0) {
            document.getElementById('privacy_func_' + active_about_id + "_" + active_about_section).querySelector('span').innerHTML = this.querySelector('.conn-name').querySelector('b').innerHTML;
            //            document.querySelector(".my_options").style.display = "none";
        } else {
            var text_add = document.querySelectorAll('.select_me_selected');
            for (var i = text_add.length - 1; i >= 0; --i) {
                text_show_up += text_add[i].getAttribute('name') + ', ';
            }
            text_show_up = text_show_up.substring(0, text_show_up.length - 2);
            document.getElementById('privacy_func_' + active_about_id + "_" + active_about_section).querySelector('span').innerHTML = text_show_up;
        }

        console.log(label_id);
        console.log(active_about_section);
        console.log(active_about_id);
        if (this.querySelector('.select_me').classList.contains('select_me_selected')) {
            my_ajax("./php/change_privacy.php", "label=" + label_id + "&privacy_level=" + privacy_level + "&about_id=" + active_about_id + "&about_section=" + active_about_section + "&action=add");
            list_html[active_about_section][active_about_id].push(label_id)
            console.log('yes')
        } else {
            my_ajax("./php/change_privacy.php", "label=" + label_id + "&privacy_level=" + privacy_level + "&about_id=" + active_about_id + "&about_section=" + active_about_section + "&action=delete");
            for (var i_remove = 0; i_remove < list_html[active_about_section][active_about_id].length; i_remove++) {
                if (list_html[active_about_section][active_about_id][i_remove] == label_id) {
                    list_html[active_about_section][active_about_id].splice(i_remove, 1);

                }
            }

        }
        console.log(list_html[active_about_section][active_about_id]);
    })
}





document.querySelector("#my_options").addEventListener("click", function () {
    document.querySelector(".my_options").style.display = "none";
})


function setting_about(){
document.getElementById('show_advance_setting_about').style.display = 'none';
    
    var sections_to_hide = document.querySelectorAll('.about_edit_show');
    for( var m = 0; m<sections_to_hide.length; m++){
        sections_to_hide[m].classList.remove('hidden_about');
    }
    
}


