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
        <div class="left-col">
            <label>Title</label>
            <input type="text" value="<?=$title;?>">
            <br>
            <label>Description</label>
            <input type="textarea" value="<?=$description;?>">
            <br>
            <label>URL</label>
            <input type="text" value="<?=$url;?>">
            <br>
            <label>Poster</label>
            <input type="text" value="<?=$poster;?>">
            <br>
            <label>Trailer ID</label>
            <input type="text" value="<?=$trailer;?>">
            <br>
            <label>IMDB Rating</label>
            <input type="number" value="<?=$imdbRating;?>">
            <br>
            <label>Duration</label>
            <input type="number" value="<?=$duration;?>">
            <br>

            <input type="submit" value="Save">
        </div>
        <div class="right-col">
            <label>Year</label>
            <input type="number" value="<?=$year;?>">
            <br>
            <label>Release Date</label>
            <input type="date" value="<?=$releaseDate;?>">
            <br>
            <label>Genres</label>
            <div id="buton1">Choose genres</div>
            <div id="dropdown1">
              <?php $res = $conn->query("SELECT * FROM genre ORDER BY name LIMIT 27");
                while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                  $id = $row['id'];
                  $name = $row['name']; 
                  $bool = in_array($id, $genre) ? true : false;
                  ?>
                  <div class="genre-item <?php if($bool) echo 'selected';?>">
                    <input type="checkbox" name="genre[]" value="<?= $id;?>" <?php if($bool) echo 'checked';?>/><?= $name?><br>
                  </div>
              <?php } ?>
              <!--<div class="genre-item selected"><input type="checkbox" name="genre[]" value="Action" checked/>Action<br></div>
              <div class="genre-item"><input type="checkbox" name="genre[]" value="Comedy" />Comedy<br></div>
              <div class="genre-item"><input type="checkbox" name="genre[]" value="Thriller" />Thriller<br></div>-->
            </div>
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