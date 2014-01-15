<?php

require("connect.php");
session_start();

$content=mysql_real_escape_string($_POST['comment_text']);
$date_time= date("Y-m-d H:i:s");
$iduser = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);//** gets iduser using session */
$idpost = mysql_real_escape_string( $_GET['id']);//** gets idpost using URL */

$result =mysql_query("INSERT INTO comment (content, date_time,iduser, idpost)
        VALUES ('".$content."','".$date_time."','".$iduser."','".$idpost."')");
if($result){
    echo ("Zahvaljujemo na komentaru!!");
    header("location: newsDetails.php?id=$idpost");
}
else{
    echo mysql_error();
}
?>
