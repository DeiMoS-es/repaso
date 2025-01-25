<?php 
include '../bbdd/mysql.php';
include 'functions.php';

$tableExistsQuery = "SHOW TABLES LIKE 'tareas'";
$result = mysqli_query($conn, $tableExistsQuery);

// Comprobar si la tabla existe, y si no existe se crea
$exisTable = existTable($conn, $result);
// Ends points
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    
}
echo $exisTable;
?>