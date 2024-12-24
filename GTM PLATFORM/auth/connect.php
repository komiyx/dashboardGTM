<?php

    $host="localhost";
    $user="root";
    $pass="";
    $db="gtmdatabase";
    $conn=new mysqli($host,$user,$pass,$db);
    if($conn->connect_error){
        echo "Failed to connect DB".$conn->connect_error;
    }
?>

<?php

    // $host="localhost";
    // $user="rndtestw_user";
    // $pass="TpW)IS3]5pw8";
    // $db="rndtestw_gtmdatabase";
    // $conn=new mysqli($host,$user,$pass,$db);
    // if($conn->connect_error){
    //     echo "Failed to connect DB".$conn->connect_error;
    // }
?>