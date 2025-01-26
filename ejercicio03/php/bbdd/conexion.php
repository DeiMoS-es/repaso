<?php
// Creamos la conexión a la bbdd
$host = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'test';
$port = 33065;

$conn = mysqli_connect($host, $username, $password, $databaseName, $port);
if(!$conn){
    die("No ha sido posible conectarse a la bbdd: " . mysqli_connect_error());
}
?>