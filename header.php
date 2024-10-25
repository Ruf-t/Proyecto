<?php    


session_start(); // Asegúrate de iniciar la sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['Usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../Register-Login/login.php");
    exit;
}
// Incluir archivos necesarios (ajusta la ruta según tu estructura de carpetas)
// include('BaseDatos/login-bd.php'); 
// include('BaseDatos/functions.php');

// Recuperar el nombre del usuario de la sesión
// $nombre_usuario = $_SESSION['Usuario'];
// <?php echo $nombre_usuario; 
?>
<div class="header">
    <div class="nombre-usuario">
        <h1 id="titulo_header"><img src="resources/img/Iconos-SVG/icons-others/hand.svg" alt=""></h1>
    </div>
    <!-- <div class="exit-img">
        <img src="../resources/img/Iconos-SVG/icons-others/exit-icon.svg">
    </div> -->
</div>


