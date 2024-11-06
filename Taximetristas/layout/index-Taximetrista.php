<?php
include_once("../../BaseDatos/functions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../style/style-Taximetristas.css">
    <link rel="icon" href="../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" type="image/png">
</head>
<body class="body-login">
<div class="container-login">
        <div class="login-card">
            <div class="logo-container">
                <img src="../../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" alt="Logo" class="logo">
            </div>
            <h1 class="title-login" id="h1_login"></h1>
            <form  id="form-inicioS-taximetrista" method="post" name="envioLogearTaximetrista">
                <div class="div-index-form">
                    <h3 class="h3-titulos" id="h3_user"></h3>
                    <input type="text" id="userTaxi" name="userTaxi" require>
                </div>
                <div class="div-index-form">
                    <h3 class="h3-titulos" id="h3_contra"></h3>
                    <input type="password" id="contraseniaTaxi" name="contraseniaTaxi" require>
                </div>
                   <button class="button-login-TXs" id="btn_login"></button>
            </form>
            <!-- <p class="p-log-reg">No tengo cuenta <a href="register-Taximetrista.php">Registrarme</a></p> -->
            <div class="respuestaAJAX" id="respuestaAJAX-index">
                <p class="mensajeAJAX"></p>
            </div>
        </div>
    </div>
    <button class="switch_idioma_index" id="switch_idioma"></button>

   

    <!---- importación de jQuery ---->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Scripts personalizados -->
    <script src="../resources-Taximetristas/script-idioma.js"></script>
    <script src="/proyecto/resources/script.js"></script>
    <script src="../resources-Taximetristas/ajax-taximetrista.js"></script>
</body>
</html>
