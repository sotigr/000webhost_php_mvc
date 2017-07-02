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
    

    $res = query("SELECT blog.id, postname, postdes, posttext, DATE_FORMAT(date,'%d/%m/%Y') as fdate, uname as author from blog, clients where blog.uid = clients.id and blog.active = 1 ORDER BY blog.date DESC LIMIT " . $valmin . ", " . $valmax . ";");
    $count = query("SELECT COUNT(*) as count FROM blog;");
    $retur = array($res, $count);
    echo json_encode($retur);

}
run();
?>