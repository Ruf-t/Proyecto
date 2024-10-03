<?php
include 'functions.php';
include 'login-bd.php';

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


if (isset($_POST["user"]) && isset($_POST["contrasenia"])){

    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    header('Content-Type: application/json');

    logear($con, $user, $contrasenia);

    // echo json_encode($logear);
    // exit();
}


if (isset($_GET['cargar_viajes'])) {
    $datos_viaje = datos_tabla_viaje($con);
    var_dump($datos_viaje);
    foreach ($datos_viaje as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['Nombre_Taxista'] . "</td>";
        echo "<td>" . $fila['Nombre_Cliente'] . "</td>";
        echo "<td>" . $fila['matricula'] . "</td>";
        echo "<td>" . $fila['Fecha'] . "</td>";
        echo "<td>" . $fila['Método_de_pago'] . "</td>";
        echo "<td>" . $fila['Tarifa'] . "</td>";
        echo "</tr>";
    }
    exit();
}
