<div class="header">
    <div class="logo">
        <a href="../web/home.php"><img src="../web/img/logo.png" witdth="250px" height="80px"></a> 
    </div>
    <div class="navbar">
        <ul>
            <li class="nav"><a class= "removed-style" href="../web/home.php">Home</a></li>
            <li class="nav"><a class= "removed-style" href="../web/movies.php">Movies</a></li>
            <li class="nav"><a class= "removed-style" href="../web/tvshows.php">TV Shows</a></li>
            <li class="nav"><a class= "removed-style" href="../web/genres.php">Genres</a></li>
        <?php 
        //Check if user is logged in
        session_start();
        if(isset($_SESSION['user_id'])) {?>
            <li class="nav"><a href="../web/profile.php">Profile</a></li>
            <span class="nav log_out"><a class= "removed-style" href="../web/logout.php">Log Out</a></span>
        <?php } else { ?>
            <span class="nav sign_in"><a class= "removed-style" href="../web/login.php">Sign In</a></span>
        <?php } ?>
            <li class="nav"><input type="text" id="search" placeholder="Search..."></li>
        </ul>
    </div>
</div>