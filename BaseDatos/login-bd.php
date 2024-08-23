<?php 
require("conexionBD.php");

$con = conectar_bd();

if (isset($_POST["envio"])) {

    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    // Llamada a la función login
    logear($con, $user, $contrasenia);
}

function logear($con, $user, $contrasenia) {

    // Iniciar la sesión
    session_start();

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
?>
