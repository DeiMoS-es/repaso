<?php
// Función para comprobar si una tabla existe en BBDD
function existTable($conn, $result){
    if(mysqli_num_rows($result) == 0){
        // La tabla no existe se crea:
        $createTable = 'CREATE TABLE tareas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(255) NOT NULL,
            descripcion TEXT,
            estado VARCHAR(255) NOT NULL,
            fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )';
        if(mysqli_query($conn, $createTable)){
            return "Tabla 'tareas' creada exitosamente";
        }else{
            return "Error al crear la tabla: " . mysqli_error($conn);
        }
    }
};

// Función para obtener todas las tareas
function getAllTasks($conn){
    $queryGetAllTasks = "SELECT * FROM tareas";
    $results = $conn->query($queryGetAllTasks);
    $tasks = [];
    if($results->num_rows > 0){
        while($fila = $results->fetch_assoc()){
            $tasks = $fila;
        }
        return json_encode($tasks, JSON_PRETTY_PRINT);
    }else{
        return json_encode(["message" => "No hay tareas."]);
    }
};

function createTask($task){
    
}
?>