<?php include('conn.php');

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if(isset($_POST['action']) && isset($_SESSION['_user_id']) && isset($_POST['mediaID'])) {
    $id = $_SESSION['_user_id'];
    $mediaID = $_POST['mediaID'];
    if($_POST['action'] == 'add') {
        $sql = "INSERT IGNORE INTO wish_list(userID,mediaID) VALUES('$id','$mediaID')";
    } else {
        $sql = "DELETE FROM wish_list WHERE userID='$id' AND mediaID='$mediaID'";
    }
    if($conn->query($sql)) {
        echo 'OK';
    } else {
        echo 'Error';
    }
} else {
    echo 'Missing';
}
?>