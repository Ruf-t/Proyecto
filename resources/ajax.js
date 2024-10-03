// se importa el archivo de css con Jquery para que no se recargue la pagina 
$.ajax({
    url: '../style.css',
    dataType: 'css'
  }).done(function(css) {
    $('<style>').html(css).appendTo('head');
  });


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
                    $('.mensajeResult').text(response.message); 
                } else {
                    // Si hubo algún error
                    $('.mensajeResult').text(response.message); 
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


//APLICAR FILTROS 
$(document).ready(function() {
    // Capturamos los selectores de turno y fecha
    const $turnoSelect = $("#turno");
    const $fechaSelect = $("#fecha");

    // Función para enviar los filtros a través de AJAX
    function aplicarFiltros() {
        const turno = $turnoSelect.val();
        const fecha = $fechaSelect.val();

        // Enviar los datos por AJAX
        $.ajax({
            type: "POST",
            url: "../BaseDatos/peticiones-ajax.php",
            data: {
                turno: turno,
                fecha: fecha
            },
            success: function(response) {
                // Insertar la respuesta en la tabla de viajes
                $("#tabla-viajes tbody").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX:", error);
            }
        });
    }

    // Escuchar cambios en los selectores y aplicar los filtros
    $turnoSelect.change(aplicarFiltros);
    $fechaSelect.change(aplicarFiltros);
});




// $(document).ready(function() {
//     $('#form-inicioS-admin').submit(function(e) {
//         e.preventDefault(); // Evita la recarga de la página

//         var user = $('#user').val();
//         var contrasenia = $('#contrasenia').val();

//         $.ajax({
//             url: '../BaseDatos/peticiones-ajax.php',  
//             type: 'POST',
//             dataType: 'json',
//             data: {
//                 user: user,
//                 contrasenia: contrasenia
//             },
//             success: function(response) {
//             if (response.status === "success") {
//                 window.location.href = '../layout/home.php';
//                 } else {
//                     $('.mensajeAJAX').text(response.message);
//                     $('.respuestaAJAX').slideDown().addClass('success-message').attr('id', 'respuestaAJAX-index'); 
//                 }
//                   // Ocultar después de 5 segundos
//               setTimeout(function() {
//                 $('.respuestaAJAX').slideUp();
//             }, 5000); // 5000 milisegundos = 5 segundos
//             },
//             error: function(error) {
//                 $('.mensajeAJAX').text('Ocurrió un error inesperado.').addClass('error-message');

//                   $('.respuestaAJAX').slideDown();
  
//                   setTimeout(function() {
//                       $('.respuestaAJAX').slideUp();
//                   }, 5000);
//             }
//         });        
//     });
// });

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


