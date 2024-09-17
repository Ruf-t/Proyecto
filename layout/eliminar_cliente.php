<?php

include ('conexionBD.php');

require_once 'C:\xampp\htdocs\Proyecto\BaseDatos\functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'];

    if (eliminar_cliente($con, $id_cliente)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
