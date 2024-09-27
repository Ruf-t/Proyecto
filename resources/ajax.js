$(document).ready(function() {
    // Capturar el evento de envío del formulario
    $('#form-add-taxi').on('submit', function(e) {
        e.preventDefault();  // Evitar que se recargue la página

        // Obtener los datos del formulario
        var formData = $(this).serialize(); 

        // Enviar la petición AJAX
        $.ajax({
            type: 'POST',
            url: '../BaseDatos/peticiones-ajax.php',
            data: formData,
            dataType: 'json',  // Asegurarse de que se espera una respuesta en JSON
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.success) {
                    // Si la operación fue exitosa
                    $('.mensajeResult').text(response.message); // Corrección en el nombre de 'message'
                } else {
                    // Si hubo algún error
                    $('.mensajeResult').text(response.message); // Corrección en el nombre de 'message'
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
                console.log('XHR:', xhr);
                console.log('Status:', status);
                $('.mensajeResult').text('Ocurrió un error inesperado.');
              }
        });
    });
});


