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


//LOGIN ADMINISTRADOR 
$(document).ready(function(){
    $('#form-inicioS-admin').submit(function(event){
        event.preventDefault(); // Evita el envío del formulario por defecto

        // Capturamos los datos del formulario
        let user = $('#user').val();
        let contrasenia = $('#contrasenia').val();

        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php', // Envía los datos a login-bd.php
            type: 'POST',
            data: {
                user: user,
                contrasenia: contrasenia
            },
            success: function(response){
                let res = JSON.parse(response); // Convertimos la respuesta en JSON
                if(res.status === "success"){
                    window.location.href = "../layout/home.php"; // Redirige al usuario
                } else {
                    $('#respuestaAJAX-index .mensajeAJAX').text(res.message);
                }
            },
            error: function(){
                $('#respuestaAJAX-index .mensajeAJAX').text("Error en la solicitud. Intente nuevamente.");
            }
        });
        
    });
    
});




// REGISTRO DE ADMINISTRADOR 
$(document).ready(function() {
    $('#form-register').on('submit', function(e) {
        e.preventDefault();
        
        // Recopilar datos del formulario
        const formData = {
            NombreNuevo_Administrador: $('#NombreNuevo_Administrador').val().trim(),
            ApellidoNuevo_Administrador: $('#ApellidoNuevo_Administrador').val().trim(),
            TelefonoNuevo_Administrador: $('#TelefonoNuevo_Administrador').val().trim(),
            DireccionNuevo_Administrador: $('#DireccionNuevo_Administrador').val().trim(),
            UserNuevo_Administrador: $('#UserNuevo_Administrador').val().trim(),
            contraseniaNuevo_Administrador: $('#contraseniaNuevo_Administrador').val().trim()
        };

        // Validación de campos con requerimientos específicos
        let errorMsg = '';

        // Validación de Nombre: máximo 20 letras
        if (!/^[A-Za-z]{1,20}$/.test(formData.NombreNuevo_Administrador)) {
            errorMsg += 'El nombre debe contener solo letras y tener un máximo de 20 caracteres.\n';
        }

        // Validación de Apellido: máximo 25 letras
        if (!/^[A-Za-z]{1,25}$/.test(formData.ApellidoNuevo_Administrador)) {
            errorMsg += 'El apellido debe contener solo letras y tener un máximo de 25 caracteres.\n';
        }

        // Validación de Teléfono: exactamente 9 dígitos
        if (!/^\d{9}$/.test(formData.TelefonoNuevo_Administrador)) {
            errorMsg += 'El teléfono debe contener exactamente 9 dígitos.\n';
        }

        // Validación de Dirección: al menos una letra y un número
        if (!/^(?=.*[A-Za-z])(?=.*\d).+$/.test(formData.DireccionNuevo_Administrador)) {
            errorMsg += 'La dirección debe contener al menos una letra y un número.\n';
        }

        // Validación de Usuario: una mayúscula, solo letras, máximo 20 caracteres
        if (!/^(?=.*[A-Z])[A-Za-z]{1,20}$/.test(formData.UserNuevo_Administrador)) {
            errorMsg += 'El usuario debe contener al menos una letra mayúscula y tener un máximo de 20 caracteres.\n';
        }

        // Validación de Contraseña: una mayúscula, una minúscula, un número, entre 6 y 20 caracteres
        if (!/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{6,20}$/.test(formData.contraseniaNuevo_Administrador)) {
            errorMsg += 'La contraseña debe tener al menos una mayúscula, una minúscula, un número, y entre 6 y 20 caracteres.\n';
        }

        // Si hay errores, mostrar mensajes y detener la ejecución
        if (errorMsg) {
            alert(errorMsg);
            return;
        }
    
        // Realizar la petición AJAX si pasa todas las validaciones
        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    alert(response.message || 'Administrador registrado correctamente');
                    $('#form-register')[0].reset();
                } else {
                    alert(response.message || 'Error al registrar el administrador');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición:', error);
                alert('Hubo un problema en la conexión. Inténtalo de nuevo más tarde.');
            }
        });
    });
});

