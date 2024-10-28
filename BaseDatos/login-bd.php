<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require("conexionBD.php");s

// $con = conectar_bd();

// session_start();

if (isset($_POST["cerrarSesionTaximetrista"])) {
    // Llamada a la función login
    cerrarSesionTaximetrista();
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


// function logear($con, $user, $contrasenia) {
//     // Preparar la consulta SQL para evitar inyección SQL
//     $consulta_login = "SELECT * FROM administrador WHERE Usuario = ?";
//     $stmt = mysqli_prepare($con, $consulta_login);

//     // Enlazar el parámetro (el usuario ingresado) a la consulta
//     mysqli_stmt_bind_param($stmt, "s", $user);

//     // Ejecutar la consulta
//     mysqli_stmt_execute($stmt);

//     // Obtener el resultado
//     $resultado_login = mysqli_stmt_get_result($stmt);

//     // Verificar si se encontró un usuario
//     if (mysqli_num_rows($resultado_login) > 0) {
//         $fila = mysqli_fetch_assoc($resultado_login);
//         $contrasenia_bd = $fila["Contraseña"];

//         if (password_verify($contrasenia, $contrasenia_bd)) {
//             $_SESSION["Usuario"] = $user;

//             // Respuesta exitosa en formato JSON
//             echo json_encode(array(
//                 "status" => "success",
//                 "message" => ""
//             ));
//         } else {
//             // Contraseña incorrecta
//             echo json_encode(array(
//                 "status" => "error",
//                 "message" => "Contraseña incorrecta. Intentelo de nuevo"
//             ));
//         }
//     } else {
//         // Usuario no encontrado
//         echo json_encode(array(
//             "status" => "error",
//             "message" => "Usuario no encontrado. Revise sus credenciales"
//         ));
//     }

//     // Cerrar la sentencia
//     mysqli_stmt_close($stmt);
// }

function logear($con, $user, $contrasenia) {
    // Preparar la consulta SQL para evitar inyección SQL
    $consulta_login = "SELECT * FROM administrador WHERE Usuario = ?";
    $stmt = mysqli_prepare($con, $consulta_login);

    // Enlazar el parámetro (el usuario ingresado) a la consulta
    mysqli_stmt_bind_param($stmt, "s", $user);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener el resultado
    $resultado_login = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró un usuario
    if (mysqli_num_rows($resultado_login) > 0) {
        $fila = mysqli_fetch_assoc($resultado_login);
        $contrasenia_bd = $fila["Contraseña"];

        if (password_verify($contrasenia, $contrasenia_bd)) {
            // Guardar el nombre de usuario en la sesión
            $_SESSION["Usuario"] = $user;

            // Respuesta exitosa en formato JSON
            echo json_encode(array(
                "status" => "success",
                "message" => ""
            ));
        } else {
            // Contraseña incorrecta
            echo json_encode(array(
                "status" => "error",
                "message" => "Contraseña incorrecta. Intentelo de nuevo"
            ));
        }
    } else {
        // Usuario no encontrado
        echo json_encode(array(
            "status" => "error",
            "message" => "Usuario no encontrado. Revise sus credenciales"
        ));
    }

    // Cerrar la sentencia
    mysqli_stmt_close($stmt);
}


// function logearTaxi($con, $userTaxi, $contrasenia) {
//     $consulta_login = "SELECT * FROM taximetrista WHERE Usuario = '$userTaxi'";
//     $resultado_login = mysqli_query($con, $consulta_login);

//     if (mysqli_num_rows($resultado_login) > 0) {

//         // Se crea una variable con el objeto fetch_assoc para acceder a las columnas que necesite
//         $fila = mysqli_fetch_assoc($resultado_login);

//         // Asignar en una variable el campo "Contraseña" de la BD
//         $contrasenia_bd = $fila["Contraseña"];

//         // Uso de la función password_verify para comparar lo que ingresa el usuario con lo que tengo en la BD
//         if (password_verify($contrasenia, $contrasenia_bd)) {
//             // Si todo es correcto, inicio la sesión y redirijo a la página del usuario logueado
//             $_SESSION["userTaxi"] = $userTaxi;
//             header("Location: ../Taximetristas/layout/home-Taximetrista.php");
//             exit();
//         } else {
//             echo "Contraseña incorrecta.<br>";
//         }
//     } else {
//         echo "Usuario no encontrado.<br>";
//     }
// }
function logearTaxi($con, $userTaxi, $contrasenia) {
    // Preparar la consulta SQL para evitar inyección SQL
    $consulta_login = "SELECT * FROM taximetrista WHERE Usuario = ?";
    $stmt = mysqli_prepare($con, $consulta_login);

    if (!$stmt) {
        // Manejo de error en la preparación de la consulta
        echo json_encode(array(
            "status" => "error",
            "message" => "Error en la consulta SQL"
        ));
        return;
    }

    // Enlazar el parámetro (el usuario ingresado) a la consulta
    mysqli_stmt_bind_param($stmt, "s", $userTaxi);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener el resultado
    $resultado_login = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró un usuario
    if (mysqli_num_rows($resultado_login) > 0) {
        $fila = mysqli_fetch_assoc($resultado_login);
        $contrasenia_bd = $fila["Contrasenia"];

        // Verificar si la contraseña ingresada coincide con la almacenada (hash)
        if (password_verify($contrasenia, $contrasenia_bd)) {
            $_SESSION["userTaxi"] = $userTaxi;  // Guardar el usuario en la sesión

            // Respuesta exitosa en formato JSON
            echo json_encode(array(
                "status" => "success",
                "message" => ""
            ));
        } else {
            // Contraseña incorrecta
            echo json_encode(array(
                "status" => "error",
                "message" => "Contraseña incorrecta. Intentelo de nuevo"
            ));
        }
    } else {
        // Usuario no encontrado
        echo json_encode(array(
            "status" => "error",
            "message" => "Usuario no encontrado. Revise sus credenciales"
        ));
    }

    // Cerrar la sentencia
    mysqli_stmt_close($stmt);
}


function cerrarSesionTaximetrista(){
    if (!isset($_SESSION['userTaxi'])) {
        header("Location: ../Taximetristas/layout/index-Taximetrista.php");
        exit;
    }
    if (isset($_POST['cerrarSesionTaximetrista'])) {    
        // Destruir todas las variables de sesión
        session_unset();
    
        // Destruir la sesión
        session_destroy();
    
        // Redirigir al usuario al inicio de sesión
        header("Location: ../Taximetristas/layout/index-Taximetrista.php");
        exit;
    }
}