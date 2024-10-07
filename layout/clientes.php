<?php
// session_start();
//     if (!isset($_SESSION['user'])) {
//         header("Location: ../Register-Login/index.php");
//         exit;
//     }
?>
<html lang="es">
<link rel="stylesheet" href="../resources/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../resources/ajax.js"></script>
<body id="body-home">
    <main>
    <div class="respuestaAJAX">
        <p class="mensajeResult"></p>
    </div>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        $datos_clientes = mostrar_datos_cliente($con);
        $cantidad_clientes = cantidad_clientes($con);
        ?>

        <div class="div-addCliente">
            <h1>Clientes</h1>
            <div class="div-cantidad-clientes">
                <button class="btn-abrir-modal boton-add-cliente">Añadir cliente</button>
                <!-- <h3 class="total-clientes">Total de clientes: <?php echo $cantidad_clientes; ?></h3> -->
            </div>
        </div>

        <dialog class="modal">
            <div>
                <h2>Agregar Nuevo Cliente</h2>
            </div>
            <form id="form-add-cliente" class="formulario" method="post">
            <div class="div-labels-forms">
                <label>Nombre<input type="text" name="NombreNuevo_Cliente" id="NombreNuevo_Cliente"></label>
                <label>Apellido<input type="text" name="ApellidoNuevo_Cliente" id="ApellidoNuevo_Cliente"></label>
            </div>
            <div class="div-labels-forms">    
                <label>Telefono<input type="number" name="TelefonoNuevo_Cliente" id="TelefonoNuevo_Cliente"></label>
                <label>Direccion<input type="text" name="DireccionNuevo_Cliente" id="DireccionNuevo_Cliente"></label>
            </div>    
            <div class="div-labels-forms">
                <label>Deuda<input type="number" name="DeudaNuevo_Cliente" id="DeudaNuevo_Cliente"></label>
                <button type="submit">Enviar</button>
            </div>    
                <button class="btn-cerrar-modal" type="button">Cerrar modal</button>
            </form>
        </dialog>

        <div class="tabla-clientes">
            <table>
                <thead>
                    <tr class="columnas-tabla-clientes">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Deuda</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos_clientes as $fila) { ?>
                        <tr>
                            <td><?php echo $fila['Nombre']; ?></td>
                            <td><?php echo $fila['Apellido']; ?></td>
                            <td><?php echo $fila['Telefono']; ?></td>
                            <td><?php echo $fila['Direccion']; ?></td>
                            <td><?php echo $fila['Deuda']; ?></td>
                            <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera" onclick="eliminarCliente(<?php echo $fila['ID']; ?>)"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </main>

    <div class="sidebar-container">
        <div class="div-usuario">
            <h1 class="user-name">Usuario</h1>
            <p class="user-num">+598 92112906</p>
        </div>
        <div class="menu-container">
            <nav>
                <a href="home.php" class="a-menu">
                    <img src="../resources/img/Iconos-SVG/white/home.svg">Panel
                </a>
                <a href="viajes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/bookmark.svg">Viajes</a>
                <a href="clientes.php" class="a-menu"><img
                        src="../resources/img/Iconos-SVG/white/cliente.svg">Clientes</a>
                <a href="taxistas.php" class="a-menu"><img
                        src="../resources/img/Iconos-SVG/white/driver.svg">Taximetristas</a>
                <a href="ingresos.php" class="a-menu"><img
                        src="../resources/img/Iconos-SVG/white/ingresos.svg">Ingresos</a>
                <a href="taxis.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/taxi.svg">Taxis</a>
            </nav>
        </div>
        <div class="config-container">
            <nav>
                <a href="configuracion.php" class="a-menu">
                    <img src="../resources/img/Iconos-SVG/white/setting.svg">Configuracion</a>
            </nav>
        </div>
    </div>

    <script src="../resources/script.js"></script>
</body>

</html>
