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
    if(type == 1){
        if(first_name.value === ""){
            alert("Please fill in your First name");
            return 0;
        }
        
    }
   
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




document.querySelector('#signup_username').addEventListener("input", function (e) {
      var input = this.querySelector('#uname');
      var not = input.value.match(/[^a-zA-Z0-9._]+/g);
      if (not) {
          not.forEach(function (text) {
              input.value = input.value.replace(text, "");
              document.querySelector('#warning').style.display="block";
          })
      }else{
          document.querySelector('#warning').style.display="none";
      }
  })
  
  


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

// Toggling Login Form
login.onclick = function(){
    sform.classList.add("hide");
    lform.classList.remove("hide");
}
// Toggling Login Form
wrong_ps_btn.onclick = function(){
//   window.alert(8)
//    lform.classList.add("hide");
//    sform.classList.remove("hide");
}

// Toggling Signup Form
signup.onclick = function(){
    lform.classList.add("hide");
    sform.classList.remove("hide");
}
smob.onclick = function(){
    window.scrollTo(0,0);
    lform.classList.add("hide");
    sform.classList.remove("hide");
}
var wrong_pass = document.getElementById('wrong_ps');
var another_username = document.getElementById('another_username');
wrong_pass.addEventListener('click',function(){
    this.classList.remove("active")
})
another_username.addEventListener('click',function(){
    this.classList.remove("active")
})



// login varifcation
function animation() {
 document.querySelector(".loader").style.display = "flex";
}
function animation_close() {
 document.querySelector(".loader").style.display = "none";
}
    document.getElementById("login_form").onsubmit = function onSubmit(form) {
             var login_username = document.getElementById("login_username").value;
              var login_password = document.getElementById("login_password").value;
             event.preventDefault();
        var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.querySelector(".load_anything").innerHTML = this.responseText;
    
     if(this.responseText==1){
          window.location.href = 'https://yaariii.com/';
         // add welcome message and redirect at
         console.log("correct password");
     }else {
          animation_close();
        wrong_pass.classList.add("active")
     }
    }else{
        animation();
        // add animation while request is being sended
    }
  };
  xhttp.open("POST", "verify.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("username="+login_username+"&password="+login_password);
    }
    
    
 // signup 
    document.getElementById("signup_username").onsubmit = function onSubmit(form) {
             var uname = document.getElementById("uname").value;
              var pass = document.getElementById("pass").value;
              var first_name = document.getElementById("first_name").value;
              var last_name = document.getElementById("last_name").value;
             event.preventDefault();
        var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.querySelector(".load_anything").innerHTML = this.responseText;
     animation();
     if(this.responseText==1){
         // add welcome message and redirect at
//         window.location.href = 'https://yaariii.com/';
         animation_close();
//         document.getElementById('created').classList.add("active")
         window.location.href = 'https://yaariii.com/';
     }else{
         animation_close();
         // choose another username
//          window.alert("Please! Choose another username");
          another_username.classList.add("active")
     }
     console.log(this.responseText);
     console.log(uname+pass+first_name+last_name);
    }else{
        animation();
        // add animation while request is being sended
    }
  };
  xhttp.open("POST", "signup.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("uname="+uname+"&pass="+pass+"&first_name="+first_name+"&last_name="+last_name);
    }
   
    
    
    
    



