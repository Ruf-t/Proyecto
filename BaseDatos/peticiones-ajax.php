<?php
include 'functions.php';
include 'login-bd.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// AÑADIR TAXI
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

// LOGEAR
if (isset($_POST["user"]) && isset($_POST["contrasenia"])){

    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    header('Content-Type: application/json');

    logear($con, $user, $contrasenia);

    // echo json_encode($logear);
    // exit();
}

// RECARGAR VIAJES
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

// AÑADIR TAXISTA 
if (isset($_POST['Nombre']) && 
    isset($_POST['Apellido-Nuevo-Taxista']) && 
    isset($_POST['FechaNac-Nuevo-Taxista']) && 
    isset($_POST['Fecha-venc-librCond-Nuevo-Taxista']) && 
    isset($_POST['Direccion-Nuevo-Taxista']) && 
    isset($_POST['Telefono-Nuevo-Taxista']) && 
    isset($_POST['UserNuevo-Taxista']) &&
    isset($_POST['ContrNuevo-Taxista'])) {

    $Nombre = $_POST['Nombre'];
    $Apellido_Nuevo_Taxista = $_POST['Apellido-Nuevo-Taxista'];
    $FechaNac_Nuevo_Taxista = $_POST['FechaNac-Nuevo-Taxista'];
    $Fecha_venc_librCond_Nuevo_Taxista = $_POST['Fecha-venc-librCond-Nuevo-Taxista'];
    $Direccion_Nuevo_Taxista = $_POST['Direccion-Nuevo-Taxista'];
    $Telefono_Nuevo_Taxista = $_POST['Telefono-Nuevo-Taxista'];
    $UserNuevo_Taxista = $_POST['UserNuevo-Taxista'];
    $ContrNuevo_Taxista = $_POST['ContrNuevo-Taxista'];

    // guarda la llamada de la función en la variable respuesta
    $respuesta = agregar_taximetrista($con, $Nombre, $Apellido_Nuevo_Taxista, $FechaNac_Nuevo_Taxista, $Fecha_venc_librCond_Nuevo_Taxista, $Direccion_Nuevo_Taxista, $Telefono_Nuevo_Taxista, $UserNuevo_Taxista, $ContrNuevo_Taxista);
   
    header('Content-Type: application/json');
    // devuelve la respuesta en formato JSON
    echo json_encode($respuesta);
    exit(); // asegura que no ejecute las peticiones por debajo
}

// AÑADIR CLIENTE  
if (isset($_POST['NombreNuevo_Cliente']) && 
    isset($_POST['ApellidoNuevo_Cliente']) && 
    isset($_POST['TelefonoNuevo_Cliente']) && 
    isset($_POST['DireccionNuevo_Cliente']) && 
    isset($_POST['DeudaNuevo_Cliente'])){

    $NombreNuevo_Cliente = $_POST['NombreNuevo_Cliente'];
    $ApellidoNuevo_Cliente = $_POST['ApellidoNuevo_Cliente'];
    $TelefonoNuevo_Cliente = $_POST['TelefonoNuevo_Cliente'];
    $DireccionNuevo_Cliente = $_POST['DireccionNuevo_Cliente'];
    $DeudaNuevo_Cliente = $_POST['DeudaNuevo_Cliente'];

    // guarda la llamada de la función en la variable respuesta
    $respuesta = agregar_nuevo_cliente($con, $NombreNuevo_Cliente, $ApellidoNuevo_Cliente, $TelefonoNuevo_Cliente, $DireccionNuevo_Cliente, $DeudaNuevo_Cliente);
   
    header('Content-Type: application/json');
    // devuelve la respuesta en formato JSON
    echo json_encode($respuesta);
    exit(); // asegura que no ejecute las peticiones por debajo
}

// MOSTRAR CLIENTES
if (isset($_POST['accion']) && $_POST['accion'] == 'mostrar_clientes') {
    $datos_clientes = mostrar_datos_cliente($con); // Llama a la función que obtiene los datos de clientes
    header('Content-Type: application/json');
    echo json_encode($datos_clientes); // Devuelve los datos en formato JSON
    exit();
}


//APLICAR FILTROS TABLA VIAJES
// Obtener los valores de los selectores
$turno = $_POST['turno'] ?? '';
$fecha = $_POST['fecha'] ?? '';

// Función personalizada para obtener los viajes filtrados
$viajesFiltrados = obtenerViajesFiltrados($turno, $fecha, $con);

// Devolver las filas actualizadas
foreach ($viajesFiltrados as $fila) {
    echo "<tr>
            <td>{$fila['Nombre_Taxista']}</td>
            <td>{$fila['Nombre_Cliente']}</td>
            <td>{$fila['matricula']}</td>
            <td>{$fila['Fecha']}</td>
            <td>{$fila['Método_de_pago']}</td>
            <td>{$fila['Tarifa']}</td>
          </tr>";
}

