<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script defer type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script defer type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <style>
            body {
                background: #262626;
                opacity: 0.9;
                display: block;
            }
            .item-card {
                position: relative;
                width: 250px;
                margin: 10px;
            }
            .hover {
                opacity: 0;
                position: absolute;
                top: 0px;
                left: 0px;
                background: grey;
                width: 250px;
                height: 375px;
                z-index: 1;
                overflow: hidden;
            }
            .hover:hover {
                animation: zoom 0.5s linear 1 normal forwards;
            }
            @keyframes zoom {
                from {opacity:0}
                to {opacity:0.90}
            }
            .poster .year {
                position: absolute;
                top: 5px;
                right: 5px;
                background: grey;
                font-size: 25px;
                color: #ffffff;
                padding: 5px;
                opacity: 0.9;
            }
            .poster .rating{
                position: absolute;
                top: 5px;
                left: 5px;
                font-size: 25px;
                background: white;
                opacity: 0.9;
                color: black;
                padding: 5px
            }
            .hover .label {
                display: block;
            }
            .poster img{
                width: 100%;
            }
            .hover .description{
                margin: 15px;
                font-family: sans-serif;
                font-weight: 500;
                font-weight: bold;
            }
            .hover .directors{
                margin: 15px;
                font-family: sans-serif;
                font-weight: 500;
                font-weight: bold;
            }
            .hover .genres{
                margin: 15px;
                font-family: sans-serif;
                font-weight: 500;
                font-weight: bold;
            }
            .hover .duration{
                margin: 15px;
                font-family: sans-serif;
                font-weight: 500;
                font-weight: bold;
            }
            .hover .actors{
                margin: 15px;
                font-family: sans-serif;
                font-weight: 500;
                font-weight: bold;
            }
            .item-card .title{
                font-family: sans-serif;
                font-weight: 900;
                color: #ffffff;
            }
            .btn1{
                position: absolute;
                margin: 0 20px;
                top: 40%;
                left: 60px;
                font-size: xxx-large;
                border-radius: 100px;
                cursor:pointer;
                border: 5px solid #262626;
                color: blanchedalmond;
                transition: 1.5s;
                transform: translateY(-50%);
                background: #262626
            }
            .btn1:hover{
                box-shadow: 0 5px 50px 0 #e60000 inset, 0 5px 50px 0 #e60000;
                text-shadow: 0 0 5px #e60000,0 0 5px #e60000;
            }
            .btn2:hover{
                box-shadow: 0 5px 50px 0 #e60000 inset, 0 5px 50px 0 #e60000;
                text-shadow: 0 0 5px #e60000,0 0 5px #e60000;
            }
            .btn2{
                position: absolute;
                margin: 0 20px;
                top: 40%;
                right: 60px;
                font-size: xxx-large;
                cursor:pointer;
                border-radius: 100px;
                border: 5px solid #262626;
                color: blanchedalmond;
                transition: 1.5s;
                transform: translateY(-50%);
                background: #262626
            }
            .container {
                width: 1225px;
                height: auto;
            }
            .row {
                position: absolute;
                left: 16%;
                width: 1120px;
                border: 10px solid grey;
                border-radius: 20px;
                padding: 0 20px;

            }
            .fill p{
                position: absolute;
                left: 20px;
                top: 20px;
                padding: 10px;
                background-color: red;
                margin: 0;
                font-family: sans-serif;
            }
            .fill a{
                position: absolute;
                right: 20px;
                top: 20px;
                padding: 10px;
                background-color: red;
                text-decoration: none;
                border-radius: 5px;
                font-family: sans-serif;
                color: black;
            }
        </style>
<title>OurMovies - Watch Movies & TV Shows Online</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<?php include('conn.php');?>
<body>
<!-- Header -->
<?php //include('header.php'); ?>
<!-- Content -->
<div class="content">
    <div class="row1">
<?php    $sql = "SELECT * FROM media WHERE tv=0 ORDER BY releaseDate DESC LIMIT 10";
         $res = $conn->query($sql);?>
    <div class="container">
        <div class="fill"><p>Latest Movies</p></div>
        <div class="fill"><a href="http://localhost/web/movies/?order=release">View All</a></div>
        <input type="button" value="◄" class="btn1">
        <div class="row" style="margin-top:70px">
            <?php while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $title = $row['title'];
                $poster = 'https://image.tmdb.org/t/p/w342'.$row['poster'];
                $year = $row['year'];
                
                $description = $row['description'];
                $imdbRating = $row['imdbRating'];
                $duration = $row['duration'];
                
                $genre = explode(',',$row['genre']);
                
                $genres = [];
                foreach($genre as $g) {
                    $sql = "SELECT name FROM genre WHERE id='$g'";
                
                    $res = $conn->query($sql);
                    $row = $res->fetch_array(MYSQLI_ASSOC);
                    array_push($genres,$row['name']);
                }
                $genres = implode(', ',$genres);
                
                //Directors
                $sql = "SELECT name FROM directors INNER JOIN directs ON directors.directorID = directs.directorID AND directs.tmdbID = '38700'";
                $res = $conn->query($sql);
                $directors = [];
                while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    array_push($directors,$row['name']);
                }
                $directors = implode(', ',$directors);
                
                //Actors
                $sql = "SELECT name FROM actors INNER JOIN acts ON actors.actorID = acts.actorID AND acts.tmdbID = '38700' LIMIT 5";
                $res = $conn->query($sql);
                $actors = [];
                while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    array_push($actors,$row['name']);
                }
                $actors = implode(', ',$actors); ?>
            <div class="item-card">
                <div class="poster">
                    <img class="img" src="<?=$poster?>">
                    <span class="year"><?=$year?></span>
                    <h3 class="title"><?=$title?>1</h3>
                    <span class="rating"><?=$imdbRating?></span>
                </div>
                <div class="hover">
                    <div class="directors">
                        <span class="label">Directed By:</span>
                        <span class="dir"><?=$directors?></span>
                    </div>
                    <div class="actors">
                        <span class="label">Staring:</span>
                        <span class="act"><?=$actors?></span>
                    </div>
                    <div class="genres">
                        <span class="label">Genres:</span>
                        <span class="genre"><?=$genres?></span>
                    </div>
                    <div class="duration">
                        <span class="tag">Duration:</span>
                        <span class="duration"><?=$duration?></span>
                    </div>
                    <div class="description">
                        <span class="label">Description:</span>
                        <span class="desc"><?=$description?></span>
                    </div>
                </div>
            </div>
            <?php } ?>
    </div>
</div>
</body>
</html>