//TAXIMETRISTAS DEL MES 
$(document).ready(function() {
    // Función para obtener el ranking de taxistas
    function obtenerRankingTaxistas() {
        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            method: 'POST',
            data: { action: 'get_ranking_taxistas' },
            dataType: 'json',
            success: function(response) {
                // Limpiamos el contenedor donde se mostrará el ranking
                $('.ranking-taxistas').empty();
                
                if (response.success) {
                    response.data.forEach((taxista, index) => {
                        // Creamos el div contenedor principal
                        const div = document.createElement('div');
                        div.classList.add('taxista-item');
                        
                        // Creamos el contenedor para el índice y nombre del taxista
                        const nombreContainer = document.createElement('div');
                        nombreContainer.classList.add('nombre-container');
                        
                        // Añadimos el índice y el nombre en una línea
                        const indice = document.createElement('span');
                        indice.classList.add('indice');
                        indice.textContent = `${index + 1}.`;
                        
                        const nombreTaximetrista = document.createElement('span');
                        nombreTaximetrista.classList.add('nombre-taximetrista');
                        nombreTaximetrista.textContent = `${taxista.nombre_taximetrista}`;
                        
                        // Agregamos el índice y el nombre en el contenedor de nombre
                        nombreContainer.appendChild(indice);
                        nombreContainer.appendChild(nombreTaximetrista);
                        
                        // Creamos el contenedor para el total generado con el texto
                        const totalContainer = document.createElement('div');
                        totalContainer.classList.add('total-container');
                        
                        const totalGeneradoText = document.createElement('span');
                        totalGeneradoText.classList.add('generado-text');
                        totalGeneradoText.textContent = `Generó en el mes: `;
                        
                        const totalGenerado = document.createElement('span');
                        totalGenerado.classList.add('total-generado');
                        totalGenerado.textContent = `$${parseFloat(taxista.total_generado).toFixed(2)}`;
                        
                        // Agregamos el texto "Generó en el mes" y el total al contenedor de total
                        totalContainer.appendChild(totalGeneradoText);
                        totalContainer.appendChild(totalGenerado);
                        
                        // Añadimos el contenedor de nombre y el contenedor de total al div principal
                        div.appendChild(nombreContainer);
                        div.appendChild(totalContainer);
                        
                        // Finalmente, agregamos el div a la sección del ranking
                        document.querySelector('.ranking-taxistas').appendChild(div);
                    });
                              
                    
                } else {
                    // Si no hay resultados, mostramos el mensaje
                    $('.ranking-taxistas').append('<div>' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                // Manejo de errores
                console.error('Error al obtener el ranking:', error);
                $('.ranking-taxistas').append('<div>Hubo un error al cargar el ranking.</div>');
            }
        });
    }

    // Llamamos a la función al cargar la página
    obtenerRankingTaxistas();
});



// AÑADIR TAXI
$(document).ready(function() {
    $('#form-add-taxi').on('submit', function(e) {
        e.preventDefault();  // Evitar que se recargue la página

        // Limpiar mensajes anteriores
        $('.mensajeResult').removeClass('success-message error-message').text('');

        // Validar los campos antes de enviar
        var matricula = $('#matricula').val().trim();
        var modelo = $('#modelo').val().trim();
        var anio = $('#anio').val().trim();
        var estado = $('#estado').val();
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

        // Si hay errores, mostrar el mensaje y salir
        if (errorMessage) {
            $('.mensajeResult').html(errorMessage).addClass('error-message');
            $('.respuestaAJAX').slideDown().delay(5000).slideUp(); // Mostrar mensaje y ocultar después de 5s
            return;  // Detener el envío del formulario
        }

        // Si todo está bien, enviar la petición AJAX
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '../BaseDatos/peticiones-ajax.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.success) {
                    $('.mensajeResult').html(response.message).removeClass('error-message').addClass('success-message');
                    $('.respuestaAJAX').slideDown().delay(5000).slideUp();
                } else {
                    $('.mensajeResult').html(response.message).removeClass('success-message').addClass('error-message');
                    $('.respuestaAJAX').slideDown().delay(5000).slideUp();
                }
            },
            error: function(xhr, status, error) {
                $('.mensajeResult').html('Ocurrió un error inesperado.').addClass('error-message');
                $('.respuestaAJAX').slideDown().delay(5000).slideUp();
            }
        });
    });
});

//ELIMINAR TAXI
// $(document).ready(function() {
//     let matriculaSeleccionada; // Guardar la matrícula seleccionada

//     // Al abrir el modal, guardar la matrícula del taxi seleccionado
//     $(document).on('click', '.btn-abrir-modal-eliminar', function() {
//         matriculaSeleccionada = $(this).closest('tr').find('td').first().text();
//         $('.modal-eliminar').show(); // Asegurarse de que el modal se muestre
//     });

