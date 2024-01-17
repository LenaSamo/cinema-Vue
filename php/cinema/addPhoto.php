<?php
    date_default_timezone_set('Asia/Yekaterinburg');
    include("/xampp/htdocs/vue/php/connection.php");
    $out = array('error' => false);

        
        $idFIlm = json_decode($_POST['data'],true);
        
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
        
        $out = array('img' => $idFIlm);
       

    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>
