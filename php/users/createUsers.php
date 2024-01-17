<?php
 include("../connection.php");
    $data = json_decode(file_get_contents("php://input"));
    if($data == ''){
        echo "error";
    }
    
    if(preg_match('/^([A-z0-9]+([\-\_.]?[A-z0-9]+)*)@([A-z]+\.[A-z]+)$/u', $data[0]) 
    && preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/', $data[1])
    && $data[2] == 1)
    {
        date_default_timezone_set('Asia/Yekaterinburg');
        $email = mysqli_real_escape_string($mysqli,  $data[0]);
        $password2 = password_hash($data[1], PASSWORD_DEFAULT);
        $date = date("y.m.d");
        $idRole = $data[2];

        $sql_SELECT = "SELECT * FROM users WHERE email = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $email);
        mysqli_stmt_execute($stmt_SELECT);
        $result = mysqli_stmt_get_result($stmt_SELECT);
        $user = $result->fetch_assoc();

        if(mysqli_num_rows($result)){
            echo 'Данный пользователь существует';
        }
        else{
            $sql_INSERT = "INSERT INTO `users` (`email`, `password`, `date_reg`, `roleID`) 
            VALUES (?, ?, ?, ?)";
            $stmt_INSERT = mysqli_prepare($mysqli, $sql_INSERT);
            mysqli_stmt_bind_param($stmt_INSERT, 'sssi', $email, $password2, $date, $idRole);
            mysqli_stmt_execute($stmt_INSERT);

            echo "ok";
        }
    }
    else {
        echo 'Введите верно информацию';
    }
?>
