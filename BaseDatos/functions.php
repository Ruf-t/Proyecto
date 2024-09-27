<?php

include('conexionBD.php');
$con = conectar_bd();



if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión solo si no está activa
}



// function FormJornadaUserTaxis($con, $KmInicialTaximetrista, $NumeroDeCocheTaximetrista) {
//     // Insertar la nueva jornada en la base de datos
//     $consulta_insertar_jornada_Taximetrista = "INSERT INTO `jornada` (`Km_Inicio`, `Km_Final`, `Fecha`, `FK-Taxi`) 
//     VALUES ('$KmInicialTaximetrista', NULL, current_timestamp(), '$NumeroDeCocheTaximetrista')";

//     if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
//         // Obtener el ID de la jornada recién insertada
//         $id_jornada = mysqli_insert_id($con);
        
//         // Guardar el ID de la jornada en la sesión del usuario
//         $_SESSION['id_jornada'] = $id_jornada;
//         $_SESSION['NumeroDeCocheTaximetrista'] = $NumeroDeCocheTaximetrista;
//         $_SESSION['KmInicialTaximetrista'] = $KmInicialTaximetrista;
        
//         echo "<h4 class='text'>Jornada iniciada con éxito! $id_jornada</h4>";
//     } else {
//         echo "Error al iniciar la jornada: " . mysqli_error($con) . "<br>";
//         echo "Consulta: " . $consulta_insertar_jornada_Taximetrista . "<br>";
//     }
// }

// En functions.php
function FormJornadaUserTaxis($con, $KmInicialTaximetrista, $NumeroDeCocheTaximetrista) {
    $consulta_insertar_jornada_Taximetrista = "INSERT INTO `jornada` (`Km_Inicio`, `Km_Final`, `Fecha`, `FK-Taxi`) 
    VALUES ('$KmInicialTaximetrista', NULL, current_timestamp(), '$NumeroDeCocheTaximetrista')";

    if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
        // Obtener el ID de la jornada recién insertada
        $id_jornada = mysqli_insert_id($con);
        
        // Guardar el ID de la jornada en la sesión del usuario
        $_SESSION['id_jornada'] = $id_jornada;
        $_SESSION['NumeroDeCocheTaximetrista'] = $NumeroDeCocheTaximetrista;
        $_SESSION['KmInicialTaximetrista'] = $KmInicialTaximetrista;
        
        // Devolver una respuesta de éxito
        return ['success' => true, 
                'message' => 'Jornada iniciada con éxito', 
                'id_jornada' => $id_jornada];
    } else {
        // Devolver un error
        return ['success' => false,
                'message' => 'Error al iniciar la jornada: ' . mysqli_error($con)];
    }
}




