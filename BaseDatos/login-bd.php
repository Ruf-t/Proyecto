<?php
session_start();

function cerrarSesion() {
    if (!isset($_SESSION['Usuario'])) { 
        echo json_encode(["status" => "error", "message" => "No hay sesión activa."]);
        exit();
    }

    if (isset($_POST['cerrar_sesion'])) {
        session_unset();
        session_destroy();
        echo json_encode(["status" => "success", "message" => "Sesión cerrada exitosamente"]);
        header("Location: ../Register-Login/login.php");
        exit();
    }
}

cerrarSesion();
