<?php
include 'mysql.php'; 
 
function run(){

    session_start();

	$page = $_GET["p"];
    $length = $_GET["l"];
    if ($page <= 0){
        echo "null";
    }
    $valmin = ($page - 1) * $length;
    $valmax = $length;
    
    $res = query("SELECT articles.id, artname,artdes,DATE_FORMAT(date,'%d/%m/%Y') as fdate, uname as author from articles, clients where articles.uid = clients.id and articles.active = 1 ORDER BY articles.date DESC LIMIT " . $valmin . ", " . $valmax . ";");
    $count = query("SELECT COUNT(*) as count FROM articles;");
    $retur = array($res, $count);
    echo json_encode($retur);
}
run();
?>