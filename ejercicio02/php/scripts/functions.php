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
            $tasks[] = $fila;
        }
        return json_encode($tasks, JSON_PRETTY_PRINT);
    }else{
        return json_encode(["message" => "No hay tareas."]);
    }
};

function createTask($conn, $task){
    $queryCreateTask = "INSERT INTO tareas (titulo, descripcion, estado) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($queryCreateTask); // Consultas "preparadas" para evitar inyección sql
    $stmt->bind_param("sss", $task['titulo'], $task['descripcion'], $task['estado']); // el parámetro "sss" indica que todos los valores son de tipo string, si fuesen distintos podría ser i: Integer, d: Double, s: String, b: Blob(binarios)
    if($stmt->execute()){
        return "Tarea creada exitosamente.";
    }else{
        return "Error al crear la tarea: ".$stmt->error;
    }
};

function deleteTask($conn, $idTask){
    $queryDeleteTask = "DELETE FROM tareas WHERE id = ?";
    $stmt = $conn->prepare($queryDeleteTask);
    $stmt->bind_param("i", $idTask);
    if($stmt->execute()){
        return "Tarea eliminada.";
    }else{
        return "Error al eliminar la tarea. ".$stmt->error;
    }
};

function editarEstadoTask($conn, $data){
    $idTask = $data['id'];
    $estado = $data['estado'];
    $queryEditTask = "UPDATE tareas SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($queryEditTask);
    $stmt->bind_param("si", $estado, $idTask);
    if($stmt->execute()){
        return "Estado modificado.";
    }else{
        return "Error al editar el estado: ".$stmt->error;
    }
}
?>