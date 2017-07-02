<?php
 
    include 'mysql.php';
    $res = query($_GET["query"]); 
    echo $res;
 
?>