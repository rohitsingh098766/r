function autosize() {
    setTimeout(function () {
        el = document.querySelector('.textarea')
        el.style.cssText = 'height:auto; padding:.75em 1em';
        el.style.cssText = 'height:calc(' + (el.scrollHeight) + 'px +  2px);';
    }, 100);
}
autosize();

document.getElementById('button_post').addEventListener("click",function(){
   document.getElementById('form').submit();
    
})

document.querySelector('.location_open').addEventListener("click",function(){
  document.querySelector('.location_div').classList.toggle("location_div_add");
})
document.querySelector('.open_more_click').addEventListener("click",function(){
  document.getElementById('open_more').classList.toggle("show_open_more");
})

        var loadFile = function(event,num) {
            var image = document.getElementById('o'+num);
            image.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("forclick").setAttribute("for", "f"+(num+1))
            document.querySelector(".ac"+num).classList.add("active");
            document.getElementById("o"+num).style.opacity="1";
            document.querySelectorAll(".sp_r")[num-1].classList.remove("cross_to_add");
            if(num==10){
                 document.getElementById("alert_more").innerHTML="You can not add more than 10 photos / images";
                 document.getElementById("alert_more").style.color="red";
                 document.querySelector(".alert_more_img").setAttribute("src","image/image-solid-red.svg");
                
            }

        };

 var selecting = document.querySelectorAll(".sp_r");
for (var i = 0; i < 10; i++) {
        selecting[i].addEventListener("click", function (){
            var x = this.getAttribute("data");
            document.getElementById("o"+x).style.opacity="0";
            document.getElementById("f"+x).value="";
            this.classList.add("cross_to_add")
        })
}



 document.getElementById('form').addEventListener('submit',function(){
     document.querySelector('.loader').style.display="flex";
 })
