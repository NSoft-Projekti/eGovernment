
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
    $registerquery = mysql_query( "insert into user (name,lastname,username,address,password,email,gender,date_of_birth,telephone,path,idgroup)
        VALUES ('".$name."','".$lastname."','".$username."','".$address."', '".$password."', '".$email."','".$gender."','".$newDate_of_birth."','".$telephone."',NULL,3)");


    if($registerquery)
    {

        echo "<script type='text/javascript'>alert('Uspješno ste se registrirali! Molimo prijavite se!');</script>";
        echo "<script type='text/javascript'>window.location.href='index.php'</script>";

    }
    else
    {
        echo "<script type='text/javascript'>alert('Greška');</script>";
    }
}

?>


