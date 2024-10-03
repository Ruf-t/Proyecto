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
                <h2>Inicio sesión Administrador</h2>
                <p>Ingresa tu usuario y contraseña</p>
                <form id="form-inicioS-admin" method="post">
                    <label for="user">Usuario</label>
                    <input type="text" id="user" name="user" placeholder="Ingresa tu usuario">
                    <label for="contrasenia">Contraseña</label>
                    <input type="password" id="contrasenia" name="contrasenia" placeholder="Ingresa tu contraseña">
                    <button type="submit">Iniciar Sesión</button>
                </form>
                <p class="p-log-reg">No tengo cuenta <a href="register.php">Registrarme</a></p>
                
            </div>

        </div>
    </div>

    
    <script src="../resources/script.js"></script>
</body>
</html>
