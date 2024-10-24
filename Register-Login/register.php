<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de sesión</title>
    <link rel="stylesheet" href="../resources/style.css">
    <link rel="stylesheet" href="../resources/style-register-login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3B.svg">
</head>
<body>
    <div class="login-box">
        <div class="login-container">
            <div class="left-panel">
                <img src="../resources/img/Others/foto-taxi.jpg" alt="Fondo">
            </div>
            <div class="right-panel">
                <div class="logo">
                    <button ><img src="../resources/img/Iconos-SVG/icons-others/flecha-izq.svg"></button>
                    <img src="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3A.svg" alt="Logo">
                </div>
                <h2 id="h2_register"></h2>
                <div class="no-tengo-cuenta">
                    <p id="p_register" class="p_register"></p><a href="login.php"><span id="a_register"></span></a>
                </div>
                <div id="message" class="message"></div>
                <form id="form-register" action="../BaseDatos/register-BD.php" method="post">
                    <div class="div-labels-forms-register">
                        <label for="nombre"><span id="label_nombre"></span></label>
                        <input type="text" id="nombre" name="nombre" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="apellido"><span id="label_apellido"></span></label>
                        <input type="text" id="apellido" name="apellido" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="telefono"><span id="label_telefono"></span></label>
                        <input type="number" id="telefono" name="telefono" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="direccion"><span id="label_direccion"></span></label>
                        <input id="direccion" name="direccion" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="user"><span id="label_usuario"></span></label>
                        <input type="text" id="user1" name="user" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="contrasenia"><span id="label_contrasenia"></span></label>
                        <input type="password" id="contrasenia1" name="contrasenia" require>
                    </div>
                    <div class="btn_submit_register">
                            <button class="btn_registrarse" type="submit" name="envio" id="btn_registrarse"></button>
                    </div>
                </form>
            </div>
            <button class="switch_idioma_index" id="switch_idioma"><img src="../resources/img/Iconos-SVG/icons-others/EN.svg"></button>
        </div>
    </div>    

    <script src="../resources/script.js"></script>
</body>
</html>

<!-- LOS TAXIMETRISTAS VAN A SER REGISTRADOS POR LOS ADMSINITRADOS, POR LO TANTO
 SOLO LOS ADMINISTRADORES VAN A TENER 
 REGISTRO Y LOS TAXIMETRISTAS VAN A TENER UN LOGIN NOMAS -->