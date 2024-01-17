<?php
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);
    
    //изменение пароля
    if($data['user'] != null && $data['info'] == 'RePassword')
    {
        
        $sql_SELECT = "SELECT  `login`, `password` FROM `users` WHERE `login` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['user']['login']);
        mysqli_stmt_execute($stmt_SELECT);
        $result = mysqli_stmt_get_result($stmt_SELECT);
        $users = $result->fetch_assoc();

        if ($users == null || !password_verify($data['Oldpassword'], $users['password'])){
            $out['error'] = 'NotOldPass';
            $out['text'] = 'Неверный старый пароль';       
        }
        else{
            $Newpassword = password_hash($data['Newpassword'], PASSWORD_DEFAULT);

            $sql_SELECT = "UPDATE `users` SET `password`= ? WHERE `login` = ?";
            $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
            mysqli_stmt_bind_param($stmt_SELECT, 'ss', $Newpassword,  $data['user']['login']);
            mysqli_stmt_execute($stmt_SELECT);

            
            $out['error'] = 'edited';
            $out['text'] = 'Пароль изменен успешно';
          
        }

        

        $out['user'] = $users;

    }



    //изменение почты
    if($data['user'] != null && $data['info'] == 'email')
    {
        
        $sql_SELECT = "SELECT  `login`, `idRole`, `id`, `email` FROM `users` WHERE `login` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['user']['login']);
        mysqli_stmt_execute($stmt_SELECT);
        $result = mysqli_stmt_get_result($stmt_SELECT);
        $users = $result->fetch_assoc();

        if($data['email'] != $users['email']){
            $sql_SELECT = "SELECT  `id` FROM `users` WHERE `email` = ? AND `id` <> ?";
            $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
            mysqli_stmt_bind_param($stmt_SELECT, 'si', $data['email'], $users['id']);
            mysqli_stmt_execute($stmt_SELECT);
            $result = mysqli_stmt_get_result($stmt_SELECT);
            $email = $result->fetch_assoc();

            if($email == null){
                $sql_SELECT = "UPDATE `users` SET `email`=? WHERE `id` = ?";
                $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
                mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['email'],  $users['id']);
                mysqli_stmt_execute($stmt_SELECT);

                $sql_SELECT = "SELECT  `login`, `idRole` FROM `users` WHERE `login` = ?";
                $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
                mysqli_stmt_bind_param($stmt_SELECT, 's', $data['user']['login']);
                mysqli_stmt_execute($stmt_SELECT);

                $result = mysqli_stmt_get_result($stmt_SELECT);
                $users = $result->fetch_assoc();
                $out['error'] = 'edited';
                $out['text'] = 'Почта успешно изменена';
            }
            else{
                $out['error'] = 'notEdited';
                $out['text'] = 'Такая почта уже есть';
            }
        }

        

        $out['user'] = $users;

    }

    //изменение логина
    if($data['user'] != null && $data['info'] == 'login')
    {
        
        $sql_SELECT = "SELECT  `login`, `idRole`, `id` FROM `users` WHERE `login` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['user']['login']);
        mysqli_stmt_execute($stmt_SELECT);
        $result = mysqli_stmt_get_result($stmt_SELECT);
        $users = $result->fetch_assoc();

        if($data['login'] != $data['user']['login']){
            $sql_SELECT = "SELECT  `id` FROM `users` WHERE `login` = ? AND `id` <> ?";
            $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
            mysqli_stmt_bind_param($stmt_SELECT, 'si', $data['login'], $users['id']);
            mysqli_stmt_execute($stmt_SELECT);
            $result = mysqli_stmt_get_result($stmt_SELECT);
            $login = $result->fetch_assoc();

            if($login == null){
                $sql_SELECT = "UPDATE `users` SET `login`=? WHERE `id` = ?";
                $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
                mysqli_stmt_bind_param($stmt_SELECT, 'ss', $data['login'],  $users['id']);
                mysqli_stmt_execute($stmt_SELECT);

                $sql_SELECT = "SELECT  `login`, `idRole` FROM `users` WHERE `login` = ?";
                $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
                mysqli_stmt_bind_param($stmt_SELECT, 's', $data['login']);
                mysqli_stmt_execute($stmt_SELECT);

                $result = mysqli_stmt_get_result($stmt_SELECT);
                $users = $result->fetch_assoc();
                $out['error'] = 'edited';
                $out['text'] = 'Логин успешно изменен';
            }
            else{
                $out['error'] = 'notEdited';
                $out['text'] = 'Такой логин уже есть';
            }
        }

        

        $out['user'] = $users;

    }

    if( $data['user'] != null && $data['info'] == 'get')
    {

        $sql_SELECT = "SELECT  `login`, `email` FROM users WHERE `login` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $data['user']['login']);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $users = $result->fetch_assoc();

        $out['login'] = $users['login'];
        $out['email'] = $users['email'];

    }
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>