<?php
// Consulta SQL para obtener empleados
$querySelectEmployees = "SELECT * FROM employees";

// Ejecutar la consulta
$result = mysqli_query($conexionID, $querySelectEmployees); // Usamos la variable $conexion directamente

// Verificar si la consulta devolvió resultados
if ($result) {
    // Recuperar todos los resultados
    $rowResult = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $totalRows = mysqli_num_rows($result);

    // Almacenar los resultados en la variable $empleados
    if ($totalRows > 0) {
        $empleados = $rowResult;
    } else {
        $empleados = [];  // Si no hay empleados, asigna un array vacío
    }
} else {
    $empleados = [];  // Si la consulta falló, asigna un array vacío
}
?>
