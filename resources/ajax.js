// se importa el archivo de css con Jquery para que no se recargue la pagina 
$.ajax({
    url: '../style.css',
    dataType: 'css'
  }).done(function(css) {
    $('<style>').html(css).appendTo('head');
  });

// AÑADIR TAXI
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
                    $('.mensajeResult').text(response.message).addClass('success-message'); 
                    $('.respuestaAJAX').slideDown();
                } else {
                    // Si hubo algún error
                    $('.mensajeResult').text(response.message).addClass('error-message'); 
                    $('.respuestaAJAX').slideDown();
  
                    setTimeout(function() {
                        $('.respuestaAJAX').slideUp();
                    }, 5000)
                }
            },
            error: function(xhr, status, error) {

                $('.mensajeResult').text('Ocurrió un error inesperado.');
              }
        });
    });
});

//ACTUALIZAR DATOS TABLA VIAJE
$(document).ready(function() {
    // setInterval(function() {
    //     cargarTablaViajes();
    // }, 5000);

    // Actualizar datos de la tabla al hacer clic en el botón
    $('#recargar-tabla').click(function() {
        cargarTablaViajes();
    });

    // Función para cargar los datos de la tabla de viajes
    function cargarTablaViajes() {
        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php', // Asegúrate de que esta ruta sea correcta
            type: 'GET',
            data: { cargar_viajes: true }, // Indicador para cargar los viajes
            dataType: 'html',
            success: function(data) {
                console.log('Datos de respuesta:', data); // Para depurar
                $('#viajes-body').html(data); // Actualizar el cuerpo de la tabla
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los datos: " + error);
            }
        });
    }
});


$(document).ready(function() {
    $('#form-inicioS-admin').submit(function(e) {
        e.preventDefault(); // Evita la recarga de la página

        var user = $('#user').val();
        var contrasenia = $('#contrasenia').val();

        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',  
            type: 'POST',
            dataType: 'json',
            data: {
                user: user,
                contrasenia: contrasenia
            },
            success: function(response) {
                if (response.status === "success") {
                    window.location.href = '../layout/home.php';
                } else {
                    $('.mensajeAJAX').text(response.message).addClass('error-message');
                    $('.respuestaAJAX').slideDown(); 
                }
                // Ocultar después de 5 segundos
                setTimeout(function() {
                    $('.respuestaAJAX').slideUp();
                }, 5000);
            },
            error: function(error) {
                $('.mensajeAJAX').text('Ocurrió un error inesperado.').addClass('error-message');
                $('.respuestaAJAX').slideDown();
  
                setTimeout(function() {
                    $('.respuestaAJAX').slideUp();
                }, 5000);
            }
        });        
    });
});


