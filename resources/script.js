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

//ELIMINAR CLIENTE
// function eliminarCliente(id) {
//     if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
//         fetch('../BaseDatos/eliminar_cliente.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//             body: `id_cliente=${id}`
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 alert('Cliente eliminado con éxito');
//                 location.reload(); // Recargar la página para reflejar los cambios
//             } else {
//                 alert('Error al eliminar el cliente');
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert('Error al eliminar el cliente');
//         });
//     }
// }

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
                titulo_headerElement.textContent = data[language].titulo_header;
                // SLIDEBAR
                home_menuElement.textContent = data[language].home_menu;
                viajes_menuElement.textContent = data[language].viajes_menu;
                clientes_menuElement.textContent = data[language].clientes_menu;
                taxistas_menuElement.textContent = data[language].taxistas_menu;
                ingresos_menuElement.textContent = data[language].ingresos_menu;
                taxis_menuElement.textContent = data[language].taxis_menu;
                config_menuElement.textContent = data[language].config_menu;
                // PANEL
                h3_panelElement.textContent = data[language].h3_panel;
                span_ordenes_panelElement.textContent = data[language].span_ordenes_panel;
                span_ganancias_panelElement.textContent = data[language].span_ganancias_panel;
                span_taxis_panelElement.textContent = data[language].span_taxis_panel;
                h3_taxistas_mesElement.textContent = data[language].h3_taxistas_mes;
                th_taxistaElement.textContent = data[language].th_taxista;
                th_clienteElement.textContent = data[language].th_cliente;
                th_matriculaElement.textContent = data[language].th_matricula;
                th_fechaElement.textContent = data[language].th_fecha;
                th_metodo_pagoElement.textContent = data[language].th_metodo_pago;
                th_ingresoElement.textContent = data[language].th_ingreso;
                // CONFIGURACIÓN
                h3_opcionesElement.textContent = data[language].h3_opciones;
                texto_btnElement.textContent = data[language].switch_idioma;
            })
            .catch(error => console.log(error));
    };

    switchIdioma.addEventListener('click', () => {
        currentLanguage = currentLanguage === 'es' ? 'en' : 'es';
        localStorage.setItem('language', currentLanguage); // Guarda el idioma
        loadContent(currentLanguage);
    });

    // Carga inicial
    loadContent(currentLanguage);
});
