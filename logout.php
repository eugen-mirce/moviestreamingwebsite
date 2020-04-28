<?php 
session_start();
unset($_SESSION['user_id']);
header("Location: http://localhost/web/home.php"); 
exit();
?>