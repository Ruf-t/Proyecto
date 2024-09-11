<?php 
require("conexionBD.php");

$con = conectar_bd();

session_start();

if (isset($_POST["envio"])) {

    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    // Llamada a la función login
    logear($con, $user, $contrasenia);
}

function cerrarSesion(){
    if (!isset($_SESSION['user'])) {
        header("Location: index.php");
        exit;
    }
    if (isset($_POST['cerrar_sesion'])) {    
        // Destruir todas las variables de sesión
        session_unset();
    
        // Destruir la sesión
        session_destroy();
    
        // Redirigir al usuario al inicio de sesión
        header("Location: index.php");
        exit;
    }
}

function logear($con, $user, $contrasenia) {
    $consulta_login = "SELECT * FROM administrador WHERE Usuario = '$user'";
    $resultado_login = mysqli_query($con, $consulta_login);

    if (mysqli_num_rows($resultado_login) > 0) {

        // Se crea una variable con el objeto fetch_assoc para acceder a las columnas que necesite
        $fila = mysqli_fetch_assoc($resultado_login);

        // Asignar en una variable el campo "Contraseña" de la BD
        $contrasenia_bd = $fila["Contraseña"];

        // Uso de la función password_verify para comparar lo que ingresa el usuario con lo que tengo en la BD
        if (password_verify($contrasenia, $contrasenia_bd)) {
            // Si todo es correcto, inicio la sesión y redirijo a la página del usuario logueado
            $_SESSION["Usuario"] = $user;
            header("Location: ../home.php");
            exit();
        } else {
            echo "Contraseña incorrecta.<br>";
        }
    } else {
        echo "Usuario no encontrado.<br>";
    }
}


function logearTaxi($con, $user, $contrasenia) {
    $consulta_login = "SELECT * FROM taximetrista WHERE Usuario = '$user'";
    $resultado_login = mysqli_query($con, $consulta_login);

    if (mysqli_num_rows($resultado_login) > 0) {

        // Se crea una variable con el objeto fetch_assoc para acceder a las columnas que necesite
        $fila = mysqli_fetch_assoc($resultado_login);

        // Asignar en una variable el campo "Contraseña" de la BD
        $contrasenia_bd = $fila["Contraseña"];

        // Uso de la función password_verify para comparar lo que ingresa el usuario con lo que tengo en la BD
        if (password_verify($contrasenia, $contrasenia_bd)) {
            // Si todo es correcto, inicio la sesión y redirijo a la página del usuario logueado
            $_SESSION["Usuario"] = $user;
            header("Location: ../home.php");
            exit();
        } else {
            echo "Contraseña incorrecta.<br>";
        }
    } else {
        echo "Usuario no encontrado.<br>";
    }
}
