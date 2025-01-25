<?php 
include '../bbdd/mysql.php';
include 'functions.php';
include 'D:/xampp8/htdocs/estudio/ejercicio02/php/scripts/table.php';

$tableExistsQuery = "SHOW TABLES LIKE 'tareas'";
$result = mysqli_query($conn, $tableExistsQuery);

// Comprobar si la tabla existe, y si no existe se crea
$exisTable = existTable($conn, $result);
// Ends points
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $tasks = getAllTasks($conn);
    tableTasks($tasks);
    // var_dump($tasks);
}
elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $task = file_get_contents("php://input");
    $task = json_decode($task, true);
    createTask($conn, $task);
    $tasks = getAllTasks($conn);
    tableTasks($tasks);
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $idTask = file_get_contents("php://input");
    deleteTask($conn, $idTask);
    $tasks = getAllTasks($conn);
    tableTasks($tasks);
}
else{
    echo "nada.";
}
// echo $exisTable;
?>