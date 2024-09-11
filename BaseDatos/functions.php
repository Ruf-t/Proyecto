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

if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
    echo $text;
    // Mostrar los datos
    // echo consultar_datos_Usuario($con);
} else {
    echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
    echo "Consulta: " . $consulta_insertar_jornada_Taximetrista . "<br>";
}



function datos_tabla_viaje($con) {
    $consulta = "SELECT * FROM viaje";
    $resultado = mysqli_query($con, $consulta);

    if (!$resultado) {
        echo "Error al ejecutar la consulta: " . mysqli_error($con);
        return null;
    }

    $datos = array();
    while ($fila = mysqli_fetch_array($resultado)) {
        $datos[] = $fila;
    }

    return $datos;
}

//función añadir clientes
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
function mostrar_datos_taxistas($con) {
    $consulta_datos_taxistas = "SELECT * FROM taximetrista";

    $resultado_taxistas = mysqli_query($con, $consulta_datos_taxistas);

    $datos_taxistas = array();
    while ($fila = mysqli_fetch_array($resultado_taxistas)) {
        $datos_taxistas[] = $fila;
    }

    return $datos_taxistas;
}