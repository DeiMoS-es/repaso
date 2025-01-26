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
            contenType : 'application/json',
            data: JSON.stringify(jsonData),
            success: function(data){
                console.log(data);
                alert(data);
            },
            error: function(){
                console.error("Error en la petición.");
            }
        });
    });
});