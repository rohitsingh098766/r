document.getElementById('r2').addEventListener("click", function () {
    document.getElementById('r1').classList.remove('active');
})
document.querySelector('.r3_1_ck').addEventListener("click", function () {
    document.getElementById('lists').classList.toggle('active');
})


var user = '';
var mute = '';
var remove_follower = '';



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





var l_nme = document.getElementById('lists').querySelectorAll('.chs_list');
for(var i=0; i<l_nme.length; i++){
  l_nme[i].addEventListener("click",function(){
//      window.alert(this.getAttribute('l')+':'+user);
      var list = this.getAttribute('l');
      document.querySelector('.tag_'+user).innerHTML = ' â€¢ '+ this.querySelector('.lst_head').innerHTML;
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




function yt(id){
//    window.alert(id);
    document.querySelector('.select_one_'+id).classList.remove('step1');
    document.querySelector('.select_one_'+id).classList.add('step2');
    my_ajx('accept=1&user=' + id)
}
function yp(id){
//    window.alert(id);
    document.querySelector('.select_one_'+id).classList.remove('step2');
    document.querySelector('.select_one_'+id).classList.add('step3');
      my_ajx('i=follow&user=' + id)
}
function yd(id){
//    window.alert(id);
     document.querySelector('.select_one_'+id).classList.remove('step1');
    document.querySelector('.select_one_'+id).classList.add('step4');
    my_ajx('deny=1&user=' + id)
}

function yb(id){
//    window.alert(id);
     document.querySelector('.act_'+id).style.display="none";
     document.querySelector('.select_one_'+id).classList.remove('step1');
    document.querySelector('.select_one_'+id).classList.add('step4');
    my_ajx('block=1&user=' + id)
}

function yk(user_id,list_id){
 my_ajx('change_list=1&list='+list_id+'&user=' + user_id);
        document.querySelector('.select_one_'+user_id).classList.remove('step3');
      document.querySelector('.tag_'+user_id).innerHTML= ' • '+document.querySelector('.list_o_'+list_id).querySelector('.lt_m').innerHTML;
}






