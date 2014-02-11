<?php
include "connect.php";
session_start();

if(!empty($_POST['contentPrijedlog']))
{

    $iduser = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);//** gets iduser using session */
    $idsubcategory = $_POST["subcategoryDropdownList"];//** gets idpost using URL */
    $date_time= date("Y-m-d H:i:s");
    $inputContent=mysql_real_escape_string($_POST['contentPrijedlog']);
    mysql_query("INSERT INTO post (content, date_time, iduser, idpost_type, idsubcategory)
    VALUES ('".$inputContent."','".$date_time."', $iduser, 3, $idsubcategory)");
    //header("location: suggestionList.php");
    echo mysql_error();
}
?>