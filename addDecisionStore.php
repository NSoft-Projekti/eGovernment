<?php

require ('connect.php');
session_start();

$title=mysql_real_escape_string($_POST['title']);
$content=mysql_real_escape_string($_POST['content']);
$summary=mysql_real_escape_string($_POST['summary']);
$iduser=mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$date_time= date("Y-m-d H:i:s");
$idsubcategory=mysql_real_escape_string($_POST['subcategory']);

$result=mysql_query("INSERT INTO post (title, content,date_time ,summary, iduser ,idsubcategory ,idpost_type)
    VALUES ('".$title."', '".$content."','".$date_time."','".$inputSummary."','".$iduser."','".$idsubcategory."',2)");
$update=mysql_query("UPDATE subcategory SET decision=true where idsubcategory=$idsubcategory ");
if($result){

    header("location: decisionList.php");
}
else{
    echo mysql_error();
}

?>