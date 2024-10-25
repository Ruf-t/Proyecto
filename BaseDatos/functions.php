<?php

include_once('conexionBD.php');
$con = conectar_bd();



if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión solo si no está activa
}

// LOGEAR TAXIMETRISTA
function logearTaxi($con, $userTaxi, $contrasenia)
{
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



function FormJornadaUserTaxis($con, $KmInicialTaximetrista, $NumeroDeCocheTaximetrista)
{
    $consulta_insertar_jornada_Taximetrista = "INSERT INTO `jornada` (`Km_Inicio`, `Km_Final`, `Fecha`, `FK_Taxi`) 
    VALUES ('$KmInicialTaximetrista', NULL, current_timestamp(), '$NumeroDeCocheTaximetrista')";

    if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
        // Obtener el ID de la jornada recién insertada
        $id_jornada = mysqli_insert_id($con);

        // Guardar el ID de la jornada en la sesión del usuario
        $_SESSION['id_jornada'] = $id_jornada;
        $_SESSION['NumeroDeCocheTaximetrista'] = $NumeroDeCocheTaximetrista;
        $_SESSION['KmInicialTaximetrista'] = $KmInicialTaximetrista;

        // Devolver una respuesta de éxito
        return [
            'success' => true,
            'message' => 'Jornada iniciada con éxito',
            'id_jornada' => $id_jornada
        ];
    } else {
        // Devolver un error
        return [
            'success' => false,
            'message' => 'Error al iniciar la jornada: ' . mysqli_error($con)
        ];
    }
}




function FormInciarViajeUserTaxis($con, $CostoViajeTaximetrista, $MetodoDePagoTaximetrista, $ClienteViajeTaximetrista)
{
    // Verificación inicial
    if (empty($ClienteViajeTaximetrista)) {
        $ClienteViajeTaximetrista = "NULL";
    } else {
        $ClienteViajeTaximetrista = "'" . mysqli_real_escape_string($con, $ClienteViajeTaximetrista) . "'";
    }

    $userTaxi = $_SESSION['userTaxi'];
    $NumeroDeCocheTaximetrista = $_SESSION['NumeroDeCocheTaximetrista'];
    $id_jornada = $_SESSION['id_jornada'];

    // Consulta para obtener el ID del taximetrista
    $consulta_obtener_id_taximetrista = "SELECT ID FROM taximetrista WHERE Usuario = '$userTaxi'";
    $resultado = mysqli_query($con, $consulta_obtener_id_taximetrista);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $id_taximetrista = $fila['ID'];

        // Insertar el viaje en la tabla 'viaje'
        $consulta_insertar_viaje_Taximetrista = "INSERT INTO `viaje` (`ID`, `Tarifa`, `Método_de_pago`, `Fecha`, `Fk_Taximetrista`, `Fk_Cliente_Registrado`, `Fk_Taxi`, `Fk_Jornada`, `Fk_Turno`) 
            VALUES (NULL, '$CostoViajeTaximetrista', '$MetodoDePagoTaximetrista', current_timestamp(), '$id_taximetrista', $ClienteViajeTaximetrista, '$NumeroDeCocheTaximetrista', '$id_jornada', NULL)";

        if (mysqli_query($con, $consulta_insertar_viaje_Taximetrista)) {
            return ['success' => true, 'message' => 'Viaje registrado con éxito'];
        } else {
            return ['success' => false, 'message' => 'Error al registrar el viaje: ' . mysqli_error($con)];
        }
    } else {
        return ['success' => false, 'message' => 'No se encontró el taximetrista con el usuario dado'];
    }
}





function FormTerminarJornadaUserTaxis($con, $KmFinalTaximetrista)
{

    // Verificar si las variables de sesión existen
    if (!isset($_SESSION['id_jornada']) || !isset($_SESSION['NumeroDeCocheTaximetrista'])) {
        return ['success' => false, 'message' => 'Sesión no válida o incompleta.'];
    }

    $id_jornada = $_SESSION['id_jornada'];
    $NumeroDeCocheTaximetrista = $_SESSION['NumeroDeCocheTaximetrista'];

    // Insertar la nueva jornada en la base de datos
    $consulta_actualizar_jornada_Taximetrista = "UPDATE `jornada` SET `Km_Final`='$KmFinalTaximetrista', `Fecha`=current_timestamp() 
    WHERE `ID`='$id_jornada' AND `FK_Taxi`='$NumeroDeCocheTaximetrista'";


    if (mysqli_query($con, $consulta_actualizar_jornada_Taximetrista)) {
        // Devolver una respuesta de éxito
        return [
            'success' => true,
            'message' => 'Jornada terminada con éxito',
            'id_jornada' => $id_jornada
        ];
    } else {
        // Devolver un error
        return [
            'success' => false,
            'message' => 'Error al terminar la jornada: ' . mysqli_error($con)
        ];
    }
}



