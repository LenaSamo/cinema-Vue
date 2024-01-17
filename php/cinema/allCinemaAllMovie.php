<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);
    
    $sql = "SELECT `movies`.`id`,`title_movie`,`year of release`,
            `timing`,`rental start date`,`rental end date`,`id_rental company`,`description`,
            `ageLimit`
            FROM `movies`";
    $query = $mysqli->query($sql);
    $cinema = array();

    while($row = $query->fetch_array()){
        array_push($cinema, $row);
    }
    for ($i = count($cinema) - 1; $i >= 0; $i--) { 
        $sql = "SELECT `genres film`.`id`, `id_film`, `id_genre`, `genre` 
        FROM `genres film` 
        JOIN `genres` ON  ( `id_genre`= `genres`.`id` )
        JOIN `movies` ON (`id_film`=`movies`.`id`)
        WHERE `id_film`='".$cinema[$i]['id']."'";

        $query = $mysqli->query($sql);
        $listsgenres = array();
    
        while($row = $query->fetch_array()){
            array_push($listsgenres, $row);
        }
        
        array_push($cinema[$i], $listsgenres); 
        
        
    }
    for ($i = count($cinema) - 1; $i >= 0; $i--) { 
        $sql = "SELECT * FROM `photos film` 
        WHERE `id_film`='".$cinema[$i]['id']."' limit 1";

        $query = $mysqli->query($sql);
        $listsgenres = array();
    
        while($row = $query->fetch_array()){
            array_push($listsgenres, $row);
        }
        
        array_push($cinema[$i], $listsgenres); 
        
        
    }
    $out['cinema'] = $cinema;
    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>