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

// ------HOME TAXIMETRISTA--------
// // Obtener todos los botones con la clase selectButton
const buttons = document.querySelectorAll('.selectButton');

// Añadir un evento click a cada botón
buttons.forEach(button => {
    button.addEventListener('click', function() {
        // Obtener el id del contenedor objetivo desde el atributo data-target
        const targetId = button.getAttribute('data-target');
        const container = document.getElementById(targetId);
        
        // Alternar la visibilidad del contenedor
        container.classList.toggle('hidden');
    });
});





// --------Botones para cambiar páginas-----------
function cambioColorBoton(button) {
    // Selecciona solo los botones con texto 1 y 2
    const buttons = document.querySelectorAll('.paginas');
    
    // Remueve la clase 'active' solo de los botones 1 y 2
    buttons.forEach(btn => {
        if (btn.textContent === '1' || btn.textContent === '2') {
            btn.classList.remove('active');
        }   
    });
    
    // Añade la clase 'active' al botón presionado
    button.classList.add('active');
}

function activarBoton(numero) {
    // Encuentra el botón correspondiente y activa su color
    const button = document.querySelector(`.paginas:nth-of-type(${parseInt(numero) + 1})`);
    cambioColorBoton(button);
}



// --------DESPLEGAR MODAL-----------

const btnsAbrirModal = document.querySelectorAll('.btn-abrir-modal');
const btnsCerrarModal = document.querySelectorAll('.btn-cerrar-modal');
const modals = document.querySelectorAll('.modal');

// Agregar eventos a todos los botones de abrir modal
btnsAbrirModal.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        modals[index].showModal();
    });
});

// Agregar eventos a todos los botones de cerrar modal
btnsCerrarModal.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        modals[index].close();
    });
});


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
    const label_deudaElement = document.getElementById('label_deuda');
    const btn_enviar_clienteElement = document.getElementById('btn_enviar_cliente');
    const th_nombreElement = document.getElementById('th_nombre');
    const th_apellidoElement = document.getElementById('th_apellido');
    const th_telefonoElement = document.getElementById('th_telefono');
    const th_direccionElement = document.getElementById('th_direccion');
    const th_deudaElement = document.getElementById('th_deuda');
    //TAXISTAS
    const h1_taxistasElement = document.getElementById('h1_taxistas');
    const btn_abrir_modal_taxistasElement= document.getElementById('btn_abrir_modal_taxistas');
    const h2_agregar_taxistaElement = document.getElementById('h2_agregar_taxista');
    const label_fecha_nacElement = document.getElementById('label_fecha_nac');
    const label_fecha_vencElement = document.getElementById('label_fecha_venc');
    const btn_enviar_taxistaElement = document.getElementById('btn_enviar_taxista');
    const th_nacimientoElement = document.getElementById('th_nacimiento');
    const th_fecha_vencElement = document.getElementById('th_fecha_venc');
    const th_info_taxistaElement = document.getElementById('th_info_taxista');
    // CONFIGURACIÓN
    const h3_opcionesElement = document.getElementById('h3_opciones');
    const texto_btnElement = document.getElementById('switch_idioma');
    
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
                if (label_deudaElement) label_deudaElement.textContent = data[language].label_deuda;
                if (btn_enviar_clienteElement) btn_enviar_clienteElement.textContent = data[language].btn_enviar_cliente;
                if (th_nombreElement) th_nombreElement.textContent = data[language].th_nombre;
                if (th_apellidoElement) th_apellidoElement.textContent = data[language].th_apellido;
                if (th_telefonoElement) th_telefonoElement.textContent = data[language].th_telefono;
                if (th_direccionElement) th_direccionElement.textContent = data[language].th_direccion;
                if (th_deudaElement) th_deudaElement.textContent = data[language].th_deuda;
                //TAXISTAS
                if (h1_taxistasElement) h1_taxistasElement.textContent = data[language].h1_taxistas;
                if (btn_abrir_modal_taxistasElement) btn_abrir_modal_taxistasElement.textContent = data[language].btn_abrir_modal_taxistas;
                if (h2_agregar_taxistaElement) h2_agregar_taxistaElement.textContent = data[language].h2_agregar_taxista;
                if (label_fecha_nacElement) label_fecha_nacElement.textContent = data[language].label_fecha_nac;
                if (label_fecha_vencElement) label_fecha_vencElement.textContent = data[language].label_fecha_venc;
                if (btn_enviar_taxistaElement) btn_enviar_taxistaElement.textContent = data[language].btn_enviar_taxista;
                if (th_nacimientoElement) th_nacimientoElement.textContent = data[language].th_nacimiento;
                if (th_fecha_vencElement) th_fecha_vencElement.textContent = data[language].th_fecha_venc;
                if (th_info_taxistaElement) th_info_taxistaElement.textContent = data[language].th_info_taxista;                
                // CONFIGURACIÓN
                if (h3_opcionesElement) h3_opcionesElement.textContent = data[language].h3_opciones;
                if (texto_btnElement) texto_btnElement.textContent = data[language].switch_idioma;
            })
            .catch(error => console.log(error));
    };

    // Si existe el botón de cambiar idioma, agregamos el listener
    if (switchIdioma) {
        switchIdioma.addEventListener('click', () => {
            currentLanguage = currentLanguage === 'es' ? 'en' : 'es';
            localStorage.setItem('language', currentLanguage); // Guarda el idioma
            loadContent(currentLanguage);
        });
    }

    // Carga inicial: cargar idioma al abrir cualquier página
    loadContent(currentLanguage);
});

