<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

    

    if($data["idFilm"] != null && $data["idSession"] != null) {
        //получение информации о фильме и сессии
        $sql = "SELECT *
        FROM `sessions`
        JOIN `halls` ON `sessions`.`id_hall`=`halls`.`id`
        JOIN `ticket prices` ON `sessions`.`id_price`=`ticket prices`.`id`
        WHERE `sessions`.`id` = '".$data["idSession"]."'";
        $query = $mysqli->query($sql);
        $session = array();
        while($row = $query->fetch_array()){
            array_push($session, $row);
        }
        $sql = "SELECT *
        FROM `movies`
        WHERE `movies`.`id` = '".$data["idFilm"]."'";
        $query = $mysqli->query($sql);
        $movie = array();
        while($row = $query->fetch_array()){
            array_push($movie, $row);
        }
        $out['movie'] = $movie;
        $out['session'] = $session;

        


    }
    $mysqli->close();

    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>