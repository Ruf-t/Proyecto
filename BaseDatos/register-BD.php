<?php
require("conexionBD.php");

$con = conectar_bd();

if (isset($_POST["envio"])) {

    // Capturar los datos del formulario
    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    // Hashear la contraseña antes de insertarla en la base de datos
    $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario con la contraseña hasheada
    $insert_query = "INSERT INTO administrador (Usuario, Contraseña) VALUES ('$user', '$hashed_password')";
    
    if (mysqli_query($con, $insert_query)) {
        echo "Usuario registrado exitosamente";
        header("Location: ../Register-Login/index.php");
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($con);
    }
}

