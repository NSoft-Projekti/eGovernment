<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2014.01.08
 * Time: 09:47
 */
require("../connect.php");
echo ("Pozvan addNewsStore.php");
session_start();
$idpost = $_GET['id'];
echo ("If uslov");
$inputTitle=mysql_real_escape_string($_POST['title']);
$inputContent=mysql_real_escape_string($_POST['content']);
$inputSummary=mysql_real_escape_string($_POST['summary']);
$date_time=date("Y-m-d H:i:s");
$iduser=mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

mysql_query("UPDATE post SET (title = '".$inputTitle."', content = '".$inputContent."', date_time = '".$date_time."', summary = '".$inputSummary."', iduser = '".$iduser."',idsubcategory = 4, idpost_type=1)
    WHERE idpost = '".$idpost."'");
echo mysql_error();

header("location: newsList.php");
echo mysql_error();


?>