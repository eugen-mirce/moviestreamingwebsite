<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$_SESSION["_admin_username"] = "";
session_destroy();
header("Location: index.php");
?>