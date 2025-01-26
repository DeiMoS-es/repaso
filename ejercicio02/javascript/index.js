$(document).ready(function(){
    const divContainer = $(".container");
    // Mostramos las tareas
    $.ajax({
        url: '../php/scripts/tareas.php',
        method: 'GET',
        success: function(data){
            divContainer.html(data);
        },
        error: function(){
            console.error("Error en la petición.");
        }
    });

    $(document).on('click', '.btn.editar', editarEstado);
    $(document).on('click', '.btn.eliminar', eliminar);

    $("#add-task").on("submit", function(event){
        event.preventDefault();
        var formData = $(this).serializeArray();
        var jsonData = {};
        $.each(formData, function(){
            jsonData[this.name] = this.value;
        });
        $.ajax({
            url: '../php/scripts/tareas.php',
            data: JSON.stringify(jsonData),
            contentType: 'application/json; charset=UTF-8',
            method: 'POST',
            success: function(response){
                $(".container").html(response);
            },
            error: function(){
                console.error("Error en la petición.");
            }
        });
    });

    function eliminar(){
        let idTarea = $(this).parent().parent().children().first().text();
        $.ajax({
            url: '../php/scripts/tareas.php',
            data: idTarea,
            method: 'DELETE',
            success: function(response){
                $(".container").html(response);
                // console.log(response);
            },
            error: function(){
                console.error("Error en la petición.");
            }
        });
    };

    function editarEstado(){
        let idTarea = $(this).parent().parent().children().first().text();
        crearFormEditar(idTarea);
        $("#edit-task").on("submit", function(event){
            event.preventDefault();
            const estadoNuevo = $(this).find("input[name='nuevoEstado']:checked").val();
            $.ajax({
                url: '../php/scripts/tareas.php',
                method: 'PUT',
                data: JSON.stringify({id: idTarea, estado: estadoNuevo }),
                success: function(data){
                    console.log(data);
                    $(".container").empty();
                    $(".container").html(data);
                },
                error: function(){
                    console.error("Error al editar la tarea.");
                }
            });
        })
    };
    function crearFormEditar(idTarea){
        let formEditar = $(`
                            <form id="edit-task">
                                <label for="nuevoEstado">Selecciona el nuevo estado:</label>
                                <br>
                                <label><input type="radio" name="nuevoEstado" value="pendiente">Pendiente</label>
                                <label><input type="radio" name="nuevoEstado" value="curso">Progreso</label>
                                <label><input type="radio" name="nuevoEstado" value="completada">Completada</label>
                                <input type="hidden" name="idTarea" value="${idTarea}">
                                <input type="submit" value="Editar estado">
                            </form>
                        `);
        $(".container").append(formEditar);
    };
});