//     // Cuando se haga clic en el botón de "Aceptar" dentro del modal
//     $(document).on('click', '#eliminar_aceptar', function() {
//         if (matriculaSeleccionada) { // Verificar que haya una matrícula seleccionada
//             $.ajax({
//                 url: '../BaseDatos/peticiones-ajax.php',
//                 type: 'POST',
//                 data: {
//                     action: 'eliminar_taxi',
//                     matricula: matriculaSeleccionada
//                 },
//                 success: function(response) {
//                     if (response === 'success') {
//                         alert('Taxi eliminado correctamente');
//                         location.reload(); // Recargar la página para actualizar la lista
//                     } else {
//                         $('.mensajeResultModal').text('Error al eliminar el taxi');
//                     }
//                 },
//                 error: function() {
//                     $('.mensajeResultModal').text('Error en la solicitud AJAX');
//                 }
//             });
//             $('.modal-eliminar').hide(); // Cerrar el modal después de enviar la solicitud
//         }
//     });

//     // Cerrar el modal cuando se haga clic en el botón de cancelar
//     $(document).on('click', '#eliminar_cancelar', function() {
//         $('.modal-eliminar').hide();
//     });
// });

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


//FUNCION CARGAR Y ACTUALIZAR TABLA VIAJES
$(document).ready(function() {
    $('#fecha').on('change', function() {
        var fecha = $('#fecha').val();
        var fechaEspecifica = $('#fecha-especifica').val();

        if (fecha === 'personalizada' && fechaEspecifica) {
            fecha = fechaEspecifica;
        }

        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: {
                fecha: fecha
            },
            success: function(response) {
                $('#viajes-body').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX:", status, error);
            }
        });
    });

    $('#recargar-tabla').click(function() {
        var fecha = $('#fecha').val();
        var fechaEspecifica = $('#fecha-especifica').val();

        if (fecha === 'personalizada' && fechaEspecifica) {
            fecha = fechaEspecifica;
        }

        $.ajax({
            url: '../BaseDatos/peticiones-ajax.php',
            type: 'POST',
            data: {
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

//FECHA PERSONALIZADA VIAJES
$('#fecha').change(function() {
    if ($(this).val() === 'personalizada') {
        $('#fecha-personalizada').show(); 
    } else {
        $('#fecha-personalizada').hide(); 
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


$(document).ready(function() {
    // Capturar el evento de envío del formulario
    $('#form-add-cliente').on('submit', function(e) {
        e.preventDefault();  // Evitar que se recargue la página

        // Limpiar mensajes previos
        $('.mensajeResult').removeClass('success-message error-message').text('');
        $('.respuestaAJAX').hide();

        // Validar campos del formulario
        let isValid = true;
        let errorMessages = '';

        if ($('#NombreNuevo_Cliente').val().trim() === '') {
            errorMessages += 'El nombre es obligatorio.<br>';
            isValid = false;
        }
        if ($('#ApellidoNuevo_Cliente').val().trim() === '') {
            errorMessages += 'El apellido es obligatorio.<br>';
            isValid = false;
        }
        if ($('#TelefonoNuevo_Cliente').val().trim() === '' || isNaN($('#TelefonoNuevo_Cliente').val())) {
            errorMessages += 'El teléfono es obligatorio y debe ser numérico.<br>';
            isValid = false;
        }
        if ($('#DeudaNuevo_Cliente').val().trim() === '' || isNaN($('#DeudaNuevo_Cliente').val())) {
            errorMessages += 'La deuda es obligatoria y debe ser numérica.<br>';
            isValid = false;
        }
        if ($('#DireccionNuevo_Cliente').val().trim() === '') {
            errorMessages += 'La dirección es obligatoria.<br>';
            isValid = false;
        }

        // Mostrar errores si hay campos no válidos
        if (!isValid) {
            $('.mensajeResult').html(errorMessages).addClass('error-message');
            $('.respuestaAJAX').slideDown();
            setTimeout(function() {
                $('.respuestaAJAX').slideUp();
            }, 5000);
            return;
        }

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
                    // Mostrar mensaje de éxito
                    $('.mensajeResult').text(response.message).addClass('success-message'); 
                    $('.respuestaAJAX').slideDown();
                    $('#form-add-cliente')[0].reset();  // Limpiar el formulario

                    // Opcional: Cerrar modal después de un tiempo
                    setTimeout(function() {
                        $('.respuestaAJAX').slideUp();
                        cerrarModal();
                    }, 2000);
                } else {
                    // Si hubo algún error
                    $('.mensajeResult').text(response.message).addClass('error-message'); 
                    $('.respuestaAJAX').slideDown();

                    setTimeout(function() {
                        $('.respuestaAJAX').slideUp();
                    }, 5000);
                }
            },
            error: function(xhr, status, error) {
                $('.mensajeResult').text('Ocurrió un error inesperado.').addClass('error-message');
                $('.respuestaAJAX').slideDown();
                setTimeout(function() {
                    $('.respuestaAJAX').slideUp();
                }, 5000);
            }
        });
    });
});

function cerrarModal() {
    document.querySelector(".modal").close();
}