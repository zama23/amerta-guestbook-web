<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'db_amerta';
    $conn = mysqli_connect($host, $user, $pass, $db);

    mysqli_select_db($conn, $db);
?>