function FormInciarViajeUserTaxis($con, $CostoViajeTaximetrista, $MetodoDePagoTaximetrista, $ClienteViajeTaximetrista) {
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





function FormTerminarJornadaUserTaxis($con, $KmFinalTaximetrista){
 
       // Verificar si las variables de sesión existen
       if (!isset($_SESSION['id_jornada']) || !isset($_SESSION['NumeroDeCocheTaximetrista'])) {
        return ['success' => false, 'message' => 'Sesión no válida o incompleta.'];
    }

    $id_jornada = $_SESSION['id_jornada'];
    $NumeroDeCocheTaximetrista = $_SESSION['NumeroDeCocheTaximetrista'];
    
    // Insertar la nueva jornada en la base de datos
    $consulta_actualizar_jornada_Taximetrista = "UPDATE `jornada` SET `Km_Final`='$KmFinalTaximetrista', `Fecha`=current_timestamp() 
    WHERE `ID`='$id_jornada' AND `FK-Taxi`='$NumeroDeCocheTaximetrista'";
    

    if (mysqli_query($con, $consulta_actualizar_jornada_Taximetrista)) {    
        // Devolver una respuesta de éxito
        return ['success' => true, 
            'message' => 'Jornada terminada con éxito', 
            'id_jornada' => $id_jornada];
    } else {
        // Devolver un error
        return ['success' => false,
                'message' => 'Error al terminar la jornada: ' . mysqli_error($con)];
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
// function FormJornadaUserTaxis($con, $KmInicialTaximetrista,$NumeroDeCocheTaximetrista){
//     $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
//     $consulta_insertar_jornada_Taximetrista = "INSERT INTO jornada (ID, Km_Inicio, Km_Final, Fecha, FK-Taxi) VALUES 
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
function mostrar_datos_cliente($con) {
    $consulta_datos_cliente = "SELECT * FROM persona 
                               JOIN cliente_registrado  ON persona.ID = cliente_registrado.Fk_Persona";

    $resultado_cliente = mysqli_query($con, $consulta_datos_cliente);

    $datos_cliente = array();
    while ($fila = mysqli_fetch_array($resultado_cliente)) {
        $datos_cliente[] = $fila;
    }

    return $datos_cliente;
}

//función mostrar taxis
function mostrar_datos_taxis($con) {
    $consulta_datos_taxis = "SELECT * FROM  taxi";
    
    $resultado_taxis = mysqli_query($con, $consulta_datos_taxis);

    $datos_taxis = array();
    while ($fila = mysqli_fetch_array($resultado_taxis)) {
        $datos_taxis[] = $fila;
    }

    return $datos_taxis;
}

//funcion para eliminar taxis
function  eliminar_taxis($con, $id_taxis) {
    $consulta_eliminar_taxis = "DELETE FROM taxi WHERE ID = '$id_taxis'";
    if (mysqli_query($con, $consulta_eliminar_taxis)) {
        echo "Taxis eliminado con exito";
        } else {
            echo "Error al eliminar taxis: " . mysqli_error($con) . "<br>";
            echo "Consulta: " . $consulta_eliminar_taxis . "<br>";
            }
}


// funcion mostrar viajes
function datos_tabla_viaje($con) {
    $consulta_datos_viaje = "SELECT viaje.*, taxi.matricula, persona.Nombre, viaje.Método_de_pago
                            FROM viaje
                            INNER JOIN taxi ON viaje.Fk_Taxi = taxi.ID
                            INNER JOIN cliente_registrado ON viaje.Fk_Cliente_Registrado = cliente_registrado.ID
                            INNER JOIN persona ON cliente_registrado.Fk_Persona = persona.ID";

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











//funcion para eliminar cliente
// function eliminar_cliente($con, $id_cliente) { 
//     // Obtener el ID de la persona asociada al cliente
//     $consulta_fk_persona = "SELECT Fk_Persona FROM cliente_registrado WHERE ID = ?";
//     $stmt = mysqli_prepare($con, $consulta_fk_persona);
//     mysqli_stmt_bind_param($stmt, 'i', $id_cliente);
//     mysqli_stmt_execute($stmt);
//     $resultado = mysqli_stmt_get_result($stmt);
//     $fila = mysqli_fetch_assoc($resultado);

//     if ($fila) {
//         $fk_persona = $fila['Fk_Persona'];

//         // Eliminar primero el registro de la tabla cliente_registrado
//         $eliminar_cliente = "DELETE FROM cliente_registrado WHERE ID = ?";
//         $stmt_cliente = mysqli_prepare($con, $eliminar_cliente);
//         mysqli_stmt_bind_param($stmt_cliente, 'i', $id_cliente);
//         $resultado_cliente = mysqli_stmt_execute($stmt_cliente);

//         // Luego eliminar el registro de la tabla persona
//         if ($resultado_cliente) {
//             $eliminar_persona = "DELETE FROM persona WHERE ID = ?";
//             $stmt_persona = mysqli_prepare($con, $eliminar_persona);
//             mysqli_stmt_bind_param($stmt_persona, 'i', $fk_persona);
//             $resultado_persona = mysqli_stmt_execute($stmt_persona);

//             // Verificar si ambas eliminaciones fueron exitosas
//             if ($resultado_persona) {
//                 return true; 
//             } else {
//                 return false; // Error al eliminar en persona
//             }
//         } else {
//             return false; // Error al eliminar en cliente_registrado
//         }
//     } else {
//         return false; // No se encontró la persona asociada
//     }
// }


// // funcion mostrar taxistas
// function mostrar_datos_taxistas($con) {
//     $consulta_datos_taxistas = "SELECT * FROM taximetrista";

//     $resultado_taxistas = mysqli_query($con, $consulta_datos_taxistas);

//     $datos_taxistas = array();
//     while ($fila = mysqli_fetch_array($resultado_taxistas)) {
//         $datos_taxistas[] = $fila;
//     }

//     return $datos_taxistas;
// }

function mostrar_datos_taxistas($con) {
    // Consulta para unir las tablas taximetrista y persona
    $consulta_datos_taxistas = "
        SELECT t.*, p.Nombre, p.Apellido, p.Telefono, p.Direccion 
        FROM taximetrista t
        INNER JOIN persona p ON t.ID = p.ID
    ";

    $resultado_taxistas = mysqli_query($con, $consulta_datos_taxistas);

    $datos_taxistas = array();
    while ($fila = mysqli_fetch_assoc($resultado_taxistas)) {
        $datos_taxistas[] = $fila;
    }

    return $datos_taxistas;
}




function obtenerMatrículasTaxis($con) {
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


function obtenerClientesRegistrados($con) {
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


function agregar_taxi($con, $matricula, $modelo, $año, $estado) {

    // Consulta SQL de inserción
    $sql = "INSERT INTO taxi (Matricula, Modelo, Año, Estado) VALUES ('$matricula', '$modelo', $año, $estado)";

    // Ejecutar la consulta y devolver el resultado
    if (mysqli_query($con, $sql)) {
        // Obtener el ID del taxi recién insertado
        $id_taxi = mysqli_insert_id($con);
        
        // Devolver una respuesta de éxito con más detalles
        return [
            'success' => true,
            'message' => 'Taxi añadido correctamente.',
        ];
    } else{
        // Devolver una respuesta de error
        return [
            'success' => false,
            'message' => 'Error al añadir el taxi: ' . mysqli_error($con)
        ];
    }
}
