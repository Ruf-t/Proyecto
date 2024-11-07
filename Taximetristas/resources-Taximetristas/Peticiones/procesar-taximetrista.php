<?php
include '../../../BaseDatos/functions.php';
session_start();
if (isset($_POST['userTaxi']) && isset($_POST['contraseniaTaxi'])) {
        // Obtener datos del formulario
        $userTaxi = $_POST["userTaxi"];
        $contraseniaTaxi = $_POST["contraseniaTaxi"];
         
        // Llamar a la función para agregar usuario
        logearTaxi($con, $userTaxi, $contraseniaTaxi);
        exit();
    }
    

// verifica si se envio los datos del formulario de iniciar jornada
if (isset($_POST['KmInicialTaximetrista']) && isset($_POST['NumeroDeCocheTaximetrista'])) {
    $kmInicial = $_POST['KmInicialTaximetrista'];
    $numeroCoche = $_POST['NumeroDeCocheTaximetrista'];

    // guarda la llamada de la funcion en la variable respuesta
    $respuesta = FormJornadaUserTaxis($con, $kmInicial, $numeroCoche);

    // devuelve la respuesta en formato JSON
    echo json_encode($respuesta);
    exit(); // asegura que no ejecute las peticiones por debajo
}


// envio de el formulario de finalizar jornada
if (isset($_POST['KmFinalTaximetrista'])) {
    
    $kmFinal = $_POST['KmFinalTaximetrista'];

     // guarda la llamada de la funcion en la variable respuesta
    $respuesta = FormTerminarJornadaUserTaxis($con,$kmFinal);

    // devuelve la respuesta en formato JSON
    echo json_encode($respuesta);
    exit(); //asegura que no ejecute las peticiones por debajo
}




if (isset($_POST['CostoViajeTaximetrista']) && isset($_POST['MetodoDePagoTaximetrista']) && isset($_POST['ClienteViajeTaximetrista'])) {
    $CostoViajeTaximetrista = $_POST['CostoViajeTaximetrista'];
    $MetodoDePagoTaximetrista = $_POST['MetodoDePagoTaximetrista'];
    $ClienteViajeTaximetrista = $_POST['ClienteViajeTaximetrista'];

    $respuesta = FormInciarViajeUserTaxis($con, $CostoViajeTaximetrista, $MetodoDePagoTaximetrista, $ClienteViajeTaximetrista);
    echo json_encode($respuesta);
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan campos por llenar']);
}


// cerrarSesionTaximetrista();

function cerrarSesionTaximetrista(){
    if (!isset($_SESSION['userTaxi'])) {
        // Si no hay sesión activa, redirige
        echo json_encode(["status" => "error", "message" => "No hay sesión activa."]);
        return;
    }
    
    // Si el botón de cerrar sesión fue presionado
    if (isset($_POST['cerrarSesionTaximetrista'])) {    
        // Destruir todas las variables de sesión
        session_unset();
    
        // Destruir la sesión
        session_destroy();
    
        // Retornar una respuesta exitosa en formato JSON
        echo json_encode(["status" => "success", "message" => "Sesión cerrada exitosamente"]);
    }
}

// Llamar a la función de cerrar sesión
cerrarSesionTaximetrista();


// Si ninguna de las condiciones anteriores se cumple
// echo json_encode(['success' => false, 'message' => 'Por favor, rellena todos los campos.']);