// function ValidarAdmin($emailAdmin, $passwordAdmin){
//     $nombre = $_POST['user'];
//     $password = $_POST['password'];



//     $consulta = mysqli_query($con, "SELECT * FROM  WHERE user = '$nombre' AND pass = '$password'");

//     if (!$consulta) {
//         echo "Usuario no existe " . $nombre . " " . $password . " o hubo un error " . mysqli_error($mysqli);
//     } else {
//         print "Bienvenido";
//     }
// }

// function AgregarUsuario($con, $nombre, $apellido, $email, $password, $dirCalle, $dirNum)
// {
//     $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
//     $consulta_insertar_user = "INSERT INTO usuario (Nombre, Contrasenia, DireccionDeCalle, Apellido, Email, NumeroDeDir) VALUES 
//     ('$nombre', '$password', '$dirCalle', '$apellido', '$email', '$dirNum')";

//     if (mysqli_query($con, $consulta_insertar_user)) {
//         echo $text;
// Mostrar los datos
// echo consultar_datos_Usuario($con);
//     } else {
//         echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
//         echo "Consulta: " . $consulta_insertar_user . "<br>";
//     }
// }


// funcion inciar jornada
// function ($con, $KmInicialTaximetrista,$NumeroDeCocheTaximetrista){
//     $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
//     $consulta_insertar_jornada_Taximetrista = "INSERT INTO jornada (ID, Km_Inicio, Km_Final, Fecha, FK_Taxi) VALUES 
//     ('', '$KmInicialTaximetrista', Null, current_timestamp(), '$NumeroDeCocheTaximetrista');";
// if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
//     echo $text;
//     // Mostrar los datos
//     // echo consultar_datos_Usuario($con);
// } else {
//     echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
//     echo "Consulta: " . $consulta_insertar_jornada_Taximetrista . "<br>";
// }



//función mostrar clientes
// function mostrar_datos_cliente($con) { 
//     $consulta_datos_cliente = "SELECT * FROM persona 
//                                JOIN cliente_registrado  ON persona.ID = cliente_registrado.Fk_Persona";

//     $resultado_cliente = mysqli_query($con, $consulta_datos_cliente);

//     $datos_cliente = array();
//     while ($fila = mysqli_fetch_array($resultado_cliente)) {
//         $datos_cliente[] = $fila;
//     }

//     return $datos_cliente;
// }

function mostrar_datos_cliente($con)
{
    $consulta_datos_cliente = "SELECT * FROM persona 
                               JOIN cliente_registrado ON persona.ID = cliente_registrado.Fk_Persona";

    $resultado_cliente = mysqli_query($con, $consulta_datos_cliente);

    if (!$resultado_cliente) {
        return null; // En caso de error, devolvemos null
    }

    $datos_cliente = array();
    while ($fila = mysqli_fetch_assoc($resultado_cliente)) {
        $datos_cliente[] = $fila; // Guardamos cada fila en el array
    }

    return $datos_cliente; // Devolvemos los datos
}

//función mostrar taxis
function mostrar_datos_taxis($con)
{
    $consulta_datos_taxis = "SELECT * FROM  taxi";

    $resultado_taxis = mysqli_query($con, $consulta_datos_taxis);

    $datos_taxis = array();
    while ($fila = mysqli_fetch_array($resultado_taxis)) {
        $datos_taxis[] = $fila;
    }

    return $datos_taxis;
}

//funcion para eliminar taxis
function  eliminar_taxis($con, $id_taxis)
{
    $consulta_eliminar_taxis = "DELETE FROM taxi WHERE ID = '$id_taxis'";
    if (mysqli_query($con, $consulta_eliminar_taxis)) {
        echo "Taxis eliminado con exito";
    } else {
        echo "Error al eliminar taxis: " . mysqli_error($con) . "<br>";
        echo "Consulta: " . $consulta_eliminar_taxis . "<br>";
    }
}


