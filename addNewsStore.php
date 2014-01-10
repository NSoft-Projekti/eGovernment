<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2014.01.08
 * Time: 09:47
 */
require("connect.php");
echo ("Pozvan addNewsStore.php");

    echo ("If uslov");
    $inputTitle=mysql_real_escape_string($_POST['title']);
    $inputContent=mysql_real_escape_string($_POST['content']);
    $inputSummary=mysql_real_escape_string($_POST['summary']);
    echo ("Izvrsena pohrana u varijable");
    mysql_query("INSERT INTO post (title, content, summary, idpost_type, iduser)
    VALUES ('".$inputTitle."', '".$inputContent."','".$inputSummary."', 1, 10)");
echo mysql_error();


?>