<?php
include("conexion.php");
$con=conectar_bd();

// Variables del Login Administrador
$emailAdmin = $_POST["emailAdmin"];
$passwordAdmin = $_POST["passwordAdmin"];

// Variables del Login Taximetrista


session_start();
function ValidarAdmin($emailAdmin, $passwordAdmin){
// $nombre = $_POST['user'];
// $password = $_POST['password'];

// 		require_once 'conexion.php';
//   $conn = dbConnect();
 

$consulta = mysqli_query ($conn, "SELECT * FROM  WHERE user = '$nombre' AND pass = '$password'");  

if(!$consulta){ 
 echo "Usuario no existe " . $nombre . " " . $password. " o hubo un error " . mysqli_error($mysqli);
} 
else{ 
print "Bienvenido"; 
} 

}
?>







?>