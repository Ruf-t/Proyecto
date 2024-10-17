<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../resources/style.css">
    <link rel="stylesheet" href="../resources/style-register-login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../resources/ajax.js"></script>
</head>
<body>
    <div class="respuestaAJAX" id="respuestaAJAX-index">
    <p class="mensajeAJAX"></p>
</div>

    <div class="login-box">
        <div class="login-container">
            <div class="left-panel">
                <img src="../resources/img/Others/foto-taxi.jpg" alt="Fondo">
            </div>
            <div class="right-panel"> 
                <div class="logo">
                    <img src="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3A.svg" alt="Logo">
                </div>
                <h2 id="h2_inicio_sesion"></h2>
                <p id="p_inicio_sesion"></p>
                <form id="form-inicioS-admin" method="post">
                    <label for="user"><span id="label_usuario"></span></label>
                    <input type="text" id="user" name="user">
                    <label for="contrasenia"><span id="label_contrasenia"></span></label>
                    <input type="password" id="contrasenia" name="contrasenia">
                    <button type="submit" id="btn_iniciar_sesion"></button>
                </form>
                <div class="no-tengo-cuenta">
                    <p id="p_no_cuenta" class="p-log-reg"></p><a id="a_registrarme" href="register.php"></a>
                </div>
            </div>

        </div>
    </div>

    
    <script src="../resources/script.js"></script>
</body>
</html>
