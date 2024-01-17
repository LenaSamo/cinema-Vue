<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

   


    
    if ($data['unput'] == 'addrental_company') {
        $sql_SELECT = "SELECT * FROM `rental companies` WHERE `rental company` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['addrental_company']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $name_director = $result->fetch_assoc();

        if ($name_director != null){
            $out['error'] = 'notedited';
            $out['text'] = 'Данная компания уже существует';	
        }
        else{
            $sql_INSERT = "INSERT INTO `rental companies`(`rental company`)
            VALUES (?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 's', $data['addrental_company']);
            mysqli_stmt_execute($stmt_INSERT);
            $out['error'] = 'edited';
            $out['text'] = 'Компания добавлена';
            
        } 	
        $out['add'] = "addrental_company add";

        $sql = "SELECT * FROM `rental companies`";
        $query = $mysqli->query($sql);
        $getRental_company = array();
    
        while($row = $query->fetch_array()){
            array_push($getRental_company, $row);
        }
    
        $out['getRental_company'] = $getRental_company;
    
    }

    if ($data['unput'] == 'addcontry') {
        $sql_SELECT = "SELECT * FROM countries WHERE `country` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['addcontry']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $name_director = $result->fetch_assoc();

        if ($name_director != null){
            $out['error'] = 'notedited';
            $out['text'] = 'Данная страна уже существует';	
        }
        else{
            $sql_INSERT = "INSERT INTO `countries`(`country`)
            VALUES (?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 's', $data['addcontry']);
            mysqli_stmt_execute($stmt_INSERT);
            $out['error'] = 'edited';
            $out['text'] = 'Страна добавлена';
        } 	
        

        $sql = "SELECT * FROM `countries`";
        $query = $mysqli->query($sql);
        $getСontry = array();
    
        while($row = $query->fetch_array()){
            array_push($getСontry, $row);
        }
        $out['getСontry'] = $getСontry;
    
    }
    

    if ($data['unput'] == 'addgenre') {
        $sql_SELECT = "SELECT * FROM genres WHERE `genre` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['addgenre']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $name_director = $result->fetch_assoc();

        if ($name_director != null){
            $out = array('error' => "Данный жанр уже существует");		
        }
        else{
            $sql_INSERT = "INSERT INTO `genres`(`genre`)
            VALUES (?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 's', $data['addgenre']);
            mysqli_stmt_execute($stmt_INSERT);
            
        } 	
        $out['add'] = "addgenre add";

        $sql = "SELECT * FROM `genres`";
        $query = $mysqli->query($sql);
        $getGenres = array();
    
        while($row = $query->fetch_array()){
            array_push($getGenres, $row);
        }
        $out['getGenres'] = $getGenres;
    
    }
    
    
    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>