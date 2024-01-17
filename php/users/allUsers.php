<?php
    $out = array('error' => false);
    
    $crud = 'read';
    if(isset($_GET['crud'])){
        $crud = $_GET['crud'];
    }
    if($crud = 'read'){
        $sql = "SELECT users.id, email, date_reg, roles.role FROM users
        JOIN roles ON roles.id = users.roleID";
        $query = $mysqli->query($sql);
        $users = array();
    
        while($row = $query->fetch_array()){
            array_push($users, $row);
        }
        
        $out['users'] = $users;

        $sql = "SELECT * FROM roles";
        $query = $mysqli->query($sql);
        $roles = array();
    
        while($row = $query->fetch_array()){
            array_push($roles, $row);
        }
        $out['roles'] = $roles;
    }
    
    
    $mysqli->close();
    
    header("Content-type: application/json");
    echo json_encode($out);
    die();
?>