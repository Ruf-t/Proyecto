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
        
    }
});

//cambiar icono desplegar menu

const button = document.getElementById('menuButton');
const menu = document.getElementById('sideMenu');
let isMenuOpen = false;

button.addEventListener('click', () => {
    isMenuOpen = !isMenuOpen;

    // Alternar la visibilidad del menú
    if (isMenuOpen) {
        menu.classList.remove('hidden');
    } else {
        menu.classList.add('hidden');
    }

    // Cambiar la imagen del botón
    const img = button.querySelector('img');
    const currentSrc = img.getAttribute('src');
    const newSrc = isMenuOpen ? currentSrc.replace('white/', 'yellow/') : currentSrc.replace('yellow/', 'white/');
    img.setAttribute('src', newSrc);
});

