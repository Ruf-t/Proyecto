<?php
include '../../../BaseDatos/functions.php'; // se llama al archivo de funciones 

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


// Si ninguna de las condiciones anteriores se cumple
// echo json_encode(['success' => false, 'message' => 'Por favor, rellena todos los campos.']);


