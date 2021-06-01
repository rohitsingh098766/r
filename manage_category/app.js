//open and close emogi and create forms
document.getElementById('all_emogi_hide').addEventListener("click", function () {
    document.getElementById('all_emogi').classList.remove("active")
})

document.querySelector('.z2').addEventListener("click", function () {
    document.getElementById('all_emogi').classList.add("active")
})

document.getElementById('warn_in').addEventListener("click", function () {
    document.getElementById('warn').classList.remove("active")
})
document.getElementById('back').addEventListener("click", function () {
    document.getElementById('warn').classList.remove("active")
})

document.querySelector('.g1_create').addEventListener("click", function () {
    document.getElementById('create_list').classList.add("active");
    my_method = "create";
    document.querySelector('.textarea1').value = '';
    document.querySelector('.textarea2').value = '';
    ramdom_emogi();
})
document.getElementById('create_click_hd').addEventListener('click', function () {
    document.getElementById('create_list').classList.remove("active")
})


//change emogi category
var divs = document.querySelector('.emogi_cot').querySelectorAll('div');
for (var i = 0; i < divs.length; i++) {
    divs[i].addEventListener("click", function () {
        document.querySelector('.emogi_cot').querySelector('.active').classList.remove('active');
        this.classList.add('active');
        var slid = this.getAttribute('t');
        document.querySelector('.show_1_cd').setAttribute('class', 'show_1_cd emg_' + slid)
    })
}


//select emogi ramdomly
var select_avatar = document.querySelector('.show_1_cd').querySelectorAll('img');
var emogi_url = '';

function ramdom_emogi() {
    var random = Math.floor(Math.random() * select_avatar.length);
    var ramdom_emo = select_avatar[random].getAttribute('src').replace("32", "128");
    emogi_url = ramdom_emo.replace("../emogi/128/", "");
    console.log(emogi_url)
    document.querySelector('.z3').setAttribute('src', ramdom_emo);
}
ramdom_emogi();
console.log(emogi_url)

//select emogi on emogi Selection
for (var i = 0; i < select_avatar.length; i++) {
    select_avatar[i].addEventListener("click", function () {
        var url = this.getAttribute('src');
        document.querySelector('.z3').setAttribute('src', url);
        emogi_url = url.replace("../emogi/32/", "");
        var url = url.replace("32", "128");
        console.log(emogi_url);
        document.querySelector('.z3').setAttribute('src', url);
        document.getElementById('all_emogi').classList.remove("active")
    })
}




var my_method = "create";
var id_sj = '';
var name_sj = '';
var des_sj = '';
var url_i_sj = '';

//ajax
function my_ajax_to_create_label(url, post_data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (my_method == "create") {
                console.log(this.responseText);
                var para = document.createElement("div");
                var node = document.createTextNode("This is new.");
                para.appendChild(node);
                para.setAttribute("class", "posts g1");
                para.innerHTML = this.responseText;
                var element = document.getElementById('all_list');
                element.appendChild(para);
                activate();
            } else if (my_method == "edit") {
                if(document.getElementById('pt_' + id_sj)){
                document.getElementById('pt_' + id_sj).innerHTML = this.responseText;
                 activate();
                }else{
                    location.reload();
                }
            }else if(my_method == "delete"){
                console.log(this.responseText)
            }
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(post_data);
}


//send ajax
document.getElementById('save').addEventListener("click", function () {

    if (my_method == "create") {
        var t1 = document.querySelector('.textarea1').value;
        var t2 = document.querySelector('.textarea2').value;
        my_ajax_to_create_label("../php/create_list.php", "t1=" + t1 + "&t2=" + t2 + "&t3=" + emogi_url + "&action=create");
        document.getElementById('create_list').classList.remove("active");
        
    } else if (my_method == "edit") {
        var t1 = document.querySelector('.textarea1').value;
        var t2 = document.querySelector('.textarea2').value;
        my_ajax_to_create_label("../php/create_list.php", "t1=" + t1 + "&t2=" + t2 + "&t3=" + emogi_url + "&id=" + id_sj + "&action=edit");
        document.getElementById('create_list').classList.remove("active");
    }

})


