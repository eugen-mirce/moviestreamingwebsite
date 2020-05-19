<?php include('conn.php');

session_start();
if(isset($_SESSION['_admin_username'])) { 
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/f6cad20e11.js" crossorigin="anonymous"></script>
<style>
    .results {
        display: flex;
        justify-content: flex-start;
        align-content: center;
        flex-wrap: wrap;
    }
    .results div {
        display: block;
        width: 156px;
        margin: 10px;
        text-align: center;
        overflow:hidden;
        text-overflow: ellipsis;
        position: relative;
    }
    .results .not {
        cursor: pointer;
    }
    .title {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        cursor: initial;
    }
    img {
        border: 1px solid black;
    }
    .fas {
        top: 0;
        left: 0;
        z-index: 1000;
        position: absolute;
        color: white;
        margin: 0;
        padding: 5px;
    }
    .fa-check {
        background-color: green;
    }
    .fa-plus,
    .fa-circle-notch {
        background-color: blue;
    }
    .results .year {
        position: absolute;
        top: 0;
        right: 0;
        background: red;
        color: white;
        padding: 5px;
    }
</style>
<script src="../js/jquery-3.5.0.js"></script>
<script>
    //Pagination//

    //Call functions
    function add_media(element) {
        let type = element.data('type');
        let id = element.data('id');
            
        let u = '';
        if(type == 'movie') {
            u = 'add_movie.php';
        } else if(type == 'tv') {
            u = 'add_tv.php';
        } else {
            alert('Something is wrong.');
            return;
        }
        let i = element.find('i');
        element.removeClass('not');
        i.removeClass('fa-plus');
        i.addClass('fa-circle-notch');
        $.ajax({
            type: 'POST',
            url: u,
            data: {tmdb_id: id},
            success: function(data) {
                element.addClass('added');
                i.removeClass('fa-circle-notch');
                i.addClass('fa-check');
                //alert(data);
            },
            error: function(xhr) {
                i.removeClass('fa-circle-notch');
                i.addClass('fa-plus');
                element.addClass('not');
                alert('Error: '+xhr.status+' '+xhr.statusText);
            }
        }); 
    }
    $(document).ready(function(){
        $('.not').on('click', function(){
            add_media($(this));
        });
    });
    function fetch_all() {
        $('.not').each(function(){
            add_media($(this));
        });
    }

</script>
</head>
<body>
    <div class="header">
    </div>
    <div class="form">
        <form id="form" action="" method="POST">
            <label for="type">Type: </label>
            <select name="type" id="type">
                <?php if(isset($_POST['type']) && $_POST['type'] == 'tv') { ?>
                    <option value="movie">Movie</option>
                    <option value="tv" selected>Tv</option>
                <?php } else { ?>
                    <option value="movie" selected>Movie</option>
                    <option value="tv">Tv</option>
                <?php } ?>
            </select>

            <label for="year">Year: </label>
            <input type="text" name="year" id="year" pattern="\d*" maxlength="4" value="2020">
            
            <label for="genre">Genre: </label>
            <select name="genre" id="genre">
                <option>All</option>
                <option>Action</option>
            </select>

            <input type="text" name="search" id="search" minlength="3" placeholder="Search..." <?php if(isset($_POST['search'])) echo 'value="'.$_POST["search"].'"';?>>
            <input type="hidden" name="page" id="page" value="<?= $page;?>">
            <input type="submit" value="Search">

            <?php //if(isset($_POST['submit'])) {?>
                <button type="button" onclick="fetch_all()">Fetch All</button>
            <?php //}?>
        </form>
    </div>
    <div class="results posters">
        <?php if(isset($_REQUEST['type']) && isset($_REQUEST['year'])) {
            $type = $_REQUEST['type'];
            $year = $_REQUEST['year'];
            
            $genre = '';
            $year_parameter	= ( $type == 'tv' ) ? 'first_air_date_year=' : 'primary_release_year=';
            if(isset($_REQUEST['genre']) && $_REQUEST['genre'] != 'All') { 
                $genre = '&with_genres='.$genre;
            }
            if(isset($_REQUEST['search']) && $_REQUEST['search']) {
                $word = $_REQUEST['search'];
                $url = "https://api.themoviedb.org/3/search/".$type."?api_key=29b41875fd9cc24c70edbf57405c2458&query=".$word."&page=".$page."&include_adult=false";
                $url = str_replace(' ','%20',$url);
                $json = file_get_contents($url);
                //echo $url;
            } else {
                $url = "https://api.themoviedb.org/3/discover/".$type."?api_key=29b41875fd9cc24c70edbf57405c2458&sort_by=popularity.desc&include_adult=false&include_video=false&".$year_parameter.$year.$genre."&page=".$page;
                $json = file_get_contents($url);
                //echo $url;
            }
            $data = json_decode($json);
            foreach($data->results as $r) {
                $tmdb_id = $r->id;
                $title = $type == 'tv' ? $r->name : $r->title;
                $poster_path = $r->poster_path ? 'https://image.tmdb.org/t/p/w154'.$r->poster_path : 'http://localhost/web/img/no-poster.jpg';
                $year = $type == 'tv'? substr($r->first_air_date,0,4) : substr($r->release_date,0,4);
                if($year == null || $year == '') $year = 'N/A'; 
                $sql = "SELECT * FROM media WHERE tmdbID = '$tmdb_id'";
                $res = $conn->query($sql);
                $added = false;
                if($res->num_rows == 1) {
                    $added = true;
                } ?>
                <div class="<?php if($added) echo 'added'; else echo 'not';?>" data-type="<?= $type?>" data-id="<?= $tmdb_id;?>">
                    <img src='<?= $poster_path;?>' width="154px" height="231px">
                    <span class="title"><?= $title;?></span>
                    <span class="year"><?= $year?></span>
                    <?php if($added) { ?>
                    <i class="fas fa-check"></i>
                    <?php } else {?>
                    <i class="fas fa-plus"></i>
                    <?php } ?>
                </div>
            <?php }
        } ?>
    </div>
</body>
</html>
<?php } else {
    die('Unauthorized access.');
}?>