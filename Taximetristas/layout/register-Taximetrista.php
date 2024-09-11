<?php
include("/xampp/htdocs/Proyecto/BaseDatos/register-BD.php");
if (
    isset($_POST['envioRegisterTaximetrista'])
    // isset($_POST['KmInicialTaximetrista']) && 
    // isset($_POST['NumeroDeCocheTaximetrista']) && 
    // isset($_POST['nombre']) && 
    // isset($_POST['apellido']) && 
    // isset($_POST['direccionTaximetrista']) && 
    // isset($_POST['telTaxista']) && 
    // isset($_POST['libretaConducir']) && 
    // isset($_POST['vencimientoLibrCond']) && 
    // isset($_POST['fechaNacTaximetrista']) && 
    // isset($_POST['userTaxi']) && 
    // isset($_POST['contraseniaTaxi'])
) {
    // Obtener datos del formulario
    $KmInicialTaximetrista = $_POST["KmInicialTaximetrista"];
    $NumeroDeCocheTaximetrista = $_POST["NumeroDeCocheTaximetrista"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccionTaximetrista = $_POST["direccionTaximetrista"];
    $telTaxista = $_POST["telTaxista"];
    $libretaConducir = $_POST["libretaConducir"];
    $vencimientoLibrCond = $_POST["vencimientoLibrCond"];
    $fechaNacTaximetrista = $_POST["fechaNacTaximetrista"];
    $userTaxi = $_POST["userTaxi"];
    $contraseniaTaxi = $_POST["contraseniaTaxi"];

    // Llamar a la función para agregar usuario
    registrarTaxi($con, $nombre, $apellido, $direccionTaximetrista, $telTaxista, $libretaConducir, $vencimientoLibrCond, $fechaNacTaximetrista,  $userTaxi, $contraseniaTaxi);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    
    <link rel="stylesheet" href="../style/style-Taximetristas.css">
</head>

<body class="body-register">
    <div class="container-login">
        <div class="register-card">
            <div class="logo-container">
                <img src="../../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" alt="Logo" class="logo">
            </div>
            <h1 class="title-login">Inciar sesión</h1>
            <form action="register-Taximetrista.php" method="post">
                <p>Nombre</p>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                <p>Apellido</p>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido">
                <p>Direccion</p>
                <input type="text" id="direccionTaximetrista" name="direccionTaximetrista" placeholder="Direccion">
                <p>Fecha de nacimiento</p>
                <input type="date" id="fechaNacTaximetrista" name="fechaNacTaximetrista" placeholder="Fecha de nacimiento">

                <p>Categoria de libreta de conducir</p>
                <input type="text" id="libretaConducir" name="LibretaConducir" placeholder="Categoria de libreta de conducir">
                <p>Fecha de Vencimiento libreta de conducir</p>
                <input type="date" id="vencimientoLibrCond" name="vencimientoLibrCond" placeholder="Fecha de Vencimiento libreta de conducir">
                <p>Telefono</p>
                <input type="number" id="telTaxista" name="telTaxista" placeholder="Numero de telefono">
            
                <p>Nombre de Usuario</p>
                <input type="text" id="userTaxi" name="userTaxi" placeholder="Usuario">
                <p>Contraseña</p>
                <input type="password" id="contraseniaTaxi" name="contraseniaTaxi" placeholder="Contraseña">


                <button type="submit" name="envioRegisterTaximetrista" class="button-login-TXs">Iniciar Sesión</button>
            </form>
            <!-- s<p class="p-log-reg"> <a href="register.php">Registrarme</a></p> -->
        </div>
    </div>
    
    <script src="../resources/script.js"></script>
</body>
</html>
