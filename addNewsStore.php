<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2014.01.08
 * Time: 09:47
 */
require("connect.php");
echo ("Pozvan addNewsStore.php");
if(!empty($_POST['title']) and !empty($_POST['content'])and !empty($_POST['summary']))
{
    echo ("If uslov");
    $inputTitle=mysql_real_escape_string($_POST['inputTitle']);
    $inputContent=mysql_real_escape_string($_POST['inputContent']);
    $inputSummary=mysql_real_escape_string($_POST['inputSummary']);
    echo ("Izvrsena pohrana u varijable");
    mysql_query($conn,"INSERT INTO post (title, content, summary, post_type_idpost_type, user_iduser)
    VALUES ('".$inputTitle."', '".$inputContent."','".$inputSummary."', 1, 10)");
echo mysql_error();
}

?>