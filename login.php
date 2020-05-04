<!DOCTYPE html>
<html>
<head>
<title>OurMovies - Log In To Your Account</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<!-- jQuery -->
<script src="js/jquery-3.5.0.js"></script>
<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>
<script src="js/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/ui/4.5.0/firebase-ui-auth.js"></script>
<link type="text/css" rel="stylesheet" href="../web/css/firebase-ui-auth.css" />
<script src="js/firebase-auth.js"></script>
</head>
<body>
<!-- Header -->
<?php include('header.php'); ?>
<!-- Content -->
<div class="content">
<?php if(isset($_SESSION['_user_id'])) { ?>
    <!-- TODO | Page Where It Shows Successfully Logged in And Redirects In 5 Seconds To Home -->
<?php } else { ?>
    <!-- Show Only If Not Logged In -->
    <div id="firebaseui-auth-container"></div>
    <div id="loader">Loading...</div>
<?php } ?>

</div>
<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>