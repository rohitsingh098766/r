<?php
     session_start();
     include '../connection.php';

//insert users 
    /* $first_name = array("Akash", "Shivam", "Nikhil", "Anurag", "Anupam", "Salil", "Anmol", "ramakant", "Umakant", "Deepak", "Saurabh", "Salil", "Chandan", "Vishal", "Rohit", "Aditya", "Apoorve", "Rishi");
     $last_name = array("Verma","Singh","Mishra","Rastogi","Pathak","Modi","Sharma","Gautam");

     $i=1;
     while ($i<100) {
     $f_name = $first_name[rand(1,count($first_name))-1];
     $l_name = $last_name[rand(1,count($last_name))-1];
     $query = "INSERT INTO yaarme.users (user_name,first_name,last_name) VALUES ('{$f_name}_{$l_name}','{$f_name}','{$l_name}');";
     if(mysqli_query($connection, $query)){
     $i++;
     }
     echo $query;
     }*/


//insert location
    /* $loca = array("Afghanistan");
     $i=0;
     while ($i<count($loca)) {
     $query = "INSERT INTO yaarme.location (location) VALUES ('{$loca[$i]}');";
     if(mysqli_query($connection, $query));
     echo $query;
         $i++;
     }*/



//insert follow
//     $i=0;
//     while ($i<1000) {
//         $a = mt_rand(1,100);
//         $b = mt_rand(1,100);
//     $query = "INSERT INTO `yaarme_follow`.`follow` (`user`, `opponent`) VALUES ('{$a}', '{$b}');";
//     if(mysqli_query($connection, $query));
//     echo $query;
//         $i++;
//     }





     ?>