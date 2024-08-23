<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de sesión</title>
    <link rel="stylesheet" href="../resources/style.css">
    <link rel="stylesheet" href="../resources/style-register-login.css">
</head>

<body>
<div class="login-box">
<div class="login-container">
        <div class="left-panel">
            <img src="../resources/img/Others/foto-taxi.jpg" alt="Fondo">
        </div>
        <div class="right-panel">
            <div class="logo">
                <img src="../resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3A.svg" alt="Logo">
            </div>
            <h2>Registrarse como administrador</h2>
            <p>Ingresa tu email y contraseña</p>
            <form id="form-register"  action="../BaseDatos/register-BD.php" method="post">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido">
                    <label for="user">Usuario</label>
                    <input type="text" id="user" name="user" placeholder="Ingresa tu nombre de usuario">
                    <label for="contrasenia">Contraseña</label>
                    <input type="password" id="contrasenia" name="contrasenia" placeholder="Ingresa una contraseña">
                    <button type="submit" name="envio">Iniciar Sesión</button>
            </form>
        </div>
    </div>


</div>    

    <script src="resources/script.js"></script>
</body>

</html>



<!-- LOS TAXIMETRISTAS VAN A SER REGISTRADOS POR LOS ADMSINITRADOS, POR LO TANTO
 SOLO LOS ADMINISTRADORES VAN A TENER 
 REGISTRO Y LOS TAXIMETRISTAS VAN A TENER UN LOGIN NOMAS -->