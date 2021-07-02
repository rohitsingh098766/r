<?php

session_start();
//if(isset($_SESSION['id'])){
//    header('Location: ../');
//}

//reset default mode
$set_to_one = 1;
setcookie("t", $set_to_one, time() + (86400 * 364),'/');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaariii | Smart social media</title>

    <link rel="stylesheet" href="../CSS/spin_loader.css?v=2">
    <link rel="stylesheet" href="CSS/style.css?v=2">
    <link rel="stylesheet" href="intro/style.css?v=2">

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
    
    <meta name="description" content="Yaariii is a smart social media platform, organize your social network, enjoy dynamic news feed, ultra sharing options, full control over privacy and much more....">
    <meta name="keywords" content="Yaariii, Social media, Social media platform, smart social media, smartest social media, dynamic news feed, organize social network, best social media, yaari, yaarii, yariii, yarii, yari">

    <!--    google login kit-->
    <?php
    $isWebView = false;
if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) :
    $isWebView = true;
elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) :
    $isWebView = true;
endif;

if($isWebView){
}else{
   echo '<script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="439528579983-k5k0e41kel6a4dsd6517jr7r48ksl7ms.apps.googleusercontent.com">';
}
    
    
   
    ?>
    
</head>

<body>

    <!--facebook login-->
<!--
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=956412888207642&autoLogAppEvents=1" nonce="NJkMk60z"></script>
-->
      <?php
    
    
    if($isWebView){
}else{
   echo '<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0&appId=956412888207642&autoLogAppEvents=1" nonce="GwISju0w"></script>';
}
    
    $intro = true;
    if(isset($_GET['add'])){
         $intro = false;
    }
    
    if($intro===true){
        
     include './intro/intro.html';
    }
    
    ?>

    

    <div class="container <?php if($intro===true){echo 'display_none';}?>">
        <div class="loader">
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="main-login" id="login-form">
            <div class="left-bar">
                <img src="../icons/logo/logo_transparent.png" class="main-img"  alt="logo">
                <div class="title">
                    <b style="color: #196fb6;">Yaariii</b><b></b>
                </div>
                <p class="about">Get connected with your friends, family and communities in a smart way.</p>
                <div class="signup-action">
                    <span class="not_a_member">Not a member yet?</span>
                    <span class="signup" id="signup-forward">Signup</span>
                </div>
            </div>
            <div class="right-bar">
                <h2 class="heading">Login</h2>
                <form action="" method="" class="form-wrap" autocomplete="off" spellcheck="false" id="login_form">
                    <div class="input-wrap">
                        <input type="text" class="fields" name="name" title="Provide UserName/Email Address/Contact Number" id="login_username" required>
                        <span class="label">Username</span>
                    </div>
                    <div class="input-wrap">
                        <input type="password" class="fields password" name="pass" id="login_password" title="Provide Password" required>
                        <span class="label">Password</span>
                    </div>
                    <div class="recovery">
                        <div class="checkbox">
                        </div>
<!--                        <a href="" style="color: blue;">Forgot Password?</a>-->
                    </div>
                    <input type="submit" class="submit" value="Login">
                    <span class="or-marker">&nbsp;Or&nbsp;</span>

<!--
                    <div class="social-media ">
                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">Login with Facebook
                        </fb:login-button>
                    </div>
                    <div class=" social-media g-signin2" data-onsuccess="onSignIn" id="google_login_button"></div>
-->
                    <div id="status" class="hide">

                    </div>
                    </form>
<!--                    <fb:login-button class="social-media " scope="public_profile,email" onlogin="checkLoginState();" id="favebook_login">Sign in</fb:login-button>-->
                  <?php
    
    
    if($isWebView){
}else{
   echo '<button class="social-media  g-signin2" data-onsuccess="onSignIn" id="google_login_button">Login with Google</button>
               <div class="fb-login-button social-media " data-width="" data-size="medium" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email"
  onlogin="checkLoginState();">Login with Facebook</div>';
}
    ?>
                    
