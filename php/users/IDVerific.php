<?php
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);
    if( $data['user'] != null)
    {

        $sql_SELECT = "SELECT  `idRole` FROM users WHERE `login` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['user']['login']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $users = $result->fetch_assoc();

        $out['user'] = $users;


    }
    else  $out = array('error' => "Вы не вошли в систему!");
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>