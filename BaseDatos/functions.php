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
        $id_numCocheTaxi = mysqli_insert_id($con);
        
        // Guardar el ID de la jornada en la sesión del usuario
        $_SESSION['id_jornada'] = $id_jornada;
        $_SESSION['NumeroDeCocheTaximetrista'] = $NumeroDeCocheTaximetrista;
        $_SESSION['KmInicialTaximetrista'] = $KmInicialTaximetrista;
      

        
        echo "<h4 class='text'>Jornada iniciada con éxito! $id_jornada</h4>";
    } else {
        echo "Error al iniciar la jornada: " . mysqli_error($con) . "<br>";
        echo "Consulta: " . $consulta_insertar_jornada_Taximetrista . "<br>";
    }
}

function FormInciarViajeUserTaxis($con, $CostoViajeTaximetrista,$MetodoDePagoTaximetrista,$ClienteViajeTaximetrista,$TaximetristaUser,$NumeroDeCocheTaximetrista){
    $text = "<h4 class='text'>Cliente agregado con exito!</h4>";


$consulta_insertar_viaje_Taximetrista = "INSERT INTO `viaje`(`ID`, `Tarifa`, `Método de pago`, `Fecha`, `Fk_Taximetrista`, `Fk_Cliente_Registrado`, `Fk_Taxi`, `Fk_Jornada`, `Fk_Turno`) VALUES
     ('$CostoViajeTaximetrista','$MetodoDePagoTaximetrista','','$TaximetristaUser','$ClienteViajeTaximetrista','$NumeroDeCocheTaximetrista','','','')";



if (mysqli_query($con, $consulta_insertar_viaje_Taximetrista)) {
    echo $text;
    // Mostrar los datos
    // echo consultar_datos_Usuario($con);
} else {
    echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
    echo "Consulta: " . $consulta_insertar_viaje_Taximetrista . "<br>";
    }
}


function FormTerminarJornadaUserTaxis($con, $KmFinalTaximetrista){
   // Verificar si la sesión ya está iniciada
   if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión solo si no está activa
}
    $text = "<h4 class='text'>Jornada Terminada</h4>";
    $id_jornada = $_SESSION['id_jornada'];
    $NumeroDeCocheTaximetrista = $_SESSION['NumeroDeCocheTaximetrista'];
    $KmInicialTaximetrista = $_SESSION['KmInicialTaximetrista'];
    
    // Insertar la nueva jornada en la base de datos
    $consulta_actualizar_jornada_Taximetrista = "UPDATE `jornada` SET `Km_Final`='$KmFinalTaximetrista', `Fecha`=current_timestamp() 
    WHERE `ID`='$id_jornada' AND `FK-Taxi`='$NumeroDeCocheTaximetrista'";
    

    if (mysqli_query($con, $consulta_actualizar_jornada_Taximetrista)) {
        // Obtener el ID de la jornada recién insertada
        echo $text;
    } else {
        echo "Error al iniciar la jornada: " . mysqli_error($con) . "<br>";
        echo "Consulta: " . $consulta_actualizar_jornada_Taximetrista . "<br>";
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
// }




// CREATE TABLE `viaje` (
//     `ID` int(11) NOT NULL,
//     `Tarifa` varchar(100) NOT NULL,
//     `Método de pago` varchar(60) NOT NULL,
//     `Fk_Taximetrista` int(11) NOT NULL,
//     `Fk_Cliente_Registrado` int(11) NOT NULL,
//     `Fk_Taxi` int(11) NOT NULL,
//     `Fk_Jornada` int(11) NOT NULL,
//     `Fk_Turno` int(11) NOT NULL
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


