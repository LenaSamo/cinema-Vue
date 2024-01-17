<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    
    $data = json_decode(file_get_contents('php://input'),true);

    if ($data['id'] != null) {
        $sql_SELECT = "DELETE FROM `sessions` WHERE  `id` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 'i', $data['id']);
        mysqli_stmt_execute($stmt_SELECT);

        $out = array('error' => false);
        include("/xampp/htdocs/vue/php/cinema/sessions.php");
    }
    else $out = array('error' => true);

    

    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>