<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

        $idFilm =  $data['idFilm'];
        $date =  date('Y-m-d H:i:s',  strtotime($data['date']));  
        $hall =  $data['hall'];
        $price = $data['price'];
        $format = mysqli_real_escape_string($mysqli,  $data['format']);

        $sql_SELECT = "SELECT  `datetime`, `id_hall`, `id_film`, `timing`
                        FROM `sessions` 
                        JOIN `movies` ON (`id_film` = `movies`.`id` )
                        WHERE `id_hall` = ? AND DATE(`datetime`) = DATE(?)";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'is',  $hall, $date);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $sessions = array();
        $film = array();
        while($row = $result->fetch_assoc()){
            array_push($sessions, $row);
        }
        $out['sessions'] = $sessions; 
        $out['FilmSession'] = false; 
        if ($sessions == null){
            $out['add'] = 'Session net';

            $sql = "SELECT `id`, `rental start date`, `rental end date`
            FROM `movies` 
            WHERE `id` = '".$idFilm."' AND (`rental start date` <= DATE('".$date."') 
                                            AND `rental end date` >= DATE('".$date."')
                                            AND DATE(DATE_ADD('".$date."', INTERVAL `timing` MINUTE)) = DATE('".$date."'))";

            $query = $mysqli->query($sql);
            $sessions = array();
            while($row = $query->fetch_assoc()){
                array_push($sessions, $row);
            }
            if ($sessions != null){

                $sql_INSERT = "INSERT INTO `sessions`
                                ( `datetime`, `id_hall`, `id_film`, `id_price`, `movieFormat`) 
                                VALUES (?,?,?,?,?)";
                $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
                mysqli_stmt_bind_param($stmt_INSERT, 'siiis', 
                                        $date, $hall,
                                        $idFilm, $price, 
                                        $format);
                mysqli_stmt_execute($stmt_INSERT);
                $out['FilmSession'] = true;   
            }
            else{
                $out['FilmSession'] = false;  
            }
        }
        else{
            $check = true;
            for ($i = 0; $i < count($sessions); $i++) 
            { 
                $dateSession = $sessions[$i]['datetime'];
                $timingSession = $sessions[$i]['timing'];
                
                $sql = "SELECT `id`, `rental start date`, `rental end date`
                        FROM `movies` 
                        WHERE `id` = '".$idFilm."' AND (`rental start date` <= DATE('".$date."') 
                                                        AND `rental end date` >= DATE('".$date."')
                                                        AND DATE(DATE_ADD('".$date."', INTERVAL `timing` MINUTE)) = DATE('".$date."'))
                        AND 
                        (
                            (
                                '".$date."' < '".$dateSession."'
                                AND DATE_ADD('".$date."', INTERVAL `timing` MINUTE) < '".$dateSession."'
                                AND TIMEDIFF ('".$dateSession."', DATE_ADD('".$date."', INTERVAL `timing` MINUTE)) >= 10
                            )
                            OR 
                            (
                                '".$date."' > DATE_ADD('".$dateSession."', INTERVAL '".$timingSession."' MINUTE) 
                                AND DATE_ADD('".$date."', INTERVAL `timing` MINUTE) > DATE_ADD('".$dateSession."', INTERVAL '".$timingSession."' MINUTE) 
                                AND TIMEDIFF ('".$date."', DATE_ADD('".$dateSession."', INTERVAL '".$timingSession."' MINUTE)) >= 10
                            )
                        ) ";

                $query = $mysqli->query($sql);
                $FilmSession = array();
            
                while($row = $query->fetch_array()){
                    array_push($FilmSession, $row);
                }    
                if($FilmSession == false){ 
                    $check = false; 
                }
            }
            $out['film'] = $FilmSession;
            if($check == false){ 
                $out['FilmSession'] = false;     
            }
            else if($check != false){
                //добавление фильма
                $sql_INSERT = "INSERT INTO `sessions`
                                ( `datetime`, `id_hall`, `id_film`, `id_price`, `movieFormat`) 
                                VALUES (?,?,?,?,?)";
                $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
                mysqli_stmt_bind_param($stmt_INSERT, 'siiis', 
                                        $date, $hall,
                                        $idFilm, $price, 
                                        $format);
                mysqli_stmt_execute($stmt_INSERT);
                $out['FilmSession'] = true;     
            }

        }
         $sql = "SELECT `sessions`.`id`, `datetime`, `title_hall`,  `price`, `movieFormat` 
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
       


        
   
    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>