// funcion mostrar viajes
function datos_tabla_viaje($con)
{
    $consulta_datos_viaje = "SELECT 
                                    p_taxista.Nombre AS Nombre_Taxista, 
                                    p_cliente.Nombre AS Nombre_Cliente,
                                    viaje.*,
                                    taxi.matricula,
                                    viaje.Método_de_pago   
                             FROM 
                                    taximetrista t
                             JOIN
                                    persona p_taxista ON t.FK_Persona = p_taxista.ID
                             JOIN 
                                    viaje ON viaje.Fk_Taximetrista = t.ID
                             JOIN 
                                    cliente_registrado c ON viaje.Fk_Cliente_Registrado = c.ID
                             JOIN 
                                    persona p_cliente ON c.Fk_Persona = p_cliente.ID
                             INNER JOIN 
                                    taxi ON viaje.Fk_Taxi = taxi.ID
                             ORDER BY viaje.Fecha DESC";


    $resultado = mysqli_query($con, $consulta_datos_viaje);

    // Verificar si la consulta fue exitosa
    if ($resultado === false) {
        echo "Error en la consulta: " . mysqli_error($con);
        return [];
    }

    $datos = array();
    while ($fila = mysqli_fetch_array($resultado)) {
        $datos[] = $fila;
    }

    return $datos;
}

//FUNCION APLICAR FILTROS 
function obtenerViajesFiltrados($turno, $fecha, $con)
{

    // Consulta base
    $query = "SELECT p_taxista.Nombre AS Nombre_Taxista, p_cliente.Nombre AS Nombre_Cliente, viaje.*, taxi.matricula,viaje.Método_de_pago   
                FROM taximetrista t JOIN persona p_taxista ON t.`FK_Persona` = p_taxista.ID JOIN viaje ON viaje.Fk_Taximetrista = t.ID
                JOIN cliente_registrado c ON viaje.Fk_Cliente_Registrado = c.ID JOIN persona p_cliente ON c.Fk_Persona = p_cliente.ID
                INNER JOIN taxi ON viaje.Fk_Taxi = taxi.ID WHERE 1=1";

    // Filtrar por turno si está seleccionado
    if (!empty($turno)) {
        $query .= " AND Fk_Turno = '$turno'";
    }

    // Filtrar por fecha según el rango seleccionado
    if ($fecha == 'hoy') {
        $query .= " AND DATE(Fecha) = CURDATE() ORDER BY Fecha DESC";
    } elseif ($fecha == 'un_dia') {
        $query .= " AND DATE(Fecha) = CURDATE() - INTERVAL 1 DAY ORDER BY Fecha DESC";
    } elseif ($fecha == 'semana') {
        $query .= " AND WEEK(Fecha) = WEEK(CURDATE()) ORDER BY Fecha DESC";
    } elseif ($fecha == 'mes') {
        $query .= " AND MONTH(Fecha) = MONTH(CURDATE()) ORDER BY Fecha DESC";
    } elseif ($fecha == 'seis_meses') {
        $query .= " AND Fecha >= CURDATE() - INTERVAL 6 MONTH ORDER BY Fecha DESC";
    }


    $resultado = $con->query($query);
    $viajes = [];

    // Guardar los resultados en un array
    while ($fila = $resultado->fetch_assoc()) {
        $viajes[] = $fila;
    }

    return $viajes;
}


function mostrar_datos_taxistas($con)
{
    $consulta_datos_taxistas = "SELECT * FROM taximetrista 
                                INNER JOIN persona ON taximetrista.`FK_Persona` = persona.ID
                                ORDER BY persona.Nombre ASC";

    $resultado_taxistas = mysqli_query($con, $consulta_datos_taxistas);

    // Verificar si la consulta fue exitosa
    if ($resultado_taxistas === false) {
        echo "Error en la consulta: " . mysqli_error($con);
        return [];
    }

    $datos_taxistas = array();
    while ($fila = mysqli_fetch_assoc($resultado_taxistas)) {
        $datos_taxistas[] = $fila;
    }

    return $datos_taxistas;
}




