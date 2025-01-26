<?php
include 'conexion.php';

// Función para comprobar si existe una tabla en BBDD
function existTable($conn, $tableName){
    $tableExistQuery = "SHOW TABLES LIKE '$tableName'";
    $result = mysqli_query($conn, $tableExistQuery);
    if(mysqli_num_rows($result) == 0){
        // La tabla no existe, se crea
        if ($tableName == 'usuarios') {
            $createTable = 'CREATE TABLE usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )';
        } else {
            return "Tabla desconocida.";
        }
        if(mysqli_query($conn, $createTable)){
            return "Tabla '$tableName' creada exitosamente.";
        } else {
            return "Error al crear la tabla '$tableName': " . mysqli_error($conn);
        }
    } else {
        return "La tabla '$tableName' ya existe.";
    }
};

// Función para registrar un usuario en BBDD
function registrarUsuario($conn, $user){
    $registarUsuarioQuery = "INSERT INTO users (username, email, password) VALUES (?, ? ,?)";
    $stmt = $conn->prepare($registarUsuarioQuery);
    $pass = password_hash($user['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $user['username'], $user['email'], $pass);
    try {
        if($stmt->execute()){
            return "Usuario regitrado correctamente.";
        }else{
            throw new Exception("Error al registrar usuario: ".$stmt->error) ;
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            return "Error: El correo electrónico ya está registrado.";
        } else {
            return "Error al registrar usuario: " . $e->getMessage();
        }
    }    
};

?>