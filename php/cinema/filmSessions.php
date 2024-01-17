<?php 
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

    $dateNow = date('Y-m-d H:i:s');
    if($data["indexActive"] == 0){
        $today = date('Y-m-d H:i:s',  strtotime($dateNow));  
    }
    else $today = date('Y-m-d', strtotime("+".$data["indexActive"]." days", strtotime($dateNow)));  
    $stop_date = date('Y-m-d', strtotime("+1 day", strtotime($today)));

    if($data["idFilm"] != null){

        //получение всех сеансов по дате
        $sql = "SELECT sessions.`id`, `id_film`, `title_hall`, `datetime`, `price`, `movieFormat`
        FROM  sessions
        JOIN `ticket prices` ON `sessions`.`id_price` = `ticket prices`.`id`
        JOIN `halls` ON `sessions`.`id_hall` = `halls`.`id`
        WHERE `id_film`=".$data["idFilm"]
        ." AND (`datetime` >= '".$today."' AND `datetime` < '".$stop_date."')";
        $query = $mysqli->query($sql);
        $schedule = array();

        while($row = $query->fetch_array()){
            array_push($schedule, $row);
        }

        $out['sessions'] = $schedule;

    }
    $mysqli->close();

    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>