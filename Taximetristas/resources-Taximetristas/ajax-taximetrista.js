// se importa el archivo de css con Jquery para que no se recargue la pagina 
$.ajax({
  url: '../style/style-Taximetristas.css',
  dataType: 'css'
}).done(function(css) {
  $('<style>').html(css).appendTo('head');
});


// funcion para enviar los datos del formulario iniciar jornada
// evalua si el documento termino de cargar 
$(document).ready(function() {
    // Manejar el envío del formulario vía AJAX del formulario de INICAR JORNADA (HOME-TAXIMETRISTA)
    $('#formIniciarJornada').on('submit', function(event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

        // Obtener los datos del formulario
        var formData = $(this).serialize();

        // Hacer la petición AJAX
        $.ajax({
            type: 'POST',
            url: '../resources-Taximetristas/Peticiones/procesar-taximetrista.php', // Ruta del archivo PHP que procesará la solicitud
            data: formData,
            success: function(response) {
                let respuesta = JSON.parse(response);
                if (respuesta.success) {
                    $('.mensajeAJAX').text(respuesta.message).addClass('success-message');
                } else {
                    $('.mensajeAJAX').text(respuesta.message).addClass('error-message');
                }
    
                $('.respuestaAJAX').slideDown();
    
                // Ocultar después de 5 segundos
                setTimeout(function() {
                    $('.respuestaAJAX').slideUp();
                }, 5000); // 5000 milisegundos = 5 segundos
            },
            error: function() {
                $('.mensajeAJAX').text('Error al enviar los datos').addClass('error-message');
                $('.respuestaAJAX').slideDown();
    
                setTimeout(function() {
                    $('.respuestaAJAX').slideUp();
                }, 5000);
            }
        });
    });
});

// funcion para enviar los datos del formulario iniciar viaje
$('#formIniciarViaje').on('submit', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: '../resources-Taximetristas/Peticiones/procesar-taximetrista.php',
        data: formData, 
        success: function(response) {
           let respuesta = JSON.parse(response);
            
            if (respuesta.success) {
                $('.mensajeAJAX').text(respuesta.message).addClass('success-message');
            } else {
                $('.mensajeAJAX').text(respuesta.message).addClass('error-message');
            }

            $('.respuestaAJAX').slideDown();

            // Ocultar después de 5 segundos
            setTimeout(function() {
                $('.respuestaAJAX').slideUp();
            }, 5000); // 5000 milisegundos = 5 segundos
        },
        error: function() {
            $('.mensajeAJAX').text('Error al enviar los datos').addClass('error-message');
            $('.respuestaAJAX').slideDown();

            setTimeout(function() {
                $('.respuestaAJAX').slideUp();
            }, 5000);
        }
    });
});



// funcion para enviar los datos del formulario terminar jornada 
$(document).ready(function() {
$('#formFinalizarJornada').on('submit', function(event) {
    // hace que el formulario no haga su comportamiento predeterminado 
    //  osea que evita que se recarque
    event.preventDefault(); 

    // se obtiene los datos del formulario
    var formData = $(this).serialize();

    // hace la peticion con el metodo ajax de jquery
    $.ajax({
        type: 'POST',
        url: '../resources-Taximetristas/Peticiones/procesar-taximetrista.php', // envvia los datos q recibe de home-taximetrista a procesar-taximetrista.php
        data: formData, 
        success: function(response) {
            let respuesta = JSON.parse(response);
            if (respuesta.success) {
                $('.mensajeAJAX').text(respuesta.message).addClass('success-message');
            } else {
                $('.mensajeAJAX').text(respuesta.message).addClass('error-message');
            }

            $('.respuestaAJAX').slideDown();

            // Ocultar después de 5 segundos
            setTimeout(function() {
                $('.respuestaAJAX').slideUp();
            }, 5000); // 5000 milisegundos = 5 segundos
        },
        error: function() {
            $('.mensajeAJAX').text('Error al enviar los datos').addClass('error-message');
            $('.respuestaAJAX').slideDown();

            setTimeout(function() {
                $('.respuestaAJAX').slideUp();
            }, 5000);
        }
    });
});
});