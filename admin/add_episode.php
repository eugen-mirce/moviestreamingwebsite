<?php 
include('conn.php');
include('some_functions.php');

//[tmdbID]	[season]	[episode]	title	description	airdate	[url]	slug
if(isset($_REQUEST['tmdbID']) && isset($_REQUEST['season']) && isset($_REQUEST['episode'])){
    $tmdbid = $_REQUEST['tmdbID'];
    $season = $_REQUEST['season'];
    $episode = $_REQUEST['episode'];
    $json = file_get_contents('https://api.themoviedb.org/3/tv/'.$tmdbid.'/season/'.$season.'/episode/'.$episode.'?api_key=29b41875fd9cc24c70edbf57405c2458');
    $data = json_decode($json);
    $title = $data->name;
    $disc = $data->overview;
    $airdate = $data->air_date;
    
    $json2 = file_get_contents('https://api.themoviedb.org/3/tv/'.$tmdbid.'?api_key=29b41875fd9cc24c70edbf57405c2458');
    $data2 = json_decode($json2);
    $slug = slugify($data2->name).'-'.$season.'-'.$episode;
    $sql = "INSERT IGNORE INTO episode (tmdbID,episode,season,title,description,airdate,url,slug)
                                    VALUES('$tmdbid','$episode','$season','$title','$disc','$airdate',NULL,'$slug')";
    if($conn->query($sql)){
        echo "success";
    }else echo "error";
        
}

?>