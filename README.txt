# Ruf-Track


## Descripción
**Ruf-Track** es un software de gestión de empresas de taxis, diseñado para optimizar el control y registro de operaciones diarias, reemplazando el uso tradicional de papel. Su objetivo es reducir errores comunes, como pérdidas de formularios o equivocaciones al registrar datos manualmente.


### Funcionalidades
El software cuenta con dos tipos de usuarios:
- **Administrador**: Tiene acceso a la gestión completa de la empresa, pudiendo visualizar, organizar y analizar los datos registrados en cada jornada por los taximetristas, además de administrar la información de taxis, clientes y otros datos clave.
- **Taximetrista**: Inicia y finaliza su jornada laboral a través del sistema, registrando el kilometraje inicial y final del vehículo y registrando los viajes realizados durante el día. Esto permite llevar un control preciso de las operaciones.


**Ruf-Track** resuelve el problema de los registros manuales, facilitando el acceso rápido y seguro a la información, minimizando los errores humanos y mejorando la eficiencia del proceso de gestión.


### Acceso
Para utilizar el programa, se han configurado credenciales de acceso en la base de datos para cada tipo de usuario:
- **Taximetristas**: Usuario: `admin`, Contraseña: `admin`
- **Administradores**: Usuario: `enzo123`, Contraseña: `123`


Estas credenciales fueron creadas para un acceso rápido y sencillo con fines de demostración.


## Estructura del Proyecto
El proyecto se divide en varias carpetas principales, cada una con un rol específico en el funcionamiento de **Ruf-Track**:


- **BaseDatos**: Contiene toda la lógica de backend, incluyendo peticiones, consultas a la base de datos y funciones esenciales del sistema.
- **layout**: Almacena las pantallas principales para administradores, como la página de inicio y otras vistas. Todo el contenido está desarrollado en PHP con estructura HTML.
- **Register-Login**: Incluye las pantallas de inicio de sesión y registro para los usuarios administradores.
- **resources**: Contiene los recursos necesarios como imágenes e íconos, así como los archivos JavaScript para AJAX/jQuery y el archivo JSON de traducción de idiomas.
- **RUFT-usuariofinal**: Esta carpeta guarda la landing page accesible para los usuarios que no pertenecen a la empresa.
- **Taximetristas**: Abarca todo lo relacionado con las interfaces y recursos de los taximetristas, incluyendo los layouts, los archivos de traducción de idiomas, los JavaScript de AJAX/jQuery y el archivo que gestiona las peticiones. También contiene el archivo de estilos para estas pantallas.


## Autores
- Valentino Cravea
- Juan Silveira
- Enzo Planchón
- Bruno Albornos


Este proyecto fue desarrollado como una herramienta educativa y de evaluación para su presentación ante nuestro profesor.