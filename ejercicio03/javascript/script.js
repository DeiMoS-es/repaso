$(document).ready(function(){
    // Registro de usuario
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
                alert(errorJson.message);
                console.error(errorJson.message);
            }
        });
    });

    // Login usuario
    $("#login-form").on("submit", function(event){
        event.preventDefault();
        let formData = $(this).serializeArray();
        let jsonData = {};
        $.each(formData, function(){
            jsonData[this.name] = this.value
        });
        $.ajax({
            url: '../php/scripts/inicio.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(jsonData),
            success: function(data){
                if (typeof data === "string") {
                    data = JSON.parse(data); // Convertir a objeto si es una cadena JSON
                }
                console.log(data.redirect);
                if(data.redirect){
                    window.location.href = data.redirect;
                }
            },
            error: function(error){
                let errorJson = JSON.parse(error.responseText);
                console.log(errorJson);
                alert(errorJson);
                console.error(errorJson);
            }
        });
    });
});