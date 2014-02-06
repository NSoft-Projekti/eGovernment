 <?php
/**
 * Created by PhpStorm.
 * User: Tomic
 * Date: 2013.12.19
 * Time: 11:55
 */

$useRemote = false ;

$dbhost = "10.0.0.250"; // ovo je server host
$dbname = "tim4"; // ime baze
$dbuser = "root"; // username
$dbpass = "mojapraksa"; // password

if ($useRemote) {
    $dbhost = "pip.intera.ba:13306";
}

$conn=mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
$selected=mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION='utf8_unicode_ci'");

 // function using md5 password hash
 //whenever a new user completes the registration form, his password will be encrypted automatically
 function hashLozinki($username, $password){
 global $conn;
 $password = md5($password);
 $q = "INSERT INTO ".TBL_USERS." VALUES ('$username', '$password')";
 return mysql_query($q, $conn);
 }
?>
