<?php
include 'mysql.php';
session_start();
 
function publish(){
    if ($_POST["type"] == "art"){
        echo query("insert into articles values(' ', ".$_SESSION["userid"].", '".$_POST["title"]."','".$_POST["description"]."','". $_POST["html"] ."', '". date("Y-m-d H:i:s") ."' ,1)");    
    }
    else if ($_POST["type"] == "post"){
        echo query("insert into blog values(' ', ".$_SESSION["userid"].", '".$_POST["title"]."','".$_POST["description"]."','". $_POST["html"] ."', '". date("Y-m-d H:i:s") ."' ,1)");
    }
}
if (array_key_exists('userid', $_SESSION)){
    publish();
}
else
{
    echo "Access denied.";
}
?>