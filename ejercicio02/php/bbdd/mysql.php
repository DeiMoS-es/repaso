<?php
    $host = '127.0.0.1';
    $database = 'test';
    $port = 33065;
    $username = 'root';
    $pass  = '';

    $conn = mysqli_connect($host, $username, $pass, $database, $port);
    if(!$conn){
        die("No ha sido posible conectarse a la bbdd: " . mysqli_connect_error());
    }
?>