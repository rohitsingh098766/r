

inputBox.oninput = function(){
    if(inputBox.value){
       document.getElementById("camera-btn").setAttribute("src","SVG/smile-solid.svg");
       inputButtons.forEach(function(btn){
           btn.style.display = "none";
       });
       inputBar.style.gridTemplateColumns = "50px 1fr 55px";
       document.querySelector(".send-btn").style.display = "block"
    }

    else{
        document.getElementById("camera-btn").setAttribute("src","SVG/camera-solid.svg");
        inputBar.style.gridTemplateColumns = "50px 1fr 45px 45px 45px";
        inputButtons.forEach(function(btn){
            btn.style.display = "flex";            
        });
        document.querySelector(".send-btn").style.display = "none";
    }
}

var sendBtn = document.querySelector(".send-btn");

