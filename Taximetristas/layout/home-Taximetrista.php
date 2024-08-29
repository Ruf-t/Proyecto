<?php
include("/xampp/htdocs/Proyecto/BaseDatos/functions.php");
// include("/xampp/htdocs/Proyecto/BaseDatos/conexionBD.php");

// $con = conectar_bd();
if (isset($_POST['KmInicialTaximetrista']) && isset($_POST['NumeroDeCocheTaximetrista'])) {
    // Obtener datos del formulario
    $KmInicialTaximetrista = $_POST["KmInicialTaximetrista"];
    $NumeroDeCocheTaximetrista = $_POST["NumeroDeCocheTaximetrista"];   

    // echo '<div class="container">'; 
    envioFormUserTaxis($con,$KmInicialTaximetrista,$NumeroDeCocheTaximetrista);   // echo '<br>' . '<button class="form-button" id="back"><a href="index.php">Volver a la página principal</a></button>';
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

    <link rel="stylesheet" href="../style/style-Taximetristas.css">
</head>

<body>
    <h1>Inciar sesión</h1>
    <!-- Botón select -->
    <button id="selectButton">Iniciar Jornada <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"
            alt="" id="flecha"></button>

    <!-- Contenedor de los inputs y el botón adicional -->
    <div id="formContainer" class="hidden">
    <form action="home-Taximetrista.php" method="post" class="formulario">
        <p>Km inicial</p>
        <input type="number" name="KmInicialTaximetrista" id="KmInicialTaximetrista" placeholder="">
        <!-- <p>Fecha</p>
        <input type="date" placeholder=""> -->
        <p>Número de coche</p>
        <input type="text" name="NumeroDeCocheTaximetrista" id="NumeroDeCocheTaximetrista"  placeholder="">
        <button>Submit</button>
    </form>    
    </div>

    <script src="/proyecto/resources/script.js"></script>
    </body>

</html>