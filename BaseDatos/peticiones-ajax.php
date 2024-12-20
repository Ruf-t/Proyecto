<?php
include 'functions.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// LOGIN 
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $con = conectar_bd(); // Función para conectar a la BD

//     $user = $_POST["user"];
//     $contrasenia = $_POST["contrasenia"];

//     // Llamar a la función para verificar las credenciales
//     logear($con, $user, $contrasenia);
//     exit();
// }

$con = conectar_bd();

// LOGIN este anda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user"]) && isset($_POST["contrasenia"])) {
    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    // Llamar a la función para verificar las credenciales
    logear($con, $user, $contrasenia);
    exit();
}




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

if (isset($_POST['fecha_I'])) {
    $fecha_I = $_POST['fecha_I'];

    // Incluir la función que obtiene las jornadas filtradas
    include_once('functions.php'); 

    // Llamar a la función que obtiene las jornadas filtradas
    $html = obtener_informacion_jornadas_filtradas($con, $fecha_I);

    // Devolver el HTML generado como respuesta
    echo $html;
    exit();
}


//REGISTRAR ADMINISTRADOR
if (isset($_POST['NombreNuevo_Administrador'], $_POST['ApellidoNuevo_Administrador'], $_POST['TelefonoNuevo_Administrador'], $_POST['DireccionNuevo_Administrador'], $_POST['UserNuevo_Administrador'], $_POST['contraseniaNuevo_Administrador'])) {
    $nombre = $_POST['NombreNuevo_Administrador'];
    $apellido = $_POST['ApellidoNuevo_Administrador'];
    $telefono = $_POST['TelefonoNuevo_Administrador'];
    $direccion = $_POST['DireccionNuevo_Administrador'];
    $usuario = $_POST['UserNuevo_Administrador'];
    $contrasenia = $_POST['contraseniaNuevo_Administrador'];
    
    header('Content-Type: application/json');
    
    // Llamar a la función y verificar el resultado
    $resultado = registrarNuevoAdministrador($con, $nombre, $apellido, $telefono, $direccion, $usuario, $contrasenia);
    
    if ($resultado) {
        // Respuesta exitosa
        echo json_encode(['success' => true, 'message' => 'Administrador registrado correctamente']);
    } else {
        // Respuesta de error
        echo json_encode(['success' => false, 'message' => 'Error al registrar el administrador']);
    }
}

// AÑADIR TAXI
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
    
    
    //----------------AÑADIR TAXIS----------------------------------
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
    
    
    
    //----------------AÑADIR CLIENTES----------------------------------
    if (isset($_POST['NombreNuevo_Cliente']) && isset($_POST['ApellidoNuevo_Cliente']) && isset($_POST['TelefonoNuevo_Cliente']) && isset($_POST['DeudaNuevo_Cliente']) && isset($_POST['DireccionNuevo_Cliente'])) {
        
        // Obtener y limpiar los valores de los inputs
        $nombre = trim($_POST['NombreNuevo_Cliente']);
        $apellido = trim($_POST['ApellidoNuevo_Cliente']);
        $telefono = trim($_POST['TelefonoNuevo_Cliente']);
        $deuda = trim($_POST['DeudaNuevo_Cliente']);
        $direccion = trim($_POST['DireccionNuevo_Cliente']);
        
        $errores = [];
        
        // Validar nombre
        if (!preg_match('/^[A-Z][a-zA-Z]{0,11}$/', $nombre)) {
        $errores[] = "El nombre debe empezar con mayúscula y tener un máximo de 12 caracteres.";
    }

    // Validar apellido
    if (!preg_match('/^[A-Z][a-zA-Z]{0,15}$/', $apellido)) {
        $errores[] = "El apellido debe empezar con mayúscula y tener un máximo de 16 caracteres.";
    }
    
    // Validar teléfono
    if (!preg_match('/^\d{9}$/', $telefono)) {
        $errores[] = "El teléfono debe tener exactamente 9 números.";
    }
    
    // Validar deuda
    if (!ctype_digit($deuda)) {
        $errores[] = "La deuda debe contener solo números.";
    }
    
    // Validar dirección
    if (!preg_match('/^[A-Z][a-zA-Z\s]+ [1-9]\d{0,3}$/', $direccion)) {
        $errores[] = "La dirección debe empezar con mayúscula y tener un número entre 1 y 9999.";
    }
    
    // Si hay errores, devolverlos en formato JSON
    if (!empty($errores)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => implode(' ', $errores)]);
        exit();
    }
    
    // Si no hay errores, llama a la función para agregar el cliente
    $respuesta = agregar_nuevo_cliente($con, $nombre, $apellido, $telefono, $deuda, $direccion);
    
    // Formatear y devolver la respuesta
    header('Content-Type: application/json');
    if ($respuesta) {
        echo json_encode(['success' => true, 'message' => 'Cliente agregado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Hubo un problema al agregar el cliente.']);
    }
    exit(); // asegura que no ejecute las peticiones por debajo
}


