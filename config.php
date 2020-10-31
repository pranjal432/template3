<?php

    $siteurl="http://localhost/training/template/OnlineTestPlatform/";

    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="otp";

    $conn=new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {

    die("Connection Failed: ".$conn->connect_error);
}



?>