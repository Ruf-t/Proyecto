<?php
include 'functions.php';
// include 'login-bd.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

//TAXIMETRISTAS DEL MES 
if (isset($_POST['action']) && $_POST['action'] === 'get_ranking_taxistas') {
    // Llamamos a la función de ranking
    $ranking = RankingTaxistasMes($con);
    
    // Devolvemos la respuesta en formato JSON
    echo json_encode($ranking);
    exit();
}

// MOSTRAR CLIENTES
if (isset($_POST['accion']) && $_POST['accion'] == 'mostrar_clientes') {
    $datos_clientes = mostrar_datos_cliente($con); // Llama a la función que obtiene los datos de clientes
    header('Content-Type: application/json');
    echo json_encode($datos_clientes); // Devuelve los datos en formato JSON
    exit();
}

// RECARGAR VIAJES (ACTUALIZADO)
if (isset($_POST['turno']) || isset($_POST['fecha'])) {
    // Verificar si se enviaron filtros
    $turno = isset($_POST['turno']) ? $_POST['turno'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

    // Llamar a la función que obtiene los viajes filtrados
    $datos_viaje = obtenerViajesFiltrados($turno, $fecha, $con);

    if (!empty($datos_viaje)) {
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
    } else {
        echo "<tr><td colspan='6'>No se encontraron viajes.</td></tr>";
    }
    exit();
}


//LOGIN ADMINISTRADOS
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $con = conectar_bd(); // Función para conectar a la BD

    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    // Llamar a la función para verificar las credenciales
    logear($con, $user, $contrasenia);
    exit();
}



//REGISTRAR ADMINISTRADOR
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $usuario = $_POST['user'];
        
    //     if (usuarioYaRegistrado($con, $usuario)) {
    //         echo json_encode(['exists' => true]);
    //     } else {
    //         // Si el usuario no existe
    //         echo json_encode(['exists' => false]);
    //     }
    // }

// // AÑADIR TAXI
// if (isset($_POST['matricula']) && isset($_POST['modelo']) && isset($_POST['anio']) && isset($_POST['estado']) ) {
//     $matricula = $_POST['matricula'];
//     $modelo = $_POST['modelo'];
//     $anio = $_POST['anio'];
//     $estado = $_POST['estado'];
    

//     // guarda la llamada de la funcion en la variable respuesta
//     $respuesta = agregar_taxi($con, $matricula, $modelo, $anio, $estado);

//     header('Content-Type: application/json');
//     // devuelve la respuesta en formato JSON
//     echo json_encode($respuesta);
//     exit(); // asegura que no ejecute las peticiones por debajo
// }

if (isset($_POST['matricula']) && isset($_POST['modelo']) && isset($_POST['anio']) && isset($_POST['estado'])) {
    
    // Obtener y limpiar los valores de los inputs
    $matricula = trim($_POST['matricula']);
    $modelo = trim($_POST['modelo']);
    $anio = trim($_POST['anio']);
    $estado = trim($_POST['estado']);
    
    $errores = [];

    // Validar matrícula
    if (strlen($matricula) < 7 || strlen($matricula) > 8) {
        $errores[] = "La matrícula debe tener entre 7 y 8 caracteres.";
    }

    // Validar modelo
    if (strlen($modelo) < 3 || strlen($modelo) > 20) {
        $errores[] = "El modelo debe tener entre 3 y 20 caracteres.";
    }

    // Validar año (4 dígitos)
    if (!preg_match('/^\d{4}$/', $anio)) {
        $errores[] = "El año debe tener 4 dígitos.";
    }

    // Validar estado
    if (empty($estado)) {
        $errores[] = "Por favor, selecciona un estado.";
    }

    // Si hay errores, devolverlos en formato JSON
    if (!empty($errores)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => implode(' ', $errores)]);
        exit();
    }

    // Si no hay errores, llama a la función para agregar el taxi
    $respuesta = agregar_taxi($con, $matricula, $modelo, $anio, $estado);

    // Formatear y devolver la respuesta
    header('Content-Type: application/json');
    if ($respuesta) {
        echo json_encode(['success' => true, 'message' => 'Taxi agregado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Hubo un problema al agregar el taxi.']);
    }
    exit(); // asegura que no ejecute las peticiones por debajo
}

// LOGEAR
// if (isset($_POST["user"]) && isset($_POST["contrasenia"])){

//     $user = $_POST["user"];
//     $contrasenia = $_POST["contrasenia"];

//     header('Content-Type: application/json');

//     logear($con, $user, $contrasenia);

//     // echo json_encode($logear);
//     // exit();
// }




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





// MOSTRAR LA SUMA DE LOS VIAJES EN UNA JORNADA
// if (isset($_POST['action']) && $_POST['action'] === 'obtener_tarifas') {
//     obtener_total_tarifas_por_todas_jornadas($con); // Llamar a la función para obtener todas las jornadas
// }
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['action']) && $_POST['action'] === 'obtener_tarifas') {
//         // Llama a la función obtener_total_tarifas_por_todas_jornadas
//         obtener_total_tarifas_por_todas_jornadas($con);
//     } else {
//         echo json_encode(['error' => 'Acción no válida']);
//     }
// } else {
//     echo json_encode(['error' => 'Método no válido']);
// }


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['action']) && $_POST['action'] === 'obtener_tarifas') {
//         // Llama a la función obtener_total_tarifas_por_todas_jornadas
//         obtener_informacion_jornadas($con);
//     } else {
//         echo json_encode(['error' => 'Acción no válida']);
//     }
// } else {
//     echo json_encode(['error' => 'Método no válido']);
// }

if (isset($_POST['action']) && $_POST['action'] === 'obtener_tarifas') {
    
    // Configurar el encabezado para devolver JSON, debe ir antes de cualquier echo o salida
    header('Content-Type: application/json');
    
    // Llamar a la función que obtiene las tarifas y devolver el JSON
    echo obtener_informacion_jornadas($con);
    
    // Detener la ejecución para evitar que cualquier salida posterior interfiera
    exit;
    
} else {
    // En caso de que no se pase la acción correcta, devolver un error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Acción no válida']);
    exit;
}


