<?php
include 'functions.php';


if (isset($_POST['matricula']) && isset($_POST['modelo']) && isset($_POST['anio']) && isset($_POST['estado']) ) {
    $Matricula = $_POST['matricula'];
    $Modelo = $_POST['modelo'];
    $Anio = $_POST['anio'];
    $Esatado = $_POST['estado'];


    // guarda la llamada de la funcion en la variable respuesta
    $respuesta = FormJornadaUserTaxis($con, $Matricula,  $Modelo, $Anio, $Esatado);


    // devuelve la respuesta en formato JSON
    echo json_encode($respuesta);
    exit(); // asegura que no ejecute las peticiones por debajo
}

?>
