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


function registrarTaxi($con, $nombre, $apellido, $direccionTaximetrista, $telTaxista, $libretaConducir, $vencimientoLibrCond, $fechaNacTaximetrista,  $userTaxi, $contraseniaTaxi ){
    
    // Insertar datos en la tabla persona
    $insert_persona_query = "INSERT INTO `persona`(`Nombre`, `Apellido`, `Direccion`, `Telefono`) VALUES ('$nombre', '$apellido', '$direccionTaximetrista', '$telTaxista')";
    
    if (mysqli_query($con, $insert_persona_query)) {
        // Recuperar el ID de la persona insertada
        $persona_id = mysqli_insert_id($con);
        
        // Hashear la contraseña antes de insertarla en la base de datos
        $hashed_password = password_hash($contraseniaTaxi, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario con la contraseña hasheada
        $insert_query = "INSERT INTO `taximetrista`(`ID`, `Licencia_De_Conducir`, `Fecha_Expiracion_Licencia`, `Fecha_Nacimiento`, `Usuario`, `Contraseña`, `FK-Persona`) VALUES 
        ('','$libretaConducir','$vencimientoLibrCond','$fechaNacTaximetrista','$userTaxi','$hashed_password','$persona_id')";
        
        if (mysqli_query($con, $insert_query)) {
            echo "Usuario registrado exitosamente";
            header("Location: index-Taximetrista.php");
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($con);
        }
    } else {
        echo "Error al registrar la persona: " . mysqli_error($con);
    }
}


