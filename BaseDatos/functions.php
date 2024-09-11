<?php

include('conexionBD.php');
$con = conectar_bd();

// // Variables del Login Administrador
// $emailAdmin = $_POST["emailAdmin"];
// $passwordAdmin = $_POST["passwordAdmin"];


if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Procesar el formulario de añadir usuario
// if (isset($_POST['KmInicialTaximetrista']) && isset($_POST['NumeroDeCocheTaximetrista'])) {
//     // Obtener datos del formulario
//     $KmInicialTaximetrista = $_POST["KmInicialTaximetrista"];
//     $NumeroDeCocheTaximetrista = $_POST["NumeroDeCocheTaximetrista"];   

//     // echo '<div class="container">'; 
// envioFormUserTaxis($con,$KmInicialTaximetrista,$NumeroDeCocheTaximetrista);   // echo '<br>' . '<button class="form-button" id="back"><a href="index.php">Volver a la página principal</a></button>';
//     // echo"</div>";
//     // Llamar a la función para agregar usuario
// }


function envioFormUserTaxis($con, $KmInicialTaximetrista,$NumeroDeCocheTaximetrista){
    $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
    $consulta_insertar_jornada_Taximetrista = "INSERT INTO `jornada` (`ID`, `Km_Inicio`, `Km_Final`, `Fecha`, `FK-Taxi`) VALUES 
    ('', '$KmInicialTaximetrista', Null, current_timestamp(), '$NumeroDeCocheTaximetrista');";

if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
    echo $text;
    // Mostrar los datos
    // echo consultar_datos_Usuario($con);
} else {
    echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
    echo "Consulta: " . $consulta_insertar_jornada_Taximetrista . "<br>";
}

}




// Variables del Login Taximetrista


// Variables de Formularios Taximetristas
// $KmInicialTaximetrista = $_POST["KmInicialTaximetrista"];
// $FechaJornadaTaximetrista = $_POST["FechaJornadaTaximetrista"];
// $NumeroDeCocheTaximetrista = $_POST["NumeroDeCocheTaximetrista"];




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
function FormJornadaUserTaxis($con, $KmInicialTaximetrista,$NumeroDeCocheTaximetrista){
    $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
    $consulta_insertar_jornada_Taximetrista = "INSERT INTO jornada (ID, Km_Inicio, Km_Final, Fecha, FK-Taxi) VALUES 
    ('', '$KmInicialTaximetrista', Null, current_timestamp(), '$NumeroDeCocheTaximetrista');";

if (mysqli_query($con, $consulta_insertar_jornada_Taximetrista)) {
    echo $text;
    // Mostrar los datos
    // echo consultar_datos_Usuario($con);
} else {
    echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
    echo "Consulta: " . $consulta_insertar_jornada_Taximetrista . "<br>";
}
}


// funcion datos de tabla viajes
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