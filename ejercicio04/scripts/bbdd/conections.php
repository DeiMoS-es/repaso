<?php
// creo la conexión a la bbdd
$userName = 'uemployees';
$password = 'uemployees';
$database = 'employees';
$server = 'localhost';
$port = 3306;
$conexion = new mysqli($server, $userName, $password, $database, $port);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>