<?php
include("/xampp/htdocs/Proyecto/BaseDatos/functions.php");

session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: index-Taximetrista.php");
        exit;
    }
if (isset($_SESSION['usuario'])) {
    echo "Bienvenido, " . $_SESSION['usuario'];
} else {
    // Si no hay sesión iniciada, redirigir al login
    header("Location: login.php");
}

if (isset($_POST['KmInicialTaximetrista']) && isset($_POST['NumeroDeCocheTaximetrista'])) {
    // Obtener datos del formulario
    $KmInicialTaximetrista = $_POST["KmInicialTaximetrista"];
    $NumeroDeCocheTaximetrista = $_POST["NumeroDeCocheTaximetrista"];   

    // echo '<div class="container">'; 
    FormJornadaUserTaxis($con,$KmInicialTaximetrista,$NumeroDeCocheTaximetrista);  
     // echo '<br>' . '<button class="form-button" id="back"><a href="index.php">Volver a la página principal</a></button>';
    // echo"</div>";
    // Llamar a la función para agregar usuario
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="icon" href="../../resources/img/Others/Favicon-Ruft.png" type="image/png">
    <link rel="stylesheet" href="../style/style-Taximetristas.css">
</head>

<body>
    <h3>Jornada</h3>
    <!-- Botón select -->
    <button class="selectButton" data-target="formContainer1">Iniciar Jornada <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>
    <!-- Contenedor de Iniciar Jornada -->
    <div id="formContainer1" class="hidden">
    <form action="home-Taximetrista.php" method="post" class="formulario">
        <p>Km inicial</p>
        <input type="number" name="KmInicialTaximetrista" id="KmInicialTaximetrista" placeholder="">
        <!-- <p>Fecha</p>
        <input type="date" placeholder=""> -->
        <p>Número de coche</p>
        <input type="text" name="NumeroDeCocheTaximetrista" id="NumeroDeCocheTaximetrista"  placeholder="">
        <button>Guardar</button>
    </form>    
    </div>


    <button class="selectButton" data-target="formContainer2">Iniciar viaje <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>
    <!-- Contenedor de Iniciar Viaje -->
    <div id="formContainer2" class="hidden">
    <form action="home-Taximetrista.php" method="post" class="formulario">
        <p>Costo</p>
        <input type="number" name="CostoViajeTaximetrista" id="CostoViajeTaximetrista" placeholder="">
        <p>Metodo de pago</p>
        <select name="MetodoDePagoTaximetrista" id="MetodoDePagoTaximetrista">
        <option value="">Seleccione un método de pago</option>
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="transferencia">Transferencia bancaria</option>
        <option value="otros">Otros</option>
    </select>
    <p>Ingresa el nombre del cliente (Si es que esta registrado)</p>
    <input type="text" name="ClienteViajeTaximetrista" id="ClienteViajeTaximetrista" placeholder="">
        <button>Guardar</button>
    </form>    
    </div>


    <button class="selectButton" data-target="formContainer3">Finalizar Jornada <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>

    <!-- Contenedor de Terminar Jornada -->
    <div id="formContainer3" class="hidden">
    <form action="home-Taximetrista.php" method="post" class="formulario">
        <p>Km final</p>
        <input type="number" name="KmFinalTaximetrista" id="KmFinalTaximetrista" placeholder="Ingresa el Km final de la jornada">
        <button>Guardar</button>
    </form>    
    </div>

    <script src="/proyecto/resources/script.js"></script>
    </body>

</html>