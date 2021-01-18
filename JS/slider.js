//
//  // drag slider
//
// var id = 1,
//      slider = document.getElementById('slider_1'),
//      sliderItems = document.getElementById('items_1'),
//      prev = document.getElementById('prev_1'),
//      next = document.getElementById('next_1');
//
//  slide(id, slider, sliderItems, prev, next);
//
//
//  var id = 796,
//      slider = document.getElementById('slider_796'),
//      sliderItems = document.getElementById('items_796'),
//      prev = document.getElementById('prev_796'),
//      next = document.getElementById('next_796');
//
//  slide(id, slider, sliderItems, prev, next);
//
//  var id = 10,
//      slider = document.getElementById('slider_10'),
//      sliderItems = document.getElementById('items_10'),
//      prev = document.getElementById('prev_10'),
//      next = document.getElementById('next_10');
//
//  slide(id, slider, sliderItems, prev, next);

  function slide(id, wrapper, items, prev, next) {

      // dots
      var slides = document.querySelector('#items_' + id).children;
      var totalSlides = slides.length;
      
      var dotsHolder = document.querySelector('.post-slider-dots_' + id);
      dotsHolder.innerHTML="";

      for (let i = 0; i < totalSlides; i++) {
          var dotC = document.createElement('div');
          
          dotC.setAttribute("data-slide-id", i);
          dotsHolder.appendChild(dotC);
          if(i){
              dotC.setAttribute("class", "ps-dot");
          }else{
              dotC.setAttribute("class", "ps-dot active_dot");
          }
      }

      // alll
      var posX1 = 0,
          posX2 = 0,
          posInitial,
          posFinal,
          threshold = 100,
          slides = items.getElementsByClassName('slide'),
          slidesLength = slides.length,
          slideSize = items.getElementsByClassName('slide')[0].offsetWidth,
          firstSlide = slides[0],
          lastSlide = slides[slidesLength - 1],
          cloneFirst = firstSlide.cloneNode(true),
          cloneLast = lastSlide.cloneNode(true),
          index = 0,
          allowShift = true;

      // Clone first and last slide
      items.appendChild(cloneFirst);
      items.insertBefore(cloneLast, firstSlide);
      wrapper.classList.add('loaded');

      // Mouse and Touch events
      items.onmousedown = dragStart;

      // Touch events
      items.addEventListener('touchstart', dragStart);
      items.addEventListener('touchend', dragEnd);
      items.addEventListener('touchmove', dragAction);

      // Click events
      prev.addEventListener('click', function () {
          shiftSlide(-1)
      });
      next.addEventListener('click', function () {
          shiftSlide(1)
      });

      // Transition events
      items.addEventListener('transitionend', checkIndex);

      function dragStart(e) {
          e = e || window.event;
          if (screen.width > 1024) {
              e.preventDefault();
          }
          posInitial = items.offsetLeft;

          if (e.type == 'touchstart') {
              posX1 = e.touches[0].clientX;
          } else {
              posX1 = e.clientX;
              document.onmouseup = dragEnd;
              document.onmousemove = dragAction;
          }
      }

      function dragAction(e) {
          e = e || window.event;

          if (e.type == 'touchmove') {
              posX2 = posX1 - e.touches[0].clientX;
              posX1 = e.touches[0].clientX;
          } else {
              posX2 = posX1 - e.clientX;
              posX1 = e.clientX;
          }
          items.style.left = (items.offsetLeft - posX2) + "px";

      }

      function dragEnd(e) {
          posFinal = items.offsetLeft;
          if (posFinal - posInitial < -threshold) {
              shiftSlide(1, 'drag');
          } else if (posFinal - posInitial > threshold) {
              shiftSlide(-1, 'drag');
          } else {
              items.style.left = (posInitial) + "px";
          }

          document.onmouseup = null;
          document.onmousemove = null;
      }

      function remove_active_dots() {
          for (var i = 0; i < totalSlides; i++) {
              document.querySelector('.post-slider-dots_' + id).querySelectorAll('.ps-dot')[i].classList.remove('active_dot');
          }
      }
      

      function shiftSlide(dir, action) {
          items.classList.add('shifting');

          if (allowShift) {
              if (!action) {
                  posInitial = items.offsetLeft;
              }

              if (dir == 1) {
                  items.style.left = (posInitial - slideSize) + "px";
                   index++;
                  console.log("next" + index);
                  remove_active_dots();if(index<totalSlides)
                  document.querySelector('.post-slider-dots_' + id).querySelectorAll('.ps-dot')[index].classList.add('active_dot');else{document.querySelector('.post-slider-dots_' + id).querySelectorAll('.ps-dot')[0].classList.add('active_dot')}
                 

              } else if (dir == -1) {
                  
                  items.style.left = (posInitial + slideSize) + "px";
                  index--;
                  console.log("pri" + index);
                  remove_active_dots();if(index>=0)
                  document.querySelector('.post-slider-dots_' + id).querySelectorAll('.ps-dot')[index].classList.add('active_dot');else{
                      document.querySelector('.post-slider-dots_' + id).querySelectorAll('.ps-dot')[totalSlides-1].classList.add('active_dot')
                  }
                  
              }
          };

          allowShift = false;
      }

      function checkIndex() {
          items.classList.remove('shifting');

          if (index == -1) {
              items.style.left = -(slidesLength * slideSize) + "px";
              index = slidesLength - 1;
          }

          if (index == slidesLength) {
              items.style.left = -(1 * slideSize) + "px";
              index = 0;
          }

          allowShift = true;
      }
  }