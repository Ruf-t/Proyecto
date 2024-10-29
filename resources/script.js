//funcion cambiar logo y texto en cada pagina del menu

// Obtener todas las opciones del menú
const alinks = document.querySelectorAll('.a-menu');

// Obtener la URL actual sin el dominio
const currentUrl = window.location.pathname.split("/").pop();

alinks.forEach(link => {
    // Comparar la URL del enlace con la URL actual
    if (link.getAttribute('href') === currentUrl) {
        link.classList.add('active');

        // Cambiar el logo si es necesario
        const img = link.querySelector('img');
        const imgsrc = img.getAttribute('src');
        
        // Reemplazar 'white/' con 'yellow/' en la URL
        const activeImgSrc = imgsrc.replace('white/', 'yellow/');
        img.setAttribute('src', activeImgSrc);
        
         // Referenciar al <a> de arriba (si existe) y añadir clase
         const prevLink = link.previousElementSibling;
         if (prevLink) {
             prevLink.classList.add('above-active');
         }1
 
         // Referenciar al <a> de abajo (si existe) y añadir clase
         const nextLink = link.nextElementSibling;
         if (nextLink) {
             nextLink.classList.add('below-active');
         }
    }
});




// --------DESPLEGAR MODAL-----------

const btnsAbrirModal = document.querySelectorAll('.btn-abrir-modal');
const btnsCerrarModal = document.querySelectorAll('.btn-cerrar-modal');
const modals = document.querySelectorAll('.modal');

btnsAbrirModal.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        modals[index].showModal();
    });
});

btnsCerrarModal.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        modals[index].close();
    });
});

// --------DESPLEGAR MODAL TAXISTA-----------

const btnsAbrirModalTaxista = document.querySelectorAll('.btn-abrir-modal-taxista');
const btnsCerrarModalTaxista = document.querySelectorAll('.btn-cerrar-modal-taxista');
const modalsTaxista = document.querySelectorAll('.modal-taxistas');

btnsAbrirModalTaxista.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        modalsTaxista[index].showModal();
    });
});

btnsCerrarModalTaxista.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        modalsTaxista[index].close();
    });
});

//---------------ABRIR MODAL MODIFICAR------------------
const btnsAbrirModalModificar = document.querySelectorAll('.btn-abrir-modal-modificar');
const modalModificar = document.querySelector('.modal');  // Solo hay un modal
const btnCerrarModalModificar = document.querySelector('.btn-cerrar-modal-modificar');  // Botón de cerrar

// Añadir el evento a todos los botones para abrir el mismo modal
btnsAbrirModalModificar.forEach(btn => {
    btn.addEventListener('click', () => {
        modalModificar.showModal();  // Abre el mismo modal para todos los botones
    });
});


//---------------ABRIR MODAL ELIMINAR------------------
const btnsAbrirModalEliminar = document.querySelectorAll('.btn-abrir-modal-eliminar');
const modalEliminar = document.querySelector('.modal-eliminar');
const btnCerrarModalEliminar = document.querySelector('.btn-cerrar-modal-eliminar');

btnsAbrirModalEliminar.forEach(btn => {
    btn.addEventListener('click', () => {
        modalEliminar.showModal(); 
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const btnCerrarModalEliminar = document.querySelector('.btn-cerrar-modal-eliminar');
    if (btnCerrarModalEliminar) {
        btnCerrarModalEliminar.addEventListener('click', () => {
            modalEliminar.close();
        });
    }
});



// btnCerrarModalEliminar.forEach((btn, index) => {
//     btn.addEventListener('click', () => {
//         modalEliminar[index].close();
//     });
// });





// const btnsAbrirModal = document.querySelectorAll('.btn-abrir-modal');
// const btnsCerrarModal = document.querySelectorAll('.btn-cerrar-modal');
// const modals = document.querySelectorAll('.modal');
// const formAddTaxi = document.getElementById('form-add-taxi');

// btnsAbrirModal.forEach((btn, index) => {
//     btn.addEventListener('click', () => {
//         modals[index].showModal();
//     });
// });

// btnsCerrarModal.forEach((btn, index) => {
//     btn.addEventListener('click', () => {
//         modals[index].close();
//     });
// });

// formAddTaxi.addEventListener('submit', function(event) {
//     event.preventDefault(); 
//     modals.forEach(modal => {
//         if (modal.open) {
//             modal.close(); 
//         }
//     });
    
// });


// Prevenir que el modal se cierre automáticamente y hacer el POST manualmente
// formulario.addEventListener('submit', (event) => {
//     event.preventDefault(); // Evita el cierre automático

//     const formData = new FormData(formulario);

//     // Puedes realizar la lógica para enviar los datos aquí, por ejemplo, usando fetch
//     fetch('ruta_a_tu_archivo.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.text())
//     .then(data => {
//         console.log(data);
//         modal.close(); // Cerrar modal manualmente después de enviar
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });



