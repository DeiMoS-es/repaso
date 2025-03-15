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
            http_response_code(201);
            return json_encode(["message" => "Usuario registrado correctamente."]);
        }else{
            throw new Exception("Error al registrar usuario: ".$stmt->error) ;
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            http_response_code(409);
            return json_encode(["message" => "Error: El correo electrónico ya está registrado."]);
        } else {
            http_response_code(500);
            return json_encode(["message" => "Error al registrar usuario: " . $e->getMessage()]);
        }
    }    
};

// Función para el Login de usuarios
function loginUser($conn, $user){
    $findUserByUserName = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($findUserByUserName);
    $stmt->bind_param("s", $user['email']);
    try {
        if($stmt->execute()){
            // Obtener resultados
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                // El usuario existe
                $row = $result->fetch_assoc();
                if(password_verify($user['password'], $row['password'])){
                    // Inicio de sesión
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    http_response_code(200);
                    return json_encode(["message" => "Login correcto."]);
                }else{
                    http_response_code(401);
                    return json_encode(["message" => "Contraseña incorrecta."]);
                }
            }else{
                http_response_code(404);
                return json_encode(["message" => "Usuario no encontrado."]);
            }
        }else{
            http_response_code(500);
            return json_encode(["message" => "Error al ejecutar la consulta."]);
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        return json_encode(["message" => "Error del servidor: ". $th->getMessage()]);
    }
};

?>