<!--                    <label for="google_login_button" class="social-media twitter">Log in with Twitter</label >-->

                
                <div class="signup-action mobile">
                    <span>Not a member yet?</span>
                    <span class="signup" id="signup-forward-mobile">Signup</span>
                </div>
            </div>
        </div>
        <div class="main-signup hide" id="signup-form">
            <div class="header">
                <img src="../icons/logo/logo_transparent.png" class="main-img head-img"  alt="logo">
                <div class="title">
                    <b style="color: #196fb6;">Yaariii</b><b></b>
                </div>
                <span class="login" id="login-back">Login</span>
            </div>
            <h2 class="heading" style="font-size: 1.25em;">Sign Up</h2>
            <div class="progress-bar">
                <span class="number finished" id="n-1">1</span>
                <span class="line" id="l-1"></span>
                <span class="number" id="n-2">2</span>

            </div>
            <div class="multi-stage">
                <form action="" class="forms" autocomplete="off" spellcheck="false">
                    <div class="form-heading">
                        <span class="svg-icon pers"></span>
                        <span>Name</span>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="first_name" name="first_name" required>
                        <span class="label">First name</span>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="fields " id="last_name" name="last_name" required>
                        <span class="label">Last name</span>
                    </div>

                    <div class="button-wrap">
                        <div data-id="1" class="continue">Continue</div>
                    </div>
                </form>

                <form action="" class="forms" autocomplete="off" spellcheck="false" id="signup_username">
                    <div class="form-heading">
                        <span class="svg-icon account"></span>
                        <span>Set up login Details </span>
                    </div>
                    <span class="note note-plus">Please take a username for sign up.</span>
                    <div class="input-wrap">
                        <input type="text" class="fields" id="uname" name="uname" required>
                        <span class="label">Username</span>
                    </div>
                    <span class="note" id="warning"> Username can use only letters, numbers, underscore and dot. </span>
                    <span class="note note-check"> this is unavailable</span>
                    <div class="input-wrap">
                        <input type="password" class="fields password" id="pass" name="upass" required>
                        <span class="label">Password</span>
                    </div>

                    <div class="button-wrap">
                        <div data-id="1" class="previous">Previous</div>
                        <input type="submit" class="signup-button" value="Sign up">
                    </div>
                    <br>
                </form>








            </div>
        </div>
         <a class="alert" href="../edit_profile/" id="created">
        <div class="alert_center">
            <div class="alert_grid">
                <div class="success_mark"><img src="images/check-circle-regular.svg" class="tick_scg"  alt="icon"></div>
                <div class="success_message">
                    <div>Account created.</div>
                    <div>Lets set up your account details quickly.</div>
                    <div> <button>Okay</button></div>
                </div>
            </div>
        </div>
    </a>

    <a href="#" class="alert " id="wrong_ps">
        <div class="alert_center">
            <div class="alert_grid">
                <div class="success_mark success_mark_wrong_ps"><img src="images/times-circle-regular.svg" class="tick_scg"  alt="icon"></div>
                <div class="success_message success_message_wrong_ps">
                    <div>Invalid details.</div>
                    <div>Incorrect username or password.<br> New at Yaariii! please create an account.</div>
                    <div> <button id="wrong_ps_btn">Try again.</button></div>
                </div>
            </div>
        </div>
    </a>
    <a href="#" class="alert " id="another_username">
        <div class="alert_center">
            <div class="alert_grid">
                <div class="success_mark success_mark_another_username"><img src="images/times-circle-regular.svg" class="tick_scg"  alt="icon"></div>
                <div class="success_message success_message_another_username">
                    <div>Username not avilable!</div>
                    <div>This username has been already taken please try another one.</div>
                    <div> <button id="wrong_ps_btn">Try Another.</button></div>
                </div>
            </div>
        </div>
    </a>
    </div>

   

    <div class="hide load_anything"></div>
    <script src="JS/main.js?v=2"></script>
    <?php
    if($intro===true){
        
     echo '<script src="JS/intro.js?v=2"></script>';
    }
    
    ?>
    




    <!-- Load the JS SDK asynchronously -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>
        FB.logout(function(response) {
            // user is now logged out
        });


        function statusChangeCallback(response) { // Called with the results from FB.getLoginStatus().
            console.log('statusChangeCallback');
            console.log(response); // The current login status of the person.
            if (response.status === 'connected') { // Logged into your webpage and Facebook.
                testAPI();
            } else { // Not logged into your webpage or we are unable to tell.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into this webpage.';
            }
        }


        function checkLoginState() { // Called when a person is finished with the Login Button.
            FB.getLoginStatus(function(response) { // See the onlogin handler
                statusChangeCallback(response);
            });
        }


        window.fbAsyncInit = function() {
            FB.init({
                appId: '956412888207642',
                cookie: true, // Enable cookies to allow the server to access the session.
                xfbml: true, // Parse social plugins on this webpage.
                version: 'v9.0' // Use this Graph API version for this call.
            });


            FB.getLoginStatus(function(response) { // Called after the JS SDK has been initialized.
                statusChangeCallback(response); // Returns the login status.
            });
        };

        function testAPI() { // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + '! id is :' + response.id;

                //   connect 

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.querySelector(".load_anything").innerHTML = this.responseText;

                        if (this.responseText == 1) {

                            // add welcome message and redirect at
//                            document.getElementById('created').classList.add("active")
                              window.location.href = 'https://Yaariii.com/edit_profile';
                            animation_close();
                        } else if (this.responseText == 2) {
                            animation_close();
                            window.location.href = 'https://Yaariii.com/';
                        }
                    } else {
                        animation();
                        // add animation while request is being sended
                    }
                };
                xhttp.open("POST", "fb_login.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("name=" + response.name + "&fb_id=" + response.id);


            });
        }
    </script>

    <script>
        var proceed = false;

        document.getElementById('google_login_button').addEventListener('click', function() {
            proceed = true;
        })

        function onSignIn(googleUser) {

            if (proceed === true) {
                var profile = googleUser.getBasicProfile();
                //   window.alert('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                //   window.alert('Name: ' + profile.getName());
                //   window.alert('Image URL: ' + profile.getImageUrl());
                //   window.alert('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.



                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.querySelector(".load_anything").innerHTML = this.responseText;
                        console.log(this.responseText);
                        if (this.responseText == 1) {

                            // add welcome message and redirect at
//                            document.getElementById('created').classList.add("active")
                              window.location.href = 'https://Yaariii.com/edit_profile';
                            animation_close();
                        } else if (this.responseText == 2) {
                            animation_close();
                            window.location.href = 'https://Yaariii.com/';
                        }
                    } else {
                        animation();
                        // add animation while request is being sended
                    }
                };
                xhttp.open("POST", "google_login.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("name=" + profile.getName() + "&google_id=" + profile.getId() + "&gmail=" + profile.getEmail());
                console.log("name=" + profile.getName() + "&google_id=" + profile.getId() + "&gmail=" + profile.getEmail());
            }
        }
    </script>
</body>

</html>