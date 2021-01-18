var tab    = document.getElementsByClassName("block-tab");
var cont   = document.getElementsByClassName("continue");
var prev   = document.getElementsByClassName("previous");
var lform  = document.getElementById("login-form");
var sform  = document.getElementById("signup-form");
var login  = document.getElementById("login-back");
var signup = document.getElementById("signup-forward");
var smob   = document.getElementById("signup-forward-mobile");
var date = document.getElementById('date');
var month = document.getElementById('month');
var year = document.getElementById('year');


// Form Required Elements
var first_name  = document.getElementById("first_name");
var last_name   = document.getElementById("last_name");

// Form Validation
function checkForm(type){
//    if(type == 1){
//        if(first_name.value === ""){
//            alert("Please fill in your First name");
//            return 0;
//        }
//        
//    }
   
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



//
//document.querySelector('#signup_username').addEventListener("input", function (e) {
//      var input = this.querySelector('#uname');
//      var not = input.value.match(/[^a-zA-Z0-9._]+/g);
//      if (not) {
//          not.forEach(function (text) {
//              input.value = input.value.replace(text, "");
//              document.querySelector('#warning').style.display="block";
//          })
//      }else{
//          document.querySelector('#warning').style.display="none";
//      }
//  })
//  
//  


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


// Filling in Date
for(var i = 1; i <= 31; i++){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    date.appendChild(option);
}

// Filling in Month
var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
for(var i = 0; i < 12; i++){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = months[i];
    month.appendChild(option);
}

// Filling in Year
for(var i = 2020; i >= 1940; i--){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    year.appendChild(option);
}




// login varifcation
function animation() {
 document.querySelector(".loader").style.display = "flex";
}
function animation_close() {
 document.querySelector(".loader").style.display = "none";
}
 
/*    
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
         window.location.href = 'https://yaarme.com/';
     }else{
         animation_close();
         // choose another username
          window.alert("Please! Choose another username");
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
   */
    
//    show skip option

//document.getElementById('date').addEventListener("input", function () {
//    showcontinue()
//})
//document.getElementById('month').addEventListener("input", function () {
//    showcontinue()
//})
//document.getElementById('month').addEventListener("input", function () {
//    showcontinue()
//})
//
//function showcontinue() {
//    if ((document.getElementById('date').value && document.getElementById('month').value) || document.getElementById('year').value) {
//        document.getElementById('st_1').innerHTML = "Continue";
//    }
//}


//autosize textarea
function autosize(getEleId) {
    setTimeout(function () {
        el = document.getElementById(getEleId);
        el.style.cssText = 'height:auto; padding:.75em 1em';
        el.style.cssText = 'height:calc(' + (el.scrollHeight) + 'px +  2px);';
    }, 100);
}
autosize();



//upload image
function loadFile(event) {
            var image = document.getElementById('o1');
            image.src = URL.createObjectURL(event.target.files[0]);
//            document.getElementById("forclick").setAttribute("for", "f"+(num+1))
//            document.querySelector(".ac"+num).classList.add("active");
//            document.getElementById("o"+num).style.opacity="1";
//            document.querySelectorAll(".sp_r")[num-1].classList.remove("cross_to_add");
//            

        };


//autocomplete location 

var countries = [];



function autocomplete(inp) {


    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var arr = countries;



        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var countries = [];
                var output = JSON.parse(this.responseText);
                for (var i = 0; i < output.location.length; i++) {
                    countries[i] = output.location[i];
                    console.log(countries)
                }

                for (i = 0; i < output.location.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (output.location[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + output.location[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += output.location[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + output.location[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function (e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }             

            }
        };
        var serchingss = document.getElementById('location').value;
        xhttp.open("GET", "location_list.php?s="+serchingss, true);
        xhttp.send();

    });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

autocomplete(document.getElementById("location"));






