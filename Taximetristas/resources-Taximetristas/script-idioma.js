//----------------------------------------------CAMBIAR IDIOMA-----------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    // HOME
    const btn_iniciar_turnoElement = document.getElementById('btn_iniciar_turno');
    const title_panelElement = document.getElementById('title_panel');
    const p_km_inicialElement = document.getElementById('p_km_inicial');
    const p_numero_cocheElement = document.getElementById('p_numero_coche');
    const seleccionar_matriculaElement = document.getElementById('seleccionar_matricula');
    const btn_submitElement = document.getElementById('btn_submit');
    const btn_registrar_viajeElement = document.getElementById('btn_registrar_viaje');
    const p_costo_viajeElement = document.getElementById('p_costo_viaje');
    const p_metodo_pago_viajeElement = document.getElementById('p_metodo_pago_viaje');
    const select_metodo_pagoElement = document.getElementById('select_metodo_pago');
    const select_efectivoElement = document.getElementById('select_efectivo');
    const select_tarjetaElement = document.getElementById('select_tarjeta');
    const select_transferenciaElement = document.getElementById('select_transferencia');
    const p_nombre_clienteElement = document.getElementById('p_nombre_cliente');
    const option_select_clienteElement = document.getElementById('option_select_cliente');
    const p_km_finalElement = document.getElementById('p_km_final');
    

    const switchIdioma = document.getElementById('switch_idioma');
    let currentLanguage = 'es';

    // Cargar idioma desde localStorage
    const storedLanguage = localStorage.getItem('language');
    if (storedLanguage) {
        currentLanguage = storedLanguage;
    }

    const loadContent = (language) => {
        fetch('../resources-Taximetristas/idiomas-taxistas.json')
            .then(response => response.json())
            .then(data => {
                // HOME
                if (titulo_headerElement) titulo_headerElement.textContent = data[language].titulo_header;
                if (btn_iniciar_turnoElement) btn_iniciar_turnoElement.textContent = data[language].btn_iniciar_turno;
                if (title_panelElement) title_panelElement.textContent = data[language].title_panel;
                if (p_km_inicialElement) p_km_inicialElement.textContent = data[language].p_km_inicial;
                if (p_numero_cocheElement) p_numero_cocheElement.textContent = data[language].p_numero_coche;
                if (seleccionar_matriculaElement) seleccionar_matriculaElement.textContent = data[language].seleccionar_matricula;
                if (btn_submitElement) btn_submitElement.textContent = data[language].btn_submit;
                if (btn_registrar_viajeElement) btn_registrar_viajeElement.textContent = data[language].btn_registrar_viaje;
                if (p_costo_viajeElement) p_costo_viajeElement.textContent = data[language].p_costo_viaje;
                if (p_metodo_pago_viajeElement) p_metodo_pago_viajeElement.textContent = data[language].p_metodo_pago_viaje;
                if (select_metodo_pagoElement) select_metodo_pagoElement.textContent = data[language].select_metodo_pago;
                if (select_efectivoElement) select_efectivoElement.textContent = data[language].select_efectivo;
                if (select_tarjetaElement) select_tarjetaElement.textContent = data[language].select_tarjeta;
                if (select_transferenciaElement) select_transferenciaElement.textContent = data[language].select_transferencia;
                if (p_nombre_clienteElement) p_nombre_clienteElement.textContent = data[language].p_nombre_cliente;
                if (option_select_clienteElement) option_select_clienteElement.textContent = data[language].option_select_cliente;
                if (p_km_finalElement) p_km_finalElement.textContent = data[language].p_km_final;

                
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