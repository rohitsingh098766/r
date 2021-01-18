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

