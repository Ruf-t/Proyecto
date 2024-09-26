<?php
// session_start();
//     if (!isset($_SESSION['user'])) {
//         header("Location: ../Register-Login/index.php");
//         exit;
//     }
?>
<html lang="es">
<link rel="stylesheet" href="../resources/style.css">
<body id="body-home">
    <main>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        $datos_clientes = mostrar_datos_cliente($con);
        ?>

        <div class="div-addCliente">
    <h1>Clientes</h1>
    <button class="btn-abrir-modal boton-add-cliente">Añadir cliente</button>
</div>

<dialog class="modal">
    <div>
        <h2>Agregar Nuevo Cliente</h2>
    </div>
    <form class="formulario" method="post">
        <label>Tu nombre<input type="text" name="nombre"></label>
        <label>Tu correo<input type="email" name="correo"></label>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda quasi incidunt ratione natus nostrum? Natus quas distinctio impedit voluptates numquam hic quia odit, veritatis tempora nostrum dicta laborum, et maiores!</p>
        <button type="submit">Enviar</button>
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
                            <td></td>
                            <!-- <td><?php echo $fila['Deuda']; ?></td> -->
                            <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera" onclick="eliminarCliente(<?php echo $fila['ID']; ?>)"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
            <div class="div-cantidad-clientes">
                <h3 class="total-clientes">Total de clientes: $5</h3>
                <div class="div-paginas">
                    <button class="pasar-paginas" onclick="activarBoton('1')"><img
                            src="../resources/img/Iconos-SVG/icons-others/flecha-menorque.svg"></button>
                    <button class="paginas active" onclick="cambioColorBoton(this)">1</button>
                    <button class="paginas">2</button>
                    <button class="pasar-paginas" onclick="activarBoton('2')"><img
                            src="../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
                </div>
            </div>
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
