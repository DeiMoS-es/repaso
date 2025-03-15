<?php
    include '../bbdd/conexion.php';
    include '../bbdd/consultas.php';

    // Comprobar si existe la tabla de usuarios
    $tableExistMessage = existTable($conn, 'usuarios');
    // echo $tableExistMessage;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Para el registro, primero comprobamos si el usuario existe en bbdd
        $user = file_get_contents("php://input");
        $user = json_decode($user, true);
        $result  = registrarUsuario($conn, $user);
        echo $result;
    }else{
        return 'Error en el metodo de petición: '.$_SERVER['REQUEST_METHOD'];
    }
?>