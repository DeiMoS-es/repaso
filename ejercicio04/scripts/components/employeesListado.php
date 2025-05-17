<?php

?>
<div class="container">
    <h2>Lista de empleados</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Género</th>
                <th>Fecha de nacimiento</th>
                <th>Fecha de contratación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado) { ?>

                <tr>
                    <td class=""><?php echo $empleado['emp_no']; ?></td>
                    <td class=""><?php echo $empleado['first_name']; ?></td>
                    <td class=""><?php echo $empleado['last_name']; ?></td>
                    <td class=""><?php echo $empleado['gender'] ?></td>
                    <td class=""><?php echo $empleado['birth_date'] ?></td>
                    <td class=""><?php echo $empleado['hire_date'] ?></td>
                </tr>

            <?php } ?>
        </tbody>
</div>