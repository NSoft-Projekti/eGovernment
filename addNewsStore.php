<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2014.01.08
 * Time: 09:47
 */
require("connect.php");
session_start();

    $inputTitle=mysql_real_escape_string($_POST['title']);
    $inputContent=mysql_real_escape_string($_POST['content']);
    $inputSummary=mysql_real_escape_string($_POST['summary']);
    $date_time=date("Y-m-d H:i:s");
    $iduser=mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);


    mysql_query("INSERT INTO post (title, content,date_time ,summary, iduser ,idsubcategory ,idpost_type)
    VALUES ('".$inputTitle."', '".$inputContent."','".$date_time."','".$inputSummary."','".$iduser."',4,1)");
echo mysql_error();

    header("location: newsList.php");
echo mysql_error();


?>