function obtenerMatrículasTaxis($con)
{
    // Consulta para obtener las matrículas de la tabla taxi
    $consulta_obtener_matriculas = "SELECT ID, Matricula FROM taxi";
    $resultado_matriculas = mysqli_query($con, $consulta_obtener_matriculas);

    // Comprobar si la consulta se ejecutó correctamente
    if (!$resultado_matriculas) {
        echo "Error en la consulta de las matrículas: " . mysqli_error($con);
        return [];
    }

    // Crear un array para almacenar las matrículas
    $matriculas = [];

    // Bucle para llenar el array con los resultados de la consulta
    while ($fila_matricula = mysqli_fetch_assoc($resultado_matriculas)) {
        $matriculas[] = [
            'ID' => $fila_matricula['ID'],
            'Matricula' => $fila_matricula['Matricula']
        ];
    }

    return $matriculas;
}


function obtenerClientesRegistrados($con)
{
    // Consulta SQL para obtener el ID del cliente registrado y su nombre
    $sql = "SELECT cliente_registrado.ID AS ClienteID, persona.Nombre 
            FROM cliente_registrado
            JOIN persona ON cliente_registrado.Fk_Persona = persona.ID";

    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Crear un array para almacenar los resultados
        $clientes = [];

        // Obtener cada fila y guardarla en el array
        while ($row = mysqli_fetch_assoc($result)) {
            $clientes[] = $row;
        }

        return $clientes;
    } else {
        return [];
    }
}

//---------------------------------------AGREGAR TAXI------------------------------------------------------------
function agregar_taxi($con, $matricula, $modelo, $año, $estado)
{

    // Consulta SQL de inserción
    $sql = "INSERT INTO taxi (Matricula, Modelo, Año, Estado) VALUES ('$matricula', '$modelo', $año, '$estado')";

    // Ejecutar la consulta y devolver el resultado
    if (mysqli_query($con, $sql)) {
        // Devolver una respuesta de éxito con más detalles
        return [
            'success' => true,
            'message' => 'Taxi añadido correctamente.',
        ];
    } else {
        // Devolver una respuesta de error
        return [
            'success' => false,
            'message' => 'Error al añadir el taxi: ' . mysqli_error($con)
        ];
    }
}


//--------------------------------------AGREGAR TAXISTA----------------------------------------------------
//AGREGAR TAXISTA Y CONTROL DE ERROR EN LICENCIA
function agregar_taximetrista($con, $Nombre, $Apellido_Nuevo_Taxista, $FechaNac_Nuevo_Taxista, $Fecha_venc_librCond_Nuevo_Taxista, $Direccion_Nuevo_Taxista, $Telefono_Nuevo_Taxista, $UserNuevo_Taxista, $ContrNuevo_Taxista)
{
    // Comenzar una transacción para asegurar la integridad de los datos
    mysqli_begin_transaction($con);

    // Convertir la fecha de vencimiento de la licencia en un objeto de fecha
    $fecha_actual = new DateTime(); // Fecha actual
    $fecha_expiracion = new DateTime($Fecha_venc_librCond_Nuevo_Taxista); // Fecha de expiración ingresada

    // Verificar si la licencia está vencida
    if ($fecha_expiracion < $fecha_actual) {
        // Revertir la transacción
        mysqli_rollback($con);
        return [
            'success' => false,
            'message' => 'Error: La licencia de conducir está vencida.'
        ];
    }

    // Verificar si faltan 15 días o menos para la expiración
    $diferencia_dias = $fecha_actual->diff($fecha_expiracion)->days;
    $notificacion = '';

    if ($diferencia_dias <= 15) {
        $notificacion = 'Advertencia: La licencia de conducir está próxima a vencer en ' . $diferencia_dias . ' días.';
    }

    // Insertar en la tabla persona
    $consulta_insertar_persona = "INSERT INTO persona (Nombre, Telefono, Apellido, Direccion) 
                                  VALUES ('$Nombre', '$Telefono_Nuevo_Taxista', '$Apellido_Nuevo_Taxista', '$Direccion_Nuevo_Taxista')";

    if (!mysqli_query($con, $consulta_insertar_persona)) {
        // Revertir la transacción en caso de error
        mysqli_rollback($con);
        return [
            'success' => false,
            'message' => 'Error al insertar en la tabla persona: ' . mysqli_error($con)
        ];
    }

    // Obtener el ID de la persona recién insertada
    $persona_id = mysqli_insert_id($con);

    $hashed_password = password_hash($ContrNuevo_Taxista, PASSWORD_DEFAULT);

    // Insertar en la tabla taximetrista
    $consulta_insertar_taximetrista = "INSERT INTO `taximetrista`(`Fecha_Expiracion_Licencia`, `Fecha_Nacimiento`, `Usuario`, `Contrasenia`,  `FK_Persona`) 
                                       VALUES ('$Fecha_venc_librCond_Nuevo_Taxista', '$FechaNac_Nuevo_Taxista', '$UserNuevo_Taxista', '$hashed_password', '$persona_id')";

    if (!mysqli_query($con, $consulta_insertar_taximetrista)) {
        // Revertir la transacción en caso de error
        mysqli_rollback($con);
        return [
            'success' => false,
            'message' => 'Error al insertar en la tabla taximetrista: ' . mysqli_error($con)
        ];
    }

    // Confirmar la transacción
    mysqli_commit($con);

    // Devolver respuesta exitosa junto con la advertencia si existe
    return [
        'success' => true,
        'message' => 'Taximetrista añadido correctamente.' . ($notificacion ? ' ' . $notificacion : ''),
        'persona_id' => $persona_id
    ];
}



