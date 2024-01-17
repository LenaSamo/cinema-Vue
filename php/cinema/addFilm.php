<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode($_POST['data'],true);
    // if(preg_match('/^([A-z0-9]+([\-\_.]?[A-z0-9]+)*)@([A-z]+\.[A-z]+)$/u', $data[0]) 
    // && preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/', $data[1])
    // && $data[2] == 1)
    // {
        $title_movie = mysqli_real_escape_string($mysqli,  $data['title_movie']);
        $contry =  $data['contry'];
        $year_of_release = mysqli_real_escape_string($mysqli,  $data['year_of_release']);
        $genres =  $data['genres'];
        $timing = mysqli_real_escape_string($mysqli,  $data['timing']);
        $rental_start_date = $data['rental_start_date'];
        $rental_end_date = $data['rental_end_date'];
        $rental_company = $data['rental_company'];
        $description = mysqli_real_escape_string($mysqli,  $data['description']);
        $ageLimit = $data['ageLimit'];

        
       //добавление фильма
        $sql_INSERT = "INSERT INTO `movies` (`title_movie`, `id_country`, 
                                            `year of release`,  `timing`, 
                                            `rental start date`, `rental end date`, 
                                            `id_rental company`, `description`, `ageLimit`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
        mysqli_stmt_bind_param($stmt_INSERT, 'sissssisi', 
        $title_movie, $contry,
        $year_of_release, 
        $timing, $rental_start_date,
        $rental_end_date, $rental_company,
        $description, $ageLimit);
        mysqli_stmt_execute($stmt_INSERT);


        $sql_SELECT = "SELECT movies.`id`
        FROM `movies` 
        WHERE `title_movie` = ? AND 
        `id_country` = ? AND ? = `year of release` 
         AND `timing` = ? AND
        `rental start date` = ?
        AND `rental end date` = ? AND
        `id_rental company` = ? AND `description` = ?
        AND `ageLimit` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT,'sissssisi', 
        $title_movie, $contry,
        $year_of_release, 
        $timing, $rental_start_date,
        $rental_end_date, $rental_company,
        $description, $ageLimit);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $movies = $result->fetch_assoc();
        //добавление жанров к фильму
        $idFIlm = $movies['id'];
        for ($i = count($data['genres']) - 1; $i >= 0; $i--) { 
            $sql_INSERT = "INSERT INTO `genres film`( `id_film`, `id_genre`)
                            VALUES (?, ?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 'ii', 
            $idFIlm, $data['genres'][$i][1]);
            mysqli_stmt_execute($stmt_INSERT);
        }
        //добавление режиссеров к фильму
        for ($i = count($data['directors']) - 1; $i >= 0; $i--) { 
            $sql_INSERT = "INSERT INTO `directors film`( `id_film`, `id_director`)
                            VALUES (?, ?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 'ii', 
            $idFIlm, $data['directors'][$i][1]);
            mysqli_stmt_execute($stmt_INSERT);
        }
        //добавление актеров к фильму
        for ($i = count($data['actors']) - 1; $i >= 0; $i--) { 
            $sql_INSERT = "INSERT INTO `actors film`(`Id_actor`, `id_film`)
                            VALUES (?, ?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 'ii', 
            $data['actors'][$i][1], $idFIlm);
            mysqli_stmt_execute($stmt_INSERT);
        }
        //добавление фото к фильму
        if(!empty($_FILES['file']))
        {     
            $tmp_name = $_FILES["file"]["name"];
            $name = basename($_FILES["file"]["name"]);
            move_uploaded_file($tmp_name, "C:/xampp/htdocs/vue/img/$name");
            $image= mysqli_real_escape_string($mysqli, $_FILES['file']['name']);
        
            $sql_INSERT = "INSERT INTO `photos film` (`photo`, `id_film`) 
            VALUES (?, ?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 'si', $image, $idFIlm);
            mysqli_stmt_execute($stmt_INSERT);
            
        }
        
        $out = array('id' => $idFIlm);
        
    // }
    // else {
    //     echo 'Введите верно информацию';
    // }
    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>
