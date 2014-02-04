<!--/**
 * Created by PhpStorm.
 * User: X
 * Date: 2/3/14
 * Time: 7:03 PM
 */-->
<?php

require("connect.php");
session_start();

$inputTitle=mysql_real_escape_string($_POST['title']);
$inputContent=mysql_real_escape_string($_POST['content']);
$inputSummary=mysql_real_escape_string($_POST['summary']);
$date_time=date("Y-m-d H:i:s");
$iduser=mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);
$idpost = mysql_real_escape_string($_POST['idpost']);
echo 'Pohranjeno u varijable';
mysql_query("UPDATE post SET title = '$inputTitle', content = '$inputContent', date_time = '$date_time', summary = '$inputSummary', iduser = '$iduser', idsubcategory = '4', idpost_type = '1' WHERE idpost = $idpost");
header("location: newsList.php");
echo mysql_error();



?>