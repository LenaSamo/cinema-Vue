<?php	
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);
    $data = json_decode(file_get_contents('php://input'),true);

// if(!empty($_POST['toComeIn_Person']))
// {
    if(preg_match('/^[\D](.*)[\w]$/', $data['login']))
    {
        $password = mysqli_real_escape_string($mysqli, $data['password']) ;
        $login = mysqli_real_escape_string($mysqli, $data['login']);
        $token = bin2hex(random_bytes(20));

        $sql_SELECT = "SELECT * FROM users WHERE `login` = ?";
        $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
        mysqli_stmt_bind_param($stmt_SELECT, 's', $login);
        mysqli_stmt_execute($stmt_SELECT);

        $result = mysqli_stmt_get_result($stmt_SELECT);
        $users = $result->fetch_assoc();

        if ($users == null || !password_verify($password, $users['password'])){
            $out = array('error' => "Пароль или логин неверен");		
        }
        else{

            $sql_SELECT = "SELECT `login`, `idRole` FROM users WHERE `login` = ?";
            $stmt_SELECT = mysqli_prepare($mysqli, $sql_SELECT);
            mysqli_stmt_bind_param($stmt_SELECT, 's', $login);
            mysqli_stmt_execute($stmt_SELECT);

            $result = mysqli_stmt_get_result($stmt_SELECT);

            $users = $result->fetch_assoc();

            // $_SESSION['user'] = $users;
            $out['user'] = $users;

            $sql_UPDATE = "UPDATE users SET autToken = ? WHERE `login` = ?";
            $stmt_UPDATE = mysqli_prepare($mysqli, $sql_UPDATE);
            mysqli_stmt_bind_param($stmt_UPDATE, 'ss', $token ,$login);
            mysqli_stmt_execute($stmt_UPDATE);

            // header ('Location: main.php');
            
            
        } 	
        
    }
    else  $out = array('error' => "Введите верно имя");
    header("Content-type: application/json");
    echo json_encode($out);
    die();
// };
?>