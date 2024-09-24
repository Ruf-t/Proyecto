$(document).ready(function() {
    // Capturar el evento de envío del formulario
    $('#form-add-taxi').on('submit', function(e) {
        e.preventDefault();  // Evitar que se recargue la página

        // Obtener los datos del formulario
        var formData = $(this).serialize(); 

        // Enviar la petición AJAX
        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: formData,
            // dataType: 'json',  // Asegurarse de que se espera una respuesta en JSON
            success: function(response) {
                let respuesta = JSON.parse(response);
                if (respuesta.success) {
                    // Si la operación fue exitosa
                    $('#resultado').html(`<p class="success">${respuesta.message}</p>`);
                } else {
                    // Si hubo algún error
                    $('#resultado').html(`<p class="error">${respuesta.message}</p>`);
                }
            },
            error: function() {
                $('#resultado').html('Ocurrió un error inesperado.');
            }
        });
    });
});


