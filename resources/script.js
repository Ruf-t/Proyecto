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
    //HEADER
    const titulo_headerElement = document.getElementById('titulo_header');
    //-----------------------------------------------------------------------  
    //SLIDEBAR
    const home_menuElement = document.getElementById('home_menu');
    const viajes_menuElement = document.getElementById('viajes_menu');
    const clientes_menuElement = document.getElementById('clientes_menu');
    const taxistas_menuElement = document.getElementById('taxistas_menu');
    const ingresos_menuElement = document.getElementById('ingresos_menu');
    const taxis_menuElement = document.getElementById('taxis_menu');
    const config_menuElement = document.getElementById('config_menu');
    //----------------------------------------------------------------------
    
    //CONFIGURACIÓN
    const h3_opcionesElement = document.getElementById('h3_opciones');
    const texto_btnElement = document.getElementById('switch_idioma');
    //-----------------------------------------------------------------------
    const switchIdioma = document.getElementById('switch_idioma');
    let currentLanguage = 'es';

    const loadContent = (language) => {
        fetch('../resources/idiomas.json')
            .then(response => response.json())
            .then(data => {
                //HEADER
                titulo_headerElement.textContent = data[language].titulo_header;
                //-------------------------------------------------------------
                //SLIDEBAR
                home_menuElement.textContent = data[language].home_menu;
                viajes_menuElement.textContent = data[language].viajes_menu;
                clientes_menuElement.textContent = data[language].clientes_menu;
                taxistas_menuElement.textContent = data[language].taxistas_menu;
                ingresos_menuElement.textContent = data[language].ingresos_menu;
                taxis_menuElement.textContent = data[language].taxis_menu;
                config_menuElement.textContent = data[language].config_menu;
                //-------------------------------------------------------------
                
                //CONFIGURACIÓN
                h3_opcionesElement.textContent = data[language].h3_opciones;
                texto_btnElement.textContent = data[language].texto_btn;
            })
            .catch(error => console.log(error));
    };

    switchIdioma.addEventListener('click', () => {
        if (currentLanguage === 'es') {
            currentLanguage = 'en';
        } else {
            currentLanguage = 'es';
        }
        loadContent(currentLanguage);
    });

    // carga inicial
    loadContent(currentLanguage);
});