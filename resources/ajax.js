// se importa el archivo de css con Jquery para que no se recargue la pagina 
$.ajax({
    url: '../style.css',
    dataType: 'css'
  }).done(function(css) {
    $('<style>').html(css).appendTo('head');
  });

// // AÑADIR TAXI
// $(document).ready(function() {
//     // Capturar el evento de envío del formulario
//     $('#form-add-taxi').on('submit', function(e) {
//         e.preventDefault();  // Evitar que se recargue la página

//         // Obtener los datos del formulario
//         var formData = $(this).serialize(); 

//         // Enviar la petición AJAX
//         $.ajax({
//             type: 'POST',
//             url: '../BaseDatos/peticiones-ajax.php',
//             data: formData,
//             dataType: 'json',  // Asegurarse de que se espera una respuesta en JSON
//             success: function(response) {
//                 console.log("Respuesta del servidor:", response);
//                 if (response.success) {
//                     // Si la operación fue exitosa
//                     $('.mensajeResult').text(response.message).addClass('success-message'); 
//                     $('.respuestaAJAX').slideDown();
//                 } else {
//                     // Si hubo algún error
//                     $('.mensajeResult').text(response.message).addClass('error-message'); 
//                     $('.respuestaAJAX').slideDown();
  
//                     setTimeout(function() {
//                         $('.respuestaAJAX').slideUp();
//                     }, 5000)
//                 }
//             },
//             error: function(xhr, status, error) {

//                 $('.mensajeResult').text('Ocurrió un error inesperado.');
//               }
//         });
//     });
// });

