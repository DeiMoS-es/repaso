$(document).ready(function(){
    console.log("Script cargado.");
    const divContainer = $(".container");
    // Mostramos las tareas
    $.ajax({
        url: '../php/tareas.php',
        method: 'GET',
        success: function(data){
            divContainer.html(data);
        },
        error: function(){
            console.error("Error en la petición.");
        }
    })
});