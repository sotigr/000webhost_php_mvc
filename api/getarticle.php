<?php
include 'mysql.php'; 
 
function run(){	
    session_start();
    $artid = $_GET["artid"]; 
    $res =  query("select articles.id, artname, artdes, artval, uname as author from articles, clients where articles.uid = clients.id and articles.active = 1 and articles.id = '".$artid."';");
    echo json_encode($res);
}
run();
?>