<?php
include("/xampp/htdocs/Proyecto/BaseDatos/login-bd.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../style/style-Taximetristas.css">
 
</head>

<body class="body-login">
<div class="container-login">
        <div class="login-card">
            <div class="logo-container">
                <img src="../../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" alt="Logo" class="logo">
            </div>
            <h1 class="title-login">Inciar sesión</h1>
            <form id="form-inicioS-taximetrista" method="post">
                <!-- <label for="user">Usuario</label> -->
                <input type="text" id="userTaxi" name="userTaxi" placeholder="Usuario">
                <!-- <label for="contrasenia">Contraseña</label> -->
                <input type="password" id="contraseniaTaxi" name="contraseniaTaxi" placeholder="Contraseña">
                <button name="envioLogearTaximetrista" class="button-login-TXs">Iniciar Sesión</button>
            </form>
            <!-- <p class="p-log-reg">No tengo cuenta <a href="register-Taximetrista.php">Registrarme</a></p> -->
            <div class="respuestaAJAX" id="respuestaAJAX-index">
        <p class="mensajeAJAX"></p>
            </div>
        </div>
    </div>
    

       <!---- importación de jQuery ---->
       <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Scripts personalizados -->
    <script src="/proyecto/resources/script.js"></script>
    <script src="../resources-Taximetristas/ajax-taximetrista.js"></script>
</body>
</html>
