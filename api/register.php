<?php
    include 'mysql.php';
    session_start();
    $username = $_GET["username"];
    $email = $_GET["email"];
    $password = $_GET["password"];
     
    $res = query("insert into clients values('', '".$username."', '".$password."', '".$email."', '', '');"); 
    echo $res;
    //echo "0";
?>