function eliminarTaxi(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este taxi?')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'eliminar_taxi.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('Taxi eliminado exitosamente.');
                    // Aquí puedes agregar el código para eliminar la fila de la tabla, si es necesario
                    // Ejemplo:
                    document.querySelector('tr[data-id="' + id + '"]').remove();
                } else {
                    alert('Error al eliminar el taxi: ' + response.message);
                }
            }
        };
        xhr.send('id=' + id);
    }
}



//----------------------------------------------CAMBIAR IDIOMA-----------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    //LOGIN
    const h2_inicio_sesionElement = document.getElementById('h2_inicio_sesion');
    const p_inicio_sesionElement = document.getElementById('p_inicio_sesion');
    const label_usuarioElement = document.getElementById('label_usuario');
    const label_contraseniaElement = document.getElementById('label_contrasenia');
    const userElement = document.getElementById('user');
    const contraseniaElement = document.getElementById('contrasenia');
    const btn_iniciar_sesionElement = document.getElementById('btn_iniciar_sesion');
    const p_no_cuentaElement = document.getElementById('p_no_cuenta');
    const a_registrarmeElement = document.getElementById('a_registrarme');
    //REGISTER
    const h2_registerElement = document.getElementById('h2_register');
    const nombreElement = document.getElementById('nombre');
    const apellidoElement = document.getElementById('apellido');
    const contrasenia1Element = document.getElementById('contrasenia1');
    const btn_registrarseElement = document.getElementById('btn_registrarse');
    const a_volverElement = document.getElementById('a_volver');
    // HEADER
    const titulo_headerElement = document.getElementById('titulo_header');
    // SLIDEBAR
    const home_menuElement = document.getElementById('home_menu');
    const viajes_menuElement = document.getElementById('viajes_menu');
    const clientes_menuElement = document.getElementById('clientes_menu');
    const taxistas_menuElement = document.getElementById('taxistas_menu');
    const ingresos_menuElement = document.getElementById('ingresos_menu');
    const taxis_menuElement = document.getElementById('taxis_menu');
    const config_menuElement = document.getElementById('config_menu');
    // PANEL
    const h3_panelElement = document.getElementById('h3_panel');
    const span_ordenes_panelElement = document.getElementById('span_ordenes_panel');
    const span_ganancias_panelElement = document.getElementById('span_ganancias_panel');
    const span_taxis_panelElement = document.getElementById('span_taxis_panel');
    const h3_taxistas_mesElement = document.getElementById('h3_taxistas_mes');
    const th_taxistaElement = document.getElementById('th_taxista');
    const th_clienteElement = document.getElementById('th_cliente');
    const th_matriculaElement = document.getElementById('th_matricula');
    const th_fechaElement = document.getElementById('th_fecha');
    const th_metodo_pagoElement = document.getElementById('th_metodo_pago');
    const th_ingresoElement = document.getElementById('th_ingreso');
    const h3_tabla_viaje_panelElement = document.getElementById('h3_tabla_viaje_panel');
    //VIAJES 
    const option_select_turnoElement = document.getElementById('option_select_turno');
    const option_select_turno1Element = document.getElementById('option_select_turno1');
    const option_select_turno2Element = document.getElementById('option_select_turno2');
    const option_select_fechaElement = document.getElementById('option_select_fecha');
    const option_select_fecha_hoyElement = document.getElementById('option_select_fecha_hoy');
    const option_select_fecha_1diaElement = document.getElementById('option_select_fecha_1dia');
    const option_select_fecha_semanaElement = document.getElementById('option_select_fecha_semana');
    const option_select_fecha_mesElement = document.getElementById('option_select_fecha_mes');
    const option_select_fecha_6mesesElement = document.getElementById('option_select_fecha_6meses');
    const option_select_fecha_personalizadaElement = document.getElementById('option_select_fecha_personalizada');
    //CLIENTES
    const h1_clientesElement = document.getElementById('h1_clientes');
    const btn_abrir_modal_clienteElement = document.getElementById('btn_abrir_modal_cliente');
    const h2_agregar_clienteElement = document.getElementById('h2_agregar_cliente');
    const label_nombreElement = document.getElementById('label_nombre');
    const label_apellidoElement = document.getElementById('label_apellido');
    const label_direccionElement = document.getElementById('label_direccion');
    const label_telefonoElement = document.getElementById('label_telefono');
    const label_deudaElement = document.getElementById('label_deuda');
    const btn_enviar_clienteElement = document.getElementById('btn_enviar_cliente');
    const th_nombreElement = document.getElementById('th_nombre');
    const th_apellidoElement = document.getElementById('th_apellido');
    const th_telefonoElement = document.getElementById('th_telefono');
    const th_direccionElement = document.getElementById('th_direccion');
    const th_deudaElement = document.getElementById('th_deuda');
    const h2_eliminar_clienteElement = document.getElementById('h2_eliminar_cliente');
    //TAXISTAS
    const h1_taxistasElement = document.getElementById('h1_taxistas');
    const btn_abrir_modal_taxistasElement= document.getElementById('btn_abrir_modal_taxistas');
    const h2_agregar_taxistaElement = document.getElementById('h2_agregar_taxista');
    const label_fecha_nacElement = document.getElementById('label_fecha_nac');
    const label_fecha_vencElement = document.getElementById('label_fecha_venc');
    const label_userElement = document.getElementById('label_user');
    const label_contraElement = document.getElementById('label_contra');
    const btn_enviar_taxistaElement = document.getElementById('btn_enviar_taxista');
    const th_nacimientoElement = document.getElementById('th_nacimiento');
    const th_fecha_vencElement = document.getElementById('th_fecha_venc');
    const th_info_taxistaElement = document.getElementById('th_info_taxista');
    const h2_eliminar_taxistaElement = document.getElementById('h2_eliminar_taxista');
    const eliminar_aceptarElement = document.getElementById('eliminar_aceptar');
    const eliminar_cancelarElement = document.getElementById('eliminar_cancelar');
    //INGRESOS
    const h1_ingresosElement = document.getElementById('h1_ingresos');
    const btn_aplicar_filtroElement = document.getElementById('btn_aplicar_filtro');
    const th_numero_taxiElement = document.getElementById('th_numero_taxi');
    const th_turnosElement = document.getElementById('th_turnos');
    //TAXIS
    const h1_taxiElement = document.getElementById('h1_taxi');
    const btn_abrir_modal_taxiElement = document.getElementById('btn_abrir_modal_taxi');
    const th_kilometrosElement = document.getElementById('th_kilometros');
    const th_anioElement = document.getElementById('th_anio');
    const th_modeloElement = document.getElementById('th_modelo');
    const th_estadoElement = document.getElementById('th_estado');
    const th_proximo_servicioElement = document.getElementById('th_proximo_servicio');
    const th_modificar_eliminarElement = document.getElementById('th_modificar_eliminar');
    const h2_agregar_taxiElement =  document.getElementById('h2_agregar_taxi');
    const label_matriculaElement = document.getElementById('label_matricula');
    const label_modeloElement = document.getElementById('label_modelo');
    const label_anioElement = document.getElementById('label_anio');
    const label_estadoElement = document.getElementById('label_estado');
    const option_select_estadoElement = document.getElementById('option_select_estado');
    const option_select_estado1Element = document.getElementById('option_select_estado1');
    const option_select_estado2Element = document.getElementById('option_select_estado2');
    const btn_add_taxiElement = document.getElementById('btn_add_taxi');
    const h2_eliminar_taxiElement = document.getElementById('h2_eliminar_taxi');
    // CONFIGURACIÓN
    const h3_opcionesElement = document.getElementById('h3_opciones');
    const texto_btnElement = document.getElementById('switch_idioma');
    const cerrar_sesionElement = document.getElementById('cerrar_sesion');
    
    const switchIdioma = document.getElementById('switch_idioma');
    let currentLanguage = 'es';

    // Cargar idioma desde localStorage
    const storedLanguage = localStorage.getItem('language');
    if (storedLanguage) {
        currentLanguage = storedLanguage;
    }

    const loadContent = (language) => {
        fetch('../resources/idiomas.json')
            .then(response => response.json())
            .then(data => {
                //LOGIN
                if (h2_inicio_sesionElement) h2_inicio_sesionElement.textContent = data[language].h2_inicio_sesion;    
                if (p_inicio_sesionElement) p_inicio_sesionElement.textContent = data[language].p_inicio_sesion;
                if (label_usuarioElement) label_usuarioElement.textContent = data[language].label_usuario;
                if (label_contraseniaElement) label_contraseniaElement.textContent = data[language].label_contrasenia;
                if (userElement) userElement.textContent = data[language].user;
                if (contraseniaElement) contraseniaElement.textContent = data[language].contrasenia;
                if (btn_iniciar_sesionElement) btn_iniciar_sesionElement.textContent = data[language].btn_iniciar_sesion;
                if (p_no_cuentaElement) p_no_cuentaElement.textContent = data[language].p_no_cuenta;
                if (a_registrarmeElement) a_registrarmeElement.textContent = data[language].a_registrarme;
                //REGISTER
                if (h2_registerElement) h2_registerElement.textContent = data[language].h2_register;
                if (nombreElement) nombreElement.textContent = data[language].nombre;
                if (apellidoElement) apellidoElement.textContent = data[language].apellido;
                if (contrasenia1Element) contrasenia1Element.textContent = data[language].contrasenia1;
                if (btn_registrarseElement) btn_registrarseElement.textContent = data[language].btn_registrarse;
                if (a_volverElement) a_volverElement.textContent = data[language].a_volver;
                // HEADER
                if (titulo_headerElement) titulo_headerElement.textContent = data[language].titulo_header;
                // SLIDEBAR
                if (home_menuElement) home_menuElement.textContent = data[language].home_menu;
                if (viajes_menuElement) viajes_menuElement.textContent = data[language].viajes_menu;
                if (clientes_menuElement) clientes_menuElement.textContent = data[language].clientes_menu;
                if (taxistas_menuElement) taxistas_menuElement.textContent = data[language].taxistas_menu;
                if (ingresos_menuElement) ingresos_menuElement.textContent = data[language].ingresos_menu;
                if (taxis_menuElement) taxis_menuElement.textContent = data[language].taxis_menu;
                if (config_menuElement) config_menuElement.textContent = data[language].config_menu;
                // PANEL
                if (h3_panelElement) h3_panelElement.textContent = data[language].h3_panel;
                if (span_ordenes_panelElement) span_ordenes_panelElement.textContent = data[language].span_ordenes_panel;
                if (span_ganancias_panelElement) span_ganancias_panelElement.textContent = data[language].span_ganancias_panel;
                if (span_taxis_panelElement) span_taxis_panelElement.textContent = data[language].span_taxis_panel;
                if (h3_taxistas_mesElement) h3_taxistas_mesElement.textContent = data[language].h3_taxistas_mes;
                if (th_taxistaElement) th_taxistaElement.textContent = data[language].th_taxista;
                if (th_clienteElement) th_clienteElement.textContent = data[language].th_cliente;
                if (th_matriculaElement) th_matriculaElement.textContent = data[language].th_matricula;
                if (th_fechaElement) th_fechaElement.textContent = data[language].th_fecha;
                if (th_metodo_pagoElement) th_metodo_pagoElement.textContent = data[language].th_metodo_pago;
                if (th_ingresoElement) th_ingresoElement.textContent = data[language].th_ingreso;
                if (h3_tabla_viaje_panelElement) h3_tabla_viaje_panelElement.textContent = data[language].h3_tabla_viaje_panel;
                //VIAJES
                if (option_select_turnoElement) option_select_turnoElement.textContent = data[language].option_select_turno;
                if (option_select_turno1Element) option_select_turno1Element.textContent = data[language].option_select_turno1;
                if (option_select_turno2Element) option_select_turno2Element.textContent = data[language].option_select_turno2;
                if (option_select_fechaElement) option_select_fechaElement.textContent = data[language].option_select_fecha;                
                if (option_select_fecha_hoyElement) option_select_fecha_hoyElement.textContent = data[language].option_select_fecha_hoy;                
                if (option_select_fecha_1diaElement) option_select_fecha_1diaElement.textContent = data[language].option_select_fecha_1dia;                
                if (option_select_fecha_semanaElement) option_select_fecha_semanaElement.textContent = data[language].option_select_fecha_semana;                
                if (option_select_fecha_mesElement) option_select_fecha_mesElement.textContent = data[language].option_select_fecha_mes;                
                if (option_select_fecha_6mesesElement) option_select_fecha_6mesesElement.textContent = data[language].option_select_fecha_6meses;                
                if (option_select_fecha_personalizadaElement) option_select_fecha_personalizadaElement.textContent = data[language].option_select_fecha_personalizada;                
                //CLIENTES
                if (h1_clientesElement) h1_clientesElement.textContent = data[language].h1_clientes;
                if (btn_abrir_modal_clienteElement) btn_abrir_modal_clienteElement.textContent = data[language].btn_abrir_modal_cliente;
                if (h2_agregar_clienteElement) h2_agregar_clienteElement.textContent = data[language].h2_agregar_cliente;
                if (label_nombreElement) label_nombreElement.textContent = data[language].label_nombre;
                if (label_apellidoElement) label_apellidoElement.textContent = data[language].label_apellido;
                if (label_direccionElement) label_direccionElement.textContent = data[language].label_direccion;
                if (label_telefonoElement) label_telefonoElement.textContent = data[language].label_telefono;
                if (label_deudaElement) label_deudaElement.textContent = data[language].label_deuda;
                if (btn_enviar_clienteElement) btn_enviar_clienteElement.textContent = data[language].btn_enviar_cliente;
                if (th_nombreElement) th_nombreElement.textContent = data[language].th_nombre;
                if (th_apellidoElement) th_apellidoElement.textContent = data[language].th_apellido;
                if (th_telefonoElement) th_telefonoElement.textContent = data[language].th_telefono;
                if (th_direccionElement) th_direccionElement.textContent = data[language].th_direccion;
                if (th_deudaElement) th_deudaElement.textContent = data[language].th_deuda;
                if (h2_eliminar_clienteElement) h2_eliminar_clienteElement.textContent = data[language].h2_eliminar_cliente;                
                //TAXISTAS
                if (h1_taxistasElement) h1_taxistasElement.textContent = data[language].h1_taxistas;
                if (btn_abrir_modal_taxistasElement) btn_abrir_modal_taxistasElement.textContent = data[language].btn_abrir_modal_taxistas;
                if (h2_agregar_taxistaElement) h2_agregar_taxistaElement.textContent = data[language].h2_agregar_taxista;
                if (label_fecha_nacElement) label_fecha_nacElement.textContent = data[language].label_fecha_nac;
                if (label_fecha_vencElement) label_fecha_vencElement.textContent = data[language].label_fecha_venc;
                if (label_userElement) label_userElement.textContent = data[language].label_user;
                if (label_contraElement) label_contraElement.textContent = data[language].label_contra;
                if (btn_enviar_taxistaElement) btn_enviar_taxistaElement.textContent = data[language].btn_enviar_taxista;
                if (th_nacimientoElement) th_nacimientoElement.textContent = data[language].th_nacimiento;
                if (th_fecha_vencElement) th_fecha_vencElement.textContent = data[language].th_fecha_venc;
                if (th_info_taxistaElement) th_info_taxistaElement.textContent = data[language].th_info_taxista;
                if (h2_eliminar_taxistaElement) h2_eliminar_taxistaElement.textContent = data[language].h2_eliminar_taxista;                
                if (eliminar_aceptarElement) eliminar_aceptarElement.textContent = data[language].eliminar_aceptar;                
                if (eliminar_cancelarElement) eliminar_cancelarElement.textContent = data[language].eliminar_cancelar;                                
                //INGRESOS
                if (h1_ingresosElement) h1_ingresosElement.textContent = data[language].h1_ingresos;
                if (btn_aplicar_filtroElement) btn_aplicar_filtroElement.textContent = data[language].btn_aplicar_filtro;
                if (th_numero_taxiElement) th_numero_taxiElement.textContent = data[language].th_numero_taxi;
                if (th_turnosElement) th_turnosElement.textContent = data[language].th_turnos;
                //TAXIS
                if (h1_taxiElement) h1_taxiElement.textContent = data[language].h1_taxi;
                if (btn_abrir_modal_taxiElement) btn_abrir_modal_taxiElement.textContent = data[language].btn_abrir_modal_taxi;
                if (th_kilometrosElement) th_kilometrosElement.textContent = data[language].th_kilometros;
                if (th_anioElement) th_anioElement.textContent = data[language].th_anio;
                if (th_modeloElement) th_modeloElement.textContent = data[language].th_modelo;
                if (th_estadoElement) th_estadoElement.textContent = data[language].th_estado;
                if (th_proximo_servicioElement) th_proximo_servicioElement.textContent = data[language].th_proximo_servicio;
                if (th_modificar_eliminarElement) th_modificar_eliminarElement.textContent = data[language].th_modificar_eliminar;
                if (h2_agregar_taxiElement) h2_agregar_taxiElement.textContent = data[language].h2_agregar_taxi;
                if (label_matriculaElement) label_matriculaElement.textContent = data[language].label_matricula;
                if (label_modeloElement) label_modeloElement.textContent = data[language].label_modelo;
                if (label_anioElement) label_anioElement.textContent = data[language].label_anio;
                if (label_estadoElement) label_estadoElement.textContent = data[language].label_estado;
                if (option_select_estadoElement) option_select_estadoElement.textContent = data[language].option_select_estado;
                if (option_select_estado1Element) option_select_estado1Element.textContent = data[language].option_select_estado1;
                if (option_select_estado2Element) option_select_estado2Element.textContent = data[language].option_select_estado2;
                if (btn_add_taxiElement) btn_add_taxiElement.textContent = data[language].btn_add_taxi;
                if (h2_eliminar_taxiElement) h2_eliminar_taxiElement.textContent = data[language].h2_eliminar_taxi;                
                // CONFIGURACIÓN
                if (h3_opcionesElement) h3_opcionesElement.textContent = data[language].h3_opciones;
                if (texto_btnElement) texto_btnElement.textContent = data[language].switch_idioma;
                if (cerrar_sesionElement) cerrar_sesionElement.textContent = data[language].cerrar_sesion;
            })
            .catch(error => console.log(error));
    };

    // Si existe el botón de cambiar idioma, agregamos el listener
    if (switchIdioma) {
        switchIdioma.addEventListener('click', () => {
            event.preventDefault();
            currentLanguage = currentLanguage === 'es' ? 'en' : 'es';
            localStorage.setItem('language', currentLanguage); // Guarda el idioma
            loadContent(currentLanguage);
        });
    }

    // Carga inicial: cargar idioma al abrir cualquier página
    loadContent(currentLanguage);
});



