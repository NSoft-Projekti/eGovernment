<html xmlns="http://www.w3.org/1999/html">
<head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">

    <link href="style/login-popup.css" rel="stylesheet" type="text/css" />    <!--css style from a login-popup form-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script> <!--script from a login-popup form-->

</head>
<body>
<?php

require("connect.php");


$name=mysql_real_escape_string($_POST['name']);
$lastname=mysql_real_escape_string($_POST['lastname']);
$username = mysql_real_escape_string($_POST['username']);
$password = md5(mysql_real_escape_string($_POST['password']));
$email = mysql_real_escape_string($_POST['email']);
$address=mysql_real_escape_string($_POST['address']);
$gender=mysql_real_escape_string($_POST['gender']);
$date_of_birth=mysql_real_escape_string($_POST['bday']);
$telephone=mysql_real_escape_string($_POST['telephone']);

$newDate_of_birth = date("Y-m-d", strtotime($date_of_birth));

$checkusername = mysql_query("SELECT * FROM user WHERE username = '".$username."'");


if(mysql_num_rows($checkusername) == 1)
{
    echo "<script type='text/javascript'>alert('Greska!! Korisničko ime već postoji ');</script>";

}
else
{
    $registerquery = mysql_query("call create_user('".$name."','".$lastname."','".$username."','".$address."', '".$password."', '".$email."','".$gender."','".$newDate_of_birth."','".$telephone."')");
    if($registerquery )
    {

        echo "<script type='text/javascript'>alert('Uspješno ste se registrirali');</script>";
        echo "<script type='text/javascript'>window.location.href='loginPopup.php'</script>";


    }
    else
    {
        echo "<script type='text/javascript'>alert('Greška');</script>";
    }
}

?>


</body>
</html>


