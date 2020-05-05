<?php
include('../conn.php');

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(isset($_SESSION['_admin_username'])) {
    //Show dashboard if user is logged in 
    //For now just a message of successful login ?>
<html>
    <head>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    </head>
    <div class="message">
        <h2>You have been successfully logged in.</h2><br>
        <p> Welcome <?= $_SESSION['_admin_username'];?> </p><br>
        Click to <a href="./logout.php" class="logout-button">Logout</a>
    </div>
</html>
<?php
} else {
    //If user is not logged in include login page
    require_once('login.php');
}?>