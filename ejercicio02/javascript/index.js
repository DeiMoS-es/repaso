$(document).ready(function(){
    console.log("Script cargado.");
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

    $(document).on('click', '.btn.editar', function(){
        console.log("click");
    });
    $(document).on('click', '.btn.eliminar', function(){
        console.log("click");
    });

    $("#add-task").on("submit", function(event){
        event.preventDefault();
        $.ajax({
            url: '../php/scripts/tareas.php',
            data: $(this).serialize(),
            contentType: 'application/json',
            method: 'POST',
            success: function(response){
                console.log("HECHO");
                console.log(response);
            },
            error: function(){
                console.error("Error en la petición.");
            }
        });
    });
})
function getAllTasks(){
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
};
;