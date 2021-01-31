function autosize() {
    setTimeout(function () {
        el = document.querySelector('#textarea')
        el.style.cssText = 'height:auto; padding:.75em 1em';
        el.style.cssText = 'height:calc(' + (el.scrollHeight) + 'px +  2px);';
    }, 100);
}
autosize();


  var loadFile = function(event) {
            var image = document.getElementById('story_pic');
            image.src = URL.createObjectURL(event.target.files[0]);
 document.getElementById('tap_para').innerHTML="Tap to change image"
        };


document.getElementById('textarea').addEventListener("mouseout",function(){
    this.style.height="74px";
})
document.getElementById('textarea').addEventListener("mouseover",function(){
    autosize() ;
})


 document.getElementById('other').addEventListener('submit',function(){
     document.querySelector('.loader').style.display="flex";
 })

//close post options 
function close_options(post_id) {
    document.querySelector("#post_option" + post_id).classList.remove('active')
}

function openlist(click_point) {
    document.getElementById('post_option'+click_point).classList.add('active');
}


function correct_seletion(){
     document.getElementById('all_follow').checked = true;
var checkboxs = document.querySelectorAll('.checkbox');
    for(var i = 0; i < checkboxs.length; i++){
        if(checkboxs[i].checked){
            document.getElementById('all_list').checked = true;
        }
    }
}
