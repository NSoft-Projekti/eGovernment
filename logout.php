<?php
session_start(); // start the same session
session_destroy(); // kill the session
header("location:home.php"); // redirecting to home.php after logging out
exit();
?>