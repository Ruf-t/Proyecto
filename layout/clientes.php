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
            <h1 id="h1_clientes"></h1>
            <div class="div-cantidad-clientes">
                <button class="btn-abrir-modal boton-add-cliente" id="btn_abrir_modal_cliente"></button>
                <!-- <h3 class="total-clientes">Total de clientes: <?php echo $cantidad_clientes; ?></h3> -->
            </div>
        </div>

        <dialog class="modal">
            <div class="div-titulo-modal">
                <h2 id="h2_agregar_cliente"></h2> 
                <button class="btn-cerrar-modal"><img src="../resources/img/Iconos-SVG/icons-others/cruz-exit.svg"></button>
            </div>
            <form id="form-add-cliente" class="formulario" method="post">
            <div class="div-labels-forms">    
                <label><span id="label_nombre"></span><input type="text" name="NombreNuevo_Cliente" id="NombreNuevo_Cliente"></label>
                <label><span id="label_apellido"></span><input type="text" name="ApellidoNuevo_Cliente" id="ApellidoNuevo_Cliente"></label>
            </div>
            <div class="div-labels-forms">    
                <label><span id="label_telefono"></span><input type="number" name="TelefonoNuevo_Cliente" id="TelefonoNuevo_Cliente"></label>
                <label><span id="label_deuda"></span><input type="number" name="DeudaNuevo_Cliente" id="DeudaNuevo_Cliente"></label>
            </div>    
            <div class="div-labels-forms">
                <label><span id="label_direccion"></span><input type="text" name="DireccionNuevo_Cliente" id="DireccionNuevo_Cliente"></label>
            </div>  
            <div class="div-labels-forms">  
                <button type="submit" id="btn_enviar_cliente"></button>
            </div>
            </form>
        </dialog>

        <div class="tabla-clientes">
            <table>
                <thead>
                    <tr class="columnas-tabla-clientes">
                        <th id="th_nombre"></th>
                        <th id="th_apellido"></th>
                        <th id="th_telefono"></th>
                        <th id="th_direccion"></th>
                        <th id="th_deuda"></th>
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
            <img src="../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-7B.svg">
        </div>
        <div class="menu-container">
            <nav><span>
                <a href="home.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/home.svg"><span id="home_menu">Panel</span></a>
                <a href="viajes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/bookmark.svg"><span id="viajes_menu">Viajes</span></a>
                <a href="clientes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/cliente.svg"><span id="clientes_menu">Clientes</span></a>
                <a href="taxistas.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/driver.svg"><span id="taxistas_menu">Taxistas</span></a>
                <a href="ingresos.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/ingresos.svg"><span id="ingresos_menu">Ingresos</span></a>
                <a href="taxis.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/taxi.svg"><span id="taxis_menu">Taxis</span></a>
                <a href="configuracion.php" class="a-menu btn-config"><img src="../resources/img/Iconos-SVG/white/setting.svg"><span id="config_menu">Configuracion</span></a>
            </nav>
        </div>
    </div>

    <script src="../resources/script.js"></script>
</body>

</html>
