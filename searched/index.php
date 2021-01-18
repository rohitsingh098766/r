<?php
if(isset($_GET['s'])){
session_start();
include '../connection.php';
    $search = mysqli_real_escape_string($connection, $_GET['s']);
$query_get_id = "SELECT *,COUNT(*)as followers, users.id as num FROM `users` join yaarme_follow.follow on users.id = yaarme_follow.follow.opponent where first_name like '{$search}%'   GROUP by yaarme_follow.follow.opponent ORDER BY `followers` DESC limit 10";
//$query_get_id = "SELECT * FROM `users` where first_name like '{$search}%' limit 10";
//    echo $query_get_id;
$result_get_id = mysqli_query($connection,$query_get_id);
$total_rows = mysqli_num_rows($result_get_id);
// echo $total_rows;

echo '{
"post" :
[';
$x=1;
while($row = mysqli_fetch_assoc($result_get_id)){
//check if i am already following
    $follow= " select * from yaarme_follow.follow where user={$_SESSION['id']}  and opponent = {$row['num']}" ;
$result_f = mysqli_query($connection,$follow);
    $following = "0";
    $requested = "0";
while($row_f = mysqli_fetch_assoc($result_f)){
    if($row_f['approve']==1){
//        he is following
        $following = 1;
    }else{
//        he just requested
        $following = "0";
        $requested = "1";
    }
}
echo '
{
"user_id":'.$row['num'].',
"name":"'.$row['first_name']." ".$row['last_name'].'",
"profile_img":"'.$row['profile_url'].'",
"followers":"'.$row['followers'].'",
"intro":"'.$row['status_mini_bio'].'",
"account_type":"'.$row['account_type'].'",
"location":"'.$row['location_locality'].", ".$row['location_state'].", ".$row['location_country'].'",
"following":"'.$following.'", 
"requested": "'.$requested.'"
}


' ;
if($x!= $total_rows){echo ",";}
$x++;

}
echo ']} ';


//echo $_GET['s'];
exit(0);
}
?>


            <div class="card-header results">
                <div class="results-title"> Showing 8 results </div>
            </div>

            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/avatar.png" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            Rohit Agarwal
                        </a>
                    </h1>
                    <span>
                        •
                        3rd+
                    </span>
                    <p>
                        Executive Engineer at GAIL (India) Limited
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        Raipur Area, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            60 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn user_send_50" onclick="follow_me(50,1,1)">FOLLOW</button>
                    <button class="connect-btn user_sending_50 hide" onclick="follow_me(50,1,0)">REQUESTED</button>
                    <button class="connect-icon ">
                        <img class="user_s_50 " src="./SVG/user-plus-solid.svg" alt="" onclick="follow_me(50,1,1)">
                        <img class="user_sing_50 hide" src="./SVG/user-plus-solid-blue.svg" alt="" onclick="follow_me(50,1,0)">
                    </button>
                </div>
            </div>
            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/rohit.jpg" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            YaarMe
                        </a>
                    </h1>
                    <span>
                        •
                        2nd
                    </span>
                    <p>
                        Official account of yaarMe follow Soon...
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        New Delhi Area, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            58 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn">FOLLOW</button>
                    <button class="connect-icon white">
                        <img src="./SVG/user-plus-solid.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/img1.jpg" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            Rohit Agarwal
                        </a>
                    </h1>
                    <span>
                        •
                        2nd
                    </span>
                    <p>
                        Student at Lnct | Yuva Bhopal
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        Bhopal Area, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            35 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn">FOLLOW</button>
                    <button class="connect-icon white">
                        <img src="./SVG/user-plus-solid.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/img2.jpg" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            Rohit Agarwal
                        </a>
                    </h1>
                    <span>
                        •
                        2nd
                    </span>
                    <p>
                        Angel Investor, Investment Banking
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        Bhopal Area, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            16 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn">FOLLOW</button>
                    <button class="connect-icon white">
                        <img src="./SVG/user-plus-solid.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/img3.jpg" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            Rohit Agarwal
                        </a>
                    </h1>
                    <span>
                        •
                        2nd
                    </span>
                    <p>
                        Student at SSN College of Engineering
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        Mumbai Area, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            6 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn">FOLLOW</button>
                    <button class="connect-icon white">
                        <img src="./SVG/user-plus-solid.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/samay.jpg" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            Rohit Agarwal
                        </a>
                    </h1>
                    <span>
                        •
                        2nd
                    </span>
                    <p>
                        Chief Operating Officer at SAP Indian Subcontinen
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        Chennai Area, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            4 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn">FOLLOW</button>
                    <button class="connect-icon white">
                        <img src="./SVG/user-plus-solid.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/akash.jpg" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            Rohit Agarwal
                        </a>
                    </h1>
                    <span>
                        •
                        2nd
                    </span>
                    <p>
                        Frontend Developer at @HSPM Solutions LLP.
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        New Delhi, Delhi, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            4 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn">FOLLOW</button>
                    <button class="connect-icon white">
                        <img src="./SVG/user-plus-solid.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="card-main res">
                <div class="img-wrap ">
                    <img class="circle" src="./search/alexandra.jpg" alt="">
                </div>
                <div class="info">
                    <h1>
                        <a href="">
                            Rohit Agarwal
                        </a>
                    </h1>
                    <span>
                        •
                        2nd
                    </span>
                    <p>
                        Executive Engineer at GAIL (India) Limited
                    </p>
                    <img class="loc-icon" src="./search/SVG/map-marker-alt-solid.svg" alt="">
                    <span class="location">
                        Pune Area, India
                    </span>
                    <br>

                    <ul class="shared">
                        <li>
                            <a href="">
                                <img src="./search/img1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="./search/img3.jpg" alt="">
                            </a>
                        </li>
                        <span class="connections">
                            3 shared connections
                        </span>
                    </ul>



                </div>
                <div class="last">
                    <button class="connect-btn">FOLLOW</button>
                    <button class="connect-icon white">
                        <img src="./SVG/user-plus-solid.svg" alt="">
                    </button>
                </div>
            </div>
