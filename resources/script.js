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
// Obtener todos los botones con la clase selectButton
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

// // Activar el botón 1 al cargar la página
// document.addEventListener('DOMContentLoaded', function() {
//     activarBoton(1);
// });

function activarBoton(numero) {
    // Encuentra el botón correspondiente y activa su color
    const button = document.querySelector(`.paginas:nth-of-type(${parseInt(numero) + 1})`);
    cambioColorBoton(button);
}

