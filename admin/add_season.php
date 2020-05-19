<?php 
include('conn.php');
include('some_functions.php');

if(isset($_REQUEST['tmdb_id']) && isset($_REQUEST['season'])){
    $tmdb_id = $_REQUEST['tmdb_id'];
    $season = $_REQUEST['season'];

    //tmdbID	season	poster
    $jeason = file_get_contents("https://api.themoviedb.org/3/tv/".$tmdb_id."/season/".$season."?api_key=29b41875fd9cc24c70edbf57405c2458");
    $data = json_decode($jeason);
    $poster = $data->poster_path;
    $sql = "INSERT IGNORE INTO season (tmdbID,season,poster)
                            VALUES('$tmdb_id','$season','$poster')";
                            
    if($conn->query($sql)){
        echo "success";
    }else echo "failed";
} 

?>