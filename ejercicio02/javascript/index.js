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
        var formData = $(this).serializeArray();
        var jsonData = {};
        $.each(formData, function(){
            jsonData[this.name] = this.value;
        })
        $.ajax({
            url: '../php/scripts/tareas.php',
            data: JSON.stringify(jsonData),
            contentType: 'application/json ; charset=UTF-8',
            method: 'POST',
            success: function(response){
                $(".container").html(response);
            },
            error: function(){
                console.error("Error en la petición.");
            }
        });
    });
});