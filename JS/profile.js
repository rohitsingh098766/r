function show_now(id){
    document.querySelector('.e11.active').classList.remove('active');
    document.querySelector('.d12.active').classList.remove('active');
    
    document.getElementById(id+'_show').classList.add('active');
    document.getElementById(id+'_add_active').classList.add('active');
}

function show_member(type) {
    if (type ==1) {
//        window.alert(type);
        document.querySelector('.follower_button').classList.add('active')
        document.querySelector('.following_button').classList.remove('active')
    } else if (type ==2) {
//        window.alert(type);
        document.querySelector('.follower_button').classList.remove('active')
        document.querySelector('.following_button').classList.add('active')
    }
    document.getElementById('follow_following_list').innerHTML="<p class='middle'><br><br><br> Loading...<br><br><br><br> please wait </p>";
    
    
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('follow_following_list').innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "php/follow_and_following_list.php?user="+user+"&type="+type, true);
    console.log("php/follow_and_following_list.php?user="+user+"&type="+type)
  xhttp.send();

    
}

function profile_follow(id,privacy){
    var status = document.getElementById('following_status');
    if(status.innerHTML==='Following'||status.innerHTML==='Requested'){
        status.innerHTML = 'Follow';
       my_ajax("./manage_people/relation.php", 'i=unfollow&user=' + id );
    }else if(status.innerHTML==='Follow'){
        my_ajax("./manage_people/relation.php", 'i=follow&user=' + id );
           if(privacy){
             status.innerHTML = 'Requested';
        }else{
            status.innerHTML = 'Following';
        }
    }
//this.innerHTML = '';
}

function profile_options(){
    document.getElementById('post_options').style.display="none"
    document.getElementById('share_options').style.display="block"
    document.getElementById('block_options').style.display="block"
}
function post_options(){
    document.getElementById('post_options').style.display="block"
    document.getElementById('share_options').style.display="none"
    document.getElementById('block_options').style.display="none"
}

//full profile image
document.getElementById('profile_image').addEventListener('click',function(){
    if(this.classList.contains('allow')){
        document.getElementById('full_image').requestFullscreen();
    }
    return false;
})

//show privacy ontions
function show_privacy_change(){
         document.querySelector(".my_options").style.display = "flex";
}


//change privacy
var select_list = document.getElementById('s_lists_privacy').querySelectorAll('.select_tl');
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



//texting remove it later
show_now('about');