// AÑADIR TAXI
$(document).ready(function() {
    // Capturar el evento de envío del formulario
    $('#form-add-taxi').on('submit', function(e) {
        e.preventDefault();  // Evitar que se recargue la página

        // Limpiar mensajes anteriores
        $('.mensajeResultModal').removeClass('success-message error-message').text('');

        // Validar los campos antes de enviar
        var matricula = $('#matricula').val().trim();
        var modelo = $('#modelo').val().trim();
        var anio = $('#anio').val().trim();
        var estado = $('#estado').val();
        var error = false;
        var errorMessage = '';

       // Obtener el año actual
       var currentYear = new Date().getFullYear();
       var maxYear = currentYear + 2;

       // Verificar si algún campo está vacío
       if (matricula === '' || modelo === '' || anio === '' || estado === '') {
           errorMessage = 'Debe completar todos los campos.';
       } else {
           if (matricula.length < 7 || matricula.length > 8) {
               errorMessage = 'La matrícula debe tener entre 7 y 8 caracteres.';
           } else if (modelo.length < 3 || modelo.length > 20) {
               errorMessage = 'El modelo debe tener entre 3 y 20 caracteres.';
           } else if (!/^\d{4}$/.test(anio)) {
               errorMessage = 'El año debe ser un número de 4 dígitos.';
           } else {
               // Validar el rango del año
               if (anio < 1990 || anio > maxYear) {
                   errorMessage = 'El año debe ser un número entre 1990 y ' + maxYear + '.';
               }
           }
       }

        // Si hay errores, mostrar el mensaje
        if (errorMessage) {
            $('.mensajeResultModal').html(errorMessage).addClass('error-message'); 
            $('.respuestaAJAX-Modal').slideDown();
            setTimeout(function() {
                $('.respuestaAJAX-Modal').slideUp();
            }, 5000); // Ocultar el mensaje después de 5 segundos
            return false;  // Detener el envío del formulario
        }

        // Si todo está bien, enviar la petición AJAX
        var formData = $(this).serialize();  // Obtener los datos del formulario

        $.ajax({
            type: 'POST',
            url: '../BaseDatos/peticiones-ajax.php',
            data: formData,
            dataType: 'json',  // Asegurarse de que se espera una respuesta en JSON
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.success) {
                    // Si la operación fue exitosa
                    $('.mensajeResultModal').html(response.message).addClass('success-message'); 
                    $('.respuestaAJAX-Modal').slideUp();
                } else {
                    // Si hubo algún error en la respuesta del servidor
                    $('.mensajeResultModal').html(response.message).addClass('error-message'); 
                    $('.respuestaAJAX-Modal').slideUp();
  
                    setTimeout(function() {
                        $('.respuestaAJAX-Modal').slideDown();
                    }, 5000);
                }
            },
            error: function(xhr, status, error) {
                // Si ocurre un error inesperado en la solicitud AJAX
                $('.mensajeResultModal').html('Ocurrió un error inesperado.').addClass('error-message');
                $('.respuestaAJAX-Modal').slideDown();
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

//ACTUALIZAR TABLA TAXIS
$(document).ready(function() {
    $('#recargar-tabla-taxista').click(function() {
        $.ajax({
            url: 'peticiones-ajax.php', // Cambia por la ruta real a tu script PHP
            type: 'GET',
            success: function(data) {
                // Actualizar el cuerpo de la tabla con la respuesta
                $('#tabla-taxistas').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar los datos: ' + error);
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


//FUNCION CARGAR Y ACTUALIZAR TABLA VIAJES
$(document).ready(function() {
    $('#turno, #fecha').on('change', function() {
        var turno = $('#turno').val();
        var fecha = $('#fecha').val();

        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: {
                turno: turno,
                fecha: fecha
            },
            success: function(response) {º
                $('#viajes-body').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX:", status, error);
            }
        });
    });

    $('#recargar-tabla').click(function() {
        var turno = $('#turno').val();
        var fecha = $('#fecha').val();

        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: {
                turno: turno,
                fecha: fecha 
            },
            success: function(response) {
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


// Archivo ajax.js

// $(document).ready(function() {
//     // Llamada AJAX para obtener los datos
//     $.ajax({
//         url: '../BaseDatos/peticiones-ajax.php', // Cambia por la ruta correcta
//         method: 'GET',
//         success: function(response) {
//             // Asegúrate de que la respuesta sea un array de objetos JSON
//             const data = JSON.parse(response);
            
//             // Limpiar el contenido actual del tbody (si es necesario)
//             $("#tabla-ingresos tbody").empty();
            
//             // Iterar sobre los datos y agregar las filas correspondientes
//             data.forEach(function(item) {
//                 const row = `
//                     <tr>
//                         <td>${item.numero_taxi}</td>
//                         <td>${item.taxista}</td>
//                         <td>${item.turnos}</td>
//                         <td>${item.fecha}</td>
//                         <td>${item.ingreso}</td>
//                     </tr>
//                 `;
//                 // Agregar la fila al tbody de la tabla
//                 $("#tabla-ingresos tbody").append(row);
//             });
//         },
//         error: function(error) {
//             console.error("Error al obtener los datos:", error);
//         }
//     });
// });

// $(document).ready(function() {
//     function obtenerTotalTarifasPorTodasJornadas() {
//         $.ajax({
//             url: '../BaseDatos/peticiones-ajax.php', // Ruta a tu archivo PHP
//             type: 'POST',
//             data: {
//                 action: 'obtener_tarifas' // Solo envía la acción, ya no el ID de la jornada
//             },
//             dataType: 'json',
//             success: function(response) {
//                 if (response.length > 0) {
//                     // Limpiar el contenido anterior
//                     $('#resultado').empty();

//                     // Recorrer los resultados y mostrarlos
//                     response.forEach(function(jornada) {
//                         $('#resultado').append(
//                             '<p>Jornada ID: ' + jornada.id_jornada + ' - Total de tarifas: ' + jornada.total_tarifas + '</p>'
//                         );
//                     });
//                 } else {
//                     $('#resultado').text('No se encontraron tarifas para las jornadas.');
//                 }
//             },
//             error: function() {
//                 $('#resultado').text('Error al obtener las tarifas.');
//             }
//         });
//     }

//     // Llamada a la función para obtener las tarifas de todas las jornadas
//     obtenerTotalTarifasPorTodasJornadas();
// });
