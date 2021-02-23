   function scrollToBottom() {
       var last = document.querySelector("main");
       window.scrollBy(0, last.scrollHeight)
   }
   scrollToBottom();
   window.onscroll = function (ev) {
       //hide mobile navs 2
       if (this.oldScroll > this.scrollY) {
           if (window.pageYOffset < 1000) {
               //  scrolling down
               console.log('down');
           }
       } else {
           //   scrolling up
           if (window.pageYOffset > last.scrollHeight - 1000) {
               console.log('up');
           }
       }
       this.oldScroll = this.scrollY;
   };



   var inputBox = document.querySelector(".msg-form input");
   var inputButtons = document.querySelectorAll(".msg-form .other-btns");
   var inputBar = document.querySelector(".input-bar");
   var inputForm = document.querySelector(".msg-form");
   var max_id = 1;

   //        send postMessage
   inputForm.addEventListener("submit", function (e) {
       e.preventDefault();
       var msg = inputBox.value;
       inputBox.value = null;
       document.getElementById("camera-btn").setAttribute("src", "SVG/camera-solid.svg");
       inputBar.style.gridTemplateColumns = "50px 1fr 45px 45px 45px";
       inputButtons.forEach(function (btn) {
           btn.style.display = "flex";
       });
       document.querySelector(".send-btn").style.display = "none";
       
//       sending show message
        document.getElementById('last').insertAdjacentHTML("beforeend", '<div class="sending active"><li class="right message_sending " ><ul><li><p class="sending">'+msg+'</p></li></ul></li></div>');
//       document.getElementById('sending').innerHTML = '<li class="right messaged " ><ul><li><p class="sending">'+msg+'</p></li></ul></li>';
        scrollToBottom();
       
       my_ajax("./send.php", 'room=' + room + '&text=' + msg + '&opponent=' + opponent);
       console.log('room=' + room + '&text=' + msg + '&opponent=' + opponent)
   });

   //        ajax
   function my_ajax(url, post_data, container) {
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function () {
           if (this.readyState == 4 && this.status == 200) {
               if (container) {
                    var unsend_messages = document.querySelectorAll('.sending.active');
                   for(var i = 0; i < unsend_messages.length; i++){
                       unsend_messages[i].innerHTML = '';
                        unsend_messages[i].classList.remove('active');
                   }
                   
                   
                   document.getElementById(container).insertAdjacentHTML("beforeend", this.responseText);

                   if (this.responseText.length > 10) {
                       scrollToBottom();
                   }
                  

               } else {
                   my_ajax("more_message.php", 'room=' + room + '&max_id=' + last_message_id(), 'last');
               }
               console.log(this.responseText);
           }
           scrollToBottom();
       };
       xhttp.open("POST", url, true);
       xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xhttp.send(post_data);
   }

   window.setInterval(function () {
       /// call your function here
       my_ajax("more_message.php", 'room=' + room + '&max_id=' + last_message_id(), 'last');
   }, 5000);



   function last_message_id() {
       var total_message = document.querySelectorAll('.messaged');
       max_id = 1;
       if (total_message.length > 0) {
           var total_message_lenght = (total_message.length) - 1;
           max_id = total_message[total_message_lenght].getAttribute('message');
       }
       return max_id;
   }









   inputBox.oninput = function () {
       if (inputBox.value) {
           document.getElementById("camera-btn").setAttribute("src", "SVG/smile-solid.svg");
           inputButtons.forEach(function (btn) {
               btn.style.display = "none";
           });
           inputBar.style.gridTemplateColumns = "50px 1fr 55px";
           document.querySelector(".send-btn").style.display = "block"
       } else {
           document.getElementById("camera-btn").setAttribute("src", "SVG/camera-solid.svg");
           inputBar.style.gridTemplateColumns = "50px 1fr 45px 45px 45px";
           inputButtons.forEach(function (btn) {
               btn.style.display = "flex";
           });
           document.querySelector(".send-btn").style.display = "none";
       }
   }

   var sendBtn = document.querySelector(".send-btn");