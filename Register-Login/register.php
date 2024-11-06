<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de sesión</title>
    <link rel="stylesheet" href="../resources/style.css">
    <link rel="icon" href="../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" type="image/png">
    <link rel="stylesheet" href="../resources/style-register-login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3B.svg">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../resources/ajax.js"></script>
</head>
<body>
    <div class="login-box">
        <div class="login-container">
            <div class="left-panel">
                <img src="../resources/img/Others/foto-taxi.jpg" alt="Fondo">
            </div>
            <div class="right-panel">
                <div class="logo">
                    <a href="login.php">
                        <button><img class="img_flecha" src="../resources/img/Iconos-SVG/icons-others/flecha-izq.svg"></button>
                    </a>
                    <img src="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3A.svg" alt="Logo">
                </div>
                <h2 id="h2_register"></h2>
                <div class="no-tengo-cuenta">
                    <p id="p_register" class="p_register"></p><a href="login.php"><span id="a_register"></span></a>
                </div>
                <div id="message" class="message"></div>
                <form id="form-register" method="post">
                    <div class="div-labels-forms-register">
                        <label for="NombreNuevo_Administrador"><span id="label_nombre"></span></label>
                        <input type="text" id="NombreNuevo_Administrador" name="NombreNuevo_Administrador" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="ApellidoNuevo_Administrador"><span id="label_apellido"></span></label>
                        <input type="text" id="ApellidoNuevo_Administrador" name="ApellidoNuevo_Administrador" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="TelefonoNuevo_Administrador"><span id="label_telefono"></span></label>
                        <input type="number" id="TelefonoNuevo_Administrador" name="TelefonoNuevo_Administrador" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="DireccionNuevo_Administrador"><span id="label_direccion"></span></label>
                        <input id="DireccionNuevo_Administrador" name="DireccionNuevo_Administrador" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="UserNuevo_Administrador"><span id="label_usuario"></span></label>
                        <input type="text" id="UserNuevo_Administrador" name="UserNuevo_Administrador" require>
                    </div>
                    <div class="div-labels-forms-register">
                        <label for="contraseniaNuevo_Administrador"><span id="label_contrasenia"></span></label>
                        <input type="password" id="contraseniaNuevo_Administrador" name="contraseniaNuevo_Administrador" require>
                    </div>
                    <div class="btn_submit_register">
                            <button class="btn_registrarse" type="submit"  id="btn_registrarse"></button>
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