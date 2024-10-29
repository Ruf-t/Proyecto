// se importa el archivo de css con Jquery para que no se recargue la pagina 
$.ajax({
    url: '../style/style-Taximetristas.css',
    dataType: 'css'
  }).done(function(css) {
    $('<style>').html(css).appendTo('head');
  });
  

  $(document).ready(function() {
    $('#form-inicioS-taximetrista').on('submit', function(event) {
        event.preventDefault();  // Evita la recarga de la página
        var formData = $(this).serialize(); 
        $.ajax({
            url: '../resources-Taximetristas/Peticiones/procesar-taximetrista.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(response) {
                console.log(response);  // Imprime la respuesta para ver si llega correctamente
                if (response.status === "success") {
                    window.location.href = '../layout/home-Taximetrista.php';
                } else {
                    $('.mensajeAJAX').text(response.message).addClass('error-message');
                    $('.respuestaAJAX').slideDown();
                    setTimeout(function() {
                        $('.respuestaAJAX').slideUp();
                    }, 5000);
                }
            },
            
            error: function(error) {
                $('.mensajeAJAX').text('Ocurrió un error inesperado.');
                $('.respuestaAJAX').slideDown();

                setTimeout(function() {
                    $('.respuestaAJAX').slideUp();
                }, 5000);
            }
        });
    });
});



  
  // funcion para enviar los datos del formulario iniciar jornada
  $(document).ready(function() {
      // Deshabilitar los botones de Iniciar Viaje y Finalizar Jornada al cargar la página
      $('#btnIniciarViaje').prop('disabled', true).addClass('btn-desactivado');
      $('#btnFinalizarJornada').prop('disabled', true).addClass('btn-desactivado');
      
      // Manejar el envío del formulario de Iniciar Jornada
      $('#formIniciarJornada').on('submit', function(event) {
          event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario
          var formData = $(this).serialize(); // Obtener los datos del formulario
  
          // Hacer la petición AJAX para Iniciar Jornada
          $.ajax({
              type: 'POST',
              url: '../resources-Taximetristas/Peticiones/procesar-taximetrista.php',
              data: formData,
              success: function(response) {
                  let respuesta = JSON.parse(response);
                  if (respuesta.success) {
                      // Mostrar mensaje de éxito
                      $('.mensajeAJAX').text(respuesta.message).addClass('success-message');
                      
                    // deshabilitar el botón de iniciar jornada, (se coloca la propiedad de disabled, y se quita la clase de btn-activado
                    // ,se coloca laclase de btn-desactivado y su vez se coloca la clase al container del form para que sea hidden y asi se oculte)
                      $('#btnIniciarJornada').prop('disabled', true).removeClass('btn-activado').addClass('btn-desactivado');
                      $('#formContainer1').addClass('hidden');


                    // se habilitan los botones de iniciar viaje y finalizar jornada, se quita la clase de btn-desactivado y se agrega la clase de btn-activado y a su vez se quita la propiedad de disabled.
                      $('#btnIniciarViaje').prop('disabled', false).removeClass('btn-desactivado').addClass('btn-activado');
                      $('#btnFinalizarJornada').prop('disabled', false).removeClass('btn-desactivado').addClass('btn-activado');
                     
                    // los inputs se reinician     
                      $('#formIniciarJornada')[0].reset();
                   
                      
                  } else {
                      $('.mensajeAJAX').text(respuesta.message).addClass('error-message');
                  }
  
                  $('.respuestaAJAX').slideDown();
  
                  // Ocultar después de 5 segundos
                  setTimeout(function() {
                      $('.respuestaAJAX').slideUp();
                  }, 5000);
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

                // los inputs y select borran lo que se coloco
                $('#formIniciarViaje')[0].reset();

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
  
  
  
  
  // Función para enviar los datos del formulario de finalizar jornada
  $(document).ready(function() {
      $('#formFinalizarJornada').on('submit', function(event) {
          event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario
          var formData = $(this).serialize(); // Obtener los datos del formulario
  
          // Hacer la petición AJAX para finalizar la jornada
          $.ajax({
              type: 'POST',
              url: '../resources-Taximetristas/Peticiones/procesar-taximetrista.php',
              data: formData, 
              success: function(response) {
                  let respuesta = JSON.parse(response);
                  if (respuesta.success) {
                $('.mensajeAJAX').text(respuesta.message).addClass('success-message');
                
                // deshabilitar los botones de Iniciar Viaje y Finalizar Jornada
                $('#btnIniciarViaje, #btnFinalizarJornada').prop('disabled', true).removeClass('btn-activado').addClass('btn-desactivado');

                // habilitar el botón de Iniciar Jornada
                $('#btnIniciarJornada').prop('disabled', false).removeClass('btn-desactivado').addClass('btn-activado');
                
                // se ocultan los contenedores de los formularios de iniciar viaje y finalizar jornada
                $('#formContainer2, #formContainer3 ').addClass('hidden');
                
                //se borra lo que se coloco   
                $('#formFinalizarJornada')[0].reset();
                
                $('.respuestaAJAX').slideDown();
                      // Ocultar después de 5 segundos
                      setTimeout(function() {
                          $('.respuestaAJAX').slideUp();
                      }, 5000); // 5000 milisegundos = 5 segundos
                  } else {
                      $('.mensajeAJAX').text(respuesta.message).addClass('error-message');
                  }
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