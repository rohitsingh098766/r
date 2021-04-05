function show_now(id) {
    document.querySelector('.e11.active').classList.remove('active');
    document.querySelector('.d12.active').classList.remove('active');

    document.getElementById(id + '_show').classList.add('active');
    document.getElementById(id + '_add_active').classList.add('active');
}

function show_member(type) {
    if (type == 1) {
        //        window.alert(type);
        document.querySelector('.follower_button').classList.add('active')
        document.querySelector('.following_button').classList.remove('active')
    } else if (type == 2) {
        //        window.alert(type);
        document.querySelector('.follower_button').classList.remove('active')
        document.querySelector('.following_button').classList.add('active')
    }
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
    //this.innerHTML = '';
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
console.log(typeof (already_checked[i].getAttribute('cd')*1));
            var list_loop = already_checked[i].getAttribute('cd')*1;
            
            if (list_html[active_about_section][active_about_id].includes(list_loop) && list_loop > 0) {
                already_checked[i].querySelector('.select_me').classList.add('select_me_selected');
                already_checked[i].querySelector('.select_me').querySelector('div').classList.add('display_flex');

            }
            console.log(list_html[active_about_section][active_about_id].includes(already_checked[i].getAttribute('cd')));
        console.log('lists_ids = '+already_checked[i].getAttribute('cd'))
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
            //              document.querySelector(".my_options").style.display = "none";
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


        var label_id = this.getAttribute('cd')*1;
        var text_show_up = '';

        //        update function call on privacy
        get_it_by_id.setAttribute('privacy_level', privacy_level);
        var privacy_level = this.getAttribute('c');
//        var active_lists = get_it_by_id.getAttribute('lists');
//console.log(typeof active_lists)
//console.log(active_lists)
//active_lists = ' '+ active_lists +' ';
//active_lists.replace('1', ' 0 ');
//console.log(active_lists)
console.log("i am good")
        if (label_id == 0) {
            //            window.alert('kk');
            document.querySelector('.header_privacy_' + active_about_section).querySelector('span').innerHTML = this.querySelector('.conn-name').querySelector('b').innerHTML;
            //            document.querySelector(".my_options").style.display = "none";
        } else {
            var text_add = document.querySelectorAll('.select_me_selected');
            for (var i = text_add.length - 1; i >= 0; --i) {
                text_show_up += text_add[i].getAttribute('name') + ', ';
            }
            text_show_up = text_show_up.substring(0, text_show_up.length - 2);
            document.querySelector('.header_privacy_' + active_about_section).querySelector('span').innerHTML += ', ' + this.querySelector('.conn-name').querySelector('b').innerHTML;
            document.querySelector('.header_privacy_' + active_about_section).querySelector('span').innerHTML = text_show_up;
        }

            console.log(label_id);
        if (this.querySelector('.select_me').classList.contains('select_me_selected')) {
            my_ajax("./php/change_privacy.php", "label=" + label_id + "&privacy_level=" + privacy_level + "&about_id=" + active_about_id + "&about_section=" + active_about_section + "&action=add");
            list_html[active_about_section][active_about_id].push(label_id)
            console.log('yes')
//            active_lists.push(label_id);
//            active_lists.replace(']', ', '+label_id+' ]');
            //            window.alert("./php/change_privacy.php"+ "label=" + label_id + "&privacy_level="+privacy_level+"&about_id="+active_about_id+"&about_section="+active_about_section+"&action=delete");
        } else {
            my_ajax("./php/change_privacy.php", "label=" + label_id + "&privacy_level=" + privacy_level + "&about_id=" + active_about_id + "&about_section=" + active_about_section + "&action=delete");
//            active_lists.replace(label_id, 0);
            //             active_lists.push(label_id);
//
            for (var i_remove = 0; i_remove < list_html[active_about_section][active_about_id].length; i_remove++) {
                if (list_html[active_about_section][active_about_id][i_remove] == label_id) {
                    list_html[active_about_section][active_about_id].splice(i_remove, 1);

                }
            }
           
            //            window.alert("./php/change_privacy.php"+ "label=" + label_id + "&privacy_level="+privacy_level+"&about_id="+active_about_id+"&about_section="+active_about_section+"&action=add");
        }
//         my_ajax("./php/change_privacy.php", "label=" + label_id + "&privacy_level=" + privacy_level + "&about_id=" + active_about_id + "&about_section=" + active_about_section + "&action=add");
//console.log(active_lists);
//        get_it_by_id.setAttribute('lists', '[' +active_lists+']');
         console.log(list_html[active_about_section][active_about_id]);
    })
}





document.querySelector("#my_options").addEventListener("click", function () {
    document.querySelector(".my_options").style.display = "none";
})






//texting remove it later
//show_now('about');