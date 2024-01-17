<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);


    if ($data['unput'] == 'genres') {
        $sql = "SELECT * FROM `genres` WHERE `genre` LIKE '%".$data['inputgenre']."%'";
        $query = $mysqli->query($sql);
        $genres = array();
    
        while($row = $query->fetch_array()){
            array_push($genres, $row);
        }
        $out['genres'] = $genres;
    
    }

    if ($data['unput'] == 'directors') {
        $sql = "SELECT * FROM `directors` WHERE `name_director` LIKE '%".$data['inputDirectors']."%'";
        $query = $mysqli->query($sql);
        $directors = array();
    
        while($row = $query->fetch_array()){
            array_push($directors, $row);
        }
        $out['directors'] = $directors;
    
    }
    if ($data['unput'] == 'actors') {
        $sql = "SELECT * FROM `actors` WHERE `name_actor` LIKE '%".$data['inputActors']."%'";
        $query = $mysqli->query($sql);
        $actors = array();
    
        while($row = $query->fetch_array()){
            array_push($actors, $row);
        }
        $out['actors'] = $actors;
    
    }
    if ($data['unput'] == 'inputgenre') {
        $sql_SELECT = "SELECT * FROM `genres` WHERE `genre` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['inputgenre']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $genre = $result->fetch_assoc();

        if ($genre != null){
            $out = array('error' => "Данный жанр уже существует");     
        }
        else{
            $sql_INSERT = "INSERT INTO `genres`(`genre`)
            VALUES (?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 's', $data['inputgenre']);
            mysqli_stmt_execute($stmt_INSERT);
            
        }   
        $out['add'] = "genres add";

        $sql = "SELECT * FROM `genres` WHERE `genre` LIKE '%".$data['inputgenre']."%'";
        $query = $mysqli->query($sql);
        $genres = array();
    
        while($row = $query->fetch_array()){
            array_push($genres, $row);
        }
        $out['genres'] = $genres;
    }
    if ($data['unput'] == 'inputActors') {
        $sql_SELECT = "SELECT * FROM actors WHERE `name_actor` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['inputActors']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $name_director = $result->fetch_assoc();

        if ($name_director != null){
            $out = array('error' => "Данный актер уже существует");		
        }
        else{
            $sql_INSERT = "INSERT INTO `actors`(`name_actor`)
            VALUES (?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 's', $data['inputActors']);
            mysqli_stmt_execute($stmt_INSERT);
            
        } 	
        $out['add'] = "Actor add";

        $sql = "SELECT * FROM `actors` WHERE `name_actor` LIKE '%".$data['inputActors']."%'";
        $query = $mysqli->query($sql);
        $actors = array();
    
        while($row = $query->fetch_array()){
            array_push($actors, $row);
        }
        $out['actors'] = $actors;
    }
    if ($data['unput'] == 'inputDirectors') {
        $sql_SELECT = "SELECT * FROM directors WHERE `name_director` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['inputDirectors']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $name_director = $result->fetch_assoc();

        if ($name_director != null){
            $out = array('error' => "Данный режиссер уже существует");		
        }
        else{
            $sql_INSERT = "INSERT INTO `directors`(`name_director`)
            VALUES (?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 's', $data['inputDirectors']);
            mysqli_stmt_execute($stmt_INSERT);
            
        } 	
        $out['add'] = "Director add";

        $sql = "SELECT * FROM `directors` WHERE `name_director` LIKE '%".$data['inputDirectors']."%'";
        $query = $mysqli->query($sql);
        $directors = array();
    
        while($row = $query->fetch_array()){
            array_push($directors, $row);
        }
        $out['directors'] = $directors;
    }
    
    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>