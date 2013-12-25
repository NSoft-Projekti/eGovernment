 <?php
/**
 * Created by PhpStorm.
 * User: Tomic
 * Date: 2013.12.19
 * Time: 11:55
 */

$dbhost = "pip.intera.ba:13306"; // ovo je server host
$dbname = "tim4"; // ime baze
$dbuser = "root"; // username
$dbpass = "mojapraksa"; // password

 $conn=mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION='utf8_unicode_ci'");

?>