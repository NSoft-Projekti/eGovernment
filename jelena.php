<?php
echo "hello world";
echo "hello there :)";
echo "hello jelena, how are u ? ;) here is my number 063/****** call me maybe! ;)";
$username = "root";
$password = "mojapraksa";
$hostname = "10.0.0.250";
$connection = mysql_connect($hostname, $username, $password)
or die("Unable to connect.");
echo ("Connected to MySQL.");
?>
