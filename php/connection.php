<?php
    $mysqli = new mysqli("localhost", "root", "", "cinema");
    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
?>