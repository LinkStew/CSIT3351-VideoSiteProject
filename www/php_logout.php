<?php
// start the session
session_start();
// destroy session/"logout"
session_destroy();
// go to index
header("Location: php_home.php");
exit();
?>