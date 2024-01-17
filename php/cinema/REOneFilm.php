<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

     //обноваление поля страны
     if($data['re'] == 'country'){
        $sql_SELECT = "UPDATE `movies` SET `id_country`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['country'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Страна обновлено';
    }

    //обноваление поля описания
    if($data['re'] == 'description'){
        $sql_SELECT = "UPDATE `movies` SET `description`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['description'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Описание фильма обновлено';
    }

    //обноваление поля компании прокатчика
    if($data['re'] == 'rental_company'){
        $sql_SELECT = "UPDATE `movies` SET `id_rental company`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['rental_company'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Компания прокатчик обновлена';
    }

    //обноваление поля название фильма
    if($data['re'] == 'title'){
        $sql_SELECT = "UPDATE `movies` SET `title_movie`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['title'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Название фильма обновлено';
    }

    //обноваление поля начала проката
    if($data['re'] == 'rentalStartDate'){
        $sql_SELECT = "UPDATE `movies` SET `rental start date`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['rentalStartDate'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Дата начала проката обновлена';
    }

    //обноваление поля конца проката
    if($data['re'] == 'rentalEndDate'){
        $sql_SELECT = "UPDATE `movies` SET `rental end date`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['rentalEndDate'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Дата конца проката обновлена';
    }

    //обноваление поля год релиза
    if($data['re'] == 'yearOfRelease'){
        $sql_SELECT = "UPDATE `movies` SET `year of release`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['yearOfRelease'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Год релиза обновлен';
    }

    //обноваление поля хронометража
    if($data['re'] == 'timing'){
        $sql_SELECT = "UPDATE `movies` SET `timing`= ? WHERE `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['timing'], $data['idFilm']);
        mysqli_stmt_execute($stmt_SELECT);
        $out['error'] = 'edited';
        $out['text'] = 'Хронометраж обновлен';
    }

    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>