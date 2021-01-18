<?php

header('Location: ../');
exit(0);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | LinkedIn</title>
    <link rel="stylesheet" href="CSS/style.css" />
    
      
            <!--icons-->
	<link rel="apple-touch-icon" sizes="57x57" href="../icons/icons/apple-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="60x60" href="../icons/icons/apple-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="../icons/icons/apple-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="../icons/icons/apple-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="../icons/icons/apple-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="../icons/icons/apple-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="../icons/icons/apple-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="../icons/icons/apple-icon-152x152.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="../icons/icons/apple-icon-180x180.png" />
	<link rel="icon" type="image/png" sizes="192x192" href="../icons/icons/android-icon-192x192.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="../icons/icons/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="96x96" href="../icons/icons/favicon-96x96.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="../icons/icons/favicon-16x16.png" />
	<link rel="manifest" href="../icons/icons/manifest.json" />
	<meta name="msapplication-TileColor" content="#0073b1" />
	<meta name="msapplication-TileImage" content="../icons/icons/ms-icon-144x144.png" />
	<meta name="theme-color" content="#0073b1" />
  </head>

  <body id="body">
    <div class="sidebar">
      <div class="profile-img-sidebar">
        <img class="avatar" src="CSS/Images/avatar.png" alt="" />
        <img class="moon" src="SVG/moon-solid.svg" alt="" />
        <p>
          Omkar Dabir <br />
          +91 750 760 1084
        </p>
        <img
          class="down expand-add-acc"
          src="SVG/chevron-down-solid.svg"
          alt=""
        />
        <!-- <i class="fas fa-chevron-down arrow expand-add-acc"></i> -->
      </div>
      <div class="all-uls">
        <ul class="add-account">
          <li class="">
            <a href="#">
              <img src="SVG/plus-solid.svg" alt="" /> <span>Add Account</span>
            </a>
          </li>
        </ul>
        <hr class="hidden-hr-add-acc" />
        <ul>
          <li class="">
            <a href="#">
              <img src="SVG/user-friends-solid.svg" alt="" />
              <span>New Group</span>
            </a>
          </li>
          <li class="">
            <a href="#">
              <img src="SVG/lock-solid.svg" alt="" />
              <span>New Secret Chat</span>
            </a>
          </li>
          <li class="">
            <a href="#">
              <img src="SVG/bullhorn-solid.svg" alt="" />
              <span>New Channel</span>
            </a>
          </li>
          <li class="">
            <a href="#">
              <img src="SVG/user-solid.svg" alt="" /> <span>Contacts</span>
            </a>
          </li>
          <li class="">
            <a href="#">
              <img src="SVG/phone-volume-solid.svg" alt="" /> <span>Calls</span>
            </a>
          </li>
          <li class="">
            <a href="#">
              <img src="SVG/bookmark-solid.svg" alt="" />
              <span>Saved messages</span>
            </a>
          </li>
          <li class="">
            <a href="#">
              <img src="SVG/cog-solid.svg" alt="" /> <span>Settings</span>
            </a>
          </li>
        </ul>
        <hr />
        <ul>
          <li class="">
            <a href="#">
              <img src="SVG/user-plus-solid.svg" alt="" />
              <span>Invite Friends</span>
            </a>
          </li>
          <li class="">
            <a href="#">
              <img src="SVG/question-circle-solid.svg" alt="" />
              <span>Telegram FAQ</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-navbar-wrap">
      <div class="main-navbar">
        <span class="icon"></span>
        <div class="input-wrap">
          <span class="icon search-icon"></span>
          <input
            type="text"
            placeholder="Search"
            class="search-bar"
            for="search"
          />
        </div>
        <ul class="nav-icons">
          <span class="icon home-icon active" title="Home"></span>
          <span class="icon user-icon" title="My Network"></span>
          <span class="icon suit-icon" title="Jobs"></span>
          <span class="icon chat-icon" title="Messaging"></span>
          <span class="icon notify-icon" title="Notifications"></span>
          <span class="icon me-icon"></span>
          <div class="work-icon">
            <span class="icon work"></span> <span class="work-cont">Work</span>
          </div>
        </ul>
      </div>
    </div>
    <div class="container-wrap">
      <div class="container">
        <div class="left-bar"></div>
        <div class="main-content">
          <div class="card">
            <div class="card-header">
              <div>
                <b>Vignesh</b>, <b>Antony</b> and 400 other connections follow
                <b>LinkedIn</b>.
              </div>
              <span class="icon more-icon"></span>
            </div>
            <div class="card-main">
              <div class="follow-conn">
                <img src="CSS/Images/main-icon.png" class="follow-icon" />
                <div class="conn-name">
                  <span><b>LinkedIn</b></span> <span>10,04,575 followers</span>
                  <span>Promoted</span>
                </div>
                <button class="follow">+&nbsp;Follow</button>
              </div>
              <p class="content select_text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo,
                laboriosam sequi asperiores, perferendis provident, quis hic
                optio eum similique veritatis accusamus ducimus tempore porro
                aspernatur molestiae et rem expedita sapiente! Lorem ipsum dolor
                sit amet consectetur adipisicing elit. Facere id quam iusto
                libero alias velit at, tempore, corrupti ducimus laborum
                perferendis nulla ex possimus? Modi perspiciatis ullam animi
                adipisci ratione. Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Illo, laboriosam sequi asperiores, perferendis
                provident, quis hic optio eum similique veritatis accusamus
                ducimus tempore porro aspernatur molestiae et rem expedita
                sapiente! Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Facere id quam iusto libero alias velit at, tempore,
                corrupti ducimus laborum perferendis nulla ex possimus? Modi
                perspiciatis ullam animi adipisci ratione.
              </p>
              <img src="CSS/Images/computer.jpg" class="card-image" />
              <div class="vote-section">
                <span class="icon like-icon"></span>
                <span class="icon info-icon"></span>
                <span class="icon love-icon"></span>
                <span class="votes">750</span>
                <span> <span class="dot">•</span> 11 Comments</span>
              </div>
              <div class="share-section">
                <div class="icon-wrap">
                  <span class="icon like-i"></span> <span>Like</span>
                </div>
                <div class="icon-wrap">
                  <span class="icon comment-icon"></span> <span>Comment</span>
                </div>
                <div class="icon-wrap">
                  <span class="icon share-icon"></span> <span>Share</span>
                </div>
                <div class="icon-wrap">
                  <span class="icon send-icon"></span> <span>Save</span>
                </div>
              </div>
            </div>

            <div class="reactions">
              <span class="comm-head">Reactions</span><br />

              <section class="stories">
                <div class="storie">
                  <span class="photo user">
                    <img src="CSS/Images/profile-pic5.jpg" alt="profile-pic" />
                    <!-- <span class="add-story"></span> -->
                  </span>
                </div>
                <div class="storie">
                  <span class="photo user">
                    <img src="CSS/Images/profile-pic3.png" alt="profile-pic" />
                  </span>
                </div>
                <div class="storie">
                  <span class="photo user">
                    <img src="CSS/Images/profile-pic3.png" alt="profile-pic" />
                  </span>
                </div>
                <div class="storie">
                  <span class="photo user">
                    <img src="CSS/Images/profile-pic5.jpg" alt="profile-pic" />
                    <!-- <span class="add-story"></span> -->
                  </span>
                </div>
                <div class="storie">
                  <span class="photo icon more-react"></span>
                </div>
              </section>
            </div>

            <div class="add-comment">
              <img
                class="add-prof"
                src="CSS/Images/profile-pic6.jpg"
                alt="Profile pic"
              />

              <div class="srch-wrap">
                <input
                  type="text"
                  placeholder="Add a comment..."
                  class="add-srch-bar"
                />
                <div class="cam-wrap">
                  <img src="CSS/Images/camera.png" alt="" />
                </div>
              </div>
            </div>

            <div class="comment-heading">
              <span class="comm-head">Comments</span>
              <div class="right-head">
                <span class="relevant">Most Relevant</span>
                <img class="sort-icon" src="CSS/Images/sort.png" />
              </div>
            </div>
            <div id="chat-message-list">
              <div class="message-row other-message">
                <div class="message-content">
                  <img src="CSS/Images/profile-pic.jpg" alt="Profile pic" />
                  <div class="message-text">
                    <div class="info">
                      <div class="title-text">
                        Abhishek Tiwari <span class="name-info"> • 2nd</span>
                      </div>
                      <div class="conversation-message">
                        Executive Engineer at GAIL (India) Limited
                      </div>
                      <div class="message-time">3h</div>
                      <span class="highlight">Abhishek Tiwari</span>
                    </div>
                    <span class="icon add-user-icon"></span>
                  </div>
                  <div class="message-interact">
                    <span class="msg-icon like-i"></span><span> • 1 like </span>
                    <span>&emsp;|&emsp;</span>
                    <span class="msg-icon comment-icon"></span
                    ><span> • 2 replies</span>
                  </div>
                </div>
              </div>

              <div class="message-row other-message">
                <div class="sh-prev">Show previous replies...</div>
                <div class="message-content reply">
                  <img src="CSS/Images/profile-pic.jpg" alt="Profile pic" />
                  <div class="message-text">
                    <div class="info">
                      <div class="title-text">
                        Abhishek Tiwari <span class="name-info"> • 2nd</span>
                      </div>
                      <div class="conversation-message">
                        Executive Engineer at GAIL (India) Limited
                      </div>
                      <div class="message-time">3h</div>
                      <span class="highlight">Abhishek Tiwari</span>
                    </div>
                    <span class="icon add-user-icon"></span>
                  </div>
                  <div class="message-interact">
                    <span class="msg-icon like-i"></span><span> • 1 like </span>
                    <span>&emsp;|&emsp;</span>
                    <span class="msg-icon comment-icon"></span
                    ><span> • 2 replies</span>
                  </div>
                </div>
              </div>

              <div class="message-row other-message">
                <div class="message-content reply">
                  <img src="CSS/Images/profile-pic.jpg" alt="Profile pic" />
                  <div class="message-text">
                    <div class="info">
                      <div class="title-text">
                        Abhishek Tiwari <span class="name-info"> • 2nd</span>
                      </div>
                      <div class="conversation-message">
                        Executive Engineer at GAIL (India) Limited
                      </div>
                      <div class="message-time">3h</div>
                      <span class="highlight">Abhishek Tiwari</span>
                    </div>
                    <span class="icon add-user-icon"></span>
                  </div>
                  <div class="message-interact">
                    <span class="msg-icon like-i"></span><span> • 1 like </span>
                    <span>&emsp;|&emsp;</span>
                    <span class="msg-icon comment-icon"></span
                    ><span> • 2 replies</span>
                  </div>
                </div>
              </div>

              <div class="message-row other-message">
                <div class="message-content">
                  <img src="CSS/Images/profile-pic.jpg" alt="Profile pic" />
                  <div class="message-text">
                    <div class="info">
                      <div class="title-text">
                        Abhishek Tiwari <span class="name-info"> • 2nd</span>
                      </div>
                      <div class="conversation-message">
                        Executive Engineer at GAIL (India) Limited
                      </div>
                      <div class="message-time">3h</div>
                      <span class="highlight">Abhishek Tiwari</span>
                    </div>
                    <span class="icon add-user-icon"></span>
                  </div>
                  <div class="message-interact">
                    <span class="msg-icon like-i"></span><span> • 1 like </span>
                    <span>&emsp;|&emsp;</span>
                    <span class="msg-icon comment-icon"></span
                    ><span> • 2 replies</span>
                  </div>
                </div>
              </div>

              <div class="message-row other-message">
                <div class="sh-prev">Show previous replies...</div>
                <div class="message-content reply">
                  <img src="CSS/Images/profile-pic.jpg" alt="Profile pic" />
                  <div class="message-text">
                    <div class="info">
                      <div class="title-text">
                        Abhishek Tiwari <span class="name-info"> • 2nd</span>
                      </div>
                      <div class="conversation-message">
                        Executive Engineer at GAIL (India) Limited
                      </div>
                      <div class="message-time">3h</div>
                      <span class="highlight">Abhishek Tiwari</span>
                    </div>
                    <span class="icon add-user-icon"></span>
                  </div>
                  <div class="message-interact">
                    <span class="msg-icon like-i"></span><span> • 1 like </span>
                    <span>&emsp;|&emsp;</span>
                    <span class="msg-icon comment-icon"></span
                    ><span> • 2 replies</span>
                  </div>
                </div>
              </div>
              <div class="message-row other-message">
                <div class="message-content">
                  <img src="CSS/Images/profile-pic.jpg" alt="Profile pic" />
                  <div class="message-text">
                    <div class="info">
                      <div class="title-text">
                        Abhishek Tiwari <span class="name-info"> • 2nd</span>
                      </div>
                      <div class="conversation-message">
                        Executive Engineer at GAIL (India) Limited
                      </div>
                      <div class="message-time">3h</div>
                      <span class="highlight">Abhishek Tiwari</span>
                    </div>
                    <span class="icon add-user-icon"></span>
                  </div>
                  <div class="message-interact">
                    <span class="msg-icon like-i"></span><span> • 1 like </span>
                    <span>&emsp;|&emsp;</span>
                    <span class="msg-icon comment-icon"></span
                    ><span> • 2 replies</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="right-bar"></div>
      </div>
      <br />
    </div>
    <div class="mobile-header">
      <span class="icon me-icon"></span>
      <div class="input-wrap">
        <span class="icon search-icon"></span>
        <input type="text" placeholder="Search" class="search-bar" />
        <span class="icon qrcode-icon"></span>
      </div>
      <span class="icon chat-icon"></span>
    </div>

    <div class="mobile-nav-bar">
      <div class="suggestions-text">
        <span>What about...</span>
        <span>Thanks for sharing...</span>
        <span>Well said...</span>
        <span>I think...</span>
        <span>This will help me...</span>
        <span>I think this is...</span>
      </div>
      <div class="suggestion-comment">
        <img src="CSS/Images/profile-pic.jpg" class="sug-img" />
        <input
          type="text"
          class="input-text"
          placeholder="Leave your thoughts here..."
        />
        <span class="icon at-icon"></span>
        <span class="button">POST</span>
      </div>
    </div>
    <script src="JS/main.js?v=1"></script>
  </body>
</html>
