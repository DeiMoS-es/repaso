<?php
// $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
// Si no se que variables me llegan desde el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    foreach($_POST as $key => $value){
        echo"-----------<br>";
        // echo htmlspecialchars($key) . ': ' . htmlspecialchars($value) . '<br>';
        $data[$key] = htmlspecialchars($value);
        // var_dump($data);
    }
    crearDataJson($data);
    getAllTasksFromJson();
}
elseif($_SERVER['REQUEST_METHOD'] === 'GET'){
    getAllTasksFromJson();
}
elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    $titleTask = $data['titleTask'];
    eliminarTarea($titleTask);
    getAllTasksFromJson();
}elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    $titleTask = $data['titleTask'];
    $estado = $data['estado'];
    editarEstadoTarea($titleTask, $estado);
    getAllTasksFromJson();
}
else{
    echo 'No se ha enviado nada';
}

function crearDataJson($data){
    $rutaJson = '../json/tareas.json';
    // Comprobar si el archivo existe
    if(!file_exists($rutaJson)){
        // Crear archivo
        file_put_contents($rutaJson, json_encode($data, JSON_PRETTY_PRINT));
    }else{
        // obtengo el json con información
        $dataJson = json_decode(file_get_contents($rutaJson), true); // true para que lo convierta en array asociativo
        if($dataJson != null){
            foreach($dataJson as $task){
                if($task['title'] === $data['title']){
                    echo 'La tarea ya existe<br>';
                    return;
                }
            }
        }
            $dataJson[] = $data;
            file_put_contents($rutaJson, json_encode($dataJson, JSON_PRETTY_PRINT));
        
    }
    // echo 'Archivo creado<br>';
};

function getAllTasksFromJson(){
    $jsonFile = json_decode(file_get_contents('../json/tareas.json'), true);
    $cabeceras = extraerCabeceras($jsonFile);
    echo '<table border="1">';
        if(!empty($cabeceras)){
            echo '<tr>';
                foreach($cabeceras as $cabecera){
                    echo '<th>'.ucfirst($cabecera).'</th>';
                }
                echo '<th>Opciones</th>';
            echo'</tr>';
            foreach($jsonFile as $key => $value){
                echo '<tr>';
                foreach($value as $a){
                    echo '<td>'.$a.'</td>';
                }
                echo '<td>
                        <button class="acciones editar">Editar</button>
                        <button class="acciones eliminar">Eliminar</button>
                      </td>';
                echo '</tr>';
            }
        }
    echo '</table>';
};

function extraerCabeceras($jsonFile){
    $cabeceras = [];
    if(is_array($jsonFile) && !empty($jsonFile)){
            $cabeceras = array_keys($jsonFile[0]);
    }
    return $cabeceras;
};

function eliminarTarea($titleTask){
    $rutaJson = '../json/tareas.json';
    if(!file_exists($rutaJson)){
        throw new Exception('El archivo no existe.');
    }
    try {
        $dataJson = json_decode(file_get_contents($rutaJson), true);
    } catch (Exception $e) {
        echo 'Error al leer el archivo JSON: ',  $e->getMessage(), "\n";
        return;
    }

    foreach($dataJson as $key => $task){
        if($task['title'] == $titleTask){
            unset($dataJson[$key]);
            file_put_contents($rutaJson, json_encode($dataJson), JSON_PRETTY_PRINT);
            echo 'Tarea eliminada correctamente <br>';
            return;
        }
    }
};
function editarEstadoTarea($titleTask, $estado){
    $rutaJson = '../json/tareas.json';
    if(!file_exists($rutaJson)){
        throw new Exception("No existe el JSON.");
    }
    try {
        $dataJson = json_decode(file_get_contents($rutaJson), true);
    } catch (Exception $e) {
        echo 'Error al leer el archivo JSON: ',  $e->getMessage(), "\n";
        return;
    }

    foreach($dataJson as $key => $task){
        if($task['title'] == $titleTask){
            $dataJson[$key]['estado'] = $estado;
            file_put_contents($rutaJson, json_encode($dataJson), JSON_PRETTY_PRINT);
            echo 'Tarea editada correctamente<br>';
            return;
        }
    }
}
?>