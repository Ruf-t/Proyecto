<?php
include 'functions.php';
include 'login-bd.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['matricula']) && isset($_POST['modelo']) && isset($_POST['anio']) && isset($_POST['estado']) ) {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $estado = $_POST['estado'];
    

    // guarda la llamada de la funcion en la variable respuesta
    $respuesta = agregar_taxi($con, $matricula, $modelo, $anio, $estado);

    header('Content-Type: application/json');
    // devuelve la respuesta en formato JSON
    echo json_encode($respuesta);
    exit(); // asegura que no ejecute las peticiones por debajo
}


if (isset($_POST["user"]) && isset($_POST["contrasenia"])){

    $user = $_POST["user"];
    $contrasenia = $_POST["contrasenia"];

    header('Content-Type: application/json');

    logear($con, $user, $contrasenia);

    // echo json_encode($logear);
    // exit();
}


if (isset($_GET['cargar_viajes'])) {
    $datos_viaje = datos_tabla_viaje($con);
    var_dump($datos_viaje);
    foreach ($datos_viaje as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['Nombre_Taxista'] . "</td>";
        echo "<td>" . $fila['Nombre_Cliente'] . "</td>";
        echo "<td>" . $fila['matricula'] . "</td>";
        echo "<td>" . $fila['Fecha'] . "</td>";
        echo "<td>" . $fila['Método_de_pago'] . "</td>";
        echo "<td>" . $fila['Tarifa'] . "</td>";
        echo "</tr>";
    }
    exit();
}


//APLICAR FILTROS TABLA VIAJES
// Recibir los valores de turno y fecha desde AJAX
$turno = isset($_POST['turno']) ? $_POST['turno'] : '';
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

// Obtener los filtros de turno y fecha
$filtros = filtrar_viajes_por_turno_y_fecha($con, $turno, $fecha);

// Concatenar los filtros a tu consulta base
$consulta_base = "SELECT 
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

// Agregar los filtros al final de la consulta base
$consulta_completa = $consulta_base . $filtros;

// Ejecutar la consulta
$resultado = mysqli_query($con, $consulta_completa);

// Generar la tabla con los resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    echo '<table border="1">
            <tr>
                <th>Taximetrista</th>
                <th>Cliente</th>
                <th>Matrícula</th>
                <th>Fecha del Viaje</th>
                <th>Método de Pago</th>
                <th>Ingreso</th>
            </tr>';

    // Rellenar la tabla con los datos
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr>
                <td>' . $fila['Nombre_Taxista'] . '</td>
                <td>' . $fila['Nombre_Cliente'] . '</td>
                <td>' . $fila['matricula'] . '</td>
                <td>' . $fila['fecha_viaje'] . '</td>
                <td>' . $fila['Método_de_pago'] . '</td>
                <td>' . $fila['ingreso'] . '</td>
              </tr>';
    }

    echo '</table>';
} else {
    echo "No hay resultados para los filtros seleccionados.";
}
