<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de sesión</title>
    <link rel="stylesheet" href="../resources/style.css">
    <link rel="stylesheet" href="../resources/style-register-login.css">
    <link rel="icon" type="image/png" href="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3B.svg">
</head>
<body>
    <div class="login-box">
        <div class="login-container">
            <div class="left-panel">
                <img src="../resources/img/Others/foto-taxi.jpg" alt="Fondo">
            </div>
            <div class="right-panel">
                <!-- <div class="div-btn-idioma">
                    <button id="btn-idioma-login"><img src="../resources/img/Iconos-SVG/icons-others/EN.svg"></button>
                </div> -->
                <div class="logo">
                    <img src="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3A.svg" alt="Logo">
                </div>
                <h2 id="h2_register"></h2>
                <p id="p_register"></p>
                <form id="form-register"  action="../BaseDatos/register-BD.php" method="post">
                    <div class="div-labels-register">
                        <label for="nombre"><span id="label_nombre"></span></label>
                        <label for="apellido"><span id="label_apellido"></span></label>
                        <label for="user"><span id="label_usuario"></span></label>
                        <label for="contrasenia"><span id="label_contrasenia"></span></label>
                        <a id="a_inicio_sesion" href="index.php">
                    </div>
                    <div class="div-inputs-register">
                        <input type="text" id="nombre" name="nombre">
                        <input type="text" id="apellido" name="apellido">
                        <input type="text" id="user1" name="user">
                        <input type="password" id="contrasenia1" name="contrasenia">
                        <button type="submit" name="envio" id="btn_registrarse"></button>
                    </div>
                </form>
            </div>
        </div>
        <button class="switch_idioma_index" id="switch_idioma"></button>
    </div>    

    <script src="../resources/script.js"></script>
</body>
</html>

<!-- LOS TAXIMETRISTAS VAN A SER REGISTRADOS POR LOS ADMSINITRADOS, POR LO TANTO
 SOLO LOS ADMINISTRADORES VAN A TENER 
 REGISTRO Y LOS TAXIMETRISTAS VAN A TENER UN LOGIN NOMAS -->