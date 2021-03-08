   //dedect scroll
   function scrollToBottom() {
       var last = document.querySelector(".conversation-container");
       document.querySelector(".conversation-container").scrollBy(0, last.scrollHeight);
       document.getElementById("input_text").focus();
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



   var inputBox = document.getElementById("input_text");
   var inputForm = document.getElementById('send_message_input');
   var max_id = 1;
   var last_seen = 0;
 var get_message_id = 0;

   //        send postMessage
   inputForm.addEventListener("submit", function (e) {

       e.preventDefault();

       var msg = inputBox.value;
       inputBox.value = null;
       var currentdate_script = new Date();
       var hours = 0;
       var an_or_pm = 'AM';
       if (currentdate_script.getHours() == 12) {
           hours_script = 12;
           an_or_pm = 'PM';
       } else if (currentdate_script.getHours() > 12) {
           hours_script = currentdate_script.getHours() % 12;
           an_or_pm = 'PM';
       } else {
           hours_script = currentdate_script.getHours();
           an_or_pm = 'AM';
       }

       document.getElementById('conversation_container').insertAdjacentHTML("beforeend", '<div class="message  sent sending" >' + msg + '<span class="metadata"><span class="time">' + hours_script + ':' + currentdate_script.getMinutes() + ' ' + an_or_pm + '</span><span class="tick tick-animation sending_svg"><svg aria-hidden="true" data-prefix="fal" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-check fa-w-14 fa-7x" width="12" height="12"><path fill="#9b9b9b" d="M413.505 91.951L133.49 371.966l-98.995-98.995c-4.686-4.686-12.284-4.686-16.971 0L6.211 284.284c-4.686 4.686-4.686 12.284 0 16.971l118.794 118.794c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-11.314-11.314c-4.686-4.686-12.284-4.686-16.97 0z" class=""></path></svg><span></span></div>');
       scrollToBottom();

       my_ajax("./send.php", 'room=' + room + '&text=' + msg + '&opponent=' + opponent);
       // console.log('room=' + room + '&text=' + msg + '&opponent=' + opponent)

   });

   //        ajax
   function my_ajax(url, post_data, container) {
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function () {
           if (this.readyState == 4 && this.status == 200) {
               if (container) {
//                   console.log(this.responseText);
                   document.getElementById('conversation_container').insertAdjacentHTML("beforeend", this.responseText);

                   var incorrect_time = document.querySelectorAll('.time_incorrect');
                   for (var i = 0; i < incorrect_time.length; i++) {

                       var currentdate_script = new Date();
                       var hours = 0;
                       var an_or_pm = 'AM';
                       if (currentdate_script.getHours() == 12) {
                           hours_script = 12;
                           an_or_pm = 'PM';
                       } else if (currentdate_script.getHours() > 12) {
                           hours_script = currentdate_script.getHours() % 12;
                           an_or_pm = 'PM';
                       } else {
                           hours_script = currentdate_script.getHours();
                           an_or_pm = 'AM';
                       }

                       incorrect_time[i].innerHTML = hours_script + ':' + currentdate_script.getMinutes() + ' ' + an_or_pm;
                       incorrect_time[i].classList.remove('.time_incorrect');
                   }

                   var update_tick = document.querySelectorAll('.data');
                   for (var i = 0; i < update_tick.length; i++) {
                       var max_last_seen = update_tick[i].getAttribute('last_seen');
                       if (max_last_seen > last_seen) {
                           last_seen = max_last_seen;
                           update_tick[i].classList.remove('data');
                           console.log(last_seen);
                       }
                   }
                   var correct_mark = document.querySelectorAll('.unread_messages')
                   for (var i = 0; i < correct_mark.length; i++) {
                       get_message_id = correct_mark[i].getAttribute('message');
                       if (get_message_id <= last_seen) {
                           correct_mark[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#009be0" /></svg>';
                       }
                      
                   }  
                   var hide_sending = document.querySelectorAll('.sending');
                   for (var i = 0; i < hide_sending.length; i++) {
                    hide_sending[i].style.display="none";
                   
                   }
console.log('get_message_id:'+get_message_id+'  and last_seen: '+last_seen)

                   if (this.responseText.length > 100) {
                       document.getElementById('insert_here').innerHTML = "";
                       scrollToBottom();
                   }


               } else {
//                   document.getElementById('insert_here').querySelector('path').setAttribute("fill", "gray");
//                   my_ajax("more_message.php", 'room=' + room + '&max_id=' + last_message_id(), 'insert_here');
                   var hide_sending = document.querySelectorAll('.sending_svg');
                   for (var i = 0; i < hide_sending.length; i++) {
                       
                    hide_sending[i].innerHTML = '<svg aria-hidden="true" data-prefix="fal" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-check fa-w-14 fa-7x" width="12" height="12"><path fill="#9b9b9b" d="M413.505 91.951L133.49 371.966l-98.995-98.995c-4.686-4.686-12.284-4.686-16.971 0L6.211 284.284c-4.686 4.686-4.686 12.284 0 16.971l118.794 118.794c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-11.314-11.314c-4.686-4.686-12.284-4.686-16.97 0z" class=""></path></svg>';
                    hide_sending[i].classList.remove('tick-animation');
//                   window.alert(9)
                   }
               }
           }
           //           scrollToBottom();
       };
       xhttp.open("POST", url, true);
       xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xhttp.send(post_data);
   }

   window.setInterval(function () {
       my_ajax("more_message.php", 'room=' + room + '&max_id=' + last_message_id(), 'insert_here');
   }, 5000);

   function last_message_id() {
       var total_message = document.querySelectorAll('.messaged');
       max_id = 1;
       if (total_message.length > 0) {
           var total_message_lenght = (total_message.length) - 1;
           max_id = total_message[total_message_lenght].getAttribute('message');
       }
       console.log(max_id)
       return max_id;
   }