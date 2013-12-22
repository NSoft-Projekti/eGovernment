<?php
//require("connect.php");
require("connect_remote.php");
$username = $_POST['username'];
$password = $_POST['password'];

$username2 = "root";
$password2 = "mojapraksa";
$hostname2 = "pip.intera.ba:13306";

//connection to the database
$conn = mysql_connect($hostname2, $username2, $password2);
//select a database to work with
$selected = mysql_select_db("tim4",$conn);
?>
<?php
//Start session
session_start();
//Array to store validation errors
$errmsg_arr = array();

//Validation error flag
$errflag = false;

//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
}

//Sanitize the POST values
$username = clean($_POST['username']);
$password = clean($_POST['password']);

//Input Validations
if($username == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

//If there are input validations, redirect back to the login form
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    echo("Greska pri logiranju");
    exit();
}

//Create query
$qry="SELECT * FROM user WHERE username='$username' AND password='$password'";
$result=mysql_query($qry);

//Check whether the query was successful or not
if($result) {
    if(mysql_num_rows($result) > 0) {
        //Login Successful
        session_regenerate_id();
        $member = mysql_fetch_assoc($result);
        $_SESSION['SESS_MEMBER_ID'] = $member['mem_id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['username'];
        $_SESSION['SESS_LAST_NAME'] = $member['password'];
        session_write_close();
        header("location: newsList.php");
        exit();
    }else {
        //Login failed
        $errmsg_arr[] = 'user name and password not found';
        $errflag = true;
        if($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            echo("Greska pri logiranju");
            exit();
        }
    }
}else {
    die("Query failed");
}
?>