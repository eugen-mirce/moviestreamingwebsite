<!DOCTYPE html>
<?php include('conn.php');
$tmdb = 38700;

$sql = "SELECT * FROM media WHERE tmdbID='$tmdb'";
$res = $conn->query($sql);

$title = '';
$description = '';
$url = '';
$poster = '';
$background = '';
$trailer = '';
$imdbRating = '';
$duration = '';
$genre = '';
$year = '';
$releaseDate = '';

$row = $res->fetch_array(MYSQLI_ASSOC);
$title = $row['title'];
$description = $row['description'];
$url = $row['url'];
$poster = $row['poster'];
$background = $row['background'];
$trailer = $row['trailer'];
$imdbRating = $row['imdbRating'];
$duration = $row['duration'];
$genre = $row['genre'];
$year = $row['year'];
$releaseDate = $row['releaseDate'];

$genre = explode(',', $genre);

?>
<html>
<head>
 <title>Admin</title>
 <link rel="stylesheet" type="text/css" href="stylesheet.css">
 <script src="../js/jquery-3.5.0.js"></script>
</head>
<body>
<div class="header">
  <ul class="menu">
    <li class="item"><a href="#">Dashboard</a></li>
    <li class="item"><a href="#">Movies</a>
  <ul>
    <li class="dropdown"><a href="">Movie List</a></li>
    <li class="dropdown"><a href="">New Movie</a></li>
    </ul>
  </li>
  <li class="item"><a href="#">TV Series</a>
    <ul>
    <li class="dropdown"><a href="">TV List</a></li>
    <li class="dropdown"><a href="">New TV</a></li>
    </ul>
  </li>
  <li class="item"><a href="#">Users</a>
  <li class="item"><a href="">Settings</a></li>
  <li class="item"><a href="">Logout</a></li>
  </li>
  </ul>
</div>

<div class="content-single"> 
        <div class="left-col-ep">
            <label>Title</label>
            <input type="text" value="<?=$title;?>">
            <br>
            <label>Season</label>
            <input type="text" value="<?=$title;?>">
            <br>
            <label>Episode</label>
            <input type="text" value="<?=$title;?>">
            <br>
            <label>Description</label>
            <input type="textarea" value="<?=$description;?>">
            <br>
            <label>Ep Title</label>
            <input type="text" value="<?=$title;?>">
            <br>
            <label>URL</label>
            <input type="text" value="<?=$url;?>">
            <br>
            <label>Title</label>
            <input type="text" value="<?=$title;?>">
            <br>
            <label>Airdate</label>
            <input type="number" value="<?=$duration;?>">
            <br>

            <input type="submit" value="Save">
        </div>
        

</div>
<script>
$(document).ready(function(){
  $('#buton1').on('click', function(){
    $('#dropdown1').toggle();
  });
  $('.genre-item').on('click', function() {
    $(this).toggleClass('selected');
    var checkbox = $(this).find('input');
    checkbox.prop("checked", !checkbox.prop("checked"));
  });
});
</script>
</body>
</html>