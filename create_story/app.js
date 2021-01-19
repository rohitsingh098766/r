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
