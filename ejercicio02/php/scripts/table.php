<?php
function tableTasks($tasks)
{
    $tasksArray = json_decode($tasks, true);
    $keys = array_keys($tasksArray[0]);
    $tasks = json_decode($tasks, true);
    // var_dump($keys);
    // var_dump($tasks);
?>
    <table border="1" id="tasks" class="table-tasks">
        <tr>
            <?php foreach ($keys as $key) { ?>
                <th><?= $key ?></th>
            <?php } ?>
            <th>Opciones</th>
        </tr>
        <?php foreach ($tasks as $key => $task) { ?>
            <tr>
                <?php foreach ($task as $value) { ?>
                    <td><?= $value ?></td>
                <?php } ?>
                <td>
                    <button class="btn editar">Editar</button>
                    <button class="btn eliminar">Eliminar</button>
                </td>
            <?php } ?>
            </tr>
    </table>
<?php } ?>