<?php
if(isset($_REQUEST['uid'])) {
    session_start();
    $_SESSION['user_id'] = $_REQUEST['uid'];
    echo $_SESSION['user_id'];
} else {
    echo 'Error 404';
}
?>