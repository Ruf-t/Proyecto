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

// AÑADIR TAXIMETRISTA
$(document).ready(function() {
    // Capturar el evento de envío del formulario
    $('#form-add-taxistas').on('submit', function(e) {
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


// AÑADIR CLIENTE
$(document).ready(function() {
    // Enviar datos del formulario para añadir un cliente
    $('#form-add-cliente').on('submit', function(e) {
        e.preventDefault();  // Prevenir que se recargue la página

        var formData = $(this).serialize(); // Recoger los datos del formulario

        $.ajax({
            type: 'POST',
            url: '../BaseDatos/peticiones-ajax.php',
            data: formData,
            dataType: 'json',  // Esperamos respuesta en JSON
            success: function(response) {
                if (response.success) {
                    // Mostrar mensaje de éxito
                    $('.mensajeResult').text(response.message).addClass('success-message'); 
                    $('.respuestaAJAX').slideDown();

                    // Llamar a la función para actualizar la tabla de clientes
                    actualizarTablaClientes();
                } else {
                    // Mostrar mensaje de error
                    $('.mensajeResult').text(response.message).addClass('error-message'); 
                    $('.respuestaAJAX').slideDown();
                }
            },
            error: function(xhr, status, error) {
                console.log('Error al agregar cliente:', error);
            }
        });
    });

    // Función para actualizar la tabla de clientes
    function actualizarTablaClientes() {
        $.ajax({
            type: 'POST',
            url: '../BaseDatos/peticiones-ajax.php',
            data: { accion: 'mostrar_clientes' }, // Enviar acción específica al servidor
            dataType: 'json',
            success: function(data) {
                var tablaClientes = '';
                
                // Construir el contenido de la tabla dinámicamente
                $.each(data, function(index, cliente) {
                    tablaClientes += '<tr>';
                    tablaClientes += '<td>' + cliente.Nombre + '</td>';
                    tablaClientes += '<td>' + cliente.Apellido + '</td>';
                    tablaClientes += '<td>' + cliente.Telefono + '</td>';
                    tablaClientes += '<td>' + cliente.Direccion + '</td>';
                    tablaClientes += '<td>' + cliente.Deuda + '</td>';
                    tablaClientes += '<td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button>';
                    tablaClientes += '<button class="boton-papelera" onclick="eliminarCliente(' + cliente.ID + ')"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>';
                    tablaClientes += '</tr>';
                });

                // Actualizar el contenido de la tabla en el HTML
                $('table tbody').html(tablaClientes);
            },
            error: function(xhr, status, error) {
                console.log('Error al actualizar la tabla de clientes:', error);
            }
        });
    }
});


//ACTUALIZAR DATOS TABLA VIAJE
$(document).ready(function() {

    // Actualizar datos de la tabla al hacer clic en el botón
    $('#recargar-tabla').click(function() {
        cargarTablaViajes();
    });

//     // Función para cargar los datos de la tabla de viajes
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

//FUNCION CARGAR Y ACTUALIZAR TABLA VIAJES
$(document).ready(function() {
    // Función para aplicar filtros
    $('#turno, #fecha').on('change', function() {
        var turno = $('#turno').val();
        var fecha = $('#fecha').val();

        // Realizar la petición AJAX
        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: {
                turno: turno,
                fecha: fecha
            },
            success: function(response) {º
                // Actualizar el cuerpo de la tabla con los nuevos datos filtrados
                $('#viajes-body').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX:", status, error);
            }
        });
    });

    // Función para actualizar la tabla
    $('#recargar-tabla').click(function() {
        // Obtener los valores actuales de los selectores
        var turno = $('#turno').val();
        var fecha = $('#fecha').val();

        // Realizar la petición AJAX para recargar la tabla
        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: {
                turno: turno,
                fecha: fecha // Enviamos los filtros actuales
            },
            success: function(response) {
                // Actualizar el cuerpo de la tabla con los nuevos datos filtrados
                $('#viajes-body').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error al recargar la tabla:", status, error);
            }
        });
    });
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


