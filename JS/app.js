  function reaction(post_id) {

      var selected_op = document.querySelector("#like_" + post_id);

      var saved = document.querySelector("#save_" + post_id);
      //  toggle like option

      selected_op.querySelector('.flex').addEventListener("click", function () {
          if (
              selected_op.classList.contains("liked_done") ||
              selected_op.classList.contains("loved_done") ||
              selected_op.classList.contains("supported_done") ||
              selected_op.classList.contains("celebrated_done") ||
              selected_op.classList.contains("fired_done") ||
              selected_op.classList.contains("haha_done") ||
              selected_op.classList.contains("sad_done")

          ) {

              if (saved.classList.contains("saved")) {
                  removereaction(post_id);

                  //                  call for update not delete
                  console.log("call event to remove like at post-id : " + post_id);
                  my_ajax("./php/post_like.php", "post_id=" + post_id + "&action=delete&save=1");
              } else {
                  removereaction(post_id);
                  console.log("call event to remove like at post-id : " + post_id);
                  my_ajax("./php/post_like.php", "post_id=" + post_id + "&action=delete");
              }


          } else {
              if (saved.classList.contains("saved")) {
                  //                  call for update insert will not work
                  selected_op.classList.add('liked_done');
                  console.log("call event to like at post-id : " + post_id);
                  my_ajax("./php/post_like.php", "post_id=" + post_id + "&action=add&save=1");
              } else {
                  selected_op.classList.add('liked_done');
                  console.log("call event to like at post-id : " + post_id);
                  my_ajax("./php/post_like.php", "post_id=" + post_id + "&action=add");
              }

          }
      })


      //  show more reactions like love ...

      if (screen.width > 1024) {
          selected_op.addEventListener("mouseover", function () {
              this.querySelector('.like_option').style.display = "flex";
          });
          selected_op.addEventListener("mouseout", function () {
              this.querySelector('.like_option').style.display = "none";
          });

      } else {

          selected_op.oncontextmenu = function () {
              this.querySelector('.like_option').style.display = "flex";
          }
          document.querySelector('body').addEventListener('click', function () {
              if (selected_op.querySelector('.like_option').style.display === "flex") {
                  selected_op.querySelector('.like_option').style.display = "none";
              }
          })
      }

      selected_op.addEventListener("click", function () {
          this.querySelector(".like_option").style.display = "none";
      });



      // other reactions
      var react = selected_op.querySelector('.like_option').querySelector('.set_it')
      react.querySelector('.like_inner').addEventListener("click", function () {
          other_reactions(post_id, 1);
          removereaction(post_id);

          selected_op.classList.add('liked_done');
      });
      react.querySelector('.love_inner').addEventListener("click", function () {
          other_reactions(post_id, 2);
          removereaction(post_id);

          selected_op.classList.add('loved_done');
      });
      react.querySelector('.support_inner').addEventListener("click", function () {
          other_reactions(post_id, 3);
          removereaction(post_id);

          selected_op.classList.add('supported_done');
      });
      react.querySelector('.cele_inner').addEventListener("click", function () {
          other_reactions(post_id, 4);
          removereaction(post_id);
          selected_op.classList.add('celebrated_done');
      });
      react.querySelector('.hot_inner').addEventListener("click", function () {
          other_reactions(post_id, 5);
          removereaction(post_id);

          selected_op.classList.add('fired_done');
      });
      react.querySelector('.smile_inner').addEventListener("click", function () {
          other_reactions(post_id, 6);
          removereaction(post_id);

          selected_op.classList.add('haha_done');
      });
      react.querySelector('.sad_inner').addEventListener("click", function () {
          other_reactions(post_id, 7);
          removereaction(post_id);

          selected_op.classList.add('sad_done');
      });



      //      remove viewPrevious reactions





  }

  function other_reactions(post_id, reaction_type) {
      var saved = document.querySelector("#save_" + post_id);
      var check_reaction = document.querySelector("#like_" + post_id);
      if (
          check_reaction.classList.contains("liked_done") ||
          check_reaction.classList.contains("loved_done") ||
          check_reaction.classList.contains("supported_done") ||
          check_reaction.classList.contains("celebrated_done") ||
          check_reaction.classList.contains("fired_done") ||
          check_reaction.classList.contains("haha_done") ||
          check_reaction.classList.contains("sad_done") ||
          saved.classList.contains("saved")
      ) {
          //         update query
          console.log("update query");
          my_ajax("./php/post_like.php", "post_id=" + post_id + "&emogi=" + reaction_type + "&action=update");

      } else {

          //         insert query
          console.log("insert query");
          my_ajax("./php/post_like.php", "post_id=" + post_id + "&emogi=" + reaction_type + "&action=add");
      }
  }


  function removereaction(id) {
      document.querySelector("#like_" + id).classList.remove('liked_done');
      document.querySelector("#like_" + id).classList.remove('loved_done');
      document.querySelector("#like_" + id).classList.remove('supported_done');
      document.querySelector("#like_" + id).classList.remove('celebrated_done');
      document.querySelector("#like_" + id).classList.remove('fired_done');
      document.querySelector("#like_" + id).classList.remove('haha_done');
      document.querySelector("#like_" + id).classList.remove('sad_done');
  }

  //auto expandable textarea
  function autosize(post_id) {
      var el = document.getElementById("comment_input_" + post_id);
      setTimeout(function () {
          el.style.cssText = 'height:auto; padding:.75em 1em';
          el.style.cssText = 'height:calc(' + (el.scrollHeight) + 'px +  2px);';
      }, 100);
  }