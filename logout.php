<?php
session_start(); // start the same session
session_destroy(); // kill the session
header("location: index.php"); // redirecting to index.php after logging out
exit();
?>