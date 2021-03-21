   
 var tab    = document.getElementsByClassName("block-tab");
var cont   = document.getElementsByClassName("continue");
var prev   = document.getElementsByClassName("previous");
var lform  = document.getElementById("login-form");
var sform  = document.getElementById("signup-form");
var login  = document.getElementById("login-back");
var signup = document.getElementById("signup-forward");
var smob   = document.getElementById("signup-forward-mobile");
var wrong_ps_btn   = document.getElementById("wrong_ps_btn");

// Form Required Elements
var first_name  = document.getElementById("first_name");
var last_name   = document.getElementById("last_name");

// Form Validation
function checkForm(type){
  
   
}

// Update Progress Bar
var progressBar = function(data,type){
    var lid = "l-" + data;
    var nid = "n-" + data;
    
    if(type === "c"){
        document.getElementById(lid).classList.add("finish-line");
        document.getElementById(nid).classList.add("finished");
    }
    else{
        document.getElementById(lid).classList.remove("finish-line");
        if(data !== "1"){
            document.getElementById(nid).classList.remove("finished");
        }
    }
}




  


for(elem of cont){
    // For Sliding left Animation
    elem.onclick = function(){
        var data = this.getAttribute('data-id');

        if(checkForm(data) != 0){
            progressBar(data,"c");
            this.parentElement.parentElement.classList.add("slide-left");
        }

        window.scrollTo(0,0);
    }
}

for(elem of prev){
    // For Sliding Right Animation
    elem.onclick = function(){
        var data = this.getAttribute('data-id');
        progressBar(data,"p");

        this.parentElement.parentElement.previousElementSibling.classList.remove("slide-left");
        window.scrollTo(0,0);
    }
}

 function autosize(getEleId) {
    setTimeout(function () {
        el = document.getElementById(getEleId);
        el.style.cssText = 'height:auto; padding:.75em 1em';
        el.style.cssText = 'height:calc(' + (el.scrollHeight) + 'px +  2px);';
    }, 100);
}
//autosize();

//animation on submit
document.getElementById('submit').addEventListener('click',function(){
    document.getElementById('form').submit;
    document.getElementById('form').submit(); 
    document.querySelector('.loader').style.display='flex';
})


//show ending date

function show_ending_date(){
//    window.alert(8);
    document.querySelector('.hide_a').classList.toggle('hide');
    document.querySelector('.hide_b').classList.toggle('hide');
}