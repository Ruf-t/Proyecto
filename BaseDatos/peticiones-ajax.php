<?php
include 'functions.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['matricula']) && isset($_POST['modelo']) && isset($_POST['anio']) && isset($_POST['estado']) ) {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $estado = $_POST['estado'];


    // guarda la llamada de la funcion en la variable respuesta
    $respuesta = agregar_taxi($con, $matricula, $modelo, $anio, $estado);

    header('Content-Type: application/json');
    // devuelve la respuesta en formato JSON
    echo json_encode($respuesta);
    exit(); // asegura que no ejecute las peticiones por debajo
}

?>
