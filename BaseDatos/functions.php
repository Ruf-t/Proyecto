<?php

include('conexionBD.php');
$con = conectar_bd();

// // Variables del Login Administrador
// $emailAdmin = $_POST["emailAdmin"];
// $passwordAdmin = $_POST["passwordAdmin"];


if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}


function FormJornadaUserTaxis($con, $KmInicialTaximetrista, $NumeroDeCocheTaximetrista) {
    session_start(); // Iniciar la sesión
    // Insertar la nueva jornada en la base de datos
    $consulta_insertar_jornada_Taximetrista = "INSERT INTO `jornada` (`Km_Inicio`, `Km_Final`, `Fecha`, `FK-Taxi`) 
    VALUES ('$KmInicialTaximetrista', NULL, current_timestamp(), '$NumeroDeCocheTaximetrista')";

    if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
        // Obtener el ID de la jornada recién insertada
        $id_jornada = mysqli_insert_id($con);
        
        // Guardar el ID de la jornada en la sesión del usuario
        $_SESSION['id_jornada'] = $id_jornada;
        
        echo "<h4 class='text'>Jornada iniciada con éxito! $id_jornada</h4>";
    } else {
        echo "Error al iniciar la jornada: " . mysqli_error($con) . "<br>";
        echo "Consulta: " . $consulta_insertar_jornada_Taximetrista . "<br>";
    }
}

function FormInciarViajeUserTaxis($con, $CostoViajeTaximetrista,$MetodoDePagoTaximetrista,$ClienteViajeTaximetrista,$TaximetristaUser){
    $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
    $consulta_insertar_viaje_Taximetrista = "INSERT INTO `viaje`(`ID`, `Tarifa`, `Método de pago`, `Fk_Taximetrista`, `Fk_Cliente_Registrado`, `Fk_Taxi`, `Fk_Jornada`, `Fk_Turno`) VALUES
     ('$CostoViajeTaximetrista','$MetodoDePagoTaximetrista','$TaximetristaUser','$ClienteViajeTaximetrista','','','','')";

if (mysqli_query($con, $consulta_insertar_viaje_Taximetrista)) {
    echo $text;
    // Mostrar los datos
    // echo consultar_datos_Usuario($con);
} else {
    echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
    echo "Consulta: " . $consulta_insertar_viaje_Taximetrista . "<br>";
}

}



// session_start();
// function ValidarAdmin($emailAdmin, $passwordAdmin)
// {
    // $nombre = $_POST['user'];
    // $password = $_POST['password'];
    
    // 		require_once 'conexionBD.php';
    //   $conn = dbConnect();
    
    
    // $consulta = mysqli_query($conn, "SELECT * FROM  WHERE user = '$nombre' AND pass = '$password'");

    // if (!$consulta) {
    //     echo "Usuario no existe " . $nombre . " " . $password . " o hubo un error " . mysqli_error($mysqli);
    // } else {
    //     print "Bienvenido";
    // }
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

// funcion mostrar viajes
function datos_tabla_viaje($con) {
    $consulta_datos_viaje = "SELECT viaje.*, taxi.numero_taxi, persona.Nombre
                             FROM viaje
                             INNER JOIN taxi ON viaje.Fk_Taxi = taxi.ID
                             INNER JOIN cliente_registrado ON cliente_registrado.Fk_Persona = cliente_registrado.Fk_Persona
                             INNER JOIN persona ON cliente_registrado.Fk_Persona = persona.ID";

    $resultado = mysqli_query($con, $consulta_datos_viaje);

    $datos = array();
    while ($fila = mysqli_fetch_array($resultado)) {
        $datos[] = $fila;
    }

    return $datos;
}


