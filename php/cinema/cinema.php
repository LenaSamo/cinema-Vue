<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

    

    if($data["idFilm"] != null) {
        //получение информации о фильме
        $sql = "SELECT movies.`id`,`title_movie`,
        `year of release`,`timing`,`rental start date`, `rental companies`.`id_rental company`,
        `rental end date`,`rental company`,`description`,
        `ageLimit`, `country`
        FROM `movies`
        JOIN `countries` ON `movies`.`id_country`=`countries`.`id`
        JOIN `rental companies` ON `movies`.`id_rental company`=`rental companies`.`id_rental company`
        WHERE movies.`id` = '".$data["idFilm"]."'";
        $query = $mysqli->query($sql);
        $cinema = array();
        while($row = $query->fetch_array()){
            array_push($cinema, $row);
        }

        $out['movie'] = $cinema;

        


        //получение всех фотографий фильма
        $sql = "SELECT * FROM `photos film` 
        WHERE `id_film`='".$data["idFilm"]."'";

        $query = $mysqli->query($sql);
        $photos = array();
    
        while($row = $query->fetch_array()){
            array_push($photos, $row);
        }
        
        $out['photos'] = $photos;
            
        //получение рижессеров фильма
        $sql = "SELECT `name_director` 
        FROM `directors film` 
        JOIN `movies` ON `movies`.`id` = `id_film` 
        JOIN `directors` ON `directors`.`id` = `id_director` 
        WHERE `id_film` = '".$data["idFilm"]."'";

        $query = $mysqli->query($sql);
        $directors = array();
    
        while($row = $query->fetch_array()){
            array_push($directors, $row);
        }
        
        $out['directors'] = $directors;
        
        //получение актеров фильма
        $sql = "SELECT `name_actor`
        FROM `actors film` 
        JOIN `movies` ON `movies`.`id` = `id_film` 
        JOIN `actors` ON `actors`.`id` = `Id_actor` 
        WHERE `id_film` = '".$data["idFilm"]."'";

        $query = $mysqli->query($sql);
        $actors = array();
    
        while($row = $query->fetch_array()){
            array_push($actors, $row);
        }
        
        $out['actors'] = $actors;

         //получение рижессеров фильма
        $sql = "SELECT `genre` , `genres`.`id`
        FROM `genres film` 
        JOIN `movies` ON `movies`.`id` = `id_film` 
        JOIN `genres` ON `genres`.`id` = `id_genre` 
        WHERE `id_film` = '".$data["idFilm"]."'";

        $query = $mysqli->query($sql);
        $genres = array();
    
        while($row = $query->fetch_array()){
            array_push($genres, $row);
        }
        
        $out['genres'] = $genres;
        $out['idFilm'] = $data["idFilm"];
    }
    $mysqli->close();

    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>