//---------------------CONTROL DE ERRORES REGISTER--------------------------------------

// document.getElementById('form-register').addEventListener('submit', function(event)){
//     event.preventDefault(); // Previene el envío por defecto

//     let nombre = document.getElementById('nombre').value;
//     let apellido = document.getElementById('apellido').value;
//     let telefono = document.getElementById('telefono').value;
//     let direccion = document.getElementById('direccion').value;
//     let user = document.getElementById('user1').value;
//     let contrasenia = document.getElementById('contrasenia1').value;
//     let message = document.getElementById('message');

//     // Obtener el idioma seleccionado del localStorage
//     let idioma = localStorage.getItem('language') || 'es'; // Por defecto español (es)

//     // Textos de validación según el idioma
//     const textos = {
//         es: {
//             camposVacios: "Debe completar todos los campos.",
//             camposIncompletos: "Faltan campos por completar.",
//             nombre: "El nombre debe empezar con mayúscula y tener un máximo de 12 letras, incluyendo acentos.",
//             apellido: "El apellido debe empezar con mayúscula y tener un máximo de 15 letras, incluyendo acentos.",
//             telefono: "El teléfono debe tener exactamente 9 números.",
//             direccion: "La dirección debe empezar con mayúscula y contener un número entre 1 y 9999.",
//             usuario: "El nombre de usuario debe empezar con mayúscula.",
//             contrasenia: "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.",
//             exito: "Formulario enviado exitosamente."
//         },
//         en: {
//             camposVacios: "All fields must be completed.",
//             camposIncompletos: "Some fields are missing.",
//             nombre: "The name must start with an uppercase letter and have a maximum of 12 letters, including accents.",
//             apellido: "The last name must start with an uppercase letter and have a maximum of 15 letters, including accents.",
//             telefono: "The phone number must be exactly 9 digits.",
//             direccion: "The address must start with an uppercase letter and contain a number between 1 and 9999.",
//             usuario: "The username must start with an uppercase letter.",
//             contrasenia: "The password must be at least 8 characters long, with one uppercase, one lowercase, one number, and one special character.",
//             exito: "Form submitted successfully."
//         }
//     }

