<?php
include("conexion.php");
$con = conectar_bd();

// Variables del Login Administrador
$emailAdmin = $_POST["emailAdmin"];
$passwordAdmin = $_POST["passwordAdmin"];






// Variables del Login Taximetrista


// Variables de Formularios Taximetristas

$KmInicialTaximetrista = $_POST["KmInicialTaximetrista"];
$FechaJornadaTaximetrista = $_POST["FechaJornadaTaximetrista"];
$NumeroDeCocheTaximetrista = $_POST["NumeroDeCocheTaximetrista"];




session_start();
function ValidarAdmin($emailAdmin, $passwordAdmin)
{
    // $nombre = $_POST['user'];
// $password = $_POST['password'];

    // 		require_once 'conexion.php';
//   $conn = dbConnect();


    $consulta = mysqli_query($conn, "SELECT * FROM  WHERE user = '$nombre' AND pass = '$password'");

    if (!$consulta) {
        echo "Usuario no existe " . $nombre . " " . $password . " o hubo un error " . mysqli_error($mysqli);
    } else {
        print "Bienvenido";
    }

}



function envioFormUserTaxis($con, $FechaJornadaTaximetrista, $NumeroDeCocheTaximetrista)
{
    $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
    $consulta_insertar_jornada_Taximetrista = "INSERT INTO 'jornada'('Km_Inicio', 'Km_Final', 'FK-Taxi') VALUES 
    ('','[value-3]','[value-4]')";


}


function AgregarUsuario($con, $nombre, $apellido, $email, $password, $dirCalle, $dirNum)
{
    $text = "<h4 class='text'>Cliente agregado con exito!</h4>";
    $consulta_insertar_user = "INSERT INTO usuario (Nombre, Contrasenia, DireccionDeCalle, Apellido, Email, NumeroDeDir) VALUES 
    ('$nombre', '$password', '$dirCalle', '$apellido', '$email', '$dirNum')";

    if (mysqli_query($con, $consulta_insertar_user)) {
        echo $text;
        // Mostrar los datos
        echo consultar_datos_Usuario($con);
    } else {
        echo "Error al insertar datos: " . mysqli_error($con) . "<br>";
        echo "Consulta: " . $consulta_insertar_user . "<br>";
    }
}







