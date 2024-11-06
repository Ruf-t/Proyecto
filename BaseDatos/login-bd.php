<?php 
session_start();
cerrarSesion();


//LOGIN 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = conectar_bd(); // Función para conectar a la BD

    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    // Llamar a la función para verificar las credenciales
    logear($con, $user, $contrasenia);
}

if (isset($_POST["cerrarSesionTaximetrista"])) {
    // Llamada a la función login
    cerrarSesionTaximetrista();
}

function cerrarSesion() {
    // Verifica si el usuario está logueado
    if (!isset($_SESSION['Usuario'])) { // Asegúrate de que este es el nombre de la variable de sesión que usaste
        header("Location: ../Register-Login/login.php");
        exit;
    }
    
    // Verifica si se ha enviado el formulario para cerrar sesión
    if (isset($_POST['cerrar_sesion'])) {    
        // Destruir todas las variables de sesión
        session_unset();
    
        // Destruir la sesión
        session_destroy();
    
        // Redirigir al usuario al inicio de sesión
        header("Location: ../Register-Login/login.php");
        exit;
    }
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