// }
//---------------------CONTROL DE ERRORES INICIOSESION--------------------------------------
// document.getElementById('form-inicioS-admin').addEventListener('submit', function(event) {
//     event.preventDefault(); // Previene el envío por defecto

//     let user = document.getElementById('user').value;
//     let contrasenia = document.getElementById('contrasenia').value;
//     let message = document.getElementById('message');

//     // Limpiar el mensaje anterior
//     message.className = 'message'; // Restablece la clase
//     message.style.display = 'none'; // Oculta el mensaje

//     // Validación para el usuario
//     if (!/^[A-ZÁÉÍÓÚ][a-zA-Z0-9]{1,}$/.test(user)) {
//         message.className = 'message error';
//         message.innerText = "El nombre de usuario debe empezar con mayúscula.";
//         message.style.display = 'block';
//         setTimeout(() => { message.style.display = 'none'; }, 3000); // Oculta el mensaje después de 3 segundos
//         return;
//     }

//     // Validación para la contraseña
//     if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(contrasenia)) {
//         message.className = 'mensajeAJAX error';
//         message.innerText = "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.";
//         message.style.display = 'block';
//         setTimeout(() => { message.style.display = 'none'; }, 3000); // Oculta el mensaje después de 3 segundos
//         return;
//     }

//     // Si todo es correcto, muestra el mensaje de éxito
//     message.className = 'mensajeAJAX success';
//     message.innerText = "Inicio de sesión exitoso.";
//     message.style.display = 'block';

//     // Redirige después de 3 segundos
//     setTimeout(() => {
//         message.style.display = 'none'; // Oculta el mensaje
//         window.location.href = 'home.php'; // Redirige a la página de inicio
//     }, 3000); // Espera 3 segundos antes de redirigir
// });