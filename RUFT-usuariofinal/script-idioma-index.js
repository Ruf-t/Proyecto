//----------------------------------------------CAMBIAR IDIOMA-----------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    //LOGIN
    const a_contactoElement = document.getElementById('a_contacto');
    const a_nosotrosElement = document.getElementById('a_nosotros');
    const a_clientesElement = document.getElementById('a_clientes');
    const h1_bienvenidoElement = document.getElementById('h1_bienvenido');
    const p_info_nosotrosElement = document.getElementById('p_info_nosotros');
    const h2_clienteElement = document.getElementById('h2_cliente');
    const p_carmisolElement = document.getElementById('p_carmisol');
    const p_derechosElement = document.getElementById('p_derechos');
    const texto_btnElement = document.getElementById('switch_idioma');
    //CARMISOL
    const p_info_carmisolElement = document.getElementById('p_info_carmisol');
    const a_pedir_taxiElement = document.getElementById('a_pedir_taxi');
    const p_derechos_carmisolElement = document.getElementById('p_derechos_carmisol');
    //CONTACTANOS
    const h1_contactanosElement = document.getElementById('h1_contactanos');
    const p_info_contactoElement = document.getElementById('p_info_contacto');
    const p_contactanosElement = document.getElementById('p_contactanos');
    const a_contactanosElement = document.getElementById('a_contactanos');
    
    
    const switchIdioma = document.getElementById('switch_idioma');
    let currentLanguage = 'es';

    // Cargar idioma desde localStorage
    const storedLanguage = localStorage.getItem('language');
    if (storedLanguage) {
        currentLanguage = storedLanguage;
    }

    const loadContent = (language) => {
        fetch('idiomas-index.json')
            .then(response => response.json())
            .then(data => {
                //LOGIN
                if (a_contactoElement) a_contactoElement.textContent = data[language].a_contacto;
                if (a_nosotrosElement) a_nosotrosElement.textContent = data[language].a_nosotros;
                if (a_clientesElement) a_clientesElement.textContent = data[language].a_clientes;    
                if (h1_bienvenidoElement) h1_bienvenidoElement.textContent = data[language].h1_bienvenido;    
                if (p_info_nosotrosElement) p_info_nosotrosElement.textContent = data[language].p_info_nosotros;    
                if (h2_clienteElement) h2_clienteElement.textContent = data[language].h2_cliente;    
                if (p_carmisolElement) p_carmisolElement.textContent = data[language].p_carmisol;    
                if (p_derechosElement) p_derechosElement.textContent = data[language].p_derechos;   
                if (texto_btnElement) texto_btnElement.textContent = data[language].switch_idioma; 
                //CARMISOL
                if (p_info_carmisolElement) p_info_carmisolElement.textContent = data[language].p_info_carmisol; 
                if (a_pedir_taxiElement) a_pedir_taxiElement.textContent = data[language].a_pedir_taxi; 
                if (p_derechos_carmisolElement) p_derechos_carmisolElement.textContent = data[language].p_derechos_carmisol; 
                //CONTACTANOS
                if (h1_contactanosElement) h1_contactanosElement.textContent = data[language].h1_contactanos;
                if (p_info_contactoElement) p_info_contactoElement.textContent = data[language].p_info_contacto; 
                if (p_contactanosElement) p_contactanosElement.textContent = data[language].p_contactanos; 
                if (a_contactanosElement) a_contactanosElement.textContent = data[language].a_contactanos;
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

// Animación de scroll
const sections = document.querySelectorAll('.section');

window.addEventListener('scroll', checkSectionVisibility);

function checkSectionVisibility() {
    const triggerBottom = window.innerHeight / 5 * 4;

    sections.forEach(section => {
        const sectionTop = section.getBoundingClientRect().top;

        if (sectionTop < triggerBottom) {
            section.classList.add('visible');
        } else {
            section.classList.remove('visible');
        }
    });
}

// Llama a la función una vez al cargar la página
checkSectionVisibility();