function agregar_nuevo_cliente($con, $NombreNuevo_Cliente, $ApellidoNuevo_Cliente, $TelefonoNuevo_Cliente, $DireccionNuevo_Cliente, $DeudaNuevo_Cliente)
{
    // Iniciar la transacción
    mysqli_begin_transaction($con);

    // Insertar los datos en la tabla persona
    $consulta_insertar_persona = "INSERT INTO persona (Nombre, Telefono, Apellido, Direccion) 
                                  VALUES ('$NombreNuevo_Cliente', '$TelefonoNuevo_Cliente', '$ApellidoNuevo_Cliente', '$DireccionNuevo_Cliente')";

    if (!mysqli_query($con, $consulta_insertar_persona)) {
        // Revertir la transacción en caso de error
        mysqli_rollback($con);
        return [
            'success' => false,
            'message' => 'Error al insertar en la tabla persona: ' . mysqli_error($con)
        ];
    }

    // Obtener el ID de la persona recién insertada
    $persona_id = mysqli_insert_id($con);

    // Insertar los datos en la tabla cliente_registrado
    $consulta_insertar_cliente = "INSERT INTO cliente_registrado (Deuda, Fk_Persona) 
                                  VALUES ('$DeudaNuevo_Cliente', '$persona_id')";

    if (!mysqli_query($con, $consulta_insertar_cliente)) {
        // Revertir la transacción en caso de error
        mysqli_rollback($con);
        return [
            'success' => false,
            'message' => 'Error al insertar en la tabla cliente_registrado: ' . mysqli_error($con)
        ];
    }

    // Confirmar la transacción si todo fue exitoso
    mysqli_commit($con);

    // Devolver respuesta exitosa
    return [
        'success' => true,
        'message' => 'Cliente añadido correctamente.',
        'persona_id' => $persona_id
    ];
}



function cantidad_clientes($con)
{
    $consulta_cant_clientes = "SELECT COUNT(DISTINCT persona.ID) AS cantidad_clientes
                               FROM persona 
                               JOIN cliente_registrado ON persona.ID = cliente_registrado.Fk_Persona";

    $resultado = mysqli_query($con, $consulta_cant_clientes);

    $fila = mysqli_fetch_assoc($resultado);

    return $fila['cantidad_clientes'];
}

// function obtener_ingreso_jornada($con, $id_jornada) {
//     $sql = "SELECT SUM(Tarifa) AS total_ingreso FROM viaje WHERE Fk_Jornada = ?";
//     $stmt = mysqli_prepare($con, $sql);
//     mysqli_stmt_bind_param($stmt, 'i', $id_jornada);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);

//     if ($row = mysqli_fetch_assoc($result)) {
//         return $row['total_ingreso'] ?: 0; // Si no hay viajes, devolver 0
//     } else {
//         return 0;
//     }
// }

// function obtener_total_tarifas_por_jornada($con) {
//     // Consulta corregida para sumar tarifas de la jornada con ID 239
//     $query = "SELECT SUM(tarifa) AS total_tarifas FROM viaje WHERE FK_Jornada = 239";

//     $result = $con->query($query);

//     $tarifas = [];

//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $tarifas[] = [
//             'id_jornada' => 239, // Puedes cambiar el valor si es dinámico
//             'total_tarifas' => $row['total_tarifas'] ?? 0 // Manejar el caso de SUM que puede ser NULL
//         ];
//     }

//     echo json_encode($tarifas);
// }

// function obtener_total_tarifas_por_todas_jornadas($con) {
//     // Paso 1: Obtener todos los IDs de jornada
//     $queryJornadas = "SELECT DISTINCT FK_Jornada FROM viaje";
//     $resultJornadas = $con->query($queryJornadas);

