<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);



    // $sql = "SELECT * FROM `genres`";
    // $query = $mysqli->query($sql);
    // $getGenres = array();

    // while($row = $query->fetch_array()){
    //     array_push($getGenres, $row);
    // }
    // $out['getGenres'] = $getGenres;

    $sql = "SELECT * FROM `countries`";
    $query = $mysqli->query($sql);
    $getСontry = array();

    while($row = $query->fetch_array()){
        array_push($getСontry, $row);
    }
    $out['getСontry'] = $getСontry;

    $sql = "SELECT * FROM `rental companies`";
    $query = $mysqli->query($sql);
    $getRental_company = array();

    while($row = $query->fetch_array()){
        array_push($getRental_company, $row);
    }

    $out['getRental_company'] = $getRental_company;

    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>