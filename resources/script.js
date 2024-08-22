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
         }
 
         // Referenciar al <a> de abajo (si existe) y añadir clase
         const nextLink = link.nextElementSibling;
         if (nextLink) {
             nextLink.classList.add('below-active');
         }
    }
});
