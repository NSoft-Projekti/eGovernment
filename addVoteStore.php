<?php
require("connect.php");
session_start();

$iduser = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);//** gets iduser using session */
$idpost= mysql_real_escape_string( $_GET['id']);//** gets idpost using URL */
// $idpost = (int) $idpoststring;
mysql_query("INSERT INTO vote (votevalue, iduser, idpost)
    VALUES (1,'".$iduser."','".$idpost."')");
echo mysql_error();
header("location: suggestionList.php");

?>