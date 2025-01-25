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
    }else{
        return "La tabla 'tareas' ya existe";
    }
}
?>