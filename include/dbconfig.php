<?php
    $mysqli = new mysqli("localhost", "booksystdbuser", "12345", "booksystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }
?>
