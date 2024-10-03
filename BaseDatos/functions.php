<?php

include('conexionBD.php');
$con = conectar_bd();



if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión solo si no está activa
}

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
    $consulta_datos_viaje = "SELECT 
                                    p_taxista.Nombre AS Nombre_Taxista, 
                                    p_cliente.Nombre AS Nombre_Cliente,
                                    viaje.*,
                                    taxi.matricula,
                                    viaje.Método_de_pago   
                                    FROM 
                                        taximetrista t
                                    JOIN
                                        persona p_taxista ON t.`FK-Persona` = p_taxista.ID
                                    JOIN 
                                        viaje ON viaje.Fk_Taximetrista = t.ID
                                    JOIN 
                                        cliente_registrado c ON viaje.Fk_Cliente_Registrado = c.ID
                                    JOIN 
                                        persona p_cliente ON c.Fk_Persona = p_cliente.ID
                                    INNER JOIN 
                                        taxi ON viaje.Fk_Taxi = taxi.ID";


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




// //Funcion 2 para mostrar clientes
// $id=$_GET['ID'];

// $sql="delete from taxis where ID='".$id."'";
// $resultado=mysqli_query($con,$sql);

// if($resultado) {
//     echo "<script languaje='JavaScript'>
//         alert('Los datos se eliminaron correctamente de la BD');
//         location.assign('index.php');
//     </script>";
//     } else {
//         echo "<script languaje='JavaScript'>
//             alert('Los datos NO se eliminaron de la BD');
//             location.assign('index.php');
//         </script>";

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
    $consulta_datos_taxistas = "SELECT * FROM taximetrista 
                                INNER JOIN persona  ON taximetrista.ID = persona.ID
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

//---------------------------------------AGREGAR TAXI------------------------------------------------------------
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


//--------------------------------------AGREGAR TAXISTA----------------------------------------------------

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Recoger los datos del formulario
//     $nombre = $_POST['nombre'];
//     $telefono = $_POST['telefono'];
//     $apellido = $_POST['apellido'];
//     $direccion = $_POST['direccion'];
//     $fechaNacimiento = $_POST['fechaNacimiento'];
//     $fechaVencLicencia = $_POST['fechaVencLicencia'];
//     $usuario = $_POST['usuario'];
//     $contrasena = $_POST['contrasena'];

//     // Llamar a la función para agregar taximetrista
//     $resultado = agregar_taximetrista($con, $nombre, $telefono, $apellido, $direccion, $fechaNacimiento, $fechaVencLicencia, $usuario, $contrasena);

//     if ($resultado['success']) {
//         echo "Taximetrista agregado exitosamente con ID de persona: " . $resultado['persona_id'];
//     } else {
//         echo "Error: " . $resultado['message'];
//     }
// }

/**
 * Función para agregar un taximetrista
 */
function agregar_taximetrista($con, $nombre, $telefono, $apellido, $direccion, $fechaNacimiento, $fechaVencLicencia, $usuario, $contrasena) {
    // Comenzar una transacción para asegurar integridad de los datos
    mysqli_begin_transaction($con);

    try {
        // Insertar en la tabla persona
        $consulta_insertar_persona = "INSERT INTO persona (Nombre, Telefono, Apellido, Direccion) 
                                      VALUES ('$nombre', '$telefono', '$apellido', '$direccion')";

        if (!mysqli_query($con, $consulta_insertar_persona)) {
            throw new Exception('Error al insertar en la tabla persona: ' . mysqli_error($con));
        }

        // Obtener el ID de la persona recién insertada
        $persona_id = mysqli_insert_id($con);

        // Insertar en la tabla taximetrista
        $consulta_insertar_taximetrista = "INSERT INTO taximetrista (Fecha_Expiracion_Licencia, Fecha_nacimiento, Usuario, Contrasena, FK_Persona) 
                                           VALUES ('$fechaVencLicencia', '$fechaNacimiento', '$usuario', '$contrasena', '$persona_id')";

        if (!mysqli_query($con, $consulta_insertar_taximetrista)) {
            throw new Exception('Error al insertar en la tabla taximetrista: ' . mysqli_error($con));
        }

        // Confirmar la transacción
        mysqli_commit($con);

        // Devolver respuesta exitosa
        return [
            'success' => true,
            'message' => 'Taximetrista añadido correctamente.',
            'persona_id' => $persona_id
        ];
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        mysqli_rollback($con);
        return [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
}




function cantidad_clientes($con) {
    $consulta_cant_clientes = "SELECT COUNT(DISTINCT persona.ID) AS cantidad_clientes
                               FROM persona 
                               JOIN cliente_registrado ON persona.ID = cliente_registrado.Fk_Persona";
    
    $resultado = mysqli_query($con, $consulta_cant_clientes);

    $fila = mysqli_fetch_assoc($resultado); 

    return $fila['cantidad_clientes']; 
}