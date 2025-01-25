<?php
function tableTasks($tasks){ 
    $keys = array_keys(json_decode($tasks, true));
    $tasks = json_decode($tasks, true);
?>
<table border="1" id="tasks" class="table-tasks">
    <tr>
        <?php foreach($keys as $key){ ?>
            <th><?= $key ?></th>
        <?php } ?>
        <th>Opciones</th>
    </tr>
    <tr>
        <?php foreach($tasks as $key => $task){ ?>            
            <td><?= $task ?></td>        
        <?php }?>
        <td>
            <button class="btn editar">Editar</button>
            <button class="btn eliminar">Eliminar</button>
        </td>    
    </tr>
</table>
<?php } ?>