//     $tarifas = [];

//     // Paso 2: Recorremos todas las jornadas
//     if ($resultJornadas->num_rows > 0) {
//         while ($rowJornada = $resultJornadas->fetch_assoc()) {
//             $id_jornada = $rowJornada['FK_Jornada'];

//             // Paso 3: Consultamos la suma de tarifas para cada jornada
//             $queryTarifas = "SELECT SUM(tarifa) AS total_tarifas FROM viaje WHERE FK_Jornada = ?";
//             $stmt = $con->prepare($queryTarifas);
//             $stmt->bind_param("i", $id_jornada);
//             $stmt->execute();
//             $result = $stmt->get_result();

//             if ($result->num_rows > 0) {
//                 $row = $result->fetch_assoc();
//                 // Paso 4: Agregar la suma de tarifas por cada jornada al array
//                 $tarifas[] = [
//                     'id_jornada' => $id_jornada,
//                     'total_tarifas' => $row['total_tarifas'] ?? 0 // Asegurar que no sea nulo
//                 ];
//             }
//         }
//     }

//     // Paso 5: Enviamos todas las sumas en formato JSON
//     return json_encode($tarifas);
// }

function obtener_informacion_jornadas($con)
{
    // Consulta ajustada para incluir jornada, taxi, taximetrista, persona y suma de tarifas
    $query = " SELECT 
            j.ID AS id_jornada, 
            j.fecha, 
            SUM(v.tarifa) AS total_tarifas, 
            t.matricula AS taxi_numero, 
            p.Nombre AS taxista_nombre  
        FROM viaje v
        INNER JOIN jornada j ON v.FK_Jornada = j.ID
        INNER JOIN taxi t ON j.`FK_Taxi` = t.ID
        INNER JOIN taximetrista tx ON v.FK_Taximetrista = tx.ID
        INNER JOIN persona p ON tx.`FK_Persona` = p.ID 
        GROUP BY j.ID, j.fecha, t.matricula, p.Nombre
";

    $result = $con->query($query);

    $datos = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $datos[] = [
                'id_jornada' => $row['id_jornada'],
                'fecha' => $row['fecha'],
                'total_tarifas' => $row['total_tarifas'] ?? 0,
                'taxi_numero' => $row['taxi_numero'],
                'taxista_nombre' => $row['taxista_nombre'] ?? 'Desconocido'
            ];
        }
    }

    // Retornamos el array como JSON para usarlo en el frontend
    return json_encode($datos);
}


// FUNCION DE TAXIMETRISTAS DEL MES
function RankingTaxistasMes($con)
{
    // Consulta SQL para obtener los 3 taxistas con más dinero generado en el mes actual
    $consulta_ranking_taxistas = "SELECT 
    CONCAT(persona.Nombre, ' ', persona.Apellido) AS nombre_taximetrista, 
    SUM(viaje.Tarifa) AS total_generado
FROM 
    viaje
INNER JOIN 
    taximetrista ON viaje.Fk_Taximetrista = taximetrista.ID
INNER JOIN 
    persona ON taximetrista.FK_Persona = persona.ID
WHERE 
    MONTH(viaje.Fecha) = MONTH(CURDATE()) 
    AND YEAR(viaje.Fecha) = YEAR(CURDATE())
GROUP BY 
    persona.ID
ORDER BY 
    total_generado DESC
LIMIT 3";

    // Ejecutar la consulta
    $resultado = mysqli_query($con, $consulta_ranking_taxistas);

    if ($resultado) {
        // Verificar si se obtuvieron resultados
        if (mysqli_num_rows($resultado) > 0) {
            $ranking = [];
            while ($fila = mysqli_fetch_assoc($resultado)) {
                // Almacenar cada taxista en el array
                $ranking[] = $fila;
            }

            // Devolver los resultados en un array con éxito
            return [
                'success' => true,
                'message' => 'Ranking generado con éxito',
                'data' => $ranking
            ];
        } else {
            // Si no hay resultados, devolver un mensaje adecuado
            return [
                'success' => false,
                'message' => 'No se encontraron taxistas para este mes.'
            ];
        }
    } else {
        // En caso de error en la ejecución de la consulta
        return [
            'success' => false,
            'message' => 'Error al generar el ranking: ' . mysqli_error($con)
        ];
    }
}
