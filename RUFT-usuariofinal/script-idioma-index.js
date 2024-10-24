//----------------------------------------------CAMBIAR IDIOMA-----------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    //LOGIN
    const h2_inicio_sesionElement = document.getElementById('h2_inicio_sesion');

    
    const switchIdioma = document.getElementById('switch_idioma');
    let currentLanguage = 'es';

    // Cargar idioma desde localStorage
    const storedLanguage = localStorage.getItem('language');
    if (storedLanguage) {
        currentLanguage = storedLanguage;
    }

    const loadContent = (language) => {
        fetch('../idiomas-index.json')
            .then(response => response.json())
            .then(data => {
                //LOGIN
                if (h2_inicio_sesionElement) h2_inicio_sesionElement.textContent = data[language].h2_inicio_sesion;    
            
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