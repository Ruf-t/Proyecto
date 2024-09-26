<?php
// session_start();
//     if (!isset($_SESSION['user'])) {
//         header("Location: ../Register-Login/index.php");
//         exit;
//     }
?>
<link rel="stylesheet" href="../resources/style.css">

<body id="body-home">
    <main>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        $datos_viaje = datos_tabla_viaje($con);
        ?>

        <div class="btn-select-turno-fecha">
            <div class="selects">
                <select>
                    <option value="" selected disabled>Selecciona un turno</option>
                    <option>Turno 1</option>
                    <option>Turno 2</option>
                </select>
                <select>
                    <option value="" selected disabled>Selección de fechas</option>
                    <option>Hoy</option>
                    <option>Hace un dia</option>
                    <option>Esta semana</option>
                    <option>Este mes</option>
                    <option>Ultimos 6 meses</option>
                    <option>Fecha personalizada</option>
                </select>
            </div>
        </div>

        <div class="div-tabla-panel">
            <table id="table-panel">
        <div class="div-tabla-panel">
            <table id="tabla-panel">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Número de coche</th>
                        <th>Fecha Viaje</th>
                        <th>Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($datos_viaje as $fila) { ?>
                    <tr>
                        <td><?php echo $fila['Nombre_Taxista']; ?></td>
                        <td><?php echo $fila['Nombre_Cliente'];?></td> 
                        <td><?php echo $fila['matricula']; ?></td>    
                        <td><?php echo $fila['Fecha']; ?></td>    
                        <td><?php echo $fila['Método_de_pago']; ?></td>    
                        <td><?php echo $fila['Tarifa']; ?></td>
                    </tr>
                <?php } ?>
                </tr> 
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
                <a href="clientes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/cliente.svg">Clientes</a>
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