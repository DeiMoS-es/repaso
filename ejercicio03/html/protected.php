<?php
session_start();
if (isset($_SESSION['user_id'])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Protected</title>
    </head>

    <body>
        <h2>RUTA PROTEGIDA.</h2>
        <h3>Bienvenido Usuario: <?= $_SESSION['username'] ?></h3>
        <a href="../php/scripts/cierre.php">Cerrar Sesión</a>
    </body>

    </html>
<?php } else {
    header("Location: index.html");
    exit();
} ?>