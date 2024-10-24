<?php
require("conexionBD.php");

$con = conectar_bd();

if (isset($_POST["envio"])) {

    // Capturar los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $user = trim($_POST["user"]);
    $contrasenia = $_POST["contrasenia"];

    // Validar los campos
    if (empty($nombre) || empty($apellido) || empty($user) || empty($contrasenia)) {
        enviarRespuesta(false, "Todos los campos son obligatorios.");
        exit;
    }

    // Llamar a la función para registrar al administrador
    registrarAdmin($con, $nombre, $apellido, $user, $contrasenia);
}

function registrarAdmin($con, $nombre, $apellido, $user, $contrasenia) {
    // Iniciar una transacción
    mysqli_begin_transaction($con);

    try {
        // Verificar si el usuario o contraseña ya existen
        $query_check = "SELECT * FROM administrador WHERE Usuario = ?";
        $stmt_check = mysqli_prepare($con, $query_check);
        mysqli_stmt_bind_param($stmt_check, 's', $user);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
        
        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            enviarRespuesta(false, "El nombre de usuario ya está en uso.");
            mysqli_rollback($con);
            return;
        }

        // Insertar en la tabla persona
        $query_persona = "INSERT INTO persona (Nombre, Apellido, Telefono, Direccion) VALUES (?, ?, '', '')";
        $stmt_persona = mysqli_prepare($con, $query_persona);
        mysqli_stmt_bind_param($stmt_persona, 'ss', $nombre, $apellido);

        if (!mysqli_stmt_execute($stmt_persona)) {
            throw new Exception("Error al insertar en la tabla persona.");
        }

        // Obtener el ID de la persona
        $persona_id = mysqli_insert_id($con);

        // Hashear la contraseña
        $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);

        // Insertar en la tabla administrador
        $query_admin = "INSERT INTO administrador (PersonaID, Usuario, Contraseña) VALUES (?, ?, ?)";
        $stmt_admin = mysqli_prepare($con, $query_admin);
        mysqli_stmt_bind_param($stmt_admin, 'iss', $persona_id, $user, $hashed_password);

        if (!mysqli_stmt_execute($stmt_admin)) {
            throw new Exception("Error al insertar en la tabla administrador.");
        }

        // Confirmar la transacción
        mysqli_commit($con);
        enviarRespuesta(true, "Administrador registrado exitosamente.");

    } catch (Exception $e) {
        // En caso de error, revertir la transacción
        mysqli_rollback($con);
        enviarRespuesta(false, $e->getMessage());
    }

    // Cerrar las consultas preparadas
    mysqli_stmt_close($stmt_check);
    mysqli_stmt_close($stmt_persona);
    mysqli_stmt_close($stmt_admin);
}

// Función para enviar respuestas en formato JSON
function enviarRespuesta($success, $message) {
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
    exit;
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


