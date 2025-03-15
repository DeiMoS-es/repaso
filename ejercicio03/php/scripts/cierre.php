<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión
header("Location: ../../html/index.html"); // Redirige a la página de inicio de sesión (ajusta la ruta según la estructura de tus directorios)
exit(); // Asegúrate de salir después de redirigir
?>
