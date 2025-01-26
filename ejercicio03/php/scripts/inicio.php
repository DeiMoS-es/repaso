<?php
session_start(); // Inicio de sesión
include '../bbdd/conexion.php';
include '../bbdd/consultas.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = file_get_contents("php://input");
    $user = json_decode($user, true);
    $response = loginUser($conn, $user);
    $responseData = json_decode($response, true);
    if($responseData['message'] === 'Login correcto.'){
        echo json_encode(["redirect" => "protected.php"]);
    }else{
        echo $responseData['message'];
    }
} else{
    return 'Error en el metodo de petición: '.$_SERVER['REQUEST_METHOD'];
}

?>