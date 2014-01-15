<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2014.01.15
 * Time: 15:04
 */
require("connect.php");
session_start();

$inputName=mysql_real_escape_string($_POST['name']);
$datumPocetka=mysql_real_escape_string($_POST['datumP']);
$datumKraja=mysql_real_escape_string($_POST['datumK']);
$date_time=date("Y-m-d H:i:s");
$iduser=mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

mysql_query("INSERT INTO subcategory (name, datumP, datumK ,summary, iduser ,idcategory ,idpost_type)
    VALUES ('".$inputTitle."', '".$inputContent."','".$date_time."','".$inputSummary."','".$iduser."',1,1)");

header("location: newsList.php");
echo mysql_error();


?>