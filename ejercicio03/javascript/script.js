$(document).ready(function(){
    $("#register-form").on("submit", function(event){
        event.preventDefault();
        let formData = $(this).serializeArray();
        let jsonData = {};
        $.each(formData, function(){
            jsonData[this.name] = this.value;
        });
        $.ajax({
            url: '../php/scripts/registro.php',
            method: 'POST',
            contentType : 'application/json',
            data: JSON.stringify(jsonData),
            success: function(data){
                alert(data);
                // Verificar si la respuesta contiene un mensaje de éxito
                if (data.includes("Usuario registrado correctamente")) {
                    // Redirigir a index.html en caso de éxito
                    window.location.href = 'index.html';
                };
            },
            error: function(error){
                let errorJson = JSON.parse(error.responseText);
                console.error(errorJson.message);
            }
        });
    });
});