//activate edit
 function activate(){
    var alledit = document.querySelectorAll('.hovrr2');
for (var i = 0; i < alledit.length; i++) {
    alledit[i].addEventListener("click", function () {
        my_method = "edit";
        id_sj = this.getAttribute('id');
        name_sj = this.getAttribute('name');
        des_sj = this.getAttribute('des');
        url_i_sj = this.getAttribute('url');

        document.getElementById('create_list').classList.add("active");
        document.querySelector('.textarea1').value = name_sj;
        document.querySelector('.textarea2').value = des_sj;
        document.querySelector('.z3').setAttribute('src', "../emogi/128/" + url_i_sj);
        emogi_url = url_i_sj;



    })
    document.querySelectorAll('.hovrr1')[i].addEventListener("click", function () {
        my_method = "delete";
        id_sj = this.getAttribute('id');
        name_sj = this.getAttribute('name');
        des_sj = this.getAttribute('des');
        url_i_sj = this.getAttribute('url'); 
          document.getElementById('warn').classList.add("active");
        document.querySelector('.warnhead').value = name_sj;
        document.querySelector('.z7').setAttribute('src', "../emogi/128/" + url_i_sj);
        document.getElementById('delete').setAttribute('c', id_sj);
         
    })
}
}
activate();

document.getElementById('delete').addEventListener("click",function(){
    my_ajax_to_create_label("../php/create_list.php", "id=" + this.getAttribute('c') + "&action=delete");
    if(document.getElementById('pt_' + id_sj)){
                document.getElementById('pt_' + id_sj).style.display="none";
                 activate();
                }else{
                    location.reload();
                }
      document.getElementById('warn').classList.remove("active");
    
})

















//privacy

var active_label = 0;
var privacy_level_got  = '';

function edit_tag_privacy(label) {
    document.querySelector(".my_options").style.display = "flex";
    
//    active_about_id = id_about;
//    active_about_section = section;
    active_label = label; 
        privacy_level_got = privacy_level[active_label];
    active_lists = selected_labels[active_label];

//    get_it_by_id = document.getElementById('privacy_func_' + active_about_id + '_' + active_about_section);

    var already_checked = document.getElementById('s_lists_about').querySelectorAll('.select_tl');
    for (var i = already_checked.length - 1; i >= 0; --i) {
        select_list[i].querySelector('.select_me').classList.remove('select_me_selected');
        select_list[i].querySelector('.select_me').querySelector('div').classList.remove('display_flex');

        if ((privacy_level_got < 4) && (privacy_level_got == already_checked[i].getAttribute('c'))) {

            already_checked[i].querySelector('.select_me').classList.add('select_me_selected');
            already_checked[i].querySelector('.select_me').querySelector('div').classList.add('display_flex');

        } else if (privacy_level_got == 4) {
            console.log(typeof (already_checked[i].getAttribute('cd') * 1));
            var list_loop = (already_checked[i].getAttribute('cd') * 1);

            if (active_lists.includes(list_loop) && list_loop > 0) {
                already_checked[i].querySelector('.select_me').classList.add('select_me_selected');
                already_checked[i].querySelector('.select_me').querySelector('div').classList.add('display_flex');

            }
            console.log(active_lists.includes(already_checked[i].getAttribute('cd')));
            console.log('lists_ids = ' + already_checked[i].getAttribute('cd'))
            console.log(active_lists)
        }
    }
}




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
        privacy_level[active_label] = this.getAttribute('c');


        if (label_id == 0) {
            document.getElementById('privacy_lebal_id_'+active_label).innerHTML = this.querySelector('.conn-name').querySelector('b').innerHTML;
            //            document.querySelector(".my_options").style.display = "none";
        } else {
            var text_add = document.querySelectorAll('.select_me_selected');
            for (var i = text_add.length - 1; i >= 0; --i) {
                text_show_up += text_add[i].getAttribute('name') + ', ';
            }
            text_show_up = text_show_up.substring(0, text_show_up.length - 2);
            document.getElementById('privacy_lebal_id_'+active_label).innerHTML = text_show_up;
        }

        console.log(label_id);
//        console.log(active_about_section);
//        console.log(active_about_id);
        if (this.querySelector('.select_me').classList.contains('select_me_selected')) {
            my_ajax("./edit.php", "label=" + label_id + "&privacy_level=" + privacy_level[active_label] + "&active_label=" + active_label + "&action=add");
            selected_labels[active_label].push(label_id)
            console.log('yes');
//            privacy_level[active_label] = 
        } else {
            my_ajax("./edit.php", "label=" + label_id + "&privacy_level=" + privacy_level[active_label] + "&active_label=" + active_label + "&action=delete");
            for (var i_remove = 0; i_remove < selected_labels[active_label].length; i_remove++) {
                if (selected_labels[active_label][i_remove] == label_id) {
                    selected_labels[active_label].splice(i_remove, 1);

                }
            }

        }
        console.log("./edit.php"+ "label=" + label_id + "&privacy_level=" + privacy_level[active_label] + "&active_label=" + active_label + "&action=add");
    })
}







//show_privacy_change(35,1);
document.querySelector("#my_options").addEventListener("click", function () {
    document.querySelector(".my_options").style.display = "none";
})

