<header>
            <a href="http://localhost/web/home" class="logo"><img src="http://localhost/web/img/logo.png"></a>
            
        </header>
        <div class="sidebar">
            <div class="toggle-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul>
                <li><a href="http://localhost/web/home/">Home</a></li>
                <li><a href="http://localhost/web/movies/">Movies</a></li>
                <li><a href="http://localhost/web/tvshows/">TV Shows</a></li>
                <li><a href="http://localhost/web/search/">Search</a></li>
                <?php if(!isset($_SESSION)) { session_start(); } 
                    if(isset($_SESSION['_user_id'])) {?>
                <li><a href="http://localhost/web/profile/">Profile</a></li>
                <li><a href="http://localhost/web/logout/">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="http://localhost/web/login/">Login</a></li>
                    <?php } ?>
            </ul>
        </div>