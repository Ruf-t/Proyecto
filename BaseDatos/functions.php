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







