<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

    

    if($data["idFilm"] != null) {
        //получение информации
        $sql = "SELECT `sessions`.`id`, `datetime`, `id_hall`, `title_hall`, `id_price`, `price`, `movieFormat` 
        FROM `sessions`
        JOIN `halls` ON `sessions`.`id_hall`=`halls`.`id`
        JOIN `ticket prices` ON `sessions`.`id_price`=`ticket prices`.`id`
        WHERE `sessions`.`id_film` = '".$data["idFilm"]."'";
        $query = $mysqli->query($sql);
        $sessons = array();
        while($row = $query->fetch_array()){
            array_push($sessons, $row);
        }

        $out['sessons'] = $sessons;

    }
    $mysqli->close();

    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>