<?php
// Archivo de conexión a la base de datos (conections.php)

$userName = 'uemployees';
$password = 'uemployees';
$database = 'employees';
$server = 'localhost';
$port = 3306;

$conexionID = new mysqli($server, $userName, $password, $database, $port);

// Verificar si la conexión es exitosa
if ($conexionID->connect_error) {
    die("Error de conexión: " . $conexionID->connect_error);
}
?>
