document.getElementById('r2').addEventListener("click", function () {
    document.getElementById('r1').classList.remove('active');
})
document.querySelector('.r3_1_ck').addEventListener("click", function () {
    document.getElementById('lists').classList.toggle('active');
})

document.querySelector('.g1_create').addEventListener("click", function () {
  
    document.querySelector('.all_ado').classList.toggle('active');
     if(document.querySelector('.all_ado').classList.contains('active')){
         if(document.getElementById('add_m_d1').querySelector('.select_one').querySelector('.active')){
         document.getElementById('add_m_d1').querySelector('.select_one').querySelector('.active').classList.remove('active');}
         document.getElementById('add_m_d1').querySelector('.select_one').querySelector('.d').classList.add('active');
         var except_list = document.querySelector('.select_one').querySelector('.active').getAttribute("l");
        my_ajax_f_add("add.php", "e="+except_list+"&l=following");
     }
})


var select_one = document.querySelector('.select_one').querySelectorAll('.d');
for (var i = 0; i < select_one.length; i++) {
    select_one[i].addEventListener('click', function () {
        document.querySelector('.select_one').querySelector('.active').classList.remove('active');
        this.classList.add('active');
        document.getElementById('result').innerHTML = "";
        my_ajax("category.php", "l=" + this.getAttribute('l'));
         document.querySelector('.all_ado').classList.remove('active')
if(isNaN(this.getAttribute('l'))){
    document.querySelector('.g1_create').classList.remove('active')
    document.getElementById('add_m_d1').classList.remove('active')
}else{
    document.querySelector('.g1_create').classList.add('active')
//    document.getElementById('add_m_d1').classList.add('active')
}
    })
}

var user = '';
var mute = '';
var remove_follower = '';

//ajax 
function my_ajax(url, post_data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('result').innerHTML = this.responseText;
            //click on triple dot
            var tridot = document.getElementById('result').querySelectorAll('.hovrr1');
            for (var i = 0; i < tridot.length; i++) {
                tridot[i].addEventListener("click", function () {
                    document.getElementById('r1').classList.add('active');
                     user = this.getAttribute("u");
                     mute = this.getAttribute("m");
                     remove_follower = this.getAttribute("f");
                    if(mute==1){
                    document.getElementById('mute_na').innerHTML = "Unmute";
                    }else{
                          document.getElementById('mute_na').innerHTML = "Mute";
                    }
                    if(remove_follower=='t'){
                          document.getElementById('remove_follower').style.display="block";
                    }else{
                        document.getElementById('remove_follower').style.display="none";
                    }
                    if(document.querySelector('.act_'+user).querySelector('.tag2')){
                        document.getElementById('unfollow_na').style.display="none"
                    }else{
                        document.getElementById('unfollow_na').style.display="block"
                    }
                })
                
            }
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(post_data);
}

var already_activeted = document.getElementById('already_activeted').querySelector('.active').getAttribute('l');

if(already_activeted>0){
    document.querySelector('.g1_create').classList.add('active');
}

my_ajax("category.php", "l="+already_activeted);

//ajax 2
function my_ajx(post_data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
//                       window.alert(this.responseText);
        }
    };
    xhttp.open("POST", "relation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(post_data);
}



function change(user_id, privacy, approve_value) {
    var inner = document.getElementById('s_' + user_id);
    if (inner.innerHTML == "Follow") {
        if (privacy) {
            inner.innerHTML = "Requested"
        } else {
            inner.innerHTML = "Following"
        }
        my_ajx('user=' + user_id + '&i=follow')
    } else if (inner.innerHTML == "Requested") {
        inner.innerHTML = "Follow"
        my_ajx('user=' + user_id + '&i=unfollow')
    } else if (inner.innerHTML == "Following") {
        inner.innerHTML = "Follow"
        my_ajx('user=' + user_id + '&i=unfollow')
    }
}


var l_nme = document.getElementById('lists').querySelectorAll('.chs_list');
for(var i=0; i<l_nme.length; i++){
  l_nme[i].addEventListener("click",function(){
//      window.alert(this.getAttribute('l')+':'+user);
      var list = this.getAttribute('l');
      document.querySelector('.tag_'+user).innerHTML = ' • '+ this.querySelector('.lst_head').innerHTML;
       document.getElementById('r1').classList.remove('active');
       my_ajx('change_list=1&user=' + user + '&list='+list);
  })
}

document.getElementById('block').addEventListener("click",function(){
      document.getElementById('r1').classList.remove('active');
      document.querySelector('.act_'+user).style.display="none"
    my_ajx('block=1&user=' + user);
})

document.getElementById('mute_na').addEventListener("click",function(){
      document.getElementById('r1').classList.remove('active');
//    window.alert("IS MUTE :"+mute)
    if(mute==1){
//     document.getElementById('mute_na').innerHTML = "Unmute";
        document.querySelector('.user_i_'+user).setAttribute('m','0')
        var value = '0';
    }else{
//        document.getElementById('mute_na').innerHTML = "Mute";
        document.querySelector('.user_i_'+user).setAttribute('m','1')
        var value = 1;
    }
    my_ajx('mute=1&user=' + user+'&value='+value);
})

document.getElementById('remove_follower').addEventListener("click",function(){
    document.getElementById('r1').classList.remove('active');
   document.querySelector('.act_'+user).style.display="none"
      my_ajx('remove_follower=1&user=' + user);
})


document.getElementById('unfollow_na').addEventListener("click",function(){
//    document.getElementById('r1').classList.remove('active');
document.querySelector('.act_'+user).style.display="none";
      document.getElementById('r1').classList.remove('active');
      my_ajx('unfollow=1&user=' + user);
})



var select_one_add = document.getElementById('add_m_d1').querySelector('.select_one').querySelectorAll('.d');
for (var i = 0; i < select_one_add.length; i++) {
    select_one_add[i].addEventListener('click', function () {
        document.getElementById('add_m_d1').querySelector('.select_one').querySelector('.active').classList.remove('active');
        this.classList.add('active');
//        document.getElementById('result').innerHTML = "";
//        window.alert(this.getAttribute('l'))
        var except_list = document.querySelector('.select_one').querySelector('.active').getAttribute("l");
        my_ajax_f_add("add.php", "e="+except_list+"&l="+this.getAttribute('l'));

    })
}



function my_ajax_f_add(url, post_data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
              document.getElementById('result_f_add').innerHTML = this.responseText;
        var total_add  = document.getElementById('result_f_add').querySelectorAll('.add'); 
 for (var i = 0; i < total_add.length; i++) {
                total_add[i].addEventListener("click", function () {
                  var  user_add = this.getAttribute("u");
                   var list_add = document.querySelector('.select_one').querySelector('.active').getAttribute("l");
                    if(this.querySelector(".d").innerHTML=="Add"){
                     my_ajx('change_list=1&user=' + user_add + '&list='+list_add);
                    this.innerHTML='<div class="active d red blue">Remove</div>';
                    }else if(this.querySelector(".d").innerHTML=="Remove"){ 
                         my_ajx('change_list=1&user=' + user_add + '&list=delete');
                    this.innerHTML='<div class="active d red">Add</div>';
                    }
//              window.alert('change_list=1&user=' + user_add + '&list='+list_add)
                })
                
            }
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(post_data);
}
