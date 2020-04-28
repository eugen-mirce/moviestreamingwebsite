<?php 
include('conn.php'); 
include('some_functions.php');

$tmdb_id = 1399;
$season = 2;

//Get TV Show Average Duration
$tv_info = json_decode(file_get_contents('https://api.themoviedb.org/3/tv/'.$tmdb_id.'?api_key=29b41875fd9cc24c70edbf57405c2458&language=en-US'));
$duration = $tv_info->episode_run_time[0];
$title = $tv_info->name;
$title = slugify($title);

//Get Season Information
$json = file_get_contents('https://api.themoviedb.org/3/tv/'.$tmdb_id.'/season/'.$season.'?api_key=29b41875fd9cc24c70edbf57405c2458&language=en-US');

$data = json_decode($json);
$poster = $data->poster_path;

$sql = "INSERT IGNORE INTO season(tmdbID,season,poster) VALUES ('$tmdb_id', '$season', '$poster')";
if ($conn->query($sql)) {
    echo "Season Created Successfully.<br>";

    $data = $data->episodes;
    for($i = 0; $i<count($data); $i++) {
        $episode = $data[$i]->episode_number;
        $slug = $title.'-'.$season.'x'.$episode;
        $ep_title = $data[$i]->name;
        $desc = $data[$i]->overview;
        $description = str_replace("'","''",$data[$i]->overview); // Escape ' characters
        $airdate = $data[$i]->air_date;
        $sql = "INSERT IGNORE INTO episode (tmdbID, season, episode, duration, slug, title, description, airdate) VALUES ('$tmdb_id', '$season', '$episode', '$duration', '$slug','$ep_title','$description','$airdate')";
        if ($conn->query($sql)) {
            echo "Episode Created Successfully.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        //echo $airdate.'<br>';
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>