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

       document.getElementById('insert_here').insertAdjacentHTML("beforeend", '<div class="message  sent" >' + msg + '<span class="metadata"><span class="time">' + hours_script + ':' + currentdate_script.getMinutes() + ' ' + an_or_pm + '</span><span class="tick tick-animation"><svg aria-hidden="true" data-prefix="fal" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-check fa-w-14 fa-7x" width="12" height="12"><path fill="transparent" d="M413.505 91.951L133.49 371.966l-98.995-98.995c-4.686-4.686-12.284-4.686-16.971 0L6.211 284.284c-4.686 4.686-4.686 12.284 0 16.971l118.794 118.794c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-11.314-11.314c-4.686-4.686-12.284-4.686-16.97 0z" class=""></path></svg><span></span></div>');
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
                   document.getElementById('conversation_container').insertAdjacentHTML("beforeend", this.responseText);

                                       var incorrect_time = document.querySelectorAll('.time_incorrect');
                                      for(var i = 0; i < incorrect_time.length; i++){
                                          
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



                   if (this.responseText.length > 10) {
                       document.getElementById('insert_here').innerHTML = "";
                       scrollToBottom();
                   }


               } else {
                   document.getElementById('insert_here').querySelector('path').setAttribute("fill", "gray");
                   my_ajax("more_message.php", 'room=' + room + '&max_id=' + last_message_id(), 'insert_here');
               }
           }
           scrollToBottom();
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