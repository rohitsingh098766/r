var sections = document.querySelectorAll("section")
var sectionsLength = sections.length

sections[0].style.transform = "rotate(0deg)"
sections[0].style.zIndex = "5000"
var nxt = 1;
var int;
var loadInt;
var index = 1;
var sectionNo = 0



slideshow(sections[sectionNo]);



function nextClick(){
    viewNext()
    clearInterval(int)
    clearInterval(loadInt)
 
    sectionNo = nxt-1;
    index = 1
    slideshow(sections[nxt-1]);
}

function prevClick(){
    
    viewPrevious();
    clearInterval(int)
    clearInterval(loadInt)

    
    sectionNo = nxt-1;
    index = 1
    slideshow(sections[nxt-1]);
}

if(window.innerWidth>450){
    var rotate = 90;
    var rotate_ = -90;
}else{
     var rotate = 45; 
     var rotate_ = -45; 
}

function viewNext(){
    if(sections[nxt]){

        sections[nxt-1].style.transform = `rotate(${rotate_}deg)`;
        sections[nxt-1].style.zIndex = nxt -1;
        sections[nxt].style.transform = `rotate(${0}deg)`;
        sections[nxt].style.zIndex = nxt;    

        nxt++;
    }
}

function viewPrevious(){
    if(sections[nxt-2]){

        sections[nxt-2].style.transform = `rotate(${0}deg)`;
        sections[nxt-2].style.zIndex = nxt -1;

        sections[nxt-1].style.transform = `rotate(${rotate}deg)`;
        sections[nxt-1].style.zIndex = nxt -2;      
    
        nxt--;
    }
}

function slideshow(section){
    var number = section.children.length - 1;
    var children = [].slice.call(section.children);
    children.shift();
    // children.pop();

    var bars = section.querySelectorAll(".bar");

    bars.forEach(function(bar){
        bar.querySelector("div").style.width = ""

        bar.querySelector("div").classList.remove("load-now")
    })

    if(index === 1){
        setTimeout(() => { bars[0].querySelector("div").classList.add("load-now") }, 2);
    }

    for(var i = 0; i <= index-2; i++){
        setTimeout(() => { bars[i].querySelector("div").classList.remove("load-now") }, 2);
        bars[i].querySelector("div").style.width = "100%"
    }

    setTimeout(() => { bars[index - 1].querySelector("div").classList.add("load-now") }, 2);

    children.forEach(child => {
        child.style.display = "none"
    });

    section.children[index].style.display = "block"
    console.log('this is story id '+ section.children[index].getAttribute("s"))
    loadDoc('./watch.php?s='+section.children[index].getAttribute("s"));
    
         int = setInterval(function(){
if (state){
            index++;

            if(index <= number){
                children.forEach(child => {
                    child.style.display = "none"
                });
                
        setTimeout(() => { bars[index - 1].querySelector("div").classList.add("load-now") }, 2);

                section.children[index].style.display = "block"
                 console.log('this is story id '+ section.children[index].getAttribute("s"))
                loadDoc('./watch.php?s='+section.children[index].getAttribute("s"));
            }
            else{
                viewNext()
                clearInterval(int)
                window.location.assign('../');
                sectionNo++;

                if(sectionNo < sectionsLength)
                {
                    index = 1
                    slideshow(sections[sectionNo]);

                }

            }           
    
//      clearInterval(int);
    }
        },3000)  

}

function leftTouch(){
    clearInterval(int)
    clearInterval(loadInt)


    sectionNo = nxt-1;
    index--;

    if(index>=1)
        slideshow(sections[nxt-1]);

        else{
            prevClick();
        }
}

function rightTouch(){

    clearInterval(int)
    clearInterval(loadInt)


    sectionNo = nxt-1;
    index++;   

    if(index <= sections[nxt-1].children.length - 1 )
        slideshow(sections[nxt-1]);

        else{
        nextClick();
        }
}


document.querySelector("body").addEventListener("mousedown", e => {
    if(e.offsetX > screen.width/2){
        rightTouch();
    }

    else{
        leftTouch();
    }
} );

document.querySelector("body").addEventListener("touchstart", startTouch, false);
document.querySelector("body").addEventListener("touchmove", moveTouch, false);

// Swipe Up / Down / Left / Right
var initialX = null;
var initialY = null;
var diffX = 0;

function simpleTouch(){

}

function startTouch(e) {
    initialX = e.touches[0].clientX;
    initialY = e.touches[0].clientY;

    
    

    if(initialX > (screen.width/2 + 50)){
        // rightTouch();
    }

    if(initialX < (screen.width/2 - 50)){
        // leftTouch();       
    }
};

function moveTouch(e) {



    if (initialX === null) {
        return;
    }

    if (initialY === null) {
        return;
    }

    var currentX = e.touches[0].clientX;
    var currentY = e.touches[0].clientY;

     diffX = initialX - currentX;
    var diffY = initialY - currentY;


    if (Math.abs(diffX) > Math.abs(diffY)) {
        
        // sliding horizontally
        if (diffX > 0) {
            // swiped left
            nextClick();
            
        } else if(diffX < 0) {
            // swiped right
            prevClick();
        }
    } else {
        // sliding vertically
        if (diffY > 0) {
            // swiped up
        } else {
            // swiped down
        }
    }

    initialX = null;
    initialY = null;

};





//hold

 let item = document.querySelector("body");

    let timerID;
    let counter = 0;
let state = true;
let add_css = document.getElementById('css');
    let pressHoldEvent = new CustomEvent("pressHold");

    // Increase or decreae value to adjust how long
    // one should keep pressing down before the pressHold
    // event fires
    let pressHoldDuration = 1000;

    // Listening for the mouse and touch events    
    item.addEventListener("mousedown", pressingDown, false);
    item.addEventListener("mouseup", notPressingDown, false);
    item.addEventListener("mouseleave", notPressingDown, false);

    item.addEventListener("touchstart", pressingDown, false);
    item.addEventListener("touchend", notPressingDown, false);

    // Listening for our custom pressHold event
    item.addEventListener("pressHold", doSomething, false);

    function pressingDown(e) {
      // Start the timer
      requestAnimationFrame(timer);

      e.preventDefault();
state = false;
        
        add_css.innerHTML = "<style>.top-section{opacity:0;} .bottom{opacity:0;}</style>";
      // console.log("Pressing!");
    }


    function notPressingDown(e) {
      // Stop the timer
      cancelAnimationFrame(timerID);
      counter = 0;
        state = true;
           add_css.innerHTML = "<style>.top-section{opacity:1;} .bottom{opacity:1;}</style>";
//      window.alert(7)
      // console.log("Not pressing!");
        
    }

    //
    // Runs at 60fps when you are pressing down
    //
    function timer() {
      // console.log("Timer tick!");

      if (counter < pressHoldDuration) {
        timerID = requestAnimationFrame(timer);
        counter++;
      } else {
        // console.log("Press threshold reached!");
        item.dispatchEvent(pressHoldEvent);
      }
    }

    function doSomething(e) {
        counter = 0;
//        state = false;
//        add_css.innerHTML = "<style>body{display:none}</style>"
//      window.alert(9)
    }



//watched
function loadDoc(url) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     console.log(this.responseText);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}













