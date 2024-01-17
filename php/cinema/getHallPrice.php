<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

    if ($data['unput'] == 'addPrice') {
        $sql_SELECT = "SELECT * FROM `ticket prices` WHERE `price` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['addPrice']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $name_director = $result->fetch_assoc();

        if ($name_director != null){
            $out = array('error' => "Данный цена уже существует");      
        }
        else{
            $dateNow = date('Y-m-d H:i:s');
            $sql_INSERT = "INSERT INTO `ticket prices`(`price`, `timestamp_price`)
            VALUES (?, ?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 'ss', $data['addPrice'], $dateNow);
            mysqli_stmt_execute($stmt_INSERT);
            
        }   
        $out['add'] = "addPrice add";
    }


    $sql = "SELECT * FROM `halls`";
    $query = $mysqli->query($sql);
    $gethalls = array();

    while($row = $query->fetch_array()){
        array_push($gethalls, $row);
    }
    $out['hall'] = $gethalls;

    $sql = "SELECT * FROM `ticket prices`";
    $query = $mysqli->query($sql);
    $getprice = array();

    while($row = $query->fetch_array()){
        array_push($getprice, $row);
    }
    $out['price'] = $getprice;

    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>