//ELIMINAR TAXI
// if (isset($_POST['action']) && $_POST['action'] === 'eliminar_taxi') {
    //     $matricula = $_POST['matricula'];
    
    //     if (eliminarTaxi($matricula, $con)) {
        //         echo 'success';
        //     } else {
            //         echo 'error';
            //     }
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
            



//MODIICAR TAXI
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modificarTaxi') {
    if (isset($_POST['matricula'], $_POST['modelo'], $_POST['anio'], $_POST['estado'], $_POST['id'])) {

        // Obtener y limpiar los valores de los inputs
        $id = trim($_POST['id']);
        $matricula = trim($_POST['matricula']);
        $modelo = trim($_POST['modelo']);
        $anio = trim($_POST['anio']);
        $estado = trim($_POST['estado']);
        
        $errores = [];

        // Validaciones
        if (strlen($matricula) < 7 || strlen($matricula) > 8) {
            $errores[] = "La matrícula debe tener entre 7 y 8 caracteres.";
        }
        
        if (strlen($modelo) < 3 || strlen($modelo) > 20) {
            $errores[] = "El modelo debe tener entre 3 y 20 caracteres.";
        }
        
        if (!preg_match('/^\d{4}$/', $anio)) {
            $errores[] = "El año debe tener 4 dígitos.";
        }
        
        if (empty($estado)) {
            $errores[] = "Por favor, selecciona un estado.";
        }

        // Si hay errores, enviarlos como JSON
        if (!empty($errores)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => implode(' ', $errores)]);
            exit();
        }

        // Llamada a la función en functions.php para modificar el taxi
        require_once 'functions.php';
        $respuesta = modificar_taxi($con, $id, $matricula, $modelo, $anio, $estado);
        
        header('Content-Type: application/json');
        if ($respuesta) {
            echo json_encode(['success' => true, 'message' => 'Taxi modificado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al modificar el taxi']);
        }
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
}

            // AÑADIR CLIENTE  
            // if (isset($_POST['NombreNuevo_Cliente']) && 
            //     isset($_POST['ApellidoNuevo_Cliente']) && 
            //     isset($_POST['TelefonoNuevo_Cliente']) && 
//     isset($_POST['DireccionNuevo_Cliente']) && 
//     isset($_POST['DeudaNuevo_Cliente'])){
    
//     $NombreNuevo_Cliente = $_POST['NombreNuevo_Cliente'];
//     $ApellidoNuevo_Cliente = $_POST['ApellidoNuevo_Cliente'];
//     $TelefonoNuevo_Cliente = $_POST['TelefonoNuevo_Cliente'];
//     $DireccionNuevo_Cliente = $_POST['DireccionNuevo_Cliente'];
//     $DeudaNuevo_Cliente = $_POST['DeudaNuevo_Cliente'];

//     // guarda la llamada de la función en la variable respuesta
//     $respuesta = agregar_nuevo_cliente($con, $NombreNuevo_Cliente, $ApellidoNuevo_Cliente, $TelefonoNuevo_Cliente, $DireccionNuevo_Cliente, $DeudaNuevo_Cliente);

//     header('Content-Type: application/json');
//     // devuelve la respuesta en formato JSON
//     echo json_encode($respuesta);
//     exit(); // asegura que no ejecute las peticiones por debajo
// }





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
                                    
                                    // if (isset($_POST['action']) && $_POST['action'] === 'obtener_tarifas') {
                                        
                                    //     // Configurar el encabezado para devolver JSON, debe ir antes de cualquier echo o salida
                                    //     header('Content-Type: application/json');
                                    
//     // Llamar a la función que obtiene las tarifas y devolver el JSON
//     echo obtener_informacion_jornadas($con);

//     // Detener la ejecución para evitar que cualquier salida posterior interfiera
//     exit;

// } else {
    //     // En caso de que no se pase la acción correcta, devolver un error en formato JSON
    //     header('Content-Type: application/json');
    //     echo json_encode(['error' => 'Acción no válida']);
    //     exit;
    // }
    
    
    
