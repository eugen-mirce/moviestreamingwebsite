<?php
include('conn.php');

if(isset($_REQUEST['uid']) && isset($_REQUEST['name']) && isset($_REQUEST['email'])) {
    $uid = $_REQUEST['uid'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $sql_query = "INSERT INTO user (id, email, name, status, expirydate) VALUES ('$uid', '$email', '$name', 'Not Subscribed', null)";
    if ($conn->query($sql_query)) {
        echo "Account Created Successfully.";
    } else {
        echo "Error: " . $sql_query . "<br>" . $conn->error;
    }
    
    $conn->close();
} else {
    echo 'Error 404';
}
?>