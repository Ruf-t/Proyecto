<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="resources/style.css">
</head>

<body>
    <div class="login-box">
        <div class="login-container">
            <div class="left-panel">
                <img src="resources/img/Others/foto-taxi.jpg" alt="Fondo">
            </div>
            <div class="right-panel">
                <div class="logo">
                    <img src="resources/img/Logos-SVG-SinFondo/Modelo-A/Logo-3A.svg" alt="Logo">
                </div>
                <h2>Inicio sesión Administrador</h2>
                <p>Ingresa tu email y contraseña</p>
                <form action="login-bd.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu email">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña">
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>

    <script src="resources/script.js"></script>
</body>

</html>