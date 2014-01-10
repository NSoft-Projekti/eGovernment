<?php
require("connect.php");
if(!empty($_POST['title']) and !empty($_POST['content'])and !empty($_POST['summary']))
{
    echo ("If uslov");
    $inputTitle=mysql_real_escape_string($_POST['titlePrijedlog']);
    $inputContent=mysql_real_escape_string($_POST['inputContent']);
    $inputSummary=mysql_real_escape_string($_POST['inputSummary']);
    echo ("Izvrsena pohrana u varijable");
    mysql_query($conn,"INSERT INTO post (title, content, summary, idpost_type, iduser)
    VALUES ('".$inputTitle."', '".$inputContent."','".$inputSummary."', 1, 10)");
    echo mysql_error();
}
?>