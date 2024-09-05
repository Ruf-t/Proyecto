<?php
session_start();
    if (!isset($_SESSION['user'])) {
        header("Location:index-Taximetrista.php");
        exit;
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

<body class="body-login">
    <div class="container-login">
        <div class="login-card">
            <div class="logo-container">
                <img src="../../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" alt="Logo" class="logo">
            </div>
            <h1 class="title-login">Inciar sesión</h1>
            <form action="../BaseDatos/login-bd.php" method="post">
                <!-- <label for="user">Usuario</label> -->
                <input type="text" id="user" name="user" placeholder="Usuario">
                <!-- <label for="contrasenia">Contraseña</label> -->
                <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña">
                <button type="submit" name="envio" class="button-login-TXs">Iniciar Sesión</button>
            </form>
            <p class="p-log-reg">No tengo cuenta <a href="register.php">Registrarme</a></p>
        </div>
    </div>
    
    <script src="../resources/script.js"></script>
</body>
</html>
