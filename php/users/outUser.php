<?php
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);
    if( $data['user'] != null)
    {
        $token = bin2hex(random_bytes(20));

        $sql_UPDATE = "UPDATE users SET autToken = ? WHERE `login` = ?";
        $stmt_UPDATE = mysqli_prepare($mysqli, $sql_UPDATE);
        mysqli_stmt_bind_param($stmt_UPDATE, 'ss', $token ,$data['user']['login']);
        mysqli_stmt_execute($stmt_UPDATE);

    }
    else  $out = array('error' => "Вы не вошли в систему!");
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>