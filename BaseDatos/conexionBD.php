<?php
function conectar_bd(){

<<<<<<< HEAD
$servidor = "localhost";
$bd = "proyectooo";
=======
$servidor = "localhost:3307";
$bd = "proyecto";
>>>>>>> 8d786ecf56388b0f2f41260ff6c70698b90ba1fa
$usuario = "root";
$pass = "";
// Por default "", en computadora de Juan "root"
// nombre bd --> proyecto

//definir la conexion usando las variables.

$conn = mysqli_connect($servidor, $usuario, $pass, $bd);


// Comprobar la conexión
if (!$conn) {
    die("Error de conexion " . mysqli_connect_error());
}
// echo "Conectado correctamente ";

//devuelvo la conexion
return $conn;
 
}

