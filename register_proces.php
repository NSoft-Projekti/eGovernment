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

    if($gender=='M'){
        $gender=='M';
    }
    else if ($gender=='Ž') {
        $gender=='Ž';
    }
else {
    $gender == "";
}
    if(mysql_num_rows($checkusername) == 1)
    {
        echo "<script type='text/javascript'>alert('Greska!! Korisničko ime već postoji ');</script>";

    }
    else
    {
        $registerquery = mysql_query("call create_user('".$name."','".$lastname."','".$username."','".$address."', '".$password."', '".$email."','".$gender."','".$newDate_of_birth."','".$telephone."')");
        if($registerquery )
        {

            echo "<script type='text/javascript'>alert('Uspjeh');</script>";
          /*  echo "<script type='text/javascript'>alert('Uspješno ste se registrirali. Klik <a href='login-popup.php'>ovdje za login</a>')</script>";*/


            /*
            echo "<h1>Uspjeh </h1>";
            echo "<p>Uspješno ste se registrirali. Klik<a href='login-popup.php'>ovdje za login</a></p>";
            */

        }
        else
        {
            echo "<h1>Greška</h1>";
        }
    }

?>
