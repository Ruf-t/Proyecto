<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>

    <link rel="stylesheet" href="../style/style-Taximetristas.css">
</head>

<body>
    <h1>Inciar sesión</h1>
    <!-- Botón select -->
    <button id="selectButton">Iniciar Jornada <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"
            alt="" id="flecha"></button>

    <!-- Contenedor de los inputs y el botón adicional -->
    <div id="formContainer" class="hidden">
    <form action="" class="formulario">
        <p>Km inicial</p>
        <input type="number" placeholder="">
        <!-- <p>Fecha</p>
        <input type="date" placeholder=""> -->
        <p>Número de coche</p>
        <input type="text" placeholder="">
        <button>Submit</button>
    </form>    
    </div>

    <script src="/proyecto/resources/script.js